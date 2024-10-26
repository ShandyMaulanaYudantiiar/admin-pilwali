<?php

namespace App\Filament\Resources\RelawanResource\Widgets;

use App\Models\Recommander;
use Filament\Widgets\Widget;
use Illuminate\Support\Facades\DB;

class RelawanOverview extends Widget
{
    protected static string $view = 'filament.resources.relawan-resource.widgets.relawan-overview';

    public $recommanders;

    public function mount()
    {
        $this->recommanders = Recommander::select('recommanders.id', 'recommanders.nama_recommander', 'recommanders.created_at', DB::raw('COUNT(relawans.id) as relawan_count'))
            ->leftJoin('relawans', 'recommanders.id', '=', 'relawans.recommander_id')
            ->groupBy('recommanders.id', 'recommanders.nama_recommander', 'recommanders.created_at')
            ->orderBy('relawan_count', 'desc')
            ->limit(5)
            ->get();
    }
}
