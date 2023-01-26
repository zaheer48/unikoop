<?php

namespace App\Http\Controllers;

use Mollie\Laravel\Facades\Mollie;
use Illuminate\Http\Request;
use Session;
use Config;
use Auth;
use DB;
use App\Models\User;
use App\Models\Notification;
use Mail;

class MollieController extends Controller
{
    public function rechargeWallet(Request $request)
    {
        $this->validate($request, [
            'amount' => 'numeric'
        ]);
        $mollie_status = DB::table('payment_methods')->where('status',1)->first();
        if(!empty($mollie_status)) {
            if ($request->payment_type == 'mollie') {
                if ($request->amount > 999) {
                    Session::flash('alert-warning', 'You have exceeded from max amount limit. Limit is 999.');
                    return back();
                }

                (string)$count = DB::table('transaction_histories')->count() + 1;
                $amount = number_format($request->amount, 2);
                Session::put('amount', $amount);
                Session::put('desc', $request->description);
                $payment = Mollie::api()->payments->create([
                    "amount" => [
                        "currency" => "EUR",
                        "value" => (string)$amount
                    ],
                    "description" => "Recharge #" . $count,
                    "redirectUrl" => route('mollio.success.payment'),
                    "webhookUrl" => route('webhooks.mollie'),
                    "metadata" => [
                        "order_id" => $count
                    ],
                ]);
                $payment = Mollie::api()->payments->get($payment->id);
                $payment_id = $payment->id;

                \Session::put('payment_id', $payment_id);

                return redirect($payment->getCheckoutUrl(), 303);
            } elseif($request->payment_type == "bankTransfer"){
                $amount = number_format($request->amount, 2);
                $desc = $request->description;
                $bank_obj = [
                    'payment_id'=>rand(1,2000),
                    'description'=>$desc,
                    'amount' => $request->amount,
                    'paid_at'=>date('Y-m-d H:i:s'),
                    'payment_method'=>'Bank Transfer'
                ];
                $id = DB::table('transaction_histories')->insertGetId([
                    'user_id' => Auth::id(),
                    'amount' => $amount,
                    'description' => $desc,
                    'summary' => json_encode($bank_obj),
                    'created_at' => now()
                ]);
                // notifications
                $obj = (object)array('transaction_id' => $id,'amount' => $request->amount,'description' => $desc);
                $bussiness_info = new Notification();
                $bussiness_info->user_id = Auth::id();
                $bussiness_info->type = 'wallet_recharge';
                $bussiness_info->data = json_encode($obj);
                $bussiness_info->save();

                $username = User::where('id',Auth::id())->first();
                $user = User::where('is_admin',1)->first();
                Mail::send(['html' => 'user.user_requests_email'], array('type'=>'wallet_toadmin','username' =>$username->username , 'amount' => $amount,'description' => $desc),
                    function ($message) use ($user) {
                        $message->to($user->email)->subject
                        ('User Query');
                        $message->from('online@unikoop.nl');
                    });

                Session::forget('amount');
                Session::forget('desc');
                Session::flash('success','Your wallet has been credited, please stay tuned for approval');
                return  redirect()->back();
            }
        }
        else{
            Session::flash('alert-warning', 'Mollie Payment gateway is turned OFF for some time please stay tuned with us .');
            return back();
        }
    }

    public function handle(Request $request)
    {
        Session::flash('alert-warning','Your Cancelled has been Failed');
        return  redirect()->back();
    }

    public function successPayment(Request $request)
    {
        $request_id = $request->session()->get('payment_id');
        $payment = Mollie::api()->payments()->get($request_id);

        if ($payment->isPaid()) {
            $paymentId = $payment->id;
            $amount = $payment->amount->value;
            $currency = $payment->amount->currency;
            $description = $payment->description;
            $method = $payment->method;
            $created = $payment->createdAt;
            $paid = $payment->paidAt;
            $card_no = $payment->details->cardNumber;
            $card_holder = $payment->details->cardHolder;
            $audience = $payment->details->cardAudience;
            $label = $payment->details->cardLabel;
            $country_code = $payment->details->cardCountryCode;
            $array = array('payment_id' => $paymentId,'amount' => $amount,'currency' => $currency,'description' => $description,'payment_method' => $method,'created_at' => $created,'paid_at' => $paid,'card_number' => $card_no,'card_holder' => $card_holder,'card_audience' => $audience,'card_label' => $label,'country_code' => $country_code);
            $mollie_obj = (object)$array;

            $charges = Session::get('amount');
            $desc = Session::get('desc');
            Session::forget('amount');
            Session::forget('desc');
            // transactions
            $id = DB::table('transaction_histories')->insertGetId([
                'user_id' => Auth::id(),
                'amount' => $charges,
                'description' => $desc,
                'summary' => json_encode($mollie_obj),
                'created_at' => now()
            ]);

            // notifications
            $obj = (object)array('transaction_id' => $id,'amount' => $amount,'description' => $desc);
            $bussiness_info = new Notification();
            $bussiness_info->user_id = Auth::id();
            $bussiness_info->type = 'wallet_recharge';
            $bussiness_info->data = json_encode($obj);
            $bussiness_info->save();

            $username = User::where('id',Auth::id())->first();
            $user = User::where('is_admin',1)->first();
            Mail::send(['html' => 'user.user_requests_email'], array('type'=>'wallet_toadmin','username' =>$username->username , 'amount' => $amount,'description' => $desc),
                function ($message) use ($user) {
                    $message->to($user->email)->subject
                    ('User Query');
                    $message->from('online@unikoop.nl');
                });

            Session::forget('amount');
            Session::forget('desc');
            Session::flash('success','Your wallet has been credited, please stay tuned for approval');
            return  redirect()->back();
        } elseif ($payment->isPending()) {
            Session::flash('alert-warning','Your Payment has set to pending, wallet not recharged.');
        } elseif ($payment->isFailed()) {
            Session::flash('alert-warning','Your Payment has been failed, wallet not recharged.');
        } elseif ($payment->isExpired()) {
            Session::flash('alert-warning','Your Payment has been expired, wallet not recharged.');
        } elseif ($payment->isCanceled()) {
            Session::flash('alert-warning','Your Payment has been cancelled, wallet not recharged.');
        }

        return  redirect()->back();
    }

    public function walletInvoice($id)
    {
        $transaction = \DB::table('transaction_histories')->where('id',$id)->first();
        $user = \DB::table('users')->where('id',$transaction->user_id)->first();
        $pdf = \PDF::loadView('userwallet.wallet_invoice', compact('transaction','user'));
        $file = 'transaction#'.$transaction->id.'.pdf';
        return $pdf->download($file);
    }

    public function paymentInvoice($id)
    {
        $transaction = \DB::table('transaction_histories')->where('id',$id)->first();
        $user = \DB::table('users')->where('id',$transaction->user_id)->first();
        $pdf = \PDF::loadView('payment-history.payment_invoice', compact('transaction','user'));
        $file = 'transaction#'.$transaction->id.'.pdf';
        return $pdf->download($file);
    }
}