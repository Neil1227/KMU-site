<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;
use App\Models\Commodity;
use App\Models\DBActivity;

class NotificationController extends Controller
{
    /**
     * Show all notifications.
     */
    public function index()
    {
        $notifications = Notification::with('commodity')->latest()->get();

        // Mark all as read
        Notification::where('is_read', false)->update(['is_read' => true]);

        return view('admin.notification', compact('notifications'));
    }

    /**
     * Push a commodity record into notifications.
     */
    public function pushFromCommodity($id)
    {
        try {
            $record = Commodity::findOrFail($id);

            // Check if already pushed
            if (Notification::where('commodity_id', $record->id)->exists()) {
                return response()->json([
                    'success' => false,
                    'message' => 'This commodity is already in notifications.'
                ], 409);
            }

            $notification = Notification::create([
                'commodity_id' => $record->id,
            ]);

            // 🟢 Log activity: pushed
            DBActivity::create([
                'action' => 'pushed',
                'model' => 'Commodity',
                'record_id' => $record->id,
                'thesis_title' => $record->thesis_title,
                'technology' => $record->technologies,
                'ip_status' => $record->ip_status,
                'changes' => json_encode([
                    'notification_id' => $notification->id,
                    'message' => 'Commodity pushed to notifications.'
                ]),
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Commodity pushed to notifications!',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to push commodity: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Revert a pushed notification (remove it).
     */
    public function revertPush($id)
    {
        try {
            $notification = Notification::with('commodity')->findOrFail($id);
            $record = $notification->commodity;

            // Delete the notification
            $notification->delete();

            // 🔵 Log activity: reverted
            DBActivity::create([
                'action' => 'reverted',
                'model' => 'Commodity',
                'record_id' => $record->id ?? null,
                'thesis_title' => $record->thesis_title ?? null,
                'technology' => $record->technologies ?? null,
                'ip_status' => $record->ip_status ?? null,
                'changes' => json_encode([
                    'notification_id' => $id,
                    'message' => 'Pushed notification reverted (removed).'
                ]),
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Push reverted and notification removed successfully.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to revert push: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Delete a notification manually.
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
