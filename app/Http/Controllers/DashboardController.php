<?php

namespace App\Http\Controllers;

use App\Models\MasterSchedule;
use App\Models\Shift;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $shifts = Shift::all();
        $delays = MasterSchedule::where('status', 'delay')->count();

        $today = Carbon::now()->format('Y-m-d');
        $filter = MasterSchedule::where('status', 'waiting')->where('date', '>', $today)->get();

        foreach($filter as $exec){
            MasterSchedule::where('id', $exec->id)->update(['status' => 'delay']);
        }

        return view('layout.page.dashboard.index', compact('shifts', 'delays'));
    }

    public function kanban()
    {
        $waitings = MasterSchedule::where('status', 'waiting')->get();
        $dones = MasterSchedule::where('status', 'done')->get();
        $delays = MasterSchedule::where('status', 'delay')->get();

        return view('layout.page.dashboard.kanban', compact('waitings', 'dones', 'delays'));
    }

    public function monthly()
    {
        $events = MasterSchedule::all();

        $event = array();
        foreach($events as $data){
            if($data->status == 'waiting'){
                $color = '#FFC100';
            }elseif($data->status == 'delay'){
                $color = '#FF4747';
            }elseif($data->status == 'done'){
                $color = '#57B657';
            }
            $event[] = array(
                "id"=> $data->id,
                "name"=> $data->user->name,
                "description"=> $data->tasks,
                "date"=> $data->date,
                "type"=>"events",
                "color"=> $color,
                "everyYear"=>false
            );
        }

        return view('layout.page.dashboard.month', compact('event'));
    }

    public function done($id)
    {
        try{
            MasterSchedule::find($id)->update(['status' => 'done']);

            return redirect()->route('dashboard')->with('success', 'Data berhasil diupdate');
        }catch(Exception $x){
            return redirect()->route('dashboard')->with('error', $x->getMessage());
        }
    }

    public function reschedule(Request $request, $id)
    {
        try{
            MasterSchedule::find($id)->update([
                'date' => $request->date,
                'status' => 'waiting'
            ]);

            return redirect()->route('kanban.index')->with('success', 'Data berhasil diupdate');
        }catch(Exception $x){
            return redirect()->route('kanban.index')->with('error', $x->getMessage());
        }
    }
}
