<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Type;
use Auth;
use Session;
use Illuminate\Support\Facades\DB;

class typeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $types = Type::orderBy('id', 'desc')->simplePaginate(10);
        return view('type.index')->withTypes($types);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('type.create');
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
                'name' => 'unique:types|required|max:255',
                'price' => 'required|max:255',
            ));
        //Store in database
        
        
        


        $type = new type;

        $type->name = $request->name;
        $type->price = $request->price;
        $type->save();

        Session::flash('success', 'ถูกสร้างเรียบร้อย!!');

        return redirect()->route('types.index');
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
        $type = Type::find($id);
        return view('type.show')->with('type', $type)->with('user',$user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $type = Type::find($id);
        $user = Auth::user();
        return view('type.edit')->withType($type)->withUser($user);
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
                'price' => 'required|max:255',
            ));

        //Save the data to the database
         $type = Type::find($id);
         $type->name = $request->name;
         $type->price = $request->price;
         $type->save();

        //set flash data with success message
         Session::flash('success', 'เปลี่ยนแปลงค่าสำเร็จ');

        //redirect with flash data to posts.show
         return redirect()->route('types.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $type = Type::find($id);

        $type->delete();

        Session::flash('success', 'The type was already deleted');

        return redirect()->route('types.index');
    }
}
