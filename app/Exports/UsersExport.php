<?php

namespace App\Exports;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Throwable;

class UsersExport implements WithMultipleSheets, ShouldQueue
{
    use Exportable, Queueable;

    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }
    /**
     * @return array
     */
    public function sheets(): array {
        $sheets = [];
        foreach($this->data as $user) {
            $sheets[] = new UserSheetExport($user);
        }
        return $sheets;
    }

    public function failed(Throwable $exception) {
        // Handle Error
    }
}
