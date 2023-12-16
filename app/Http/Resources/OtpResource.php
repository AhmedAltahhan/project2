<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OtpResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        $data = [
            'code' => $this->code,
            'expire' => $this->expire,
            'user_id' => $this->user_id,
            'email'=> $this->user->email,
        ];
        return $data;
    }
}
