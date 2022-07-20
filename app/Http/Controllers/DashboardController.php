<?php

namespace App\Http\Controllers;

use App\Models\MasterSchedule;
use App\Models\Shift;
use Exception;
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
            MasterSchedule::where('id', $id)->update(['status' => 'done']);

            return redirect()->route('dashboard')->with('success', 'Data berhasil diupdate');
        }catch(Exception $x){
            return redirect()->route('dashboard')->with('error', $x->getMessage());
        }
    }
}
