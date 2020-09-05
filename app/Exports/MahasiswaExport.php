<?php

namespace App\Exports;

use App\Mahasiswa;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

class MahasiswaExport implements FromCollection, WithMapping, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Mahasiswa::all();
    }

    public function map($mahasiswa): array
    {
        return [
            $mahasiswa->mhs_code,
            $mahasiswa->mhs_nama,
            $mahasiswa->mhs_kelamin,
            $mahasiswa->rata2nilai(),

            //Date::dateTimeToExcel($invoice->created_at),
        ];
    }

    public function headings(): array
    {
        return [
            'KODE MAHASISWA',
            'NAMA LENGKAP',
            'JENIS KELAMIN',
            'AVG NILAI',
        ];
    }
}
