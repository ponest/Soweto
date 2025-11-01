<?php

namespace Modules\General\Http\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Modules\Auth\Models\User;
use Spatie\Activitylog\Models\Activity;

class LogActivitiesController extends Controller
{
    public function index()
    {
        $params['logs'] = Activity::latest()->limit(200)->get(); // paginate for convenience
        $params['users'] = User::orderBy('first_name')->get();
        return view('general::log_activities.index', $params);
    }

    public function getFiltered(Request $request)
    {
        $query = Activity::query()->latest();

        if ($request->filled('user_id')) {
            $query->where('causer_id', $request->user_id);
        }

        if ($request->filled('action')) {
            $query->where('properties->action', $request->action);
        }

        if ($request->filled('from_date') && $request->filled('to_date')) {
            $from = Carbon::parse($request->from_date)->startOfDay();
            $to = Carbon::parse($request->to_date)->endOfDay();
            $query->whereBetween('created_at', [$from, $to]);
        }

        $params['logs'] = $query->latest()->get();
        $params['users'] = User::orderBy('first_name')->get();// If you want to list all users for the dropdown

        return view('general::log_activities.index', $params);
    }
}
