<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SettingController extends BaseController
{
    /**
     * /about page index.
     *
     * @return View
     */
    public function index(): View
    {
        $data = settingData();
        return view('setting', compact('data'));
    }

    /**
     * updating data on settings table.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function update(Request $request): RedirectResponse
    {
        $setting = $request->input('data');

        foreach ($setting as $key => $v) {

            $searchSetting = Setting::whereName($key)->first();
            $searchSetting->value = $v;
            $searchSetting->save();
        };

        return redirect('/about');
    }
}
