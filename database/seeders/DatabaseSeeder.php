<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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
        DB::table('users')->insert([
            [
                'name' => 'Admin',
                'nis' => '-',
                'tahun_ajaran' => '-',
                'email' => 'admin@admin.com',
                'password' => Hash::make('12345678'),
                'is_admin' => true,
                'is_verified' => true
            ]
        ]);

        $this->call([
            CategorySeeder::class,
            BookSeeder::class,
            InventorySeeder::class,
            GuestSeeder::class,
            DamagedBookSeeder::class,
            TeacherSeeder::class,

            
        ]);
    }
}
