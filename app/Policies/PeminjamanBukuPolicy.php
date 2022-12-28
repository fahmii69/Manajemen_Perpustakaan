<?php

namespace App\Policies;

use App\Models\Transaksi\PeminjamanBuku;
use Illuminate\Auth\Access\Response;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PeminjamanBukuPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * make policy for update(pencil button)
     *
     * @param User|null $user
     * @param PeminjamanBuku $peminjaman
     * @return Response
     */
    public function update(?User $user, PeminjamanBuku $peminjaman): Response
    {
        return $user->id === $peminjaman->user_id
            ? Response::allow()
            : Response::deny("Peminjaman ini tidak dibuat oleh anda 😂");
    }
}
