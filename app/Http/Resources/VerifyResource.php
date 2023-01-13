<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class VerifyResource.
 *
 *
 * @OA\Schema(
 *      schema="VerifyResource",
 *      type="object",
 *      description="Password verify data",
 *      title="Verify",
 *      oneOf={
 *          @OA\Schema(
 *              schema="Verify",
 *              title="Verify",
 *              @OA\Property(
 *                  property="password",
 *                  format="string",
 *                  type="string",
 *                  description="Typed password",
 *                  example="123456"
 *              ),
 *              @OA\Property(
 *                  property="rules", 
 *                  format="array",
 *                  description="All rules of the validation",
 *              ),
 *              @OA\Property(
 *                  property="verify",
 *                  format="boolean",
 *                  type="boolean",
 *                  description="Password is valid",
 *                  example="true"
 *              ),
 *              @OA\Property(
 *                  property="match", 
 *                  format="array", 
 *                  type="array", 
 *                  description="Rules that the password did not pass", 
 *                  example={"minDigits", "noRepeat"},
 *                  @OA\Items(
 *                      type="string"
 *                  )
 *              ),
 *          ),
 *      }
 * )
 */
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
