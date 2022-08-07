<?php

namespace App\Services;

use App\Imports\SociosImport;
use Maatwebsite\Excel\Facades\Excel;


class ExcelService extends ResponseService
{

    public function __construct()
    {
    }

    public function importSocios($file)
    {
        Excel::import(new SociosImport, $file);
        //return $this->sendResponse(true, ["test" => "hola mundo!"]);
    }
}
