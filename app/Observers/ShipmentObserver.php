<?php

namespace App\Observers;

use App\Models\Shipment;

class ShipmentObserver
{
    public function updated(Shipment $shipment): void
    {
        if ($shipment->wasChanged('stock')) {
            $shipment->histories()->create([
                'last_stock'  => (int) $shipment->getOriginal('stock'),
                'new_stock'   => (int) $shipment->stock,
                'change_type' => request()->input('change_type'),
            ]);
        }
    }
}
