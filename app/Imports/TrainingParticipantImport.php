<?php

namespace App\Imports;

use App\TrainingParticipants;
use Maatwebsite\Excel\Concerns\ToModel;

class TrainingParticipantImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new TrainingParticipants([
            //
        ]);
    }
}
