<?php

namespace App\Http\Resources\V1\Members;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin User */
class MemberUpdateResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'phone' => $this->phone,
            'email' => $this->email,
            'gender' => $this->gender,
            'qualification' => $this->qualification,

            'zone_id' => $this->zone_id,
            'branch_id' => $this->branch_id,
            'roles' => $this->whenLoaded('roles', fn () => $this->roles->pluck('id')->toArray()),
        ];
    }
}
