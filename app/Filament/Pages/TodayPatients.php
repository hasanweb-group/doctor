<?php

namespace App\Filament\Pages;

use App\Enums\Gender;
use App\Enums\Localization;
use App\Models\Patient;
use Filament\Actions\ActionGroup;
use Filament\Pages\Page;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Columns\Layout\View;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Contracts\Support\Htmlable;

class TodayPatients extends Page implements HasTable
{
    use InteractsWithTable;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.today-patients';

    public $currentPatientAppointment = null;


    public static function getNavigationLabel(): string
    {
        return __(Localization::Patient->value . '.today_patients');
    }

    public function getTitle(): string|Htmlable
    {
        return __(Localization::Patient->value . '.today_patients');
    }



    public function table(Table $table): Table
    {

        return $table
            ->searchable()
            ->query($this->todayPatientsQuery())
            ->striped()
            ->columns([

                ImageColumn::make('photo')
                    ->label(Localization::Patient->value . '.photo')
                    ->translateLabel()
                    ->toggleable()
                    ->disk('public'),

                TextColumn::make('full_name')
                    ->label(Localization::Patient->value . '.full_name')
                    ->translateLabel()
                    ->toggleable()
                    ->sortable(),

                TextColumn::make('gender')
                    ->label(Localization::Patient->value . '.gender.title')
                    ->translateLabel()
                    ->formatStateUsing(fn($state) => Gender::getLabelByValue($state))
                    ->toggleable()
                    ->sortable(),

                TextColumn::make('age')
                    ->label(Localization::Patient->value . '.age')
                    ->translateLabel()
                    ->toggleable()
                    ->sortable(),


            ])
            ->filters([
                // Optionally add filters here
            ])
            ->actions([]);
    }

    public function getCurrentPatientAppointment()
    {
        $currentTime = now();

        $this->currentPatientAppointment =  Patient::whereHas('appointments', function ($query) use ($currentTime) {
            $query->whereDate('start_at', $currentTime)
                ->whereDate('end_at', $currentTime);;
        })->first();

        return $this->currentPatientAppointment;
    }

    public function todayPatientsQuery()
    {
        return Patient::whereHas('appointments', function ($query) {
            $query->whereDate('start_at', now());
        })->whereNot('id', $this->getCurrentPatientAppointment()->id);
    }
}
