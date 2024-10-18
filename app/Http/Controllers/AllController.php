<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Target;
use Illuminate\Http\Request;

class AllController extends Controller
{
    public function index(){
        $targets = Target::all();
        return view('index',["targets"=>$targets]);
    }
    public function store(Request $request){
        Message::create($request->all());
        return back();
    }
    public function save(Request $request){
        $kode = $request->kode;
        return redirect("/messages/$kode");
    }
    public function messages(Request $request,Target $target){
        return view('messages',["target"=>$target]);
    }
}
