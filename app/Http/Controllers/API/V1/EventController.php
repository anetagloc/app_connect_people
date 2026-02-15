<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Http\Resources\EventResource;
use OpenApi\Attributes as OA;

class EventController extends Controller
{
    #[OA\Get(
        path: '/events',
        summary: 'List all events',
        description: 'Retrieve a list of all events.',
        operationId: 'events.index',
        security: [['bearerAuth' => []]],
        tags: ['Events'],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Successful operation',
                content: new OA\JsonContent(properties: [
                    new OA\Property(property: 'data', type: 'array', items: new OA\Items(ref: '#/components/schemas/Event')),
                ])
            ),
            new OA\Response(response: 401, description: 'Unauthenticated'),
        ]
    )]
    public function index()
    {
        return EventResource::collection(Event::all());
    }

    #[OA\Post(
        path: '/events',
        summary: 'Create a new event',
        description: 'Create a new event with name, location, date and max participants.',
        operationId: 'events.store',
        security: [['bearerAuth' => []]],
        tags: ['Events'],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ['name', 'location', 'date', 'max_participants'],
                properties: [
                    new OA\Property(property: 'name', type: 'string', maxLength: 45, example: 'Mecz w parku'),
                    new OA\Property(property: 'location', type: 'string', maxLength: 45, example: 'Warszawa, Park Łazienkowski'),
                    new OA\Property(property: 'date', type: 'string', format: 'date', example: '2026-03-15'),
                    new OA\Property(property: 'max_participants', type: 'integer', minimum: 2, example: 10),
                ]
            )
        ),
        responses: [
            new OA\Response(
                response: 201,
                description: 'Event created successfully',
                content: new OA\JsonContent(properties: [
                    new OA\Property(property: 'data', ref: '#/components/schemas/Event'),
                ])
            ),
            new OA\Response(response: 401, description: 'Unauthenticated'),
            new OA\Response(response: 422, description: 'Validation error'),
        ]
    )]
    public function store(StoreEventRequest $request)
    {
        $event = Event::create($request->validated());

        return new EventResource($event);
    }

    #[OA\Get(
        path: '/events/{id}',
        summary: 'Get event by ID',
        description: 'Retrieve a single event by its ID.',
        operationId: 'events.show',
        security: [['bearerAuth' => []]],
        tags: ['Events'],
        parameters: [
            new OA\Parameter(name: 'id', in: 'path', required: true, description: 'Event ID', schema: new OA\Schema(type: 'integer')),
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Successful operation',
                content: new OA\JsonContent(properties: [
                    new OA\Property(property: 'data', ref: '#/components/schemas/Event'),
                ])
            ),
            new OA\Response(response: 401, description: 'Unauthenticated'),
            new OA\Response(response: 404, description: 'Event not found'),
        ]
    )]
    public function show(Event $event)
    {
        return new EventResource($event);
    }

    #[OA\Put(
        path: '/events/{id}',
        summary: 'Update an event',
        description: 'Update an existing event.',
        operationId: 'events.update',
        security: [['bearerAuth' => []]],
        tags: ['Events'],
        parameters: [
            new OA\Parameter(name: 'id', in: 'path', required: true, description: 'Event ID', schema: new OA\Schema(type: 'integer')),
        ],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(properties: [
                new OA\Property(property: 'name', type: 'string', maxLength: 45, example: 'Mecz w parku'),
                new OA\Property(property: 'location', type: 'string', maxLength: 45, example: 'Warszawa'),
                new OA\Property(property: 'date', type: 'string', format: 'date', example: '2026-03-15'),
                new OA\Property(property: 'max_participants', type: 'integer', minimum: 2, example: 10),
            ])
        ),
        responses: [
            new OA\Response(
                response: 200,
                description: 'Event updated successfully',
                content: new OA\JsonContent(properties: [
                    new OA\Property(property: 'data', ref: '#/components/schemas/Event'),
                ])
            ),
            new OA\Response(response: 401, description: 'Unauthenticated'),
            new OA\Response(response: 404, description: 'Event not found'),
            new OA\Response(response: 422, description: 'Validation error'),
        ]
    )]
    public function update(UpdateEventRequest $request, Event $event)
    {
        $event->update($request->validated());

        return new EventResource($event);
    }

    #[OA\Delete(
        path: '/events/{id}',
        summary: 'Delete an event',
        description: 'Delete an event by its ID.',
        operationId: 'events.destroy',
        security: [['bearerAuth' => []]],
        tags: ['Events'],
        parameters: [
            new OA\Parameter(name: 'id', in: 'path', required: true, description: 'Event ID', schema: new OA\Schema(type: 'integer')),
        ],
        responses: [
            new OA\Response(response: 204, description: 'Event deleted successfully'),
            new OA\Response(response: 401, description: 'Unauthenticated'),
            new OA\Response(response: 404, description: 'Event not found'),
        ]
    )]
    public function destroy(Event $event)
    {
        $event->delete();

        return response()->noContent();
    }
}
