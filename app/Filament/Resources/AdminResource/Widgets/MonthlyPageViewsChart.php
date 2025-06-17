<?php

namespace App\Filament\Resources\AdminResource\Widgets;

use App\Models\PageView;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MonthlyPageViewsChart extends ChartWidget
{
    protected static ?string $heading = 'Nombre de vues par mois (année en cours)';

    protected function getData(): array
    {
        // Récupère les vues groupées par mois pour l'année en cours
        $views = PageView::select(
                DB::raw('MONTH(created_at) as month'),
                DB::raw('COUNT(*) as total')
            )
            ->whereYear('created_at', Carbon::now()->year)
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        // Liste des mois avec noms français abrégés
        $monthLabels = [
            1 => 'Jan', 2 => 'Fév', 3 => 'Mar', 4 => 'Avr',
            5 => 'Mai', 6 => 'Juin', 7 => 'Juil', 8 => 'Août',
            9 => 'Sep', 10 => 'Oct', 11 => 'Nov', 12 => 'Déc'
        ];

        $labels = [];
        $data = [];

        foreach ($views as $view) {
            $labels[] = $monthLabels[$view->month];
            $data[] = $view->total;
        }

        return [
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'Vues',
                    'data' => $data,
                    'backgroundColor' => [
                        '#3b82f6', '#10b981', '#f59e0b', '#ef4444',
                        '#6366f1', '#ec4899', '#8b5cf6', '#22d3ee',
                        '#84cc16', '#eab308', '#14b8a6', '#f97316',
                    ],
                ],
            ],
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
