<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeImport;
use Maatwebsite\Excel\Events\BeforeSheet;

class XlsxImport implements ToCollection,WithEvents
{
    use Exportable;
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        //
        return $collection;
    }


    public function registerEvents(): array
    {
        return [
            BeforeSheet::class => function(BeforeSheet $event){

                $creater = $event->getSheet()->getDelegate();

                dd($creater);

                $this->mergeCells = $creater;
            }
        ];
    }
}
