<?php

namespace Modules\Sales\Commands\Bills;

use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\Printer;

class BillPrint
{
    protected $printer;

    public function __construct()
    {
        // For Windows
         $connector = new WindowsPrintConnector("EPSON M352A");

        // For Network printer (replace with your printer's IP)
//        $connector = new NetworkPrintConnector("192.168.1.100", 9100);

        $this->printer = new Printer($connector);
    }

    public function printBill($receiptData)
    {
        try {
            // Set character set
            $this->printer->setJustification(Printer::JUSTIFY_CENTER);

            // Hotel Name
            $this->printer->setEmphasis(true);
            $this->printer->text($receiptData['hotel_name'] . "\n");
            $this->printer->setEmphasis(false);

            // Invoice header
            $this->printer->text("Invoice\n");
            $this->printer->feed();

            // Receipt details
            $this->printer->setJustification(Printer::JUSTIFY_LEFT);
            $this->printer->text("Receipt No: " . $receiptData['receipt_no'] . "\n");
            $this->printer->text("Date: " . $receiptData['date'] . "\n");
            $this->printer->text("Customer: " . $receiptData['customer'] . "\n");
            $this->printer->feed();

            // Column headers
            $this->printer->text($this->formatLine("Item", "Qty", "Amount"));
            $this->printer->text(str_repeat("-", 42) . "\n");

            // Items
            foreach ($receiptData['items'] as $item) {
                $this->printer->text($item['name'] . "\n");
                $this->printer->text($this->formatItemLine(
                    $item['quantity'],
                    $item['unit_price'],
                    $item['total']
                ));
            }

            $this->printer->feed();

            // Totals
            $this->printer->text(str_repeat("-", 42) . "\n");
            $this->printer->text($this->formatTotal("Total", $receiptData['total']));
            $this->printer->feed();
            $this->printer->text($this->formatTotal("Grand Total", $receiptData['grand_total']));
            $this->printer->feed();
            $this->printer->text($this->formatTotal("Rounded Total", $receiptData['rounded_total']));
            $this->printer->feed();
            $this->printer->text($this->formatTotal("Paid Amount", $receiptData['paid_amount']));
            $this->printer->feed();

            // Total quantity
            $this->printer->text($this->formatTotal("Total Qty", $receiptData['total_qty']));
            $this->printer->feed(2);

            // Footer
            $this->printer->setJustification(Printer::JUSTIFY_CENTER);
            $this->printer->text("Thank you, please visit again.\n");
            $this->printer->feed(3);

            // Cut paper
            $this->printer->cut();

        } finally {
            $this->printer->close();
        }
    }

    private function formatLine($col1, $col2, $col3): string
    {
        return sprintf("%-20s %8s %12s\n", $col1, $col2, $col3);
    }

    private function formatItemLine($qty, $unitPrice, $total): string
    {
        $qtyText = number_format($qty, 1);
        $unitPriceText = number_format($unitPrice, 2);
        $totalText = number_format($total, 2);

        return sprintf("%20s @ %s %12s\n", $qtyText, $unitPriceText, $totalText);
    }

    private function formatTotal($label, $amount): string
    {
        return sprintf("%-28s %s %12s\n", $label, "TZS", number_format($amount, 2));
    }
}
