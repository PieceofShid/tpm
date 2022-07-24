<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\RunningText;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DocumentController extends Controller
{
    public function index()
    {
        $sop = Document::where('type', 'SOP')->get();
        $pm = Document::where('type', 'PM')->get();
        $cm = Document::where('type', 'CM')->get();
        $running = RunningText::where('code', 1)->get();

        foreach($running as $row){
            $data = $row->text;
        }

        count($running) > 0 ? $text = $data : $text = null;

        return view('layout.page.document.index', compact('sop', 'pm', 'cm', 'text'));
    }

    public function upload(Request $request)
    {
        $ext = $request->file('name')->getClientOriginalExtension();
        if($ext != 'pdf'){
            return redirect()->route('content.document')->with('error', 'Only accept pdf files');
        }

        $filename = $request->type.'.'.$ext;
        $data = array_replace($request->all(), array('name' => $filename));

        try{
            $request->file('name')->move(public_path('assets/img'), $filename);

            DB::transaction(function() use ($data){
                Document::create($data);
            });

            return redirect()->route('content.document')->with('success', 'Dokumen berhasil diupload');
        }catch(Exception $x){
            return redirect()->route('content.document')->with('error', $x->getMessage());
        }

        return $data;
    }

    public function update(Request $request)
    {
        $ext = $request->file('name')->getClientOriginalExtension();
        if($ext != 'pdf'){
            return redirect()->route('content.document')->with('error', 'Only accept pdf files');
        }

        $filename = $request->type.'.'.$ext;

        try{
            $request->file('name')->move(public_path('assets/img'), $filename);

            return redirect()->route('content.document')->with('success', 'Dokumen berhasil diupdate');
        }catch(Exception $x){
            return redirect()->route('content.document')->with('error', $x->getMessage());
        }
    }

    public function running(Request $request)
    {
        try{
            RunningText::updateOrCreate([
                'code' => 1,
                'text' => $request->text
            ]);

            return redirect()->route('content.document')->with('success', 'Running teks berhasil diupdate');
        }catch(Exception $x){
            return redirect()->route('content.document')->with('error', $x->getMessage());
        }
    }
}
