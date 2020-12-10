<?php

namespace Azuriom\Plugin\CapeApi\Controllers;

use Azuriom\Http\Controllers\Controller;
use Azuriom\Plugin\CapeApi\CapeAPI;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CapeApiController extends Controller
{
    /**
     * Show the home plugin page.
     *
     * @param  \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('cape-api::index', [
            'skinUrl' => route('cape-api.api.show', $request->user()->id).'?v='.Str::random(4),
        ]);
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'cape' => ['required', 'mimes:png', SkinAPI::getRule()],
        ]);

        $request->file('cape')->storeAs('cape', "{$request->user()->id}.png", 'public');

        return redirect()->back()->with('success', trans('cape-api::messages.updated'));
    }
}