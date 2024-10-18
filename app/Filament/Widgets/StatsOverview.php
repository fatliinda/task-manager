<?php

namespace App\Filament\Widgets;

use App\Models\Task;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Tasks',Task::count())
            ->description('Tasks trend')
            ->descriptionIcon('heroicon-m-arrow-trending-up')
            ->color('primary')
            ->chart([3,4,5,6,7,3]),

             Stat::make('Completed Tasks', Task::where('status', 'done')->count())
             ->description('Tasks completed successfully')
             ->descriptionIcon('heroicon-m-check-circle')
             ->color('success')
             ->chart([1, 2, 3, 5, 4, 6]),

              Stat::make('Tasks in Progress', Task::where('status', 'in_progress')->count())
             ->description('Tasks currently being worked on')
             ->descriptionIcon('heroicon-m-arrow-right')
             ->color('warning')
             ->chart([2, 3, 2, 4, 1, 3]),

            Stat::make('Tasks To Do', Task::where('status', 'todo')->count())
            ->description('Tasks that are yet to be started')
            ->descriptionIcon('heroicon-m-clock')
            ->color('secondary')
            ->chart([4, 3, 5, 2, 6, 4]),
        
        ];
    }
    
}

    
        

