<?php

namespace App\Filament\Resources\AdminResource\Widgets;

use App\Models\PageView;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class PageViewStats extends ChartWidget
{
    protected static ?string $heading = 'Nombre de vues par jour (7 derniers jours)';

    protected function getData(): array
    {
        $views = PageView::select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('COUNT(*) as total')
            )
            ->where('created_at', '>=', now()->subDays(6)->startOfDay())
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        $labels = $views->pluck('date')->map(fn ($date) => \Carbon\Carbon::parse($date)->format('d/m'))->toArray();
        $data = $views->pluck('total')->toArray();

        return [
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'Vues',
                    'data' => $data,
                    'backgroundColor' => 'rgba(59, 130, 246, 0.7)',
                    'borderColor' => 'rgba(59, 130, 246, 1)',
                    'borderWidth' => 1,
                ],
            ],
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}