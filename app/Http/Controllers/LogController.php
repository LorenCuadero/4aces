<?php

namespace App\Http\Controllers;

use App\Models\Log;
use Illuminate\Http\Request;

class LogController extends Controller
{
   public function index()
   {
    $logs = Log::all();

    return view('pages.admin-auth.logs.index', compact('logs'));
   }
}
