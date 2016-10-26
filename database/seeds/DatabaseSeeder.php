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
        $location = new \App\Location();
        $location->name = "Radenthein";
        $location->description = "Die Nockhalle in Radenthein wurde erst 2008 errichtet.";
        $location->save();
        $location2 = new \App\Location();
        $location2->name = "Villach";
        $location2->description = "Stadthalle in Villach";
        $location2->save();
        $location3 = new \App\Location();
        $location3->name = "Steindorf";
        $location3->description = "Ossiacher-See-Halle in Steindorf";
        $location3->save();
    }
}
