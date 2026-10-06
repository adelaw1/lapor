<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kegiatan;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Dashboard | ' . $this->title,
            'kegiatan' => Kegiatan::latest()->get(),
            'format' => new Carbon,
            'laporan' => $this->master->getInputLaporan(),
        ];

        return view('dashboard.main', $data);
    }
}
