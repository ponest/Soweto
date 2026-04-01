<?php

namespace Modules\General\Commands\KitchenTransRequest;

use Exception;
use Modules\General\Models\KitchenTransReq;
use Modules\General\Models\KitchenTransReqItem;

class SubmitCommand
{
    public static function handle($id): array
    {
        try {
            //check if there are items
            $items = KitchenTransReqItem::where('kitchen_trans_req_id', $id)->get();
            if ($items->count() == 0) {
                return [
                    'message' => 'Please add items to the request!',
                    'type' => 'error'
                ];
            }

            $kitchenTransReq = KitchenTransReq::find($id);
            $kitchenTransReq->submitted_by = auth()->id();
            $kitchenTransReq->submitted_at = now();
            $kitchenTransReq->status = "Submitted";

            //Remove other states
            $kitchenTransReq->is_approved = null;
            $kitchenTransReq->reviewed_at = null;
            $kitchenTransReq->reviewed_by = null;
            $kitchenTransReq->reject_comments = null;

            $kitchenTransReq->update();
            //Sending Notification Back
            return [
                'message' => 'Kitchen Transaction Request Successfully Submitted!',
                'type' => 'success'
            ];

        } catch (Exception $ex) {
            return [
                'message' => $ex->getMessage(),
                'type' => 'error'
            ];
        }
    }
}
