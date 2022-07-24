<?php

namespace App\Http\Controllers;

use App\Models\Problem;
use Exception;
use Illuminate\Http\Request;

class ProblemController extends Controller
{
    public function index()
    {
        $problems = Problem::orderByDesc('created_at')->get();
        return view('layout.page.problem.index', compact('problems'));
    }

    public function add()
    {
        return view('layout.page.problem.tambah');
    }

    public function create(Request $request, $id)
    {
        try{
            Problem::create([
                'master_schedule_id' => $id,
                'problem' => $request->problem
            ]);

            return redirect()->route('dashboard')->with('success', 'Data berhasl ditambahkan');
        }catch(Exception $x){
            return redirect()->route('dashboard')->with('error', $x->getMessage());
        }
    }

    public function edit($id)
    {
        $problem = Problem::find($id);
        return view('layout.page.problem.edit', compact('problem'));
    }

    public function update(Request $request, $id)
    {
        try{
            Problem::find($id)->update($request->only(['master_schedule_id', 'problem']));

            return redirect()->route('problem.index')->with('success', 'Data berhasil diupdate');
        }catch(Exception $x){
            return redirect()->route('problem.index')->with('error', $x->getMessage());
        }
    }

    public function delete($id)
    {
        try{
            Problem::find($id)->delete();

            return redirect()->route('problem.index')->with('success', 'Data berhasil dihapus');
        }catch(Exception $x){
            return redirect()->route('problem.index')->with('error', $x->getMessage());
        }
    }
}
