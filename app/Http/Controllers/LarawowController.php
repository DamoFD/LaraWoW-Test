<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Services\LarawowService;

class LarawowController extends Controller
{
    // Redirect the user to Battle.net and receive the code.
    public function redirect(): RedirectResponse
    {
        $state = bin2hex(random_bytes(16));

        session(['state' => $state]);

        $queryParams = http_build_query([
            'client_id' => config('larawow.client_id'),
            'redirect_uri' => config('larawow.redirect_uri'),
            'response_type' => 'code',
            'scope' => config('larawow.scopes'),
            'state' => $state
        ]);

        $url = 'https://oauth.battle.net/authorize?' . $queryParams;

        return redirect($url);
    }

    // Get Access Token For User
    public function get(Request $request)
    {
        if ($request->get('state') !== session('state')) {
            return response('Invalid state parameter', 422);
        }

        try {
            $accessToken = (new LarawowService())->getAccessTokenFromCode($request->get('code'));
        } catch (\Exception $e) {
            return response()->json(['error' => 'Invalid code', 'message' => $e->getMessage()], 400);
        }

        try {
            $user = (new LarawowService())->getCurrentAccount($accessToken);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Invalied Token', 'message' => $e->getMessage()], 400);
        }
    }
}
