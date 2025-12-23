<?php

namespace Database\Seeders;

use App\Models\Inventaris;
use Illuminate\Database\Seeder;

class InventarisSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['nama' => 'Laptop Dell XPS', 'kondisi' => 5, 'jumlah' => 12, 'tahun' => 2023, 'status' => 'Layak', 'status_val' => 1],
            ['nama' => 'Proyektor Epson', 'kondisi' => 2, 'jumlah' => 5, 'tahun' => 2018, 'status' => 'Perlu Diganti', 'status_val' => 0],
            ['nama' => 'Meja Kantor Kayu', 'kondisi' => 4, 'jumlah' => 50, 'tahun' => 2021, 'status' => 'Layak', 'status_val' => 1],
            ['nama' => 'Kursi Staff', 'kondisi' => 1, 'jumlah' => 20, 'tahun' => 2015, 'status' => 'Perlu Diganti', 'status_val' => 0],
            ['nama' => 'AC Panasonic 2PK', 'kondisi' => 3, 'jumlah' => 8, 'tahun' => 2019, 'status' => 'Perawatan', 'status_val' => 0.5],
            ['nama' => 'Printer HP LaserJet', 'kondisi' => 5, 'jumlah' => 3, 'tahun' => 2023, 'status' => 'Layak', 'status_val' => 1],
            ['nama' => 'Router Cisco', 'kondisi' => 4, 'jumlah' => 10, 'tahun' => 2020, 'status' => 'Layak', 'status_val' => 1],
            ['nama' => 'Lemari Arsip Besi', 'kondisi' => 2, 'jumlah' => 15, 'tahun' => 2010, 'status' => 'Perlu Diganti', 'status_val' => 0],
        ];

        foreach ($data as $item) {
            Inventaris::create($item);
        }
    }
}