<?php
/**
 * Created by PhpStorm.
 * user: KILENGA
 * Date: 2/5/2019
 * Time: 4:52 PM
 */

namespace App\Helpers;


use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\File;

class General
{
    public static function customMessage($message, $alert_type)
    {
        return $notification = array(
            'message' => $message,
            'alert-type' => $alert_type
        );
    }

    public static function ApiGetRequest($url)
    {
        $client = new Client();

        $request = $client->get($url, ['verify' => false]);

        return json_decode($request->getBody()->getContents());
    }

    public static function deleteFile($file_path): string
    {
        if (File::exists(public_path($file_path))) {
            File::delete(public_path($file_path));
            return "Deleted";
        } else {
            return "Not Deleted";
        }
    }

    public static function sendResponse($data, $message)
    {
        $response = [
            'success' => true,
            'data' => $data,
            'message' => $message,
        ];
        return response()->json($response, 201);
    }

    public static function sendError($error, $errorMessages = [], $code = 505): JsonResponse
    {
        $response = [
            'success' => false,
            'message' => $error,
        ];
        if (!empty($errorMessages)) {
            $response['data'] = $errorMessages;
        }
        return response()->json($response, $code);
    }

    public static function daysBetweenInclusive($start, $end): float|int
    {
        $startDate = Carbon::parse($start)->startOfDay();
        $endDate = Carbon::parse($end)->startOfDay();

        $diff = $startDate->diffInDays($endDate);

        return $diff === 0 ? 1 : $diff + 1;
    }
}
