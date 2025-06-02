<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Shop;
use App\Models\User;

class ShopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Get admin user
        $admin = User::where('role', 'admin')->first();

        // Create default shop
        Shop::create([
            'user_id' => $admin->id,
            'name_shop' => 'TJ Mart',
            'email' => 'tjmart@telkomuniversity.ac.id',
            'phone' => '08123456789',
            'address' => 'Telkom University',
            'desc' => 'TJ Mart adalah toko online yang menyediakan berbagai macam kebutuhan mahasiswa Telkom University',
            'path' => 'logos/tj-logo.png'
        ]);
    }
} 