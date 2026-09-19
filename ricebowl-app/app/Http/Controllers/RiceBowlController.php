<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RiceBowlController extends Controller
{
        private $bases = [
        'nasi_putih' => ['nama' => 'Nasi Putih', 'harga' => 5000, 'icon' => '🍚'],
        'nasi_merah' => ['nama' => 'Nasi Merah', 'harga' => 7000, 'icon' => '🍙'],
        'nasi_kuning' => ['nama' => 'Nasi Kuning', 'harga' => 6000, 'icon' => '🍛'],
    ];

    private $proteins = [
        'ayam'   => ['nama' => 'Ayam Suwir', 'harga' => 10000, 'icon' => '🍗'],
        'telur'  => ['nama' => 'Telur Ceplok', 'harga' => 5000, 'icon' => '🍳'],
        'sosis'  => ['nama' => 'Sosis Goreng', 'harga' => 8000, 'icon' => '🌭'],
        'tahu'   => ['nama' => 'Tahu Crispy', 'harga' => 6000, 'icon' => '🥟'],
    ];

    private $levels = [
        'tidak_pedas' => ['nama' => 'Tidak Pedas', 'tambahan' => 0, 'icon' => '😌'],
        'sedang'      => ['nama' => 'Pedas Sedang', 'tambahan' => 1000, 'icon' => '🌶️'],
        'extra'       => ['nama' => 'Extra Pedas', 'tambahan' => 2000, 'icon' => '🔥'],
    ];

    public function index()
    {
        return view('ricebowl.form', [
            'bases'    => $this->bases,
            'proteins' => $this->proteins,
            'levels'   => $this->levels,
        ]);
    }

    public function order(Request $request)
    {
        $baseKey    = $request->input('base');
        $proteinKey = $request->input('lauk');
        $levelKey   = $request->input('level');
        $nama       = $request->input('nama');

        $base    = $this->bases[$baseKey];
        $lauk = $this->proteins[$proteinKey];
        $level   = $this->levels[$levelKey];

        $total = $base['harga'] + $lauk['harga'] + $level['tambahan'];

        return view('ricebowl.receipt', [
            'nama'    => $nama,
            'base'    => $base,
            'lauk' => $lauk,
            'level'   => $level,
            'total'   => $total,
        ]);
    }
}