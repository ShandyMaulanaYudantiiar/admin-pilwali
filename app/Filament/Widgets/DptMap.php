<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DptMap extends Widget
{
    protected static string $view = 'filament.widgets.dpt-map';
    protected function getViewData(): array
    {
        $addresses = DB::table('dpt')
            ->join('relawans', 'dpt.nik', '=', 'relawans.nik')
            ->select('dpt.alamat')
            ->get();
        // Log the addresses to see the result
        Log::info('Addresses:', $addresses->toArray());


        return [
            'addresses' => $addresses,
        ];
    }
}
