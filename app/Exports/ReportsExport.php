<?php

namespace App\Exports;

use App\Models\Visitor;
use App\Models\InternsAttachee;
use App\Models\Staff;
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
        $visitors = Visitor::select(
            'full_name',
            'id_number',
            'phone',
            'vehicle_registration',
            'number_of_visitors',
            'reason_for_visit',
            'host_name',
            'whom_to_see',
            'purpose',
            'check_in_time',
            'check_out_time',
            'status'
        )->get();

        return $visitors;
    }

    public function headings(): array
    {
        return [
            'Name',
            'ID Number',
            'Phone',
            'Vehicle',
            'No. Visitors',
            'Reason',
            'Host',
            'Whom to See',
            'Purpose',
            'Check In',
            'Check Out',
            'Status'
        ];
    }

    public function styles(Worksheet $sheet): array
    {
        return [
            1 => [
                'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
                'fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '667eea']],
            ],
        ];
    }
}
