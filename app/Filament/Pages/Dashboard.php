<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use App\Filament\Resources\AdminResource\Widgets\PageViewStats;
use App\Filament\Resources\AdminResource\Widgets\MonthlyPageViewsChart;
use App\Filament\Resources\AdminResource\Widgets\PageViewsOverview;

class Dashboard extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.dashboard';

    protected function getHeaderWidgets(): array
    {
        return [
            PageViewStats::class,
            MonthlyPageViewsChart::class,
            PageViewsOverview::class,
        ];
    }
}
