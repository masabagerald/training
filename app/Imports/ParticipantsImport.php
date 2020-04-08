<?php

namespace App\Imports;

use App\Participant;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ParticipantsImport implements ToModel,WithBatchInserts,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Participant([

            'pin'  => $row['trainee_number'],
            'first_name'  => $row['first_name'],
            'middle_name' => $row['middle_name'],
            'sex' => $row['sex'],
            'job_title_id' => $row['job_title'],
            'mobile'  => $row['phone_number'],
             'health_facility' => $row['facility'],
            'last_name'    => $row['surname'],
             'district'  => $row['district'],






        ]);

    }

    /**
     * @return int
     */
    public function batchSize(): int
    {
        return 1000;
    }
}
