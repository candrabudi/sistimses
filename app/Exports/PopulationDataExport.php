<?php

namespace App\Exports;

use App\Models\PopulationData;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithRowHeight;
use App\Models\MasterData;
use App\Models\RealizationDetail;

class PopulationDataExport implements FromArray, WithHeadings, WithColumnWidths
{

    public function headings(): array
    {
        return [
            'NO',
            'NIK',
            'NAMA',
            'NOMOR HANDPHONE',
            'KECAMATAN',
            'DESA',
            'ALAMAT',
            'PENANGGUNG JAWAB',
            'KETERANGAN'
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 10,
            'B' => 25,
            'C' => 25,
            'D' => 20,
            'E' => 25,
            'F' => 25,
            'G' => 25,
            'H' => 25,
            'I' => 75,
        ];
    }

    public function array(): array
    {
        $fetch = PopulationData::get()->toArray();
        $i = 0;
        $reform = array_map(function($new) use (&$i) { 
            $i++;
            return [
                'no' => $i.'.',
                'nik' => $new['nik'],
                'name' => $new['name'],
                'phone_number' => '`'.$new['phone_number'],
                'district' => $new['district'],
                'sub_district' => $new['sub_district'],
                'address' => $new['address'],
                'person_responsible' => $new['person_responsible'],
                'information' => $new['information'],
            ]; 
        }, $fetch);

        return $reform;
    }

    
}
