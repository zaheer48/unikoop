<?php

namespace App\Mail;
use App\BolPlazaClient;
use Auth;
use DB;
use View;
use PDF;
use Mail;
use \Milon\Barcode\DNS1D;
use Illuminate\Support\Facades\Hash;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class MyDemoMail extends Mailable
{
    use Queueable, SerializesModels;
    public $data;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
        $subj = $data['subject'];
        $this->subject = $subj;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(Request $request)
    {
        $subject = $this->subject;
        $mail = $this->from('online@unikoop.nl')->subject($subject)->view('emails.invoice2_mail')->with('data', $this->data);
        if($request->file('files')){
            foreach($request->file('files') as $attachment) {
                $attachments[] = [
                    'file' => $attachment->getRealPath(),
                    'options' => [
                        'mime' => $attachment->getClientMimeType(),
                        'as'    => $attachment->getClientOriginalName()
                    ],
                ];
            }
            foreach($attachments as $attachment) {
                $mail->attach($attachment['file'],$attachment['options']);
            }
        }
        if($this->data['pdf1'] != "")
            $mail->attachData($this->data['pdf1']->output(), $this->data['file1']);
        if($this->data['pdf2'] != "")
            $mail->attachData($this->data['pdf2']->output(), $this->data['file2']);
        return $mail;
    }
}