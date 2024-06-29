<?php

namespace App\Http\Resources\V1\Roles;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\Role */
class RolesIndexResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'uuid' => $this->uuid,
            'name' => $this->name,
            'created_at' => $this->created_at,
            'permissions_count' => $this->permissions_count,
            'users_count' => $this->users_count,
        ];
    }
}
