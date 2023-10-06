<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
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

    // Get Access Token from Battle.net API
    public function get(Request $request): RedirectResponse | JsonResponse
    {
        // Match state returned with state stored in session
        if ($request->get('state') !== session('state')) {
            return response('Invalid state parameter', 422);
        }

        // Get the access token
        try {
            $accessToken = (new LarawowService())->getAccessTokenFromCode($request->get('code'));
        } catch (\Exception $e) {
            return response()->json(['error' => 'Invalid code', 'message' => $e->getMessage()], 400);
        }

        // Get the user
        try {
            $user = (new LarawowService())->getCurrentAccount($accessToken);
            $user->setAccessToken($accessToken);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Invalied Token', 'message' => $e->getMessage()], 400);
        }

        // Confirm the logged-in user's ID is matching the ID retrieved from API
        if (auth()->check()) {
            if (auth()->id() !== $user->id) {
                auth()->logout();
                return $this->throwError('invalid_user');
            }

            // Confirm the session in case user was redirected from password.confirm middleware
            $request->session()->put('auth.password_confirmed_at', time());
        }

        // Create or update user in db
        // Initialize DB transaction in case something goes wrong
        DB::beginTransaction();
        try {
            $user = (new LarawowService())->updateOrCreateUser($user);
            //$user = $user->fresh();
            $user->accessToken()->updateOrCreate([], $accessToken->toArray());
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->throwError('database_error', $e);
        }

        // Commit the Database Transaction
        DB::commit();

        // Authenticating the user if they're not logged in
        if (!auth()->check()) {
            auth()->login($user);
        }

        // Redirect the user home.
        return redirect()->route('home');
    }

    // Throws error
    private function throwError(string $message, \Exception $exception = NULL): RedirectResponse | JsonResponse
    {
        if (app()->hasDebugModeEnabled()) {
            return response()->json([
                'larawow_message' => config('larawow.error_messages.' . $message),
                'message' => $exception?->getMessage(),
                'code' => $exception?->getCode()
            ]);
        }
    }

    // Refresh the User's WoW characters
    public function WoWUserRefresh(): RedirectResponse | JsonResponse
    {
        $user = auth()->user();
        $accounts = (new LarawowService())->getUserWowAccounts($user);

        // Create or update user in db
        // Initialize DB transaction in case something goes wrong
        DB::beginTransaction();
        try {
            $accounts = (new LarawowService())->updateOrCreateAccounts($user, $accounts);
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->throwError('database_error', $e);
        }

        // Commit the Database Transaction
        DB::commit();

        return redirect()->back();
    }
}
