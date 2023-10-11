<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithGroupedHeadingRow;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithUpsertColumns;
use Maatwebsite\Excel\Concerns\WithUpserts;

class UserImport implements ToModel, WithUpserts, WithUpsertColumns, WithHeadingRow, WithGroupedHeadingRow
{
    use Importable;

    public function model(array $row) {

        if (!$row[0]) {
            return null;
        }
        return new User([
            'name' => $row['name'],
            'email' => $row['email'],
            'phone_no' => $row['phone_no'],
            'password' => Hash::make($row['password']),
            'address' => $row['address']
        ]);
    }

    public function uniqueBy()
    {
        return 'email';
    }

    public function upsertColumns()
    {
        return ['name'];
    }

    public function headingRow(): int
    {
        return 2;
    }
}
