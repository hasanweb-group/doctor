<?php

namespace App\Helpers;

use Illuminate\Support\Str;

class Patient
{
    public static function getPatientQrCodeValue()
    {
        return env('PATIENT_QR_CODE_URL', 'PATIENT_QR_CODE_URL_FALLBACK') . '/' . Str::uuid();
    }

    public static function getPatienQrCodeEnv()
    {
        return env('PATIENT_QR_CODE_URL', 'PATIENT_QR_CODE_URL_FALLBACK') . '/';
    }
}
