<?php

namespace Database\Seeders;

use App\Models\Param;
use App\Models\ParamValue;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ParamsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $home = User::where('email', 'domy@domy.com')->first()->homes[0];

        $param = Param::create([
            'key' => 'connections.philipshue.bridgeip',
        ]);
        ParamValue::create([
            'param_id' => $param->id,
            'linked_id' => $home->id,
            'linked_type' => 'App\Models\Home',
            'value' => '192.168.1.72'
        ]);

        $param = Param::create([
            'key' => 'connections.philipshue.bridgeuser',
        ]);
        ParamValue::create([
            'param_id' => $param->id,
            'linked_id' => $home->id,
            'linked_type' => 'App\Models\Home',
            'value' => '3O5OdwX6eTTVNUnqwlRHrHZSCox6JeaZHPYdzQRr'
        ]);

    }
}
