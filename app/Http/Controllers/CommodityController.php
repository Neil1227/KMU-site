<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Commodity;
use App\Models\DBActivity;

class CommodityController extends Controller
{
    /**
     * List all commodities with their total count.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $commodities = Commodity::select('commodity')
            ->selectRaw('COUNT(*) as total')
            ->groupBy('commodity')
            ->get();

        return view('admin.database.commodities', compact('commodities'));
    }

    /**
     * Show all records for a specific commodity.
     *
     * @param string $commodity
     * @return \Illuminate\View\View
     */
    public function show($commodity)
    {
        // Get all records for the commodity, most recent first
        $records = Commodity::where('commodity', $commodity)
            ->latest() // or ->orderBy('created_at', 'desc')
            ->get();

        $commodities = Commodity::select('commodity')
            ->selectRaw('COUNT(*) as total')
            ->groupBy('commodity')
            ->get();

        return view('admin.database.commodity-table', compact('commodity', 'records', 'commodities'));
    }


    /**
     * Store a new commodity record.
     * Logs the creation into the activity table.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'commodity' => 'required|string|max:255',
            'commodity_other' => 'nullable|string|max:255',
            'thesis_title' => 'required|string|max:500',
            'technologies' => 'nullable|string|max:255',
            'technology_generator' => 'nullable|string|max:255',
            'contact_info' => 'nullable|string|max:100',
            'type_of_technology' => 'nullable|string|max:100',
            'ip_status' => 'nullable|string|max:100',
            'trl_level' => 'nullable|integer|min:1|max:9',
            'sdgs' => 'nullable|string|max:500',
            'remarks' => 'nullable|string|max:255',
            'recommendations' => 'nullable|string|max:500',
            'link' => 'nullable|url|max:500',
            'priority_area' => 'nullable|string|max:255',
        ]);

        // Use custom commodity if "other" is selected
        if ($validated['commodity'] === 'other') {
            $validated['commodity'] = $request->input('commodity_other');
        }

        $commodity = Commodity::create($validated);

        // Log activity
        DBActivity::create([
            'action' => 'created',
            'model' => 'Commodity',
            'record_id' => $commodity->id,
            'thesis_title' => $commodity->thesis_title,
            'technology' => $commodity->technologies,
            'ip_status' => $commodity->ip_status,
            'changes' => json_encode($validated),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Commodity record added successfully!',
            'data' => $commodity,
        ]);
    }

    /**
     * Update a commodity record.
     * Logs the changes into the activity table.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'commodity' => 'required|string|max:255',
            'commodity_other' => 'nullable|string|max:255',
            'thesis_title' => 'required|string|max:500',
            'technologies' => 'nullable|string|max:255',
            'technology_generator' => 'nullable|string|max:255',
            'contact_info' => 'nullable|string|max:100',
            'type_of_technology' => 'nullable|string|max:100',
            'ip_status' => 'nullable|string|max:100',
            'trl_level' => 'nullable|integer|min:1|max:9',
            'sdgs' => 'nullable|string|max:500',
            'remarks' => 'nullable|string|max:255',
            'recommendations' => 'nullable|string|max:500',
            'link' => 'nullable|string|max:500',
            'priority_area' => 'nullable|string|max:255',
        ]);

        if ($validated['commodity'] === 'other') {
            $validated['commodity'] = $request->input('commodity_other');
        }

        $commodity = Commodity::findOrFail($id);
        $oldData = $commodity->toArray();

        $commodity->update($validated);

        // Log activity
        DBActivity::create([
            'action' => 'updated',
            'model' => 'Commodity',
            'record_id' => $commodity->id,
            'thesis_title' => $commodity->thesis_title,
            'technology' => $commodity->technologies,
            'ip_status' => $commodity->ip_status,
            'changes' => json_encode([
                'old' => $oldData,
                'new' => $validated,
            ]),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Commodity record updated successfully!',
            'data' => $commodity,
        ]);
    }

    /**
     * Delete a commodity record.
     * Logs the deletion into the activity table.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        try {
            $record = Commodity::findOrFail($id);
            $recordData = $record->toArray();

            $record->delete();

            DBActivity::create([
                'action' => 'deleted',
                'model' => 'Commodity',
                'record_id' => $id,
                'thesis_title' => $recordData['thesis_title'] ?? null,
                'technology' => $recordData['technologies'] ?? null,
                'ip_status' => $recordData['ip_status'] ?? null,
                'changes' => json_encode($recordData),
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Record deleted successfully.',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete record.',
            ], 500);
        }
    }

    /**
     * Show all recent activity logs across commodities.
     *
     * @return \Illuminate\View\View
     */
    public function activities()
    {
        // Get all activity logs, newest first
        $activities = DBActivity::latest()->get();

        // Pass commodities for modal selection
        $commodities = Commodity::select('commodity')
            ->selectRaw('COUNT(*) as total')
            ->groupBy('commodity')
            ->get();

        return view('admin.database.activity', compact('activities', 'commodities'));
    }

    /**
     * Delete a specific activity record if it's not among the latest three.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteActivity($id)
    {
        $latestThreeIds = DBActivity::orderBy('created_at', 'desc')
            ->limit(3)
            ->pluck('id')
            ->toArray();

        if (in_array($id, $latestThreeIds)) {
            return response()->json([
                'success' => false,
                'message' => 'Cannot delete the latest 3 activity records.',
            ]);
        }

        DBActivity::findOrFail($id)->delete();

        return response()->json([
            'success' => true,
            'message' => 'Activity deleted successfully.',
        ]);
    }

    /**
     * Clear all activity records except the latest three.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function clearAllActivities()
    {
        $latestThreeIds = DBActivity::orderBy('created_at', 'desc')
            ->limit(3)
            ->pluck('id')
            ->toArray();

        DBActivity::whereNotIn('id', $latestThreeIds)->delete();

        return response()->json([
            'success' => true,
            'message' => 'Old activities cleared, latest 3 kept.',
        ]);
    }

    public function graphs()
    {
        $data = Commodity::select('commodity')
            ->selectRaw('COUNT(*) as total')
            ->groupBy('commodity')
            ->pluck('total', 'commodity');

        $techTypes = Commodity::select('type_of_technology')
            ->selectRaw('COUNT(*) as total')
            ->groupBy('type_of_technology')
            ->pluck('total', 'type_of_technology');

        $ipStatuses = Commodity::select('ip_status')
            ->selectRaw('COUNT(*) as total')
            ->groupBy('ip_status')
            ->pluck('total', 'ip_status');

        $trlLevels = Commodity::select('trl_level')
            ->selectRaw('COUNT(*) as total')
            ->groupBy('trl_level')
            ->pluck('total', 'trl_level');

        $priorities = Commodity::select('priority_area')
            ->selectRaw('COUNT(*) as total')
            ->groupBy('priority_area')
            ->pluck('total', 'priority_area');

        $commodities = Commodity::select('commodity')
            ->selectRaw('COUNT(*) as total')
            ->groupBy('commodity')
            ->get();

        return view('admin.database.graphs', compact(
            'data',
            'techTypes',
            'ipStatuses',
            'trlLevels',
            'priorities',
            'commodities'
        ));
    }

    public function view()
    {
        // Only fetch commodities with IP Applied
        $commodities = Commodity::where('ip_status', 'IP Applied')->latest()->get();

        return view('admin.database.view-ip-applied', compact('commodities'));
    }



}
