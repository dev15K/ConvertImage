<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use FPDF;

class ImagePdfController extends Controller
{
    public function index()
    {
        return view('image-to-pdf');
    }

    public function convert(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpg,jpeg,png|max:20480',
        ]);

        $file = $request->file('image');
        $imagePath = $file->getRealPath();

        $fileName = pathinfo(
            $file->getClientOriginalName(),
            PATHINFO_FILENAME
        );

        $pdfName = $fileName . '.pdf';

        $imageSize = getimagesize($imagePath);

        if (!$imageSize) {
            return back()->withErrors([
                'image' => 'Invalid image file.',
            ]);
        }

        [$width, $height] = $imageSize;

        $pageWidth = 190;
        $pageHeight = 277;

        $ratio = min(
            $pageWidth / $width,
            $pageHeight / $height
        );

        $newWidth = $width * $ratio;
        $newHeight = $height * $ratio;

        $pdf = new FPDF('P', 'mm', 'A4');
        $pdf->AddPage();

        $x = (210 - $newWidth) / 2;
        $y = (297 - $newHeight) / 2;

        $extension = match ($file->getMimeType()) {
            'image/jpeg' => 'JPG',
            'image/png' => 'PNG',
            default => throw new \RuntimeException('Unsupported image type'),
        };

        $pdf->Image(
            $imagePath,
            $x,
            $y,
            $newWidth,
            $newHeight,
            $extension
        );

        return response($pdf->Output('S'), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' =>
                'attachment; filename="' .
                str_replace('"', '', basename($pdfName)) .
                '"',
            'Cache-Control' => 'private, no-store',
        ]);
    }
}
