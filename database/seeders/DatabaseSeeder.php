<?php

namespace Database\Seeders;

use Filament\Facades\Filament;
use Filament\Models\Contracts\FilamentUser;
use Illuminate\Auth\EloquentUserProvider;
use Illuminate\Auth\SessionGuard;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        /** @var SessionGuard $auth */
        $auth = Filament::auth();

        /** @var EloquentUserProvider $userProvider */
        $userProvider = $auth->getProvider();

        $userModel = $userProvider->getModel();

        $user = $userModel::create([
           'email'=>'admin@bfo.ch',
           'name'=>'admin@bfo.ch',
           'password'=>Hash::make('admin@bfo.ch'),
        ]);

    }
}
