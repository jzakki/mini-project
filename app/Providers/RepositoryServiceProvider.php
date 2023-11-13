<?php

namespace App\Providers;

use App\Repositories\Category\CategoryRepository;
use App\Repositories\Category\EloquentCategoryRepository;
use App\Repositories\Game\EloquentGameRepository;
use App\Repositories\Game\GameRepository;
use App\Repositories\Player\EloquentPlayerRepository;
use App\Repositories\Player\PlayerRepository;
use App\Repositories\PlayerAnswer\EloquentPlayerAnswerRepository;
use App\Repositories\PlayerAnswer\PlayerAnswerRepository;
use App\Repositories\PlayerGame\EloquentPlayerGameRepository;
use App\Repositories\PlayerGame\PlayerGameRepository;
use App\Repositories\Question\EloquentQuestionRepository;
use App\Repositories\Question\QuestionRepository;
use App\Repositories\Score\EloquentScoreRepository;
use App\Repositories\Score\ScoreRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(GameRepository::class, EloquentGameRepository::class);
        $this->app->bind(PlayerRepository::class, EloquentPlayerRepository::class);
        $this->app->bind(PlayerGameRepository::class, EloquentPlayerGameRepository::class);
        $this->app->bind(QuestionRepository::class, EloquentQuestionRepository::class);
        $this->app->bind(CategoryRepository::class, EloquentCategoryRepository::class);
        $this->app->bind(PlayerAnswerRepository::class, EloquentPlayerAnswerRepository::class);
        $this->app->bind(ScoreRepository::class, EloquentScoreRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
