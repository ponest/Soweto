<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class ExpSalesReport implements FromView,WithEvents
{
    public function registerEvents(): array
    {
        $styleArray = [
            'font' => ['bold' => true, 'name' => 'Cambria', 'size' => 11],
        ];
        return [
            // Handle by a closure.
            AfterSheet::class => function (AfterSheet $event) use ($styleArray) {
                $event->sheet->getStyle('A2:F2')->applyFromArray($styleArray);
                $event->sheet->getStyle('A1:F1')->applyFromArray($styleArray);
                $event->sheet->getStyle('A1:F1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $event->sheet->mergeCells('A1:F1');

                for ($col = 'A'; $col !== 'G'; $col++) {
                    $event->sheet->getColumnDimension($col)->setAutoSize(true);
                }

                $sales = count(session('sales_data'));
                $count = $sales + 3;

                $event->sheet->getStyle('A'.$count.':F'.$count)->applyFromArray($styleArray);


//                $event->sheet->getColumnDimension('B')->setAutoSize(false);
//                $event->sheet->getColumnDimension('B')->setWidth(30);
//                $event->sheet->getStyle('B2:B' . $count)->getAlignment()->setWrapText(true);
//
//                $event->sheet->getColumnDimension('C')->setAutoSize(false);
//                $event->sheet->getColumnDimension('C')->setWidth(40);
//                $event->sheet->getStyle('C2:C' . $count)->getAlignment()->setWrapText(true);
//
//                $event->sheet->getColumnDimension('F')->setAutoSize(false);
//                $event->sheet->getColumnDimension('F')->setWidth(30);
//                $event->sheet->getStyle('F2:F' . $count)->getAlignment()->setWrapText(true);
            }];
    }

    public function view(): View
    {
        $params['items'] = (session('sales_data'));
        $params['total_price'] = (session('total_sales'));
        $params['header_prefix'] = (session('header_prefix'));
        return view('sales::sales.sales_excel', $params);
    }
}
