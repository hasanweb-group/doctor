<?php

namespace App\Traits;

trait HasResourceIndexRedirect
{
    protected function getRedirectUrl(): string
    {
        return static::getResource()::getUrl('index');
    }
}
