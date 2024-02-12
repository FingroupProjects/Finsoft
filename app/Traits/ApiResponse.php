<?php
namespace App\Traits;

use App\Enums\ApiResponse as ApiResponseEnum;
use Illuminate\Http\JsonResponse;

trait ApiResponse
{
    public function success($result = null, $code = 200): \Illuminate\Http\JsonResponse
    {
        return response()->json(['result' => $result ?? ApiResponseEnum::Success, 'errors' => null], $code);
    }

    public function error($result, $code = 400): \Illuminate\Http\JsonResponse
    {
        return response()->json(['result' => null, 'errors' => $result ?? ApiResponseEnum::Error], $code);
    }

    public function notAccess($result, $code = 403): \Illuminate\Http\JsonResponse
    {
        return response()->json(['result' => null, 'errors' => $result ?? ApiResponseEnum::Error], $code);
    }

    public function created($result, $code = 201) :JsonResponse
    {
        return response()->json(['result' => $result ?? ApiResponseEnum::Created, 'errors' => null], $code);
    }

    public function deleted() :JsonResponse
    {
        return response()->json(['result' => ApiResponseEnum::Deleted, 'errors' => null]);
    }
}
