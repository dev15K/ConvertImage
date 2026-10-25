<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use setasign\Fpdi\Fpdi;

class PdfController extends Controller
{
    public function index()
    {
        return view('pdf.merge');
    }

    public function merge(Request $request)
    {
        $request->validate([
            'pdf1' => 'required|file|mimes:pdf|max:20480',
            'pdf2' => 'required|file|mimes:pdf|max:20480',
        ]);

        $pdf = new Fpdi();

        foreach (['pdf1', 'pdf2'] as $field) {
            $filePath = $request->file($field)->getRealPath();

            $pageCount = $pdf->setSourceFile($filePath);

            for ($page = 1; $page <= $pageCount; $page++) {
                $templateId = $pdf->importPage($page);
                $size = $pdf->getTemplateSize($templateId);

                $pdf->AddPage(
                    $size['orientation'],
                    [$size['width'], $size['height']]
                );

                $pdf->useTemplate($templateId);
            }
        }

        $content = $pdf->Output('S');

        $fileName = pathinfo(
                $request->file('pdf1')->getClientOriginalName(),
                PATHINFO_FILENAME
            ) . '.pdf';

        return response()->streamDownload(
            function () use ($content) {
                echo $content;
            },
            $fileName,
            ['Content-Type' => 'application/pdf']
        );
    }
}
