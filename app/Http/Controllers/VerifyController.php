<?php

namespace App\Http\Controllers;

use App\Http\Requests\VerifyFormRequest;
use App\Http\Resources\VerifyResource;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Throwable;


class VerifyController extends Controller
{
    private array $response = [];
    private int $statusCode = Response::HTTP_OK;

    /**
    *
    *  @OA\Post(
    *      path="/api/verify",
    *      tags={"verify"},
    *      operationId="verify",
    *      description="Method that verify if password is valid.",
    *      @OA\RequestBody(
    *          required=true,
    *          @OA\MediaType(
    *              mediaType="application/json",
    *              @OA\Schema(
    *                  @OA\Property(
    *                      property="password",
    *                      description="Typed password",
    *                      format="string",
    *                      type="string",
    *                      example="123456",
    *                  ),
    *              ),
    *          ),
    *      ),
    *      @OA\Response(
    *          response=200,
    *          description="Returns the rules, password and errors.",
    *          @OA\JsonContent(ref="#/components/schemas/VerifyResource")
    *      ),
    *      @OA\Response(
    *          response=402,
    *          description="Error validating sent data."
    *      ),
    *  ),
    */
    public function verify(VerifyFormRequest $request)
    {
        try {
            $this->response = $request->all();
            if (!$this->response['verify']) {
                $this->statusCode = Response::HTTP_BAD_REQUEST;
            }
        } catch (Throwable $e) {
            Log::error(__CLASS__ . '::' . __FUNCTION__ . ', ' . $e->getMessage());

            $this->response = [
                'message' => trans('validation.bad_request')
            ];
            $this->statusCode = Response::HTTP_BAD_REQUEST;
        }

        return (new VerifyResource($this->response))
            ->response()->setStatusCode($this->statusCode);
    }
}
