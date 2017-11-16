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
        /*
        $gdlist = \App\Gameday::all();
        for($i = 0; $i < count($gdlist); $i++) {
            $gdlist[$i]->playercount_redundant = $gdlist[$i]->playercount_redundant - $gdlist[$i]->goaliecount_redundant;
            $gdlist[$i]->save();
        }
        */
    }
}
