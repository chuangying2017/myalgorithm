<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class XlsxDataExport implements FromCollection, WithEvents
{
    use Exportable, RegistersEventListeners;

    protected $arr = [];

    protected $header = [];

    public function __construct(array $arr, $header = [])
    {
        $this->arr = $arr;

        $this->header = $header;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        //
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $afterSheet) {
                $count = array_map(function($arr){
                    return count($arr);
                }, $this->arr);


            }
        ];
    }



}
