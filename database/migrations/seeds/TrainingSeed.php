<?php

use Illuminate\Database\Seeder;

class TrainingSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            
            ['id' => 1, 'region' => 'Uganda', 'venue' => 'cafe azivia', 'start_date' => '02-03-2019', 'end_date' => '03-03-2019', 'type_of_training' => 'dialec', 'sponsor' => 'cdc', 'comments' => null,],

        ];

        foreach ($items as $item) {
            \App\Training::create($item);
        }
    }
}
