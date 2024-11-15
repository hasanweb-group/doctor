@php
use App\Enums\Localization;
$currentPatientlabel = Localization::Patient->value . '.current_patient'
@endphp
<x-filament-panels::page>
    <div  wire:poll>
        @if ($this->getCurrentPatientAppointment())
            <p>{{ __($currentPatientlabel) }}</p>
            <ul>
                <li>{{ $this->currentPatientAppointment->full_name }}</li>
                <li>{{ $this->currentPatientAppointment->age }}</li>
            </ul>
        @endif
    </div>
    <div>
        {{ $this->table }}
    </div>
</x-filament-panels::page>
