<?php

namespace Database\Seeders;

use App\Jobs\PhilipsHueDataDownload;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DevicesTypesRoomsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::where('email', 'domy@domy.com')->first();
        $home = $user->homes[0];

        PhilipsHueDataDownload::dispatch($home);
    }
}
