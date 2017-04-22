<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class PangkatPegawaiTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('msPangkatPegawai')->truncate();
        $data = [
            [
                'nama' => 'Juru Muda',
                'golongan' => 'I/a',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'nama' => 'Juru Muda Tk. I',
                'golongan' => 'I/b',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'nama' => 'Juru',
                'golongan' => 'I/c',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'nama' => 'Juru Tk. I',
                'golongan' => 'I/d',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'nama' => 'Pengatur Muda',
                'golongan' => 'II/a',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'nama' => 'Pengatur Muda Tk. I',
                'golongan' => 'II/b',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'nama' => 'Pengatur',
                'golongan' => 'II/c',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'nama' => 'Pengatur Tk. I',
                'golongan' => 'II/d',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'nama' => 'Penata Muda',
                'golongan' => 'III/a',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'nama' => 'Penata Muda Tk. I',
                'golongan' => 'III/b',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'nama' => 'Penata',
                'golongan' => 'III/c',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'nama' => 'Penata Tk. I',
                'golongan' => 'III/d',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'nama' => 'Pembina',
                'golongan' => 'IV/a',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'nama' => 'Pembina Tk. I',
                'golongan' => 'IV/b',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'nama' => 'Pembina Utama Muda',
                'golongan' => 'IV/c',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'nama' => 'Pembina Utama Madya',
                'golongan' => 'IV/d',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'nama' => 'Pembina Utama',
                'golongan' => 'IV/e',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ];

        foreach ($data as $pangkat) {
            DB::table('msPangkatPegawai')->insert($pangkat);
        }

    }
}
