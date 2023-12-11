<?php

namespace App\Http\Controllers;

use App\Models\Log;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class LogController extends Controller {
    public function index() {
        if(Auth::user()->role != '2') {
            return redirect()->back()->with('error', 'You do not have permission to access this page');
        }

        $sixMonthsAgo = Carbon::now()->subMonths(6);

        $logs = Log::whereDate('created_at', '>=', $sixMonthsAgo)
            ->orderBy('created_at', 'desc')
            ->get();

        // dd($logs);

        return view('pages.admin-auth.logs.index', compact('logs'));
    }

}
