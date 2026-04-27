<?php

namespace App\Http\Controllers;

use App\Models\Transfer;
use Illuminate\Http\Request;

class TransferPrintController extends Controller
{
    public function __invoke(Transfer $transfer)
    {
        $transfer->load([
            'originUnit.institution',
            'destinationUnit.institution',
            'items.archivalFile.section',
            'items.archivalFile.series',
        ]);

        return view('transfers.print', compact('transfer'));
    }
}