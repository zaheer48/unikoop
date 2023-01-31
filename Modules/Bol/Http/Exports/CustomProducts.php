<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use App\CustomOrder;
use Auth;

class CustomProducts implements FromCollection
{
    public function collection()
    {
        return CustomOrder::where('user_id',Auth::id())->all();
    }
}
