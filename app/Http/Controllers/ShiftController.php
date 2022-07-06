<?php

namespace App\Http\Controllers;

use App\Models\Shift;
use Exception;
use Illuminate\Http\Request;

class ShiftController extends Controller
{
    public function index()
    {
        $shifts = Shift::orderByDesc('created_at')->get();
        return view('layout.page.shift.index', compact('shifts'));
    }

    public function add()
    {
        return view('layout.page.shift.tambah');
    }

    public function create(Request $request)
    {
        try{
            Shift::create($request->only('name'));

            return redirect()->route('shift.index')->with('success', 'Data berhasl ditambahkan');
        }catch(Exception $x){
            return redirect()->route('shift.index')->with('error', $x->getMessage());
        }
    }

    public function edit($id)
    {
        $shift = Shift::find($id);
        return view('layout.page.shift.edit', compact('shift'));
    }

    public function update(Request $request, $id)
    {
        try{
            Shift::find($id)->update($request->only('name'));

            return redirect()->route('shift.index')->with('success', 'Data berhasil diupdate');
        }catch(Exception $x){
            return redirect()->route('shift.index')->with('error', $x->getMessage());
        }
    }

    public function delete($id)
    {
        try{
            Shift::find($id)->delete();

            return redirect()->route('shift.index')->with('success', 'Data berhasil dihapus');
        }catch(Exception $x){
            return redirect()->route('shift.index')->with('error', $x->getMessage());
        }
    }
}
