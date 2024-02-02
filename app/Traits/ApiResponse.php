<?php
namespace App\Traits;

use App\Enums\ApiResponse as ApiResponseEnum;
use Illuminate\Http\JsonResponse;

trait ApiResponse
{
    public function success($result, $code = 200): \Illuminate\Http\JsonResponse
    {
        return response()->json(['result' => ApiResponseEnum::Success, 'errors' => null], $code);
    }

    public function error($code = 400): \Illuminate\Http\JsonResponse
    {
        return response()->json(['result' => null, 'errors' => ApiResponseEnum::Error], $code);
    }

    public function notAccess($code = 403): \Illuminate\Http\JsonResponse
    {
        return response()->json(['result' => null, 'errors' => ApiResponseEnum::Error], $code);
    }

    public function created($result, $code = 201) :JsonResponse
    {

        return response()->json(['result' => ApiResponseEnum::Created, 'errors' => null], $code);
    }
}
