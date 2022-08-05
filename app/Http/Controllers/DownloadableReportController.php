<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class DownloadableReportController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $validated = $request->validate([
            'month' => 'required|integer|between:1,12',
            'inline' => 'nullable'
        ]);

        $min = now()->setMonth($validated['month'])->startOfMonth();
        $max = now()->setMonth($validated['month'])->endOfMonth();

        $posts = Post::whereBetween('created_at', [$min, $max])->get();

        dd($posts);

        $filename = 'example_018.pdf';
        $dest = !array_key_exists('inline', $validated) ? 'D' : 'I';

        $pdf = app('tcpdf');

        // set some language dependent data:
        $lg = Array();
        $lg['a_meta_charset'] = 'UTF-8';
        $lg['a_meta_dir'] = 'rtl';
        $lg['a_meta_language'] = 'fa';
        $lg['w_page'] = 'page';

        // set some language-dependent strings (optional)
        $pdf->setLanguageArray($lg);

        // set font
        $pdf->SetFont('aealarabiya', '', 18);

        // add a page
        $pdf->AddPage();

        // Arabic and English content
        $htmlcontent = \View::make('reports.simple')->render();
        $pdf->WriteHTML($htmlcontent, true, 0, true, 0);

        //Close and output PDF document
        $pdf->Output($filename, $dest);
        exit;
    }
}
