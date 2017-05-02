<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Member;


class SearchController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    
    public function autocomplete($name)
    {
    	
    	$data = Member::select("name")->where("name","LIKE","%$name%")->get();
    	return response()->json($data);
    }

    public function search(Request $request)
    {
    	$member = Member::where('name', $request->users)->first();
        return redirect()->route('members.show', $member->id);
    }
}
