<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class InvalidRowsExport implements FromCollection, WithHeadings
{
    protected $invalidRows;

    public function __construct($invalidRows)
    {
        $this->invalidRows = $invalidRows;
    }

    public function collection()
    {
        return collect($this->invalidRows);
    }

    public function headings(): array
    {
        return ['NIK', 'No HP', 'Recommander', 'Anggota Dewan', 'Operator', 'Organisasi', 'Jabatan', 'SK', 'Status NIK', 'Error'];
    }
}
