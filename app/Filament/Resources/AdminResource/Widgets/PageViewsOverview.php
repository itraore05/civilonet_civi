<?php

namespace App\Filament\Resources\AdminResource\Widgets;

use App\Models\PageView;
use Carbon\Carbon;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;
use Illuminate\Support\Facades\DB;

class PageViewsOverview extends BaseWidget
{
    // Retirer la déclaration static ici
    protected ?string $heading = 'Statistiques de vues';  // Pas de static ici

    protected function getCards(): array
    {
        $today = Carbon::today();
        $startOfWeek = now()->subDays(6)->startOfDay();
        $startOfPreviousWeek = now()->subDays(13)->startOfDay();
        $endOfPreviousWeek = now()->subDays(7)->endOfDay();

        $todayViews = PageView::whereDate('created_at', $today)->count();

        $thisWeekViews = PageView::where('created_at', '>=', $startOfWeek)->count();
        $lastWeekViews = PageView::whereBetween('created_at', [$startOfPreviousWeek, $endOfPreviousWeek])->count();

        $trend = 0;
        if ($lastWeekViews > 0) {
            $trend = (($thisWeekViews - $lastWeekViews) / $lastWeekViews) * 100;
        }

        return [
            Card::make('Vues aujourd\'hui', $todayViews)
                ->description('Total de vues pour la journée en cours'),

            Card::make('Vues cette semaine', $thisWeekViews)
                ->description('Total des vues sur les 7 derniers jours'),

            Card::make('Tendance hebdomadaire', ($trend >= 0 ? '+' : '') . number_format($trend, 2) . '%')
                ->description('Comparaison par rapport à la semaine précédente')
                ->color($trend > 0 ? 'success' : ($trend < 0 ? 'danger' : 'gray')),
        ];
    }
}
