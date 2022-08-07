<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class CreateBackupController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        Artisan::call('tmp:trash');
        $exitCode = Artisan::call('backup:run');
        Artisan::call('backup:clean');

        if ($exitCode !== 0) {
            session()->flash('error', 'حدث خطأ! عملية النسخ الإحتياطي فشلت.');
        } else {
            session()->flash('success', 'تم أخذ نسخة إحتياطية بنجاح.');
        }

        return redirect(route('backups.index'));
    }
}
