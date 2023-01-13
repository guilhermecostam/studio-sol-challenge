<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class VerifyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        if (! empty($this->resource)) {
            $rules = [];
            foreach ($this->resource['rules'] as $key => $value) {
                $rules[] = [
                    'rule' => $key,
                    'value' => $value
                ];
            }

            return [
                'password' => $this->resource['password'] ?? null,
                'rules' => $rules,
                'verify' => $this->resource['verify'],
                'match' => $this->resource['match']
            ];
        } else {
            return $this->resource;
        }

    }
}
