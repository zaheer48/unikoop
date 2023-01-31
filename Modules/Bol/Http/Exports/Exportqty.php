<?php

namespace Modules\Bol\Http\Exports;

use App\Bol_data;
use DB;

use PHPExcel_Worksheet_MemoryDrawing;
use Carbon;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeExport;
use Maatwebsite\Excel\Events\AfterSheet;
use App\MttRegistration;
Use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use PhpOffice\PhpSpreadsheet\RichText\RichText;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use \PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use \stdClass;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use \Milon\Barcode\DNS1D;
use \Milon\Barcode\DNS2D;

class Exportqty implements FromCollection, WithHeadings, WithDrawings, WithEvents, WithCustomStartCell
{
    /**
    * @return \Illuminate\Support\Collection
    */

    protected $recid;

    function __construct($recid) {
            $this->recid = $recid;
    }    

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
            //$event->sheet->getDelegate()->getColumnDimension('A')->setWidth(15);
            $event->sheet->getDelegate()->getRowDimension('1')->setRowHeight(80);
            $event->sheet->getDelegate()->getRowDimension('2')->setRowHeight(20);
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
            //$event->$sheet->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);
            $cellRange = 'A1:E100';
            $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(9);
            $event->sheet->getDelegate()->getStyle("B3:E1000")->getAlignment()->setWrapText(true);
            $event->sheet->getDelegate()->getStyle("A3:H1000")->getAlignment()->applyFromArray(array('vertical' => 'top'));
            //$event->sheet->getDelegate()->getFont()->setName('Calibri')->setSize(9); 
            

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

            
        //$objRichText->createText('');
        $anta_qty = 3;
        $get_anta = DB::table('bol_data')->select('producttitel')->where('bol_rec_id', $this->recid)->groupby('producttitel')->distinct()->orderBy('referentie')->get();

        foreach ($get_anta as $anta_product) {
            $anta_prod = $anta_product->producttitel;
            $result = DB::table('bol_data')->where('producttitel', $anta_prod)->where('bol_rec_id', $this->recid)->get();
            
            $anta = 0;
            
            foreach ($result as $row) {
                $anta  = $anta + $row->aantal;
            }	
            
            //print($anta);
            $event->sheet->getDelegate()->getCell('G'.$anta_qty)->setValue($anta);
            //echo $anta_prod."<br/>";
            $anta_qty++;
        }
        //print_r($get_anta);
        //exit();

        $get_site = DB::table('bol_rec')->select('site', 'date')->where('id', $this->recid)->first();

        $site = $get_site->site;
        //exit();

        $export = DB::table('bol_data')->select('EAN', 'producttitel')->where('bol_rec_id', $this->recid)->groupby('producttitel')->distinct()->orderBy('referentie')->get();
        $barcode = 3;
              $d = new DNS1D();
        foreach ($export as $key) {
            $ean = $key->EAN;

            $data= $d->getBarcodePNG($ean, "C39+",3,33,array(1,1,1));
            $data = base64_decode($data); 
     
            //$data = \Storage::disk('public')->put('ean'.$ean.'.png',$data);
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
            //$drawing_img[] = array($drawing3);
            
                $barcode++;
                //echo $barcode;
        }
        $event->sheet->getDelegate()->getStyle('A1')->getAlignment()->applyFromArray(array('horizontal' => 'center'));
        $event->sheet->getDelegate()->getStyle('A1')->getAlignment()->applyFromArray(array('vertical' => 'center'));
        $event->sheet->getDelegate()->mergeCells('A1:H1');
        $mytime = Carbon\Carbon::now();
        $dt = $mytime->toDateTimeString();
        $rich_text = new \PhpOffice\PhpSpreadsheet\RichText\RichText();
        // dump($rich_text->getRichTextElements($value));
        $objBold = $rich_text->createTextRun('Bestellingen | Orders ');
        $objBold->getFont()->setBold(true);
    
		$date = date('d-m-Y H:i:s');
	
        $rich_text->createText("\nPaklijst | Pick list - ID ".$this->recid." | ".date('d-m-Y H:i:s', strtotime($get_site->date))."\n".$site." (Quantity Base)\n");
        $event->sheet->getDelegate()->getStyle("A1")->getAlignment()->setWrapText(true);
    
        $event->sheet->getDelegate()->getCell('A1')->setValue($rich_text);
        //$event->sheet->getDelegate()->getCell('D1')->setValue($objBold);
            //exit();

		$event->sheet->getDelegate()->getHeaderFooter()->setOddFooter("Page &P of &N");
		
		$event->sheet->getDelegate()->getHeaderFooter()->setEvenFooter("Page &P of &N");
		
		/*$event->sheet->getDelegate()->getHeaderFooter()->setOddFooter("Let op!          | Caution!            \n 
		Onmiddellijk aan melden bij de admin | Immediately sign in to the admin If a \n 
		Als een product niet te vinden is of             | product is not findable or is out of stock \n
		niet meer op voorraad is.")->setHeight(20);
		
		$event->sheet->getDelegate()->getHeaderFooter()->setEvenFooter("Let op!          | Caution!            \n 
		Onmiddellijk aan melden bij de admin | Immediately sign in to the admin If a \n 
		Als een product niet te vinden is of             | product is not findable or is out of stock \n
		niet meer op voorraad is.");*/

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
            'Aant',
            'OK'
            ],
        ];
    }

    public function collection()
    {
        //echo $this->recid;
        //exit();
         //$exportqty = DB::table('bol_data')->select('EAN')->where('bol_rec_id', $this->recid)->get();
         //$producttitel = $exportqty->producttitel;
         //echo $producttitel;
         //exit();
        $export = DB::table('bol_data')->select(DB::raw("CONCAT(bestelnummer, ' ') AS bestelnummer"), DB::raw("CONCAT(voornaam_verzending, ' ', achternaam_verzending) AS full_name"), DB::raw("CONCAT(EAN, ' ') AS EAN"), 'producttitel', 'referentie','adres_verz_toevoeging')->where('bol_rec_id', $this->recid)->groupby('producttitel')->distinct()->orderBy('referentie')->get();

		foreach($export as $row)
		{
			$row->adres_verz_toevoeging = "";
		}

        //print_r($export);
        //exit();
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
