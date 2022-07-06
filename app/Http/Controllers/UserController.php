<?php

namespace App\Http\Controllers;

use App\Models\Level;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderByDesc('created_at')->get();
        return view('layout.page.user.index', compact('users'));
    }

    public function add()
    {
        $levels = Level::all();

        return view('layout.page.user.tambah', compact('levels'));
    }

    public function create(Request $request)
    {
        try{
            User::create([
                'name' => $request->name,
                'username' => $request->username,
                'level_id' => $request->level,
                'password' => Hash::make($request->password)
            ]);

            return redirect()->route('user.index')->with('success', 'Data berhasl ditambahkan');
        }catch(Exception $x){
            return redirect()->route('user.index')->with('error', $x->getMessage());
        }
    }

    public function edit($id)
    {
        $user = User::find($id);
        $levels = Level::all();

        return view('layout.page.user.edit', compact('user', 'levels'));
    }

    public function update(Request $request, $id)
    {
        if($request->password != ''){
            $data = array_replace($request->all(), array('password' => Hash::make($request->password)));
        }else{
            $data = $request->except('password');
        }

        try{
            User::find($id)->update($data);

            return redirect()->route('user.index')->with('success', 'Data berhasil diupdate');
        }catch(Exception $x){
            return redirect()->route('user.index')->with('error', $x->getMessage());
        }
    }

    public function delete($id)
    {
        try{
            User::find($id)->delete();

            return redirect()->route('user.index')->with('success', 'Data berhasil dihapus');
        }catch(Exception $x){
            return redirect()->route('user.index')->with('error', $x->getMessage());
        }
    }
}
