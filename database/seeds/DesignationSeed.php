<?php

use Illuminate\Database\Seeder;

class DesignationSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            
            ['id' => 1, 'name' => 'it officer',],

        ];

        foreach ($items as $item) {
            \App\Designation::create($item);
        }
    }
}
