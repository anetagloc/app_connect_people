<?php

namespace App\Http\Controllers\API\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use OpenApi\Attributes as OA;

class LoginController extends Controller
{
    /**
     * Authenticate the user and issue an API token.
     */
    #[OA\Post(
        path: '/login',
        summary: 'Login',
        description: 'Authenticate with email or username and receive an API token.',
        operationId: 'login',
        tags: ['Auth'],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ['login', 'password'],
                properties: [
                    new OA\Property(property: 'login', type: 'string', example: 'jan@example.com', description: 'Email or username'),
                    new OA\Property(property: 'password', type: 'string', format: 'password', example: 'haslo123'),
                ]
            )
        ),
        responses: [
            new OA\Response(
                response: 200,
                description: 'Successful login',
                content: new OA\JsonContent(properties: [
                    new OA\Property(property: 'user', ref: '#/components/schemas/User'),
                    new OA\Property(property: 'token', type: 'string', example: '1|abc123xyz...'),
                ])
            ),
            new OA\Response(
                response: 422,
                description: 'Invalid credentials',
                content: new OA\JsonContent(properties: [
                    new OA\Property(property: 'message', type: 'string', example: 'The given data was invalid.'),
                    new OA\Property(property: 'errors', type: 'object'),
                ])
            ),
        ]
    )]
    public function __invoke(LoginRequest $request)
    {
        $login = $request->login;

        $user = User::where('email', $login)
            ->orWhere('username', $login)
            ->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'login' => [__('auth.failed')],
            ]);
        }

        // Revoke all existing tokens for this user (one active session at a time)
        $user->tokens()->delete();

        return response()->json([
            'user' => $user,
            'token' => $user->createToken('api')->plainTextToken,
        ]);
    }
}
