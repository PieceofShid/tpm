<?php

namespace App\Http\Controllers;

use App\Models\Kanban;
use App\Models\Machine;
use App\Models\MasterSchedule;
use App\Models\Shift;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class MasterScheduleController extends Controller
{
    public function index()
    {
        $schedules = MasterSchedule::orderByDesc('created_at')->get();
        return view('layout.page.schedule.index', compact('schedules'));
    }

    public function add()
    {
        $users = User::where('level_id', 3)->get();
        $machines = Machine::all();
        $shifts = Shift::all();
        $kanbans = Kanban::all();

        return view('layout.page.schedule.tambah', compact('users', 'machines', 'shifts', 'kanbans'));
    }

    public function create(Request $request)
    {
        try{
            MasterSchedule::create($request->all());

            return redirect()->route('schedule.index')->with('success', 'Data berhasl ditambahkan');
        }catch(Exception $x){
            return redirect()->route('schedule.index')->with('error', $x->getMessage());
        }
    }

    public function edit($id)
    {
        $users = User::where('level_id', 3)->get();
        $machines = Machine::all();
        $shifts = Shift::all();
        $schedule = MasterSchedule::find($id);
        $kanbans = Kanban::all();

        return view('layout.page.schedule.edit', compact('schedule', 'users', 'machines', 'shifts', 'kanbans'));
    }

    public function update(Request $request, $id)
    {
        try{
            MasterSchedule::find($id)->update($request->all());

            return redirect()->route('schedule.index')->with('success', 'Data berhasil diupdate');
        }catch(Exception $x){
            return redirect()->route('schedule.index')->with('error', $x->getMessage());
        }
    }

    public function delete($id)
    {
        try{
            MasterSchedule::find($id)->delete();

            return redirect()->route('schedule.index')->with('success', 'Data berhasil dihapus');
        }catch(Exception $x){
            return redirect()->route('schedule.index')->with('error', $x->getMessage());
        }
    }
}
