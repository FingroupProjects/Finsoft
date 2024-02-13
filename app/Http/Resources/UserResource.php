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
            'name' => $this->name,
            'surname' => $this->surname ?? '',
            'lastname' => $this->lastname ?? '',
            'login' => $this->login,
            'email'=> $this->email ?? '',
            'organization' => $this->organization->name ?? '',
            'phone' => $this->phone ?? '',
        ];
    }
}
