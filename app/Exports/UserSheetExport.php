<?php

namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithDefaultStyles;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style;
use PhpOffice\PhpSpreadsheet\Style\Style as DefaultStyles;


class UserSheetExport implements WithTitle, WithHeadings, FromQuery, WithMapping, WithColumnWidths, ShouldAutoSize, WithStyles, WithEvents
{
    use RegistersEventListeners;
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

    public function columnWidths(): array {
        return [
            'B'=> 25
        ];
    }

    public function styles(Worksheet $sheet) {
        // return [
        //     '1' => ['font' => ['bold' => true]],
        // ];
        $sheet->getStyle('1')->getFont()->setBold(true);
        $sheet->getStyle('B1:B'.$sheet->getHighestRow())->getAlignment()->setWrapText(true);
    }

    /**
     * @return array|void
     */
    public function defaultStyles(DefaultStyles $defaultStyle)
    {
        return [
            'font' => [
                'name' => 'Calibri',
                'size' => 12
            ],
            'alignment' => [
                'horizontal' => Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => Style\Alignment::VERTICAL_CENTER,
            ],
        ];
    }

    public static function afterSheet(AfterSheet $event)
    {
        return $event->sheet->getDelegate()->setRightToLeft(true);
    }
}
