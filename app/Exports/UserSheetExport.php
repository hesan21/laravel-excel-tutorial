<?php

namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;

class UserSheetExport implements WithTitle, WithHeadings, FromQuery, WithMapping
{
    public $user;

    public function __construct ($user) {
        $this->user = $user;
    }

    /**
     * @return string
     */
    public function title(): string {
        return $this->user->name;
    }

    public function headings (): array {
        return [
            'ID',
            'Notes',
            'Status',
            'Amount'
        ];
    }

    public function query() {
        return Order::where('user_id', $this->user->id);
    }

    public function map($row): array {
        return [
            $row['id'],
            $row['notes'],
            $row['status'],
            $row['amount'],
        ];
    }
}
