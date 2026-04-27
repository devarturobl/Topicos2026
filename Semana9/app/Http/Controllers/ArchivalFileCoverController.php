<?php

namespace App\Http\Controllers;

use App\Models\ArchivalFile;
use Illuminate\Contracts\View\View;

class ArchivalFileCoverController extends Controller
{
    public function show(ArchivalFile $archivalFile): View
    {
        $archivalFile->load([
            'institution',
            'administrativeUnit',
            'section',
            'subsection',
            'series',
            'subseries',
            'classification',
            'accessControl',
        ]);

        return view('archival-files.cover', [
            'archivalFile' => $archivalFile,
            'classification' => $archivalFile->classification,
            'accessControl' => $archivalFile->accessControl,
        ]);
    }
}
