<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;
use App\Models\Commodity;

class NotificationController extends Controller
{
    /**
     * Show all notifications.
     */
    public function index()
    {
        // eager load commodity so blade can access commodity details
        $notifications = Notification::with('commodity')->latest()->get();

        return view('admin.notification', compact('notifications'));
    }




    /**
     * Push a commodity record into notifications.
     */
    public function pushFromCommodity($id)
    {
        $record = Commodity::findOrFail($id);

        // check if already pushed
        $exists = Notification::where('commodity_id', $record->id)->exists();
        if ($exists) {
            return response()->json([
                'success' => false,
                'message' => 'This commodity is already in notifications.'
            ], 409);
        }

        // create only with foreign key
        Notification::create([
            'commodity_id' => $record->id,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Commodity pushed to notifications!'
        ]);
    }

    /**
     * Delete a notification.
     */
    public function destroy($id)
    {
        $notification = Notification::findOrFail($id);
        $notification->delete();

        return response()->json([
            'success' => true,
            'message' => 'Notification deleted successfully.'
        ]);
    }
}
