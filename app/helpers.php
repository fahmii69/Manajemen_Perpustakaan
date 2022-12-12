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

if (!function_exists('getDenda')) {
    function getDenda($peminjaman)
    {
        $startDate = Carbon::parse($peminjaman->updated_at);
        $endDate = Carbon::parse($peminjaman->tgl_kembali);

        $days = $startDate->diffInDays($endDate);
        $denda = 0;
        if ($days > 1) {
            $denda = getSetting('nominal_denda');
        };

        return $denda;
    }
}
