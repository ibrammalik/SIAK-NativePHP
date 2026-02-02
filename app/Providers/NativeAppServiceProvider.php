<?php

namespace App\Providers;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Native\Desktop\Facades\Window;
use Native\Desktop\Contracts\ProvidesPhpIni;
use Native\Desktop\Facades\Menu;

class NativeAppServiceProvider implements ProvidesPhpIni
{
    /**
     * Executed once the native application has been booted.
     * Use this method to open windows, register global shortcuts, etc.
     */
    public function boot(): void
    {
        try {
            if (DB::table('kelurahan')->count() === 0) {
                Artisan::call('db:seed', [
                    '--class' => 'KelurahanSeeder',
                    '--force' => true,
                ]);

                Log::info('KelurahanSeeder berhasil dijalankan otomatis.');
            }
        } catch (\Throwable $e) {
            Log::error('Gagal menjalankan KelurahanSeeder otomatis.', [
                'message' => $e->getMessage(),
                'file'    => $e->getFile(),
                'line'    => $e->getLine(),
            ]);
        }

        Menu::create(
            Menu::file(),
            Menu::edit(),
            Menu::view(),
            Menu::window(),
            Menu::route('beranda', 'Beranda'),
            Menu::route('filament.app.pages.dashboard', 'Dashboard'),
        );

        Window::open()
            ->maximized()
            ->zoomFactor(0.8);
    }

    /**
     * Return an array of php.ini directives to be set.
     */
    public function phpIni(): array
    {
        return [];
    }
}
