<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class JasaExport implements FromView, ShouldAutoSize
{
    protected $transaksi;
    public function __construct($transaksi)
    {
        $this->transaksi = $transaksi;
    }
    public function view(): View
    {
        return view("exports.jasa", [
            'transaksi' => $this->transaksi
        ]);
    }
}
