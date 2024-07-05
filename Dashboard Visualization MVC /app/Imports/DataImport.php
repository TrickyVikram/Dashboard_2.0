<?php
namespace App\Imports;

use App\Models\Data;
use Maatwebsite\Excel\Concerns\ToModel;

class DataImport implements ToModel
{
    public function model(array $row)
    {
        return new Data([


        ]);
    }
}
