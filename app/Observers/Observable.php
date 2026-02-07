<?php

namespace App\Observers;

trait Observable
{
    public static function bootObservable(): void
    {
        $observer = class_basename(self::class).'Observer';

        self::observe("App\Observers\\$observer");
    }
}
