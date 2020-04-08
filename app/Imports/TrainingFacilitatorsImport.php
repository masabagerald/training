<?php

namespace App\Imports;

use App\TrainingFacilitators;
use Maatwebsite\Excel\Concerns\ToModel;

class TrainingFacilitatorsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new TrainingFacilitators([
            //
        ]);
    }
}
