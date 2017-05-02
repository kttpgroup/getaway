<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Card;
use App\Type;
use Auth;
use Session;
use Illuminate\Support\Facades\DB;

class cardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cards = Card::orderBy('id', 'desc')->simplePaginate(10);
        return view('card.index')->withcards($cards);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = Type::all();
        return view('card.create')->withTypes($types);
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
                'name' => 'unique:cards|required|max:255',
                'idNumber' => 'unique:cards|required|max:255',
            ));
        //Store in database
        $check = Card::where('idNumber',$request->idNumber)->count();
        
        if($check != 0){
            Session::flash('fail', 'รหัสประชาชนนี้ถูกใช้แล้ว');
            return view('cards.create');
        }


        $card = new card;

        $card->name = $request->name;
        $card->idNumber = $request->idNumber;
        $card->type_id = $request->type;
        
        $card->suspend = 0;
        $card->save();

        Session::flash('success', 'ถูกสร้างเรียบร้อย!!');

        return redirect()->route('cards.show', $card->id);
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
        $card = Card::find($id);
        return view('card.show')->with('card', $card)->with('user',$user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $card = Card::find($id);
        $user = Auth::user();
        $types = Type::all();
        return view('card.edit')->withcard($card)->withUser($user)->withTypes($types);
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
         

        //Save the data to the database
         $card = Card::find($id);
         $card->name = $request->name;
         $card->idNumber = $request->idNumber;
         $card->type_id = $request->type;
         $card->suspend = $request->suspend;
         $card->save();

        //set flash data with success message
         Session::flash('success', 'เปลี่ยนแปลงค่าสำเร็จ');

        //redirect with flash data to posts.show
         return redirect()->route('cards.show', $card->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $card = Card::find($id);

        $card->delete();

        Session::flash('success', 'The card was already deleted');

        return redirect()->route('cards.index');
    }
}
