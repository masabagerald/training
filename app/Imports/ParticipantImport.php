<?php

namespace App\Imports;

use App\Participant;
use App\Training;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use PhpOffice\PhpSpreadsheet\Worksheet\AutoFilter\Column\Rule;

class ParticipantImport implements ToCollection,WithHeadingRow
{

    use Importable;

   /*private $data;


    public function __construct($data)
    {

        $this->data = $data;

    }*/

    public function collection(Collection $rows)
    {
        $pins = Participant::all('pin')->toArray();


        foreach ($rows as $row){
            if(!isset($row[0]))


                continue;


            //skip numbers previously added
            if(in_array($row[0],$pins))


                continue;




            Participant::firstOrCreate([
                'pin'=>$row['Pin'],
                'first_name'=>$row['Fname'],
                'middle_name'=>$row['Mname'],
                'last_name'=>$row['Lname'],
                'mobile'=>$row['Mobile'],
                'sex'=>$row['Sex'],
                'dob'=>$row['Dob'],
                'health_facility'=>$row['Facility'],


            ]);


            $pins[] = $row[0];



        }
    }



}
