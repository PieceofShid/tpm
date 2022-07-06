<?php

namespace App\Http\Controllers;

use App\Models\Machine;
use Exception;
use Illuminate\Http\Request;

class MachineController extends Controller
{
    public function index()
    {
        $machines = Machine::orderByDesc('created_at')->get();
        return view('layout.page.mesin.index', compact('machines'));
    }

    public function add()
    {
        return view('layout.page.mesin.tambah');
    }

    public function create(Request $request)
    {
        try{
            Machine::create($request->only('name'));

            return redirect()->route('mesin.index')->with('success', 'Data berhasl ditambahkan');
        }catch(Exception $x){
            return redirect()->route('mesin.index')->with('error', $x->getMessage());
        }
    }

    public function edit($id)
    {
        $machine = Machine::find($id);
        return view('layout.page.mesin.edit', compact('machine'));
    }

    public function update(Request $request, $id)
    {
        try{
            Machine::find($id)->update($request->only('name'));

            return redirect()->route('mesin.index')->with('success', 'Data berhasil diupdate');
        }catch(Exception $x){
            return redirect()->route('mesin.index')->with('error', $x->getMessage());
        }
    }

    public function delete($id)
    {
        try{
            Machine::find($id)->delete();

            return redirect()->route('mesin.index')->with('success', 'Data berhasil dihapus');
        }catch(Exception $x){
            return redirect()->route('mesin.index')->with('error', $x->getMessage());
        }
    }
}
