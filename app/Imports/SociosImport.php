<?php

namespace App\Imports;

use App\Models\Socio;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\RemembersRowNumber;


class SociosImport implements ToModel, WithValidation, WithHeadingRow
{
    use RemembersRowNumber;

    public function model(array $row)
    {

        $currentRowNumber = $this->getRowNumber();
        
        return new Socio([
            'cedula' => $currentRowNumber,
            'nombre'  => $row['nombre'],
            'codigo' => $row['codigo'],
        ]);

      
    }

    public function headingRow(): int
    {
        return 1;
    }

    public function rules(): array
    {
        return [
            'codigo' => 'required',
            'nombre' => 'required',
        ];
    }
}
