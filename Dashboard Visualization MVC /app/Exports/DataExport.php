<?php

namespace App\Exports;

use App\Models\Data;
use Illuminate\Support\Facades\Schema;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DataExport implements FromCollection, WithHeadings
{
    protected $attributes;

    public function __construct()
    {

        $this->attributes = Schema::getColumnListing((new Data())->getTable());
    }

  
    public function collection()
    {

        return Data::select($this->attributes)->get();
    }


    public function headings(): array
    {

        return $this->attributes;
    }
}
