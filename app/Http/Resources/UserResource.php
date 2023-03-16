<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public static $wrap = 'user';

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'orcid' => $this->orcid,
            'name' => $this->name,
            'lastname' => $this->lastname,
            'email' => $this->email,
            'keywords' => $this->keywords,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
