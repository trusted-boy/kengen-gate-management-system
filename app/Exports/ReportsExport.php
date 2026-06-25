<?php

namespace App\Exports;

use App\Models\Visitor;
use App\Models\Vehicle;
use App\Models\Contractor;
use App\Models\EquipmentMovement;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ReportsExport implements FromCollection, WithHeadings, WithStyles
{
    public function collection()
    {
        $visitors = Visitor::select('full_name', 'id_number', 'phone', 'organization', 'host_name', 'department', 'status', 'check_in_time', 'check_out_time')->get();

        return $visitors;
    }

    public function headings(): array
    {
        return ['Name', 'ID Number', 'Phone', 'Organization', 'Host', 'Department', 'Status', 'Check In', 'Check Out'];
    }

    public function styles(Worksheet $sheet): array
    {
        return [
            1 => ['font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']], 'fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '667eea']]],
        ];
    }
}
