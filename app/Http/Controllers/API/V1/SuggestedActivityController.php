<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\SuggestedActivity;
use App\Http\Requests\StoreSuggestedActivityRequest;
use App\Http\Requests\UpdateSuggestedActivityRequest;
use App\Http\Resources\SuggestedActivityResource;
use OpenApi\Attributes as OA;

class SuggestedActivityController extends Controller
{
    #[OA\Get(
        path: '/suggested-activities',
        summary: 'List all suggested activities',
        description: 'Retrieve a list of all suggested activities.',
        operationId: 'suggestedActivities.index',
        security: [['bearerAuth' => []]],
        tags: ['Suggested Activities'],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Successful operation',
                content: new OA\JsonContent(properties: [
                    new OA\Property(property: 'data', type: 'array', items: new OA\Items(ref: '#/components/schemas/SuggestedActivity')),
                ])
            ),
            new OA\Response(response: 401, description: 'Unauthenticated'),
        ]
    )]
    public function index()
    {
        return SuggestedActivityResource::collection(SuggestedActivity::all());
    }

    #[OA\Post(
        path: '/suggested-activities',
        summary: 'Create a suggested activity',
        description: 'Suggest a new activity by referencing an existing activity ID.',
        operationId: 'suggestedActivities.store',
        security: [['bearerAuth' => []]],
        tags: ['Suggested Activities'],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ['activity_id'],
                properties: [
                    new OA\Property(property: 'activity_id', type: 'integer', example: 3, description: 'ID of the activity being suggested'),
                ]
            )
        ),
        responses: [
            new OA\Response(
                response: 201,
                description: 'Suggested activity created successfully',
                content: new OA\JsonContent(properties: [
                    new OA\Property(property: 'data', ref: '#/components/schemas/SuggestedActivity'),
                ])
            ),
            new OA\Response(response: 401, description: 'Unauthenticated'),
            new OA\Response(response: 422, description: 'Validation error'),
        ]
    )]
    public function store(StoreSuggestedActivityRequest $request)
    {
        $suggestedActivity = SuggestedActivity::create($request->validated());

        return new SuggestedActivityResource($suggestedActivity);
    }

    #[OA\Get(
        path: '/suggested-activities/{id}',
        summary: 'Get suggested activity by ID',
        description: 'Retrieve a single suggested activity by its ID.',
        operationId: 'suggestedActivities.show',
        security: [['bearerAuth' => []]],
        tags: ['Suggested Activities'],
        parameters: [
            new OA\Parameter(name: 'id', in: 'path', required: true, description: 'Suggested activity ID', schema: new OA\Schema(type: 'integer')),
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Successful operation',
                content: new OA\JsonContent(properties: [
                    new OA\Property(property: 'data', ref: '#/components/schemas/SuggestedActivity'),
                ])
            ),
            new OA\Response(response: 401, description: 'Unauthenticated'),
            new OA\Response(response: 404, description: 'Suggested activity not found'),
        ]
    )]
    public function show(SuggestedActivity $suggestedActivity)
    {
        return new SuggestedActivityResource($suggestedActivity);
    }

    #[OA\Put(
        path: '/suggested-activities/{id}',
        summary: 'Update a suggested activity',
        description: 'Update an existing suggested activity.',
        operationId: 'suggestedActivities.update',
        security: [['bearerAuth' => []]],
        tags: ['Suggested Activities'],
        parameters: [
            new OA\Parameter(name: 'id', in: 'path', required: true, description: 'Suggested activity ID', schema: new OA\Schema(type: 'integer')),
        ],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ['activity_id'],
                properties: [
                    new OA\Property(property: 'activity_id', type: 'integer', example: 5),
                ]
            )
        ),
        responses: [
            new OA\Response(
                response: 200,
                description: 'Suggested activity updated successfully',
                content: new OA\JsonContent(properties: [
                    new OA\Property(property: 'data', ref: '#/components/schemas/SuggestedActivity'),
                ])
            ),
            new OA\Response(response: 401, description: 'Unauthenticated'),
            new OA\Response(response: 404, description: 'Suggested activity not found'),
            new OA\Response(response: 422, description: 'Validation error'),
        ]
    )]
    public function update(UpdateSuggestedActivityRequest $request, SuggestedActivity $suggestedActivity)
    {
        $suggestedActivity->update($request->validated());

        return new SuggestedActivityResource($suggestedActivity);
    }

    #[OA\Delete(
        path: '/suggested-activities/{id}',
        summary: 'Delete a suggested activity',
        description: 'Delete a suggested activity by its ID.',
        operationId: 'suggestedActivities.destroy',
        security: [['bearerAuth' => []]],
        tags: ['Suggested Activities'],
        parameters: [
            new OA\Parameter(name: 'id', in: 'path', required: true, description: 'Suggested activity ID', schema: new OA\Schema(type: 'integer')),
        ],
        responses: [
            new OA\Response(response: 204, description: 'Suggested activity deleted successfully'),
            new OA\Response(response: 401, description: 'Unauthenticated'),
            new OA\Response(response: 404, description: 'Suggested activity not found'),
        ]
    )]
    public function destroy(SuggestedActivity $suggestedActivity)
    {
        $suggestedActivity->delete();

        return response()->noContent();
    }
}
