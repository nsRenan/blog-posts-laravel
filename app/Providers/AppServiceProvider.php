<?php

namespace App\Providers;

use App\Models\Topic;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
        // Mantém o que você já tinha
        View::composer('layouts.app', function ($view) {
            $view->with('topics', Topic::orderBy('name')->get());
        });

        // Adiciona o tópico selecionado da rota (se houver)
        View::composer('layouts.app', function ($view) {
            $view->with('topicId', request()->route('Id') ?? null);
        });
    }
}
