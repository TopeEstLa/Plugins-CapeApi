<?php

namespace Azuriom\Plugin\CapeApi\Controllers\Admin;

use Azuriom\Http\Controllers\Controller;
use Azuriom\Models\Setting;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Show the home admin page of the plugin.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('cape-api::admin.index', [
            'width' => setting('cape.width', 64),
            'height' => setting('cape.height', 64),
            'scale' => setting('cape.scale', 1),
        ]);
    }

    public function update(Request $request) {
        $settings = $this->validate($request, [
            'height' => 'required|integer|min:0',
            'width' => 'required|integer|min:0',
            'scale' => 'required|integer|min:0',
        ]);

        foreach ($settings as $name => $value) {
            Setting::updateSettings("cape.{$name}", $value);
        }

        return redirect()->route('cape-api.admin.home')
            ->with('success', trans('admin.settings.status.updated'));
    }
}