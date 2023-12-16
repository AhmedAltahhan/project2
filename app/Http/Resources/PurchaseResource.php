<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PurchaseResource extends JsonResource
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
            'id' => $this->id,
            'purchaseable_type' => $this->purchaseable_type,
            'purchaseable_id' => $this->purchaseable_id,
            'user' => AuthResource::make($this->whenLoaded('user'))
        ];
        return $data;
    }
}
