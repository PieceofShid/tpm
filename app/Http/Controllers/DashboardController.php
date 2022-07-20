<?php

namespace App\Http\Controllers;

use App\Models\MasterSchedule;
use App\Models\Shift;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $shifts = Shift::all();

        return view('layout.page.dashboard.index', compact('shifts'));
    }

    public function kanban()
    {
        $waitings = MasterSchedule::where('status', 'waiting')->get();
        $dones = MasterSchedule::where('status', 'done')->get();
        $delays = MasterSchedule::where('status', 'delay')->get();

        return view('layout.page.dashboard.kanban', compact('waitings', 'dones', 'delays'));
    }
}
