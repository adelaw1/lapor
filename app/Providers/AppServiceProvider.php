<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Carbon;
use Illuminate\Support\Number;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Carbon::macro('toSpelledOutIndonesian', function () {
            /** @var Carbon $this */
            $date = $this->copy()->locale('id');

            $namaHari      = $date->translatedFormat('l');
            $hariTerbilang  = Number::spell((int) $date->format('d'), locale: 'id');
            $namaBulan     = strtolower($date->translatedFormat('F'));
            $tahunTerbilang = Number::spell((int) $date->format('Y'), locale: 'id');

            return "<b><i>{$namaHari}</i></b> tanggal <b><i>{$hariTerbilang}</i></b> bulan <b><i>{$namaBulan}</i></b> tahun <b><i>{$tahunTerbilang}</i></b>.";
        });
    }
}
