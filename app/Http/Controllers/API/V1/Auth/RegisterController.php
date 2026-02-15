<?php

namespace App\Http\Controllers\API\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use OpenApi\Attributes as OA;

class RegisterController extends Controller
{
    /**
     * Register a new user and issue an API token.
     */
    #[OA\Post(
        path: '/register',
        summary: 'Register',
        description: 'Create a new user account and receive an API token. Optionally provide profile details.',
        operationId: 'register',
        tags: ['Auth'],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ['username', 'email', 'password', 'password_confirmation'],
                properties: [
                    new OA\Property(property: 'username', type: 'string', maxLength: 16, example: 'janek'),
                    new OA\Property(property: 'email', type: 'string', format: 'email', example: 'jan@example.com'),
                    new OA\Property(property: 'password', type: 'string', format: 'password', minLength: 8, example: 'haslo123'),
                    new OA\Property(property: 'password_confirmation', type: 'string', format: 'password', example: 'haslo123'),
                    new OA\Property(property: 'description', type: 'string', maxLength: 45, nullable: true, example: 'Lubię biegać'),
                    new OA\Property(property: 'activity_id', type: 'integer', nullable: true, example: 3, description: 'ID of chosen activity'),
                    new OA\Property(property: 'location_id', type: 'integer', nullable: true, example: 1),
                    new OA\Property(property: 'age', type: 'string', maxLength: 45, nullable: true, example: '25'),
                ]
            )
        ),
        responses: [
            new OA\Response(
                response: 201,
                description: 'User registered successfully',
                content: new OA\JsonContent(properties: [
                    new OA\Property(property: 'user', ref: '#/components/schemas/User'),
                    new OA\Property(property: 'token', type: 'string', example: '1|abc123xyz...'),
                ])
            ),
            new OA\Response(response: 422, description: 'Validation error'),
        ]
    )]
    public function __invoke(RegisterRequest $request)
    {
        $user = User::create($request->validated());

        return response()->json([
            'user' => $user,
            'token' => $user->createToken('api')->plainTextToken,
        ], 201);
    }
}
