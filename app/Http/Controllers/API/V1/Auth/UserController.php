<?php

namespace App\Http\Controllers\API\V1\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use OpenApi\Attributes as OA;

class UserController extends Controller
{
    /**
     * Return the currently authenticated user.
     */
    #[OA\Get(
        path: '/user',
        summary: 'Get authenticated user',
        description: 'Return the currently authenticated user\'s profile.',
        operationId: 'user.current',
        security: [['bearerAuth' => []]],
        tags: ['Auth'],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Authenticated user data',
                content: new OA\JsonContent(ref: '#/components/schemas/User')
            ),
            new OA\Response(response: 401, description: 'Unauthenticated'),
        ]
    )]
    public function __invoke(Request $request)
    {
        return $request->user();
    }
}
