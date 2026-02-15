<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Http\Requests\StoreActivityRequest;
use App\Http\Requests\UpdateActivityRequest;
use App\Http\Resources\ActivityResource;
use OpenApi\Attributes as OA;

class ActivityController extends Controller
{
    #[OA\Get(
        path: '/activities',
        summary: 'List all activities',
        description: 'Retrieve a list of all activities.',
        operationId: 'activities.index',
        security: [['bearerAuth' => []]],
        tags: ['Activities'],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Successful operation',
                content: new OA\JsonContent(properties: [
                    new OA\Property(property: 'data', type: 'array', items: new OA\Items(ref: '#/components/schemas/Activity')),
                ])
            ),
            new OA\Response(response: 401, description: 'Unauthenticated'),
        ]
    )]
    public function index()
    {
        return ActivityResource::collection(Activity::all());
    }

    #[OA\Post(
        path: '/activities',
        summary: 'Create a new activity',
        description: 'Create a new activity belonging to a category.',
        operationId: 'activities.store',
        security: [['bearerAuth' => []]],
        tags: ['Activities'],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ['name', 'category_id'],
                properties: [
                    new OA\Property(property: 'name', type: 'string', maxLength: 100, example: 'Piłka nożna'),
                    new OA\Property(property: 'category_id', type: 'integer', example: 1, description: 'ID of the parent category'),
                    new OA\Property(property: 'activity_goal', type: 'string', maxLength: 100, nullable: true, example: 'Rekreacja'),
                    new OA\Property(property: 'max_assign_person', type: 'string', maxLength: 100, nullable: true, example: '22'),
                ]
            )
        ),
        responses: [
            new OA\Response(
                response: 201,
                description: 'Activity created successfully',
                content: new OA\JsonContent(properties: [
                    new OA\Property(property: 'data', ref: '#/components/schemas/Activity'),
                ])
            ),
            new OA\Response(response: 401, description: 'Unauthenticated'),
            new OA\Response(response: 422, description: 'Validation error'),
        ]
    )]
    public function store(StoreActivityRequest $request)
    {
        $activity = Activity::create($request->validated());

        return new ActivityResource($activity);
    }

    #[OA\Get(
        path: '/activities/{id}',
        summary: 'Get activity by ID',
        description: 'Retrieve a single activity by its ID.',
        operationId: 'activities.show',
        security: [['bearerAuth' => []]],
        tags: ['Activities'],
        parameters: [
            new OA\Parameter(name: 'id', in: 'path', required: true, description: 'Activity ID', schema: new OA\Schema(type: 'integer')),
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Successful operation',
                content: new OA\JsonContent(properties: [
                    new OA\Property(property: 'data', ref: '#/components/schemas/Activity'),
                ])
            ),
            new OA\Response(response: 401, description: 'Unauthenticated'),
            new OA\Response(response: 404, description: 'Activity not found'),
        ]
    )]
    public function show(Activity $activity)
    {
        return new ActivityResource($activity);
    }

    #[OA\Put(
        path: '/activities/{id}',
        summary: 'Update an activity',
        description: 'Update an existing activity.',
        operationId: 'activities.update',
        security: [['bearerAuth' => []]],
        tags: ['Activities'],
        parameters: [
            new OA\Parameter(name: 'id', in: 'path', required: true, description: 'Activity ID', schema: new OA\Schema(type: 'integer')),
        ],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(properties: [
                new OA\Property(property: 'name', type: 'string', maxLength: 100, example: 'Piłka nożna'),
                new OA\Property(property: 'category_id', type: 'integer', example: 1),
                new OA\Property(property: 'activity_goal', type: 'string', maxLength: 100, nullable: true, example: 'Profesjonalnie'),
                new OA\Property(property: 'max_assign_person', type: 'string', maxLength: 100, nullable: true, example: '11'),
            ])
        ),
        responses: [
            new OA\Response(
                response: 200,
                description: 'Activity updated successfully',
                content: new OA\JsonContent(properties: [
                    new OA\Property(property: 'data', ref: '#/components/schemas/Activity'),
                ])
            ),
            new OA\Response(response: 401, description: 'Unauthenticated'),
            new OA\Response(response: 404, description: 'Activity not found'),
            new OA\Response(response: 422, description: 'Validation error'),
        ]
    )]
    public function update(UpdateActivityRequest $request, Activity $activity)
    {
        $activity->update($request->validated());

        return new ActivityResource($activity);
    }

    #[OA\Delete(
        path: '/activities/{id}',
        summary: 'Delete an activity',
        description: 'Delete an activity by its ID.',
        operationId: 'activities.destroy',
        security: [['bearerAuth' => []]],
        tags: ['Activities'],
        parameters: [
            new OA\Parameter(name: 'id', in: 'path', required: true, description: 'Activity ID', schema: new OA\Schema(type: 'integer')),
        ],
        responses: [
            new OA\Response(response: 204, description: 'Activity deleted successfully'),
            new OA\Response(response: 401, description: 'Unauthenticated'),
            new OA\Response(response: 404, description: 'Activity not found'),
        ]
    )]
    public function destroy(Activity $activity)
    {
        $activity->delete();

        return response()->noContent();
    }
}
