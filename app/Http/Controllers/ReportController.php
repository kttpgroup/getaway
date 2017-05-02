<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rent;
use App\Member;
use App\User;
use Carbon\Carbon;
use Auth;
use App\Collect;
use Excel;



class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rentsCollect = Rent::where('collect_id','!=',null)->get();
        $rentsNonCollect = Rent::where('collect_id',null)->get();
        $totalGetAway = Rent::where('collect_id',null)->sum('total');
        $totalAbig = Rent::where('collect_id','!=',null)->sum('total');
        
        
        return view('report.index')->with('rentsC', $rentsCollect)->with('rentsN', $rentsNonCollect)->with('totalG', $totalGetAway)->with('totalA', $totalAbig);
        
    }

    public function reportCollect($from, $end){
    	
        $rents = Rent::where('collect_id', null)->whereBetween('checkOut', array($from,$end))->get();
        $user = Auth::user();
        $collect = new Collect;
        $collect->invoiceNumber = 1;
        $collect->amount = 0;
        $collect->user_id= $user->id;
        $collect->save();
        foreach ($rents as $rent) {
            $rent->collect_id = $collect->id;
            $collect->amount = $collect->amount+$rent->total;
            $rent->save();
        }
        $collect->user_id= $user->id;
        $collect->save();
    	return redirect()->route('reports.index');
    	
    }

    public function show(Request $request)
    {
        $from = date("Y-m-d" . ' 00:00:00.000000' , strtotime($request->from));

        $end = date("Y-m-d" . ' 23:59:59.999999' , strtotime($request->end));
        
        $rents = Rent::whereBetween('checkOut', array($from,$end))->simplePaginate(8);

        
        
        return view('report.show')->withRents($rents)->withFrom($from)->withEnd($end);
    }

    public function showCollect(Request $request)
    {
        $from = date("Y-m-d" . ' 00:00:00.000000' , strtotime($request->from));

        $end = date("Y-m-d" . ' 23:59:59.999999' , strtotime($request->end));
        
        $collects = Collect::whereBetween('created_at', array($from,$end))->get();

        return view('report.collect')->withCollects($collects)->withFrom($from)->withEnd($end);
    }

    public function exportReport(Request $request)
    {
        

        Excel::create('Report', function($excel) use($request) {

            $excel->sheet('New sheet', function($sheet) use($request) {
                $from = date("Y-m-d" . ' 00:00:00.000000' , strtotime($request->from));

        $end = date("Y-m-d" . ' 23:59:59.999999' , strtotime($request->end));
        
        $collects = Collect::whereBetween('created_at', array($from,$end))->get();

                $sheet->loadView('report.export')->withCollects($collects);

            });

        })->export('xls');

        return back();
    }
}
