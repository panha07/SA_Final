<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CV_PDFController extends Controller
{
    public function index()
    {
        return view('frontend.cv.create_cv');
    }

    // public function downloadPDF(Request $request)
    // {
    //     $data = $request->all();
    //     $pdf = PDF::loadView('frontend.cv.cv_pdf', compact('data'));
    //     return $pdf->download('cv.pdf');
    // }

    public function previewPDF(Request $request)
    {
        $data = $request->all();
        return view('frontend.cv.cv_pdf', compact('data'));
    }
}
