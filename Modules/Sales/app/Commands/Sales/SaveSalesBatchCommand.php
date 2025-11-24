<?php

namespace Modules\Sales\Commands\Sales;

use Modules\Sales\Models\SalesBatch;

class SaveSalesBatchCommand
{
    public static function handle($grandTotal, $category, $booking): SalesBatch
    {
        $salesBatch = new SalesBatch();
        $salesBatch->batch_number = 'SL-' . now()->timestamp;
        $salesBatch->total_price = $grandTotal;
        $salesBatch->created_by = auth()->id();
        $salesBatch->source = ucwords($category);
        $salesBatch->room_id = $booking?->room_id;
        $salesBatch->client_id = $booking?->client_id;
        $salesBatch->client_type = $booking ? 'Hotel Guest' : null;
        $salesBatch->save();
        return $salesBatch;
    }
}
