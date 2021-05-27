<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $usr = User::create([
            'name' => 'Administrator',
            'empID' => 'ADMIN-00123',
            'email' => 'admin@bt.bt',
            'password' => Hash::make('12345678'),
        ]);
        $usr->attachRole('admin');
    }
}
