<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contact;
use Carbon\Carbon;
use Validator;

class ContactController extends Controller
{
    public function store(Request $request){
        // dd($request->all());
    	$validator = Validator::make($request->all(),[
			"name" => "required|max:15|min:2",
    		"organization" => "nullable|max:50",
    		"address" => "nullable|max:50",
    		"number" => "required|max:50|min:5",
    		"email" => "required|max:50|min:5",
    		"content" => "required|min:5"
    	]);
    	if ($validator->fails()) {
    		// var_dump($validator);
    		// $request->session()->flash('case', $validator);
    		$request->session()->flash('status', '发送失败');
    		return redirect('/')->withErrors($validator, 'status');
        }
    	Contact::create($request->all());
    	return redirect("/")->with("status", "发送成功");
    }
    public function destroy(Request $request, $id){
    	$case = $request->input("case");
    	Contact::destroy($id);
    	$request->session()->flash('case', $case);

    	return redirect("/admin")
    	->with("status", "删除留言成功")
    	->with("case", $case);
    }
}
