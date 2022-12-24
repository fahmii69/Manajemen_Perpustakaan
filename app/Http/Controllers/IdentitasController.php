<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class IdentitasController extends BaseController
{
    public function index()
    {
        $data = identitasAplikasi();
        return view('identitas', compact('data'));
    }

    public function update(Request $request)
    {
        // dd($request->all());
        // dd($data);
        // $data = $request->key;
        // $waw = $request->except('_method', '_token');

        // $data = $request->alamat;
        foreach ($request->except('_method', '_token') as $key => $data) {
            // $gas = $request->$key;
            $save = $key = $data;
            dd($save);

            // $setting = $this->settings->value = $data;
            // $setting->update();
            // dd($setting);
            // $setting->value = $v;
            // $data->update();
        };
        $save->update();
    }
}
