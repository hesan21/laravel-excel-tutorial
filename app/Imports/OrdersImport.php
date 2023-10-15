<?php

namespace App\Imports;

use App\Models\MenuItem;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Events\BeforeSheet;

class OrdersImport implements ToModel, WithEvents, WithHeadingRow, WithBatchInserts, WithChunkReading
{
    use Importable;
    public $sheetName = '';

    /**
     * @return array
     */
    public function registerEvents(): array
    {
        return [
            BeforeSheet::class => function (BeforeSheet $event) {
                $this->sheetName = $event->getSheet()->getDelegate()->getTitle();
            }
        ];
    }

    public function model(array $row) {
        $user = User::where('name', $this->sheetName)->first();
        if (!$user) return null;

        $order = new Order([
            'id' => $row['id'],
            'status' => $row['status'],
            'delivered_at' => $row['delievered_at'],
            'notes' => $row['notes'],
            'amount' => $row['amount'],
        ]);
        $order->user()->associate($user);
        $order->save();

        if ($item = MenuItem::where('name', $row['item'])->first()) {
            $order->items()->create([
                'item_count' => 1,
                'item_id' => $item->id
            ]);
        }

        return $order;
    }

    public function batchSize(): int {
        return 50;
    }

    public function chunkSize(): int
    {
        return 1000;
    }
}
