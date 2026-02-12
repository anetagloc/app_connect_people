<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'username' => $this->username,
            'email' => $this->email,
            'create_time' => $this->create_time,
            'location_id' => $this->location_id,
            'age' => $this->age,
            'description' => $this->description,
            'gender' => $this->gender,
            'event_id' => $this->event_id,
            'event' => new EventResource($this->whenLoaded('event')),
            'activity_id' => $this->activity_id,
            'activity' => new ActivityResource($this->whenLoaded('activity')),
            'avaible_time_id' => $this->avaible_time_id,
            'avaible_time' => new AvaibleTimeResource($this->whenLoaded('avaibleTime')),
        ];
    }
}
