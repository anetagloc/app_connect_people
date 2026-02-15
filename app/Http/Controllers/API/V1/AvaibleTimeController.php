<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\AvaibleTime;
use App\Http\Requests\StoreAvaibleTimeRequest;
use App\Http\Requests\UpdateAvaibleTimeRequest;
use App\Http\Resources\AvaibleTimeResource;
use OpenApi\Attributes as OA;

class AvaibleTimeController extends Controller
{
    #[OA\Get(
        path: '/avaible-times',
        summary: 'List all available times',
        description: 'Retrieve a list of all available time slots.',
        operationId: 'avaibleTimes.index',
        security: [['bearerAuth' => []]],
        tags: ['Available Times'],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Successful operation',
                content: new OA\JsonContent(properties: [
                    new OA\Property(property: 'data', type: 'array', items: new OA\Items(ref: '#/components/schemas/AvaibleTime')),
                ])
            ),
            new OA\Response(response: 401, description: 'Unauthenticated'),
        ]
    )]
    public function index()
    {
        return AvaibleTimeResource::collection(AvaibleTime::all());
    }

    #[OA\Post(
        path: '/avaible-times',
        summary: 'Create a new available time',
        description: 'Create a new available time slot.',
        operationId: 'avaibleTimes.store',
        security: [['bearerAuth' => []]],
        tags: ['Available Times'],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ['name'],
                properties: [
                    new OA\Property(property: 'name', type: 'string', maxLength: 45, example: 'Weekendy'),
                ]
            )
        ),
        responses: [
            new OA\Response(
                response: 201,
                description: 'Available time created successfully',
                content: new OA\JsonContent(properties: [
                    new OA\Property(property: 'data', ref: '#/components/schemas/AvaibleTime'),
                ])
            ),
            new OA\Response(response: 401, description: 'Unauthenticated'),
            new OA\Response(response: 422, description: 'Validation error'),
        ]
    )]
    public function store(StoreAvaibleTimeRequest $request)
    {
        $avaibleTime = AvaibleTime::create($request->validated());

        return new AvaibleTimeResource($avaibleTime);
    }

    #[OA\Get(
        path: '/avaible-times/{id}',
        summary: 'Get available time by ID',
        description: 'Retrieve a single available time slot by its ID.',
        operationId: 'avaibleTimes.show',
        security: [['bearerAuth' => []]],
        tags: ['Available Times'],
        parameters: [
            new OA\Parameter(name: 'id', in: 'path', required: true, description: 'Available time ID', schema: new OA\Schema(type: 'integer')),
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Successful operation',
                content: new OA\JsonContent(properties: [
                    new OA\Property(property: 'data', ref: '#/components/schemas/AvaibleTime'),
                ])
            ),
            new OA\Response(response: 401, description: 'Unauthenticated'),
            new OA\Response(response: 404, description: 'Available time not found'),
        ]
    )]
    public function show(AvaibleTime $avaibleTime)
    {
        return new AvaibleTimeResource($avaibleTime);
    }

    #[OA\Put(
        path: '/avaible-times/{id}',
        summary: 'Update an available time',
        description: 'Update an existing available time slot.',
        operationId: 'avaibleTimes.update',
        security: [['bearerAuth' => []]],
        tags: ['Available Times'],
        parameters: [
            new OA\Parameter(name: 'id', in: 'path', required: true, description: 'Available time ID', schema: new OA\Schema(type: 'integer')),
        ],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ['name'],
                properties: [
                    new OA\Property(property: 'name', type: 'string', maxLength: 45, example: 'Wieczory'),
                ]
            )
        ),
        responses: [
            new OA\Response(
                response: 200,
                description: 'Available time updated successfully',
                content: new OA\JsonContent(properties: [
                    new OA\Property(property: 'data', ref: '#/components/schemas/AvaibleTime'),
                ])
            ),
            new OA\Response(response: 401, description: 'Unauthenticated'),
            new OA\Response(response: 404, description: 'Available time not found'),
            new OA\Response(response: 422, description: 'Validation error'),
        ]
    )]
    public function update(UpdateAvaibleTimeRequest $request, AvaibleTime $avaibleTime)
    {
        $avaibleTime->update($request->validated());

        return new AvaibleTimeResource($avaibleTime);
    }

    #[OA\Delete(
        path: '/avaible-times/{id}',
        summary: 'Delete an available time',
        description: 'Delete an available time slot by its ID.',
        operationId: 'avaibleTimes.destroy',
        security: [['bearerAuth' => []]],
        tags: ['Available Times'],
        parameters: [
            new OA\Parameter(name: 'id', in: 'path', required: true, description: 'Available time ID', schema: new OA\Schema(type: 'integer')),
        ],
        responses: [
            new OA\Response(response: 204, description: 'Available time deleted successfully'),
            new OA\Response(response: 401, description: 'Unauthenticated'),
            new OA\Response(response: 404, description: 'Available time not found'),
        ]
    )]
    public function destroy(AvaibleTime $avaibleTime)
    {
        $avaibleTime->delete();

        return response()->noContent();
    }
}
