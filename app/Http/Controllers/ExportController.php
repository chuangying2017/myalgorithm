<?php

namespace App\Http\Controllers;

use App\Exports\XlsxDataExport;
use App\Imports\XlsxImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Exception;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Reader\Xls;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

class ExportController extends Controller
{
    //

    public function getImportInfo()
    {

        //假设已知 商品名称 需要合并 规格名称需要合并=x未知合并个数 已经合并高度 求: x等于合并多少且如何恒等其他合并个数
        $options = ['mergeCells' => []];
//        dd(storage_path('app/public/DuoguigeMB.xlsx'));
        $all = $this->importExcel(storage_path('app/public/DuoguigeMB.xlsx'),0,$options);

        $arr = $this->validProductNum($all, $options['mergeCells']);

        $count = array_map(function ($arr){
            return count($arr);
        }, $arr);

        dd($count);
      //  Excel::store(new XlsxDataExport($arr, $this->headings),date('YmdHis').'.xlsx','local_xlsx');

        dd('success');
    }

    function importExcel(string $filePath = "", int $sheet = 0, &$options = [])
    {

        try {
            /* 转码 */
            $filePath = iconv("utf-8", "gb2312", $filePath);

            if (empty($filePath) or !file_exists($filePath)) {
                throw new Exception("文件不存在!");
            }

            /** @var Xlsx $objRead */
            $objRead = IOFactory::createReader("Xlsx");

            if (!$objRead->canRead($filePath)) {
                /** @var Xls $objRead */
                $objRead = IOFactory::createReader("Xls");

                if (!$objRead->canRead($filePath)) {
                    throw new Exception("只支持导入Excel文件！");
                }
            }

            /* 如果不需要获取特殊操作，则只读内容，可以大幅度提升读取Excel效率 */
            empty($options) && $objRead->setReadDataOnly(true);
            /* 建立excel对象 */
            $obj = $objRead->load($filePath);
            /* 获取指定的sheet表 */
            $currSheet = $obj->getSheet($sheet);

            if (isset($options["mergeCells"])) {
                /* 读取合并行列 */
                $options["mergeCells"] = $currSheet->getMergeCells();
            }

//            if (0 == $columnCnt) {
//                /* 取得最大的列号 */
//                $columnH = $currSheet->getHighestColumn();
//                /* 兼容原逻辑，循环时使用的是小于等于 */
//                $columnCnt = Coordinate::columnIndexFromString($columnH);
//            }


            /* 获取总行数 */
//            $rowCnt = $currSheet->getHighestRow();
            $data   = [];

            $arr = $currSheet->toArray();

            $this->headings = $head = $arr[0];

            foreach ($arr as $k => $v)
            {
                $count = count(array_filter($v, function($val){
                    return !is_null($val);
                }));

                if ($count < 3)
                {
                    continue;
                }

                $data[] = array_combine($head, $v);
            }

            return $data;
        } catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * 多规格数据拼装
     * @param array $rows
     * @param array $mergeCell
     * @return array
     */
    protected function validProductNum(array $rows,array $mergeCell): array
    {

        $data = [];

        $x = 0;

        $recordNeedle = 1;

        $count = count($rows);

        if (empty($mergeCell))
        {
            for ($i=1; $i<$count; $i++)
            {
                if (empty(array_values($rows[$i])[0])) continue;

                $product[] = $rows[$i];

                $data[] = $product;

                $product = [];
            }

            return $data;
        }

        foreach ($mergeCell as $vv)
        {

            if (strpos($vv, "B") !== false)
            {
                $x += 1;

                list($start, $end) = array_map(function($a1){
                    preg_match('/\d+/',$a1, $argv);
                    return array_shift($argv);
                },explode(':', $vv));

                $product = [];

                if (!isset($rows[$start-1]) || empty($rows[$start-1]))
                {
                    continue;
                }

                for ($i = $start-1; $i < $end; $i++)
                {
                    $product[] = $rows[$i];
                }

                $differenceSet = $start - 1 - $recordNeedle;

                for ($insertNum=0; $insertNum < $differenceSet; $insertNum++)
                {
                    $data[] = [$rows[$recordNeedle + $insertNum]];
                }

                $recordNeedle = $end;

                $data[] = $product;
            }

        }

        if ($x < 1)
        {
            for ($i=1; $i<$count; $i++)
            {
                if (empty(array_values($rows[$i])[0])) continue;

                $product[] = $rows[$i];

                $data[] = $product;

                $product = [];
            }
        }

        for ($recursive = 0; $recursive < (isset($end) ? $count - $end : 0); $recursive++)
        {
            $data[] = [$rows[$end+$recursive]];
        }

        if (empty($data))
        {
            throw new \Exception('格式不对应');
        }

        /*        for ($origin = $recursive = isset($end) ? $count - $end : 0; $recursive > 0; $recursive--)
                {
                    $data[] = [$rows[$end + $origin - ($recursive - 1) - 1]];
                }*/

        return $data;
    }

    protected $head;

    public function __construct()
    {
        $this->head = range('A','Z');
    }

    protected function xlsHeadAlgorithm(array $data)
    {

        $head = $this->head;

        if (($count = count($data)) > $head)
        {

        }

        foreach ($data as $k => $v)
        {

        }
    }

    protected $arr = [];

    protected function xlsNumHead(int $count)
    {
        if ($count < 0)
        {
            return $this->arr;
        }

        $head = $this->head;

        $forEachNum = 24;

        for ($i=0;$i<$forEachNum;$i++)
        {
            $this->arr[] = $head[$i];
        }

        $count = $count - $forEachNum;

        $this->xlsNumHead($count);
    }
}
