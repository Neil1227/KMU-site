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

    // Mark all notifications as read
    Notification::where('is_read', false)->update(['is_read' => true]);

    return view('admin.notification', compact('notifications'));
}


public function pushToRegistered(Request $request, $id) 
{
    // Find the notification
    $notification = Notification::find($id);

    if (!$notification) {
        return response()->json([
            'success' => false,
            'message' => 'Notification not found!'
        ], 404);
    }

    // Create the registered technology record
    $tech = RegisteredTechnology::create([
        'technology'           => $request->input('technology'),
        'technology_generator' => $request->input('technology_generator'),
        'description'          => $request->input('description'),
        'link'                 => $request->input('link'),
    ]);

    // Delete the notification
    $notification->delete();

    // Return JSON response
    return response()->json([
        'success' => true,
        'message' => 'Technology pushed to registered and removed from notifications!',
        'data'    => $tech,
    ]);
}


    /**
     * Push a commodity record into notifications.
     */
public function pushFromCommodity($id)
{
    try {
        // Find the commodity
        $record = Commodity::findOrFail($id);

        // Check if it is already in notifications
        $exists = Notification::where('commodity_id', $record->id)->exists();

        if ($exists) {
            return response()->json([
                'success' => false,
                'message' => 'This commodity is already in notifications.'
            ], 409);
        }

        // Create a new notification with only the foreign key
        Notification::create([
            'commodity_id' => $record->id,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Commodity pushed to notifications!'
        ]);
    } catch (\Exception $e) {
        // Catch any unexpected error
        return response()->json([
            'success' => false,
            'message' => 'Failed to push commodity: ' . $e->getMessage()
        ], 500);
    }
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
