<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = auth()->user()->notifications()->orderBy('created_at', 'DESC')->paginate(10);

        return response()->json([
            'response_code' => 200,
            'data' => $notifications
        ]);
    }
}
