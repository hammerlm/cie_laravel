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
        $userlist = \App\User::all();
        for($i = 0; $i < count($userlist); $i++) {
            $hashpart = substr(\Illuminate\Support\Facades\Hash::make($i),8,10);
            echo $userlist[$i]->name . " -> " . $hashpart . " \n";
            $userlist[$i]->password = \Illuminate\Support\Facades\Hash::make($hashpart);
            $userlist[$i]->save();
        }

    }
}
