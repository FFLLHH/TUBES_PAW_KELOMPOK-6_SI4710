<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Shop;
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
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // Create default admin account
        $admin = User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'admin'
        ]);

        // Create default customer account
        User::create([
            'name' => 'pengguna',
            'email' => 'pengguna@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'customer'
        ]);

        // Create default shop data
        Shop::create([
            'user_id' => $admin->id,
            'name_shop' => 'TJ Mart',
            'email' => 'tjmart@telkomuniversity.ac.id',
            'phone' => '08123456789',
            'address' => 'Telkom University',
            'desc' => 'TJ Mart adalah toko online yang menyediakan berbagai macam kebutuhan mahasiswa Telkom University',
            'path' => 'logos/tj-logo.png'
        ]);

        // Create default courier accounts
        \App\Models\User::firstOrCreate([
            'email' => 'kurir1@example.com',
        ], [
            'name' => 'kurir 1',
            'password' => bcrypt('password'),
            'role' => 'kurir',
        ]);
        \App\Models\User::firstOrCreate([
            'email' => 'kurir2@example.com',
        ], [
            'name' => 'kurir 2',
            'password' => bcrypt('password'),
            'role' => 'kurir',
        ]);
        \App\Models\User::firstOrCreate([
            'email' => 'kurir3@example.com',
        ], [
            'name' => 'kurir 3',
            'password' => bcrypt('password'),
            'role' => 'kurir',
        ]);
    }
}
