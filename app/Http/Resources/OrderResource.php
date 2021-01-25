<?php

namespace App\Http\Resources;

use App\Http\Requests\OrderRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param $request
     * @return array
     */
    public function toArray($request): array
    {
        return array_filter([
          'id' => $this->id,
          'email' => $this->email,
          'shipping_address_1' => $this->shipping_address_1,
          'shipping_address_2' => $this->shipping_address_2 ?? null,
          'shipping_address_3' => $this->shipping_address_3 ?? null,
          'city' => $this->city,
          'county_code' => $this->county_code,
          'zip_postal_code' => $this->zip_postal_code,
          'phone_number' => $this->phone_number,
        ]);
    }
}
