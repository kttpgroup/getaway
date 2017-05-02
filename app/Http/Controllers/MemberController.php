<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Member;
use App\Rent;
use Auth;
use Session;
use Illuminate\Support\Facades\DB;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $members = Member::orderBy('id', 'desc')->simplePaginate(10);
        return view('member.index')->withMembers($members);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('member.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Validate data
        $this->validate($request, array(
                'name' => 'required|max:255',
                'tel' => 'required',
                'idCard' => 'required|max:255',
            ));
        //Store in database
        $check = Member::where('idCard',$request->idCard)->count();
        
        if($check != 0){
            Session::flash('fail', 'รหัสประชาชนนี้ถูกใช้แล้ว');
            return back()->withInput();
        }


        $member = new Member;

        $member->name = $request->name;
        $member->tel = $request->tel;
        $member->idCard = $request->idCard;
        $convert_date = date("Y-m-d", strtotime($request->birth));
        $member->birth = $convert_date;
        $member->suspend = 0;
        $member->point = 0;
        $member->level = 0;
        $member->save();

        Session::flash('success', 'ถูกสร้างเรียบร้อย!!');

        return redirect()->route('members.show', $member->id);
    }
 
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $user = Auth::user();
        $member = Member::find($id);
        $rent = Rent::where('member_id',$member->id)->where('paid', 0)->first();
        $rents = Rent::where('member_id',$member->id)->where('paid', 1)->orderBy('id', 'desc')->simplePaginate(5);
        return view('member.show')->with('member', $member)->with('user',$user)->with('rent', $rent)->with('rents',$rents);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $member = Member::find($id);
        $user = Auth::user();
        return view('member.edit')->withMember($member)->withUser($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //Validate the data
         $this->validate($request, array(
                'name' => 'required|max:255',
                'tel' => 'required',
                'idCard' => 'required|max:255',
            ));

        //Save the data to the database
         $member = Member::find($id);
         $member->name = $request->name;
         $member->tel = $request->tel;
         $member->idCard = $request->idCard;
         $member->level = $request->level;
         $member->point = $request->pointHidden;
         $member->birth = $request->birth;
         $member->suspend = $request->suspend;
         $member->save();

        //set flash data with success message
         Session::flash('success', 'เปลี่ยนแปลงค่าสำเร็จ');

        //redirect with flash data to posts.show
         return redirect()->route('members.show', $member->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $member = Member::find($id);

        $member->delete();

        Session::flash('success', 'The member was already deleted');

        return redirect()->route('members.index');
    }
}
