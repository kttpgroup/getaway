<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rent;
use App\Member;
use App\Card;
use Carbon\Carbon;
use Auth;
use Session;
use Redirect;


class RentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function show(){
        $rents = Rent::where('paid', 0)->simplePaginate(10);
        $now = Carbon::now();
        return view('rent.show')->withRents($rents)->withNow($now);
    }

    public function checkIn(Request $request){
    	$card = Card::where('idNumber', $request->idNumber)->first();
        

        
        if($card == null){
            Session::flash('fail', 'บัตรที่กรอกไม่ถูกต้อง');
            
            return Redirect::back();
        }else {
            $dup = Rent::where('paid', 0)->where('card_id', $card->id)->first();
           
            if($dup != null){
                Session::flash('fail', 'บัตรนี้ถูกใช้แล้ว');
                return Redirect::back();
            }
        }
    	
    	$user = Auth::user();
        $member = Member::find($request->member_id);

        //New Rent
        $rent = new Rent;
        $rent->member_id = $request->member_id;
        $rent->card_id = $card->id;
     	$rent->checkIn = Carbon::now();
        $rent->paid=0;
        $rent->totalMin=0;
        $rent->total=0;

        $rent->save();
        $rents = Rent::where('member_id',$request->member_id)->where('paid', 1)->get();
    	return redirect()->route('members.show', $request->member_id);
    	
    }

    public function checkOut(Request $request){
         // dd($request->member_id_hideden);
    	$card = Card::where('idNumber', $request->idNumber_hideden)->first();

    	$rent = Rent::where('card_id', $card->id)->where('paid',0)->first();


    	$checkIn = Carbon::instance($rent->checkIn);
    	$checkOut = Carbon::now();

    	//calculate price to pay
    	$usedMin = $checkIn->diffInMinutes($checkOut);
    	$roundUp = 0;
    	$section = floor($usedMin/15);
    	if($usedMin%15>0) {
    		$roundUp = 1;
    	}
        if($usedMin>=300 && $card->type_id==1){
            $total = 200;
        }
        else {
            $total = (($section*$card->type->price)+($roundUp*$card->type->price))/4;
        }
    	

    	$rent->paid = 1;
    	$rent->totalMin = $usedMin;
    	$rent->total = $total;
    	$rent->checkOut = $checkOut;
    	$rent->save();

        $temp  = $rent;
        $rent = null;
        if(isset($request->timeTable)){
           $timeTable = 1;
        }else{
            $timeTable = 0;
        }
        // show a print page
    	return view('report.print')->with('rent', $temp)->with('timeTable', $timeTable);
    	
    } 

/*

Start Edit by Bee

*/
     public function calculatePrice (Request $request){

        $card = Card::where('idNumber', $request->idNumber)->first();
        
        if($card == null){
            Session::flash('fail', 'บัตรที่กรอกไม่ถูกต้อง');
            
            return Redirect::back();
        }
        $rent = Rent::where('card_id', $card->id)->where('paid',0)->first();
        $member = Member::find($request->member_id);
        $rents = Rent::where('member_id',$member->id)->where('paid',1)->get();
    
        $roundUp = 0;
        $section = 0;
        $usedMin = 0;
        if($rent != null){
           $checkIn = Carbon::instance($rent->checkIn);
            $checkOut = Carbon::now();

            //calculate price to pay
            $usedMin = $checkIn->diffInMinutes($checkOut);
            
            $section = floor($usedMin/15);
            if($usedMin%15>0) {
                $roundUp = 1;
            } 
        }
        
        //check if more than 5 hours and card type =1
        if($usedMin>=300 && $card->type_id==1){
            $total = 200;
        }
        else {
            $total = (($section*$card->type->price)+($roundUp*$card->type->price))/4;
        }

        $validateCard = 1;
        if($rent == null){
            $validateCard = 0;
        }

        $json = '{"useTime": '.$usedMin.', 
                    "totalPrice": '.$total.', 
                    "validateCard": '.$validateCard.' }';
        $obj = json_decode($json, true);

        return response()->json($obj);
     } 
/*

End Edit by Bee

*/
}
