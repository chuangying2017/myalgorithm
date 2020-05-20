<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;

class XlsxDataExport implements FromCollection, WithEvents,WithHeadings
{
    use Exportable, RegistersEventListeners;

    protected $arr = [];

    protected $header = [];

    public function __construct(array $arr, $header = [])
    {
        $this->arr = $arr;

        $this->header = array_combine(app('tools.market')->hanNuoTaAlgorithm(count($header)),$header);
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return collect($this->arr);
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $afterSheet) {
                $count = array_map(function($arr){
                    return count($arr);
                }, $this->arr);

                $mergeCells = [
                    "商品名称（必填）",
                    "库存预警",
                    "商品分类",
                    "商品图片名称主图-1（必填）",
                    "商品图片-2",
                    "商品图片-3",
                    "商品图片-4",
                    "商品图片-5",
                    "商品图片-6",
                ];
                $start = 1;
                $specName = '规格名称';
                $i = 1;
                $specArr = [];
                foreach ($count as $mergeHeight)
                {
                    foreach ($mergeCells as $cell)
                    {
                        if (in_array($specName.$i, $this->header))
                        {
                           $specArr[] = $specName.$i;
                        }
                        $titleKey = array_search($cell, $this->header);
                        $mergeVal = $titleKey.($start+1).':'.$titleKey.($mergeHeight+$start);
                        $afterSheet->sheet->getDelegate()->mergeCells($mergeVal);
                        $i+=1;
                    }

                    foreach ($specArr as $name)
                    {
                        $titleKey = array_search($name, $this->header);
                        $mergeVal = $titleKey.($start+1).':'.$titleKey.($mergeHeight+$start);
                        $afterSheet->sheet->getDelegate()->mergeCells($mergeVal);
                    }

                    $start = $mergeHeight + $start;
                }
            }
        ];
    }


    /**
     * @return array
     */
    public function headings(): array
    {
        return $this->header;
    }
}
