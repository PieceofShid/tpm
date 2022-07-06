<?php

namespace App\Http\Controllers;

use App\Models\Level;
use Exception;
use Illuminate\Http\Request;

class LevelController extends Controller
{
    public function index()
    {
        $levels = Level::orderByDesc('created_at')->get();
        return view('layout.page.level.index', compact('levels'));
    }

    public function add()
    {
        return view('layout.page.level.tambah');
    }

    public function create(Request $request)
    {
        try{
            Level::create($request->only('name'));

            return redirect()->route('level.index')->with('success', 'Data berhasl ditambahkan');
        }catch(Exception $x){
            return redirect()->route('level.index')->with('error', $x->getMessage());
        }
    }

    public function edit($id)
    {
        $level = Level::find($id);
        return view('layout.page.level.edit', compact('level'));
    }

    public function update(Request $request, $id)
    {
        try{
            Level::find($id)->update($request->only('name'));

            return redirect()->route('level.index')->with('success', 'Data berhasil diupdate');
        }catch(Exception $x){
            return redirect()->route('level.index')->with('error', $x->getMessage());
        }
    }

    public function delete($id)
    {
        try{
            Level::find($id)->delete();

            return redirect()->route('level.index')->with('success', 'Data berhasil dihapus');
        }catch(Exception $x){
            return redirect()->route('level.index')->with('error', $x->getMessage());
        }
    }
}
