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

    public static function numberToWords($number) {
        $words = [
            'zero', 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine',
            'ten', 'eleven', 'twelve', 'thirteen', 'fourteen', 'fifteen', 'sixteen', 'seventeen', 'eighteen', 'nineteen'
        ];

        $tens = [
            '', '', 'twenty', 'thirty', 'forty', 'fifty', 'sixty', 'seventy', 'eighty', 'ninety'
        ];

        $num = abs((int)$number);
        $result = '';

        if($num < 20) {
            $result = $words[$num];
        } elseif($num < 100) {
            $result = $tens[(int)($num / 10)];
            if($num % 10) {
                $result .= '-'.$words[$num % 10];
            }
        } elseif($num < 1000) {
            $result = $words[(int)($num / 100)].' hundred';
            if($num % 100) {
                $result .= ' and '.self::numberToWords($num % 100);
            }
        } elseif($num < 12000) {
            $result = $words[(int)($num / 1000)].' thousand';
            if($num % 1000) {
                $result .= ' '.self::numberToWords($num % 1000);
            }
        } else {
            $result = 'Number is too large for conversion';
        }

        return $result;
    }
}
