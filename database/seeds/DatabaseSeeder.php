<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $this->call(DesignationSeed::class);
        $this->call(RoleSeed::class);
        $this->call(TrainingSeed::class);
        $this->call(UserSeed::class);
        $this->call(UserActionSeed::class);

    }
}
