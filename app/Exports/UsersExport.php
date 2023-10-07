<?php

namespace App\Exports;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Throwable;

class UsersExport implements WithMultipleSheets, ShouldQueue
// , WithEvents
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

    // /**
    //  * @return array
    //  */
    // public function registerEvents(): array
    // {
    //     return [
    //         BeforeExport::class  => function(BeforeExport $event) {
    //             $event->writer->setCreator('Hesan');
    //         },
    //         AfterSheet::class    => function(AfterSheet $event) {
    //             $event->sheet->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);

    //             $event->sheet->styleCells(
    //                 'B2:G8',
    //                 [
    //                     'borders' => [
    //                         'outline' => [
    //                             'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
    //                             'color' => ['argb' => 'FFFF0000'],
    //                         ],
    //                     ]
    //                 ]
    //             );
    //         },
    //     ];
    // }
}
