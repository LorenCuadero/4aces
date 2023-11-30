<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use App\Models\Log;

class StoreLogsService
{
    public static function storeLogs(int $user_id, $action, $record, $student_id, $staff_id, $year)
    {
        if ($user_id && $action) {
            $logs = new Log();
            $logs->user_id = $user_id;
            $logs->action = $action;
            $logs->record = $record;
            $logs->student_id = $student_id;
            $logs->staff_id = $staff_id;
            $logs->year = $year;
            $logs->save();

            return response()->json(['message' => 'Log stored successfully']);
        }
        return response()->json(['error' => 'Invalid user_id or action']);
    }
}
