<?php

namespace App\Exports;

use PHPExcel_Worksheet_MemoryDrawing;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeExport;
use Maatwebsite\Excel\Events\AfterSheet;
Use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use PhpOffice\PhpSpreadsheet\RichText\RichText;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use \PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use \Milon\Barcode\DNS1D;
use \Milon\Barcode\DNS2D;
use App\MttRegistration;
use App\CustomOrder;
use \stdClass;
use Carbon;
use Auth;
use DB;

class CustomQuantity implements FromCollection, WithHeadings, WithDrawings, WithEvents, WithCustomStartCell
{
    /**
     * @return \Illuminate\Support\Collection
     */

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                //$event->sheet->getDelegate()->getColumnDimension('A')->setWidth(15);
                $event->sheet->getDelegate()->getRowDimension('1')->setRowHeight(80);
                $event->sheet->getDelegate()->getRowDimension('A2:H12')->setRowHeight(20);
                $event->sheet->getDelegate()->getColumnDimension('A')->setWidth(9);
                $event->sheet->getDelegate()->getColumnDimension('B')->setWidth(12);
                $event->sheet->getDelegate()->getColumnDimension('C')->setWidth(16);
                $event->sheet->getDelegate()->getColumnDimension('D')->setWidth(50);
                $event->sheet->getDelegate()->getColumnDimension('E')->setWidth(12);
                $event->sheet->getDelegate()->getColumnDimension('F')->setWidth(18);
                $event->sheet->getDelegate()->getColumnDimension('G')->setWidth(5);
                $event->sheet->getDelegate()->getColumnDimension('H')->setWidth(3);
                $event->sheet->getDelegate()->getStyle('A3:Bs140')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);

                // setting default row height
                $event->sheet->getDefaultRowDimension('A2:H50')->setRowHeight(19);
                $event->sheet->getDelegate()->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
                $cellRange = 'A1:E100';
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(9);
                $event->sheet->getDelegate()->getStyle("B3:E1000")->getAlignment()->setWrapText(true);
                $event->sheet->getDelegate()->getStyle("A3:H1000")->getAlignment()->applyFromArray(array('vertical' => 'top'));
                $event->sheet->getDelegate()->getStyle('A2:F2')->getAlignment()->applyFromArray( [ 'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT ] );
                $styleArray = [
                    'borders' => [
                        'inside' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            'color' => ['argb' => 'C0C0C0'],
                        ],
                    ],
                ];

                $event->sheet->getDelegate()->getStyle('A2:H50')->applyFromArray($styleArray);
                $stylerray = [
                    'borders' => [
                        'allborders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_NONE,
                            'color' => ['argb' => ''],
                        ],
                    ],
                ];

                $event->sheet->getDelegate()->getStyle('A1:D1')->applyFromArray($stylerray);
                $export = DB::table('custom_data')->select('logistics')->where('user_id', Auth::id())->get();
                $barcode = 3;
                foreach ($export as $key) {
                    $ean = $key->ean;
                    $data= DNS1D::getBarcodePNG($ean, "C39+",3,33,array(1,1,1));
                    $data = base64_decode($data);
                    file_put_contents(public_path('/storage/ean'.$ean.'.png'), $data);

                    $drawing3 = new Drawing();
                    $drawing3->setName('Other image');
                    $drawing3->setDescription('This is a second image');
                    $drawing3->setPath(public_path('/storage/ean'.$ean.'.png'));
                    $drawing3->setWidth(9);
                    $drawing3->setHeight(14);
                    $drawing3->setOffsetX(2);
                    $drawing3->setOffsetY(3);
                    $drawing3->setCoordinates('F'.$barcode);
                    $drawing3->setWorksheet($event->sheet->getDelegate());

                    $drawing4 = new Drawing();
                    $drawing4->setName('Other image');
                    $drawing4->setDescription('This is a second image');
                    $drawing4->setPath(public_path('/images/checkbox.png'));
                    $drawing4->setWidth(9);
                    $drawing4->setHeight(14);
                    $drawing4->setOffsetX(5);
                    $drawing4->setOffsetY(5);
                    $drawing4->setCoordinates('H'.$barcode);
                    $drawing4->setWorksheet($event->sheet->getDelegate());
                    $barcode++;
                }

                $event->sheet->getDelegate()->getStyle('A1')->getAlignment()->applyFromArray(array('horizontal' => 'center'));
                $event->sheet->getDelegate()->getStyle('A1')->getAlignment()->applyFromArray(array('vertical' => 'center'));
                $event->sheet->getDelegate()->mergeCells('A1:H1');
                $mytime = Carbon\Carbon::now();
                $dt = $mytime->toDateTimeString();
                $rich_text = new \PhpOffice\PhpSpreadsheet\RichText\RichText();
                $objBold = $rich_text->createTextRun('Bestellingen | Orders ');
                $objBold->getFont()->setBold(true);
                $date = date('d-m-Y H:i:s');
                $rich_text->createText("\nPaklijst | Pick list - Custom Orders | ".date('d-m-Y H:i:s')."\n (Quantity Base)\n");
                $event->sheet->getDelegate()->getStyle("A1")->getAlignment()->setWrapText(true);
                $event->sheet->getDelegate()->getCell('A1')->setValue($rich_text);
                $event->sheet->getDelegate()->getHeaderFooter()->setOddFooter("Page &P of &N");
                $event->sheet->getDelegate()->getHeaderFooter()->setEvenFooter("Page &P of &N");
                $event->sheet->getDelegate()->getPageSetup()->setPaperSize(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::PAPERSIZE_A4);
                $event->sheet->getDelegate()->getStyle('A2:H2')->getBorders()->getTop()->applyFromArray( [ 'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN, 'color' => [ 'rgb' => '000000' ] ] );
                $event->sheet->getDelegate()->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
            },
        ];
    }

    public function headings(): array
    {
        return [
            [
                'Bestelnr',
                'Naam',
                'EAN',
                'Producttitel',
                'Locatie',
                'Barcode',
                'Logistiek',
                'OK'
            ],
        ];
    }

    public function collection()
    {
        $export = DB::table('custom_data')->select(DB::raw("CONCAT(	bestel_nummer, ' ') AS bestelnummer"), DB::raw("CONCAT(first_name, ' ', last_name) AS full_name"), DB::raw("CONCAT(ean, ' ') AS EAN"), 'product_title', 'postal_code','logistics')->where('user_id', Auth::id())->get();
        return $export;
    }

    public function startCell(): string
    {
        return 'A2';
    }

    public function drawings()
    {
        $drawing = new Drawing();
        $drawing->setName('Logo');
        $drawing->setDescription('This is my logo');
        $drawing->setPath(public_path('/dhl/images/Homee For your comforts.jpg'));
        $drawing->setWidth(200);
        $drawing->setHeight(70);
        $drawing->setOffsetX(25);
        $drawing->setOffsetY(17);
        $drawing->setCoordinates('A1');

        $drawing2 = new Drawing();
        $drawing2->setName('Other image');
        $drawing2->setDescription('This is a second image');
        $drawing2->setPath(public_path('/images/bol_logo.png'));
        $drawing2->setWidth(15);
        $drawing2->setHeight(50);
        $drawing2->setOffsetX(50);
        $drawing2->setOffsetY(17);
        $drawing2->setCoordinates('E1');

        $stack = array($drawing, $drawing2);

        return $stack;
    }

}
