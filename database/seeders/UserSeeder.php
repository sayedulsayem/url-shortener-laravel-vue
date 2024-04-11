<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::where('id', '>', 0)->delete();

        User::create([
            'name' => 'Sayem',
            'username' => 'sayem',
            'email' => 'sayem@gmail.com',
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make('sayem'),
        ]);
    }
}
