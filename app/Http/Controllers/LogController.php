<?php

namespace App\Http\Controllers;

use App\Models\Log;
use Illuminate\Http\Request;
use Carbon\Carbon;

class LogController extends Controller
{
   public function index()
   {
        $sixMonthsAgo = Carbon::now()->subMonths(6);

        Log::whereDate('created_at', '<', $sixMonthsAgo)->delete();

        $logs = Log::orderBy('created_at', 'desc')->get();

        return view('pages.admin-auth.logs.index', compact('logs'));
   }
}
