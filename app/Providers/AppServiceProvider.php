<?php

namespace App\Providers;

use App\Repositories\Question\QuestionRepository;
use App\Services\CategoryService;
use App\Services\QuestionService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(QuestionService::class, function ($app) {
            return new QuestionService(
                $app->make(QuestionRepository::class),
                $app->make(CategoryService::class)
            );
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
