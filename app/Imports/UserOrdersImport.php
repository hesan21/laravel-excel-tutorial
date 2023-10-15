<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class UserOrdersImport implements WithMultipleSheets
{
    use Importable;
    public function sheets(): array {
        return [
            new OrdersImport(),
            new OrdersImport()
        ];
    }
}
