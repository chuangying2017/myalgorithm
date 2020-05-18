<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;

class TestExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return collect([
            [1,2,3,4],
            [1,2,3,4],
            [1,2,3,4],
        ]);
    }
}
