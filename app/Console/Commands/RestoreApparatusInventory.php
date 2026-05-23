<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\LabRequest;
use App\Models\InventoryTransaction;
use App\Models\InventoryApparatus;
use Carbon\Carbon;

class RestoreApparatusInventory extends Command
{
    protected $signature = 'inventory:restore-apparatus';
    protected $description = 'Restore apparatus from completed lab sessions';

    public function handle()
    {
        // Find lab requests that are in the past and approved
        $pastRequests = LabRequest::where('status', 'approved')
            ->whereDate('approved_date', '<', now())
            ->get();

        foreach ($pastRequests as $request) {
            $this->restoreApparatusForRequest($request);
            
            // Mark request as completed
            $request->update(['status' => 'completed', 'completed_at' => now()]);
        }

        $this->info('Apparatus restoration completed.');
    }

    private function restoreApparatusForRequest(LabRequest $request)
    {
        // Find pending apparatus transactions
        $transactions = InventoryTransaction::where('lab_request_id', $request->id)
            ->where('item_type', 'apparatus')
            ->where('status', 'pending')
            ->get();

        foreach ($transactions as $transaction) {
            $apparatus = InventoryApparatus::find($transaction->item_id);
            
            if ($apparatus) {
                $apparatus->increment('available_quantity', $transaction->quantity);
                
                $transaction->update([
                    'status' => 'restored',
                    'completed_at' => now(),
                ]);
                
                $this->info("Restored {$transaction->quantity} of {$transaction->item_name}");
            }
        }
    }
}