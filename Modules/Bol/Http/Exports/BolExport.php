<?php

namespace App\Exports;

use App\Bol_data;
use Maatwebsite\Excel\Concerns\FromCollection;

class BolExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Bol_data::all();
    }
}
