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
public function pushToRegistered(Request $request, $id)
{
    $notification = Notification::findOrFail($id);
    $commodity = $notification->commodity;

    $tech = RegisteredTechnology::create([
        'technology' => $request->input('technology'),
        'technology_generator' => $request->input('technology_generator'),
        'description' => $request->input('description'),
        'link' => $request->input('link'), // <-- use the new link
    ]);

    $notification->delete();

    return response()->json([
        'success' => true,
        'message' => 'Technology pushed to registered and removed from notifications!',
        'data' => $tech,
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
