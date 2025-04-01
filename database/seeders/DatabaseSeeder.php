<?php

namespace Database\Seeders;

// use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    // public function run(): void
    // {
    //     // User::factory(10)->create();

    //     User::factory()->create([
    //         'name' => 'Test User',
    //         'email' => 'test@example.com',
    //     ]);
    // }

    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'Admin',
                'username' => 'admin',
                'email' => 'admin@example.com',
                'password' => Hash::make('password'),
                'email' => 'admin',
            ],
            [
                'name' => 'Yanul',
                'username' => 'manager',
                'email' => 'test@example.com',
                'password' => Hash::make('password'),
                'email' => 'manager',
            ],
        ]);

        DB::table('bahan_baku')->insert([
            [
                'id' => 'BB001',
                'nama' => 'Pipa 38',
                'jenis' => 'pipa',
                'minimal' => 20,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 'BB002',
                'nama' => 'Pipa 28',
                'jenis' => 'pipa',
                'minimal' => 20,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 'BB003',
                'nama' => 'Ninja FI',
                'jenis' => 'pureng',
                'minimal' => 20,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 'BB004',
                'nama' => 'Ninja FI',
                'jenis' => 'Plendes',
                'minimal' => 20,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 'BB005',
                'nama' => 'Matic',
                'jenis' => 'pureng',
                'minimal' => 20,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 'BB00',
                'nama' => 'Matic',
                'jenis' => 'plendes',
                'minimal' => 20,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        DB::table('barang_jadi')->insert([
            [
                'id' => 'BJ001',
                'nama' => 'MP 35-38 Uripan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 'BJ002',
                'nama' => 'MP 35-38 Paten',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 'BJ003',
                'nama' => 'MP Full 38 Paten',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 'BJ004',
                'nama' => 'MP Full 35 Paten',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 'BJ005',
                'nama' => 'Tiger Full 38 Paten',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 'BJ006',
                'nama' => 'Tiger 35-38 Paten',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        DB::table('barang_setengah_jadi')->insert([
            [
                'id' => 'BSJ001',
                'nama' => 'MP 35-38 Uripan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 'BSJ002',
                'nama' => 'MP 35-38 Paten',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 'BSJ003',
                'nama' => 'MP Full 38 Paten',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 'BSJ004',
                'nama' => 'MP Full 35 Paten',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 'BSJ005',
                'nama' => 'Tiger Full 38 Paten',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 'BSJ006',
                'nama' => 'Tiger 35-38 Paten',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        DB::table('potongan')->insert([
            [
                'nama' => 'Potongan 1',
                'bahan_baku_id' => 'BB001',
                'angka_potong' => 10,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Potongan 2',
                'bahan_baku_id' => 'BB002',
                'angka_potong' => 15,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Potongan 3',
                'bahan_baku_id' => 'BB003',
                'angka_potong' => 20,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Potongan 4',
                'bahan_baku_id' => 'BB004',
                'angka_potong' => 25,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Potongan 5',
                'bahan_baku_id' => 'BB005',
                'angka_potong' => 30,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Potongan 6',
                'bahan_baku_id' => 'BB001',
                'angka_potong' => 35,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Potongan 7',
                'bahan_baku_id' => 'BB002',
                'angka_potong' => 40,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Potongan 8',
                'bahan_baku_id' => 'BB003',
                'angka_potong' => 45,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Potongan 9',
                'bahan_baku_id' => 'BB004',
                'angka_potong' => 50,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Potongan 10',
                'bahan_baku_id' => 'BB005',
                'angka_potong' => 55,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
