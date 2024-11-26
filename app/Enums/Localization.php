<?php

namespace App\Enums;


enum Localization: string
{
    case Patient = 'patient';
    case Doctor = 'doctor';
    case Prescription = 'prescription';
    case PrescriptionInformation = 'prescriptionInformation';
    case Drug = 'drug';
}
