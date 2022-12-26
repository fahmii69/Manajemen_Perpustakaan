<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class IdentitasController extends BaseController
{
    /**
     * /about page index.
     *
     * @return View
     */
    public function index(): View
    {
        $data = identitasAplikasi();
        return view('identitas', compact('data'));
    }

    /**
     * updating data on settings table.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function update(Request $request): RedirectResponse
    {
        $identitas = $request->input('data');

        foreach ($identitas as $key => $v) {

            $searchIdentitas = Setting::whereName($key)->first();
            $searchIdentitas->value = $v;
            $searchIdentitas->save();
        };

        return redirect('/about');
    }
}
