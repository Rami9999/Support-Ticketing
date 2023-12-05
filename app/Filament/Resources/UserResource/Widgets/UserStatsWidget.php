<?php

namespace App\Filament\Resources\UserResource\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\User;

class UserStatsWidget extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Users',User::count()),
            Stat::make('Total Admin',User::where('role',User::ROLE_ADMIN)->count()),
            Stat::make('Total Editor',User::where('role',User::ROLE_EDITOR)->count())
        ];
    }
}
