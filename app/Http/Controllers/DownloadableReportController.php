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
            'month' => 'nullable|integer|between:1,12',
            'hijy' => 'nullable|integer|digits:4',
            'user_id' => 'nullable|integer',
            'inline' => 'nullable'
        ]);

        $reportType = 'year';
        $postsQuery = Post::with('tags')->with('user')->where('hijri_year', '=', $request->filterable('hijy'));

        if (array_key_exists('month', $validated)) {
            $postsQuery->where('hijri_month', $validated['month']);
            $reportType = 'month';
        } else if (array_key_exists('user_id', $validated)) {
            $postsQuery->where('user_id', '=', $validated['user_id']);
            $reportType = 'user';
        }

        $posts = $postsQuery->get();
        $tags = $posts->flatMap(fn ($i) => $i->tags)->unique(fn ($i) => $i->name);
        $users = $posts->map(fn ($i) => $i->user)->unique(fn ($i) => $i->username);

        $count = [
            'posts' => $posts->count(),
            'tags' => $tags->count(),
            'users' => $users->count(),
        ];

        $performance = [];
        
        foreach ($users as $user) {
            $userPosts = $posts->filter(fn ($i) => $i->user->username === $user->username);

            $performance[] = [
                'username' => $user->username,
                'additions' => $userPosts->count(),
                'tags' => $userPosts->flatMap(fn ($i) => $i->tags)->groupBy(fn ($i) => $i->id)->map(fn ($v, $k) => [
                    'tag' => $tags->first(fn ($i) => $i->id === $k)->name,
                    'additions' => $v->count(),
                ])->toArray(),
            ];
        }

        $filename = now()->format(\DateTime::ISO8601) . '.pdf';
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
        $htmlcontent = \View::make('reports.simple', compact('performance', 'count', 'posts', 'users', 'tags'))->withType($reportType)->render();
        $pdf->WriteHTML($htmlcontent, true, 0, true, 0);

        //Close and output PDF document
        $pdf->Output($filename, $dest);
        exit;
    }
}
