<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class ExpPaymentReport implements FromView,WithEvents
{
    public function registerEvents(): array
    {
        $styleArray = [
            'font' => ['bold' => true, 'name' => 'Cambria', 'size' => 11],
        ];
        return [
            // Handle by a closure.
            AfterSheet::class => function (AfterSheet $event) use ($styleArray) {
                $event->sheet->getStyle('A2:G2')->applyFromArray($styleArray);
                $event->sheet->getStyle('A1:G1')->applyFromArray($styleArray);
                $event->sheet->getStyle('A1:G1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $event->sheet->mergeCells('A1:G1');

                for ($col = 'A'; $col !== 'H'; $col++) {
                    $event->sheet->getColumnDimension($col)->setAutoSize(true);
                }

                $sales = count(session('payment_data'));
                $count = $sales + 3;

                $event->sheet->getStyle('A'.$count.':G'.$count)->applyFromArray($styleArray);

            }];
    }

    public function view(): View
    {
        $params['items'] = (session('payment_data'));
        $params['total_price'] = (session('total_payments'));
        $params['header_prefix'] = (session('header_prefix'));
        return view('sales::payment.excel', $params);
    }
}
