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
    public function messages(Request $request){

        $target = Target::where('kode',$request->kode)->first();
        return view('messages',["target"=>$target]);
    }
}
