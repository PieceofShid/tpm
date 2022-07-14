<?php

namespace App\Http\Controllers;

use App\Models\Kanban;
use Exception;
use Illuminate\Http\Request;

class KanbanController extends Controller
{
    public function index()
    {
        $kanbans = Kanban::orderByDesc('created_at')->get();
        return view('layout.page.kanban.index', compact('kanbans'));
    }

    public function add()
    {
        return view('layout.page.kanban.tambah');
    }

    public function create(Request $request)
    {
        try{
            Kanban::create($request->only('name'));

            return redirect()->route('kanban.index')->with('success', 'Data berhasl ditambahkan');
        }catch(Exception $x){
            return redirect()->route('kanban.index')->with('error', $x->getMessage());
        }
    }

    public function edit($id)
    {
        $kanban = Kanban::find($id);
        return view('layout.page.kanban.edit', compact('kanban'));
    }

    public function update(Request $request, $id)
    {
        try{
            Kanban::find($id)->update($request->only('name'));

            return redirect()->route('kanban.index')->with('success', 'Data berhasil diupdate');
        }catch(Exception $x){
            return redirect()->route('kanban.index')->with('error', $x->getMessage());
        }
    }

    public function delete($id)
    {
        try{
            Kanban::find($id)->delete();

            return redirect()->route('kanban.index')->with('success', 'Data berhasil dihapus');
        }catch(Exception $x){
            return redirect()->route('kanban.index')->with('error', $x->getMessage());
        }
    }
}
