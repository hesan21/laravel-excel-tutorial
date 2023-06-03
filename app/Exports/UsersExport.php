<?php

namespace App\Exports;

use App\Models\Order;
use App\Models\User;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;

class UsersExport implements FromArray, WithHeadings, WithMapping, WithStrictNullComparison
{
    use Exportable;

    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * @return array
     */
    public function headings(): array {
        $headings = [];
        foreach ( $this->data->toArray()[0] as $key => $value ) {
            $headings[] = User::HEADINGS[$key];
        }
        $headings[] = 'Failed Orders Count';
        return $headings;
    }

    /**
     * @return array
     */
    public function array(): array
    {
        return $this->data->toArray();
    }

    public function prepareRows($rows)
    {
        foreach ($rows as $key => $user) {
            $rows[$key]['name'].= '(prepared)';
        }
        return $rows;
    }

     /**
     * @param  mixed  $row
     * @return array
     */
    public function map($row): array {
        return [
            // [
                $row['id'],
                $row['name'],
                $row['email'],
                $row['address'],
                $row['phone_no'],
                Order::where('status', 'failed')->where('user_id', $row['id'])->count()
            // ],
            // [
            //     $row['id'],
            //     $row['name'],
            //     $row['email'],
            //     $row['address'],
            //     '----'
            // ],
            // [
            //     $row['id'],
            //     $row['name'],
            //     $row['email'],
            //     '----',
            //     $row['phone_no']
            // ]
        ];
    }
}
