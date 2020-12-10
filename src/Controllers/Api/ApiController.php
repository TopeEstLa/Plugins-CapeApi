<?php

namespace Azuriom\Plugin\CapeApi\Controllers\Api;

use Azuriom\Http\Controllers\Controller;
use Azuriom\Models\User;
use Azuriom\Plugin\CapeApi\CapeAPI;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ApiController extends Controller
{
    /**
     * Show the home plugin page.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($user)
    {
        $userId = User::where('id', $user)->orWhere('name', $user)->value('id');

        if ($userId === null || ! Storage::disk('public')->exists("capes/{$userId}.png")) {
            return response()->file(base_path().'/plugins/cape-api/assets/img/default.png', [
                'Content-Type' => 'image/png',
            ]);
        }

        return Storage::disk('public')->response("capes/{$userId}.png", 'capes.png', [
            'Content-Type' => 'image/png',
        ]);
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'access_token' => 'required|string',
            'cape' => ['required', 'mimes:png', CapeAPI::getRule()],
        ]);

        $user = User::firstWhere('access_token', $request->input('access_token'));

        if ($user === null) {
            return response()->json(['status' => false, 'message' => 'Invalid token'], 422);
        }

        if ($user->is_banned) {
            return response()->json(['status' => false, 'message' => 'User banned'], 422);
        }

        return $request->file('cape')->storeAs('cape', "{$request->user()->id}.png", 'public');
    }
}