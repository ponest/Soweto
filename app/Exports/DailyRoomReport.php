<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class DailyRoomReport implements FromView,WithEvents
{
    public function registerEvents(): array
    {
        $styleArray = [
            'font' => ['bold' => true, 'name' => 'Cambria', 'size' => 12],
        ];
        return [
            // Handle by a closure.
            AfterSheet::class => function (AfterSheet $event) use ($styleArray) {
                $event->sheet->getStyle('A2:I2')->applyFromArray($styleArray);
                $event->sheet->getStyle('A1:I1')->applyFromArray($styleArray);
                $event->sheet->getStyle('A1:I1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $event->sheet->mergeCells('A1:I1');

                for ($col = 'A'; $col !== 'J'; $col++) {
                    $event->sheet->getColumnDimension($col)->setAutoSize(true);
                }
            }];
    }

    public function view(): View
    {
        $params['items'] = (session('room_status_data'));
        $params['header'] = (session('header'));
        return view('reports::room_status.excel', $params);
    }
}
