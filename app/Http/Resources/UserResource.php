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
        
        // return [
        //     "id"=> $this->id,
        //     "firstname"=> $this->firstName,
        //     "lastname"=> $this->lastName,
        //     "role"=> $this->role,
        //     'username' => $this->username,
        //     'email' => $this->email,
        // ];
        return $request->user()->toArray();
    }
}
