<?php

namespace ZPos\Http\Controllers;

use Illuminate\Http\Request;
use ZPos\Item;
use ZPos\ItemGroup;
use ZPos\Satuan;
use ZPos\Location;
use ZPos\Sale;
use ZPos\LocationMovingTr;
use ZPos\Http\Requests;
use ZPos\Http\Controllers\Controller;
use \Auth, \Redirect, \Validator, \Input, \Session, \Response;
use Alert;
use DB;

class SearchController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function items(Request $request)
    {
        // Sets the parameters from the get request to the variables.
        if(Input::get('code')){
        $code = Input::get('code');
              
            if(Item::where('barcode', '=', $code)->orWhere('upc_ean_isbn', '=', $code)->exists()) {
                $items = Item::Where('upc_ean_isbn', '=', $code)->orWhere('barcode', '=', $code)->paginate(15);            
                return view('item.index')->with('item', $items);
            }else{
            Alert::error('Whoops, barcode item not found !.');
                // echo "<script>alert('Barcode Item not found !');</script>";
            } 
            
        }  
                        
        $items = Item::where('type', 1)->get();
        return view('item.index')->with('item', $items);
    }

    public function sales(Request $request)
    {
        // Sets the parameters from the get request to the variables.
        if(Input::has('code') || Input::has('date') || Input::has('date2')){
        $code = Input::get('code');
        $from_date = date("Y-m-d", strtotime(Input::get('date')));
        $to_date = date("Y-m-d", strtotime(Input::get('date2')));

            // if(Sale::where('id', '=', $code)->orWhere('customer_name', 'like', '%'.$code.'%')->exists()) {
            //     $sales = Sale::Where('id', '=', $code)->orWhere('customer_name', 'like', '%'.$code.'%')->whereBetween('created_at',[$from_date, $to_date])->paginate(15);            
            //     return view('report.sale')->with('saleReport', $sales);
            // }else{
            // Alert::error('Whoops, your search not found !.');
            //     // echo "<script>alert('Barcode Item not found !');</script>";
            // } 
            // $sales = Sale::whereBetween('created_at',[$from_date.'%', $to_date.'%'])->paginate(15);            
            // if($sales = Sale::Where('customer_name', 'like', '%'.$code)->orWhere('id', $code)->whereBetween('created_at',[$from_date.'%', $to_date.'%'])->orderBy('created_at','asc')->paginate(15)) 
            // {
            //  print_r($sales) ;
            //   // return view('report.sale')->with('saleReport', $sales);
            // }   else{
            // Alert::error('Whoops, your search not found !.');
            //     // echo "<script>alert('Barcode Item not found !');</script>";
            // } 
        $sales = Sale::Where('id', $code)->orWhere('customer_name','like','%'.$code.'%')->WhereBetween('created_at',[$from_date.'%', $to_date.'%'])->orderBy('created_at','asc')->paginate(15);
        // print_r($sales);
        return view('report.sale')->with('saleReport', $sales);

        }  else
                            
        $salesReport = Sale::orderby('created_at','desc')->paginate(20);
          return view('report.sale')->with('saleReport', $salesReport);
    }

    public function location(Request $request)
    {
        // Sets the parameters from the get request to the variables.
        if(Input::get('code')){
        $code = Input::get('code');
              
            if(LocationMovingTr::where('no', '=', $code)->exists()) {
                $data = LocationMovingTr::Where('no', '=', $code)->get();            
                return view('location.move')->with('location', $data);
            }else{
            Alert::error('Whoops, No. Bukti tidak ditemukan !.');
            } 
            
        }  
                        
        $locations = LocationMovingTr::get();
        return view('location.move')->with('location', $locations);
    }

// api search begin -------
    public function readBarcode(Request $request)
    {
        $id = Input::get('term');
            $results = 
            Item::select('barcode','item_name','upc_ean_isbn')
            ->where('id', $id )
            ->orWhere('barcode', 'LIKE', '%'. $id . '%')
            ->orWhere('upc_ean_isbn', 'like', '%'. $id . '%')
            ->orWhere('item_name', 'like', '%'. $id . '%')
            ->get();
                  
            return Response::json($results);
    }

      public function readSales(Request $request)
    {
        $id = Input::get('term');
            $results = 
            Sale::select('id','customer_name')
            ->where('id', '=', $id)
            ->orWhere('customer_name', 'like', '%'. $id . '%')
            ->get();
                  
            return Response::json($results);
    }

    public function readLocation(Request $request)
    {
        $id = Input::get('term');
            $results = Location::where('code', 'LIKE', '%'. $id . '%')
            ->orWhere('name', 'like', '%'. $id . '%')
            ->orWhere('desc', 'like', '%'. $id . '%')
            ->get();
            return Response::json($results);
    }

    public function readGroup(Request $request)
    {
        $id = Input::get('term');
            $results = ItemGroup::where('code', 'LIKE', '%'. $id . '%')
            ->orWhere('name', 'like', '%'. $id . '%')
            ->orWhere('desc', 'like', '%'. $id . '%')
            ->get();
            return Response::json($results);
    }


    public function readLocationMoving(Request $request)
    {
        $id = Input::get('term');
            $results = LocationMovingTr::where('no', 'LIKE', '%'. $id . '%')
            ->get();
            return Response::json($results);
    }


    
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
