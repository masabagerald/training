<?php

namespace App\Imports;

use App\Designation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class JobTitlesImport implements ToModel,WithHeadingRow
{

    /**
     * @param array $row
     *
     * @return Model|Model[]|null
     */
    public function model(array $row)
    {
        return new Designation([
            'name'  => $row['job_title'],

        ]);

    }
}
