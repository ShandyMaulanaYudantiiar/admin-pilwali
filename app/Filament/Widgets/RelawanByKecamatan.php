<?php

namespace App\Filament\Widgets;

use App\Models\Relawan;
use Filament\Widgets\Widget;
use Illuminate\Support\Facades\DB;

class RelawanByKecamatan extends Widget
{
    protected static string $view = 'filament.widgets.relawan-by-kecamatan';
    protected function getViewData(): array
    {
        $relawanByKecamatan = DB::table('dpt')
            ->select('kecamatan', DB::raw('count(relawans.nik) as total'))
            ->leftJoin('relawans', 'dpt.nik', '=', 'relawans.nik')
            ->groupBy('dpt.kecamatan')
            ->get();

        return [
            'relawanByKecamatan' => $relawanByKecamatan,
        ];
    }
}
