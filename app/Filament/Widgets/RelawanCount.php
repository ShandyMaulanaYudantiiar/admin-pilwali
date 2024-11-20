<?php

namespace App\Filament\Widgets;

use App\Models\Relawan;
use Filament\Widgets\Widget;

class RelawanCount extends Widget
{
    protected static string $view = 'filament.widgets.relawan-count';

    protected function getViewData(): array
    {
        return [
            'count' => Relawan::count(),
        ];
    }
}
