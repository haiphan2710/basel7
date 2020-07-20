<?php

namespace App\Http\Controllers;

use HaiPhan\BaseL7\Exceptions\AccountLoggedInException;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use HaiPhan\BaseL7\Http\Requests\AuthRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Throwable;

class AuthController extends Controller
{
    /**
     * @param AuthRequest $request
     * @return JsonResponse
     * @throws Exception|Throwable
     */
    public function login(AuthRequest $request)
    {
        $data        = $request->validated();
        $credentials = [
            'email'    => $data['email'],
            'password' => $data['password']
        ];

        if (!Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);
        }

        $user = $request->user();

        $this->checkLoginTimes($user, $request);

        $tokenResult       = $user->createToken('Personal Access Token');
        $token             = $tokenResult->token;
        $token->expires_at = ($request->remember_me)
            ? Carbon::now()->addWeek()
            : Carbon::now()->addDay();

        $token->save();

        return response()->json([
            'access_token' => $tokenResult->accessToken,
            'token_type'   => 'Bearer',
            'expires_at'   => Carbon::parse($token->expires_at)->toDateTimeString(),
            'user'         => $user->load('roles')
        ]);
    }

    /**
     * Logout user (Revoke the token)
     *
     * @param Request $request
     * @return JsonResponse [string] message
     */
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();

        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }

    /**
     * Check User logged in
     * Note: Will revoke token if request contain new_auth param
     *
     * @param User $user
     * @param AuthRequest $request
     * @throws Throwable
     */
    protected function checkLoginTimes(User $user, AuthRequest $request)
    {
        if ($user->tokens()->count() > 0) {
            if (!$request->new_auth) {
                abort(401, 'USER_LOGGED_IN');
            }

            $user->tokens()->delete();
        }
    }
}
