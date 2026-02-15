<?php

namespace App\Http\Controllers;

use OpenApi\Attributes as OA;

#[OA\Info(
    version: '1.0.0',
    title: 'Connect People API',
    description: 'API for the Connect People application – find activities, events, and people to connect with.',
    contact: new OA\Contact(email: 'admin@example.com')
)]
#[OA\Server(url: '/api/v1', description: 'API v1')]
#[OA\SecurityScheme(
    securityScheme: 'bearerAuth',
    type: 'http',
    scheme: 'bearer',
    bearerFormat: 'JWT',
    description: 'Enter your Sanctum token (e.g. 1|abc123...)'
)]

#[OA\Schema(
    schema: 'User',
    properties: [
        new OA\Property(property: 'id', type: 'integer', example: 1),
        new OA\Property(property: 'username', type: 'string', example: 'janek'),
        new OA\Property(property: 'email', type: 'string', format: 'email', example: 'jan@example.com'),
        new OA\Property(property: 'age', type: 'string', nullable: true, example: '25'),
        new OA\Property(property: 'description', type: 'string', nullable: true, example: 'Lubię biegać'),
        new OA\Property(property: 'gender', type: 'string', nullable: true, example: 'male'),
        new OA\Property(property: 'location_id', type: 'integer', nullable: true, example: 1),
        new OA\Property(property: 'activity_id', type: 'integer', nullable: true, example: 3),
        new OA\Property(property: 'event_id', type: 'integer', nullable: true, example: null),
        new OA\Property(property: 'avaible_time_id', type: 'integer', nullable: true, example: null),
        new OA\Property(property: 'create_time', type: 'string', format: 'date-time', nullable: true),
    ]
)]
#[OA\Schema(
    schema: 'Category',
    properties: [
        new OA\Property(property: 'id', type: 'integer', example: 1),
        new OA\Property(property: 'name', type: 'string', example: 'Sport'),
        new OA\Property(property: 'created_at', type: 'string', format: 'date-time'),
        new OA\Property(property: 'updated_at', type: 'string', format: 'date-time'),
    ]
)]
#[OA\Schema(
    schema: 'Activity',
    properties: [
        new OA\Property(property: 'id', type: 'integer', example: 1),
        new OA\Property(property: 'name', type: 'string', example: 'Piłka nożna'),
        new OA\Property(property: 'category_id', type: 'integer', example: 1),
        new OA\Property(property: 'activity_goal', type: 'string', nullable: true, example: 'Rekreacja'),
        new OA\Property(property: 'max_assign_person', type: 'string', nullable: true, example: '22'),
        new OA\Property(property: 'created_at', type: 'string', format: 'date-time'),
        new OA\Property(property: 'updated_at', type: 'string', format: 'date-time'),
    ]
)]
#[OA\Schema(
    schema: 'Event',
    properties: [
        new OA\Property(property: 'id', type: 'integer', example: 1),
        new OA\Property(property: 'name', type: 'string', example: 'Mecz w parku'),
        new OA\Property(property: 'location', type: 'string', example: 'Warszawa, Park Łazienkowski'),
        new OA\Property(property: 'date', type: 'string', format: 'date', example: '2026-03-15'),
        new OA\Property(property: 'max_participants', type: 'integer', example: 10),
        new OA\Property(property: 'created_at', type: 'string', format: 'date-time'),
        new OA\Property(property: 'updated_at', type: 'string', format: 'date-time'),
    ]
)]
#[OA\Schema(
    schema: 'AvaibleTime',
    properties: [
        new OA\Property(property: 'id', type: 'integer', example: 1),
        new OA\Property(property: 'name', type: 'string', example: 'Weekendy'),
        new OA\Property(property: 'created_at', type: 'string', format: 'date-time'),
        new OA\Property(property: 'updated_at', type: 'string', format: 'date-time'),
    ]
)]
#[OA\Schema(
    schema: 'SuggestedActivity',
    properties: [
        new OA\Property(property: 'id', type: 'integer', example: 1),
        new OA\Property(property: 'activity_id', type: 'integer', example: 3),
        new OA\Property(property: 'created_at', type: 'string', format: 'date-time'),
        new OA\Property(property: 'updated_at', type: 'string', format: 'date-time'),
    ]
)]
abstract class Controller
{
    //
}
