<?php

use App\Models\Setting;
use App\Models\Transaksi\PeminjamanBuku;
use Carbon\Carbon;

if (!function_exists('getSetting')) {
    function getSetting($key)
    {
        return Setting::whereName($key)->first()->value;
    }
}

if (!function_exists('getDescription')) {
    function getDescription($key)
    {
        return Setting::whereName($key)->first()->description;
    }
}

if (!function_exists('getDenda')) {
    function getDenda($pengembalian)
    {
        $startDate = Carbon::parse($pengembalian->updated_at);
        $endDate = Carbon::parse($pengembalian->tgl_kembali);

        $days = $startDate->diffInDays($endDate);
        $denda = 0;
        if ($days > 7) {
            $denda = getSetting('nominal_denda');
        };

        return $denda;
    }

    if (!function_exists('getTotalDenda')) {
        function getTotalDenda($pengembalian)
        {
            $total = 0;
            $denda = $pengembalian->denda;
            $hilang = $pengembalian->hilang;
            $total = $denda + $hilang;


            return $total;
        }
    }

    if (!function_exists('identitasAplikasi')) {
        function identitasAplikasi()
        {
            $data = [
                'nama_perpus',
                'alamat',
                'email',
                'telepon',
                'nominal_denda',
            ];

            return $data;
        }
    }

    // }
}
