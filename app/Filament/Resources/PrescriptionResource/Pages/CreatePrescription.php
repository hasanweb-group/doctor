<?php

namespace App\Filament\Resources\PrescriptionResource\Pages;

use App\Filament\Resources\PrescriptionResource;
use App\Traits\HasResourceIndexRedirect;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePrescription extends CreateRecord
{
    use HasResourceIndexRedirect;

    protected static string $resource = PrescriptionResource::class;
}
