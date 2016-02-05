<?php

namespace ZPos\Http\Controllers;

use Illuminate\Http\Request;
use ZPos\Item;
use ZPos\ItemGroup;
use ZPos\Location;
use ZPos\Http\Requests;
use ZPos\Http\Controllers\Controller;
use \Auth, \Redirect, \Validator, \Input, \Session;
use Alert;
use PDF;
use App;
use DB; 

class InventoryReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function search()
    {
       
        // ok 
        if(Input::get('option_group') === 'all' AND Input::get('option_items') === 'items'){
            $code = Input::get('code');

            $invReports = Item::where('barcode','=',$code)->get();
            $loc_id = Item::select('fk_location')->where('barcode','=', $code)->value('fk_location');
            $group_id = Item::select('fk_cat')->where('barcode','=', $code)->value('fk_cat');
            $locReports = Location::where('id', '=', $loc_id)->get();
            $groupReports = ItemGroup::where('id', '=', $group_id)->get();
            // $this->set_cart($invReports);
            // return view('report.stock_items')->with('invReport',$invReports);
            $this->set_cart($invReports);
            $this->set_group($groupReports);
            $this->set_location($locReports);
            $items = Session::get('items');  
            $group = Session::get('group');  
            $location = Session::get('location');  
            return PDF::loadView('report/pdf',array('items'=> $items, 'group'=> $group, 'location' => $location))->setPaper('a4')->setOrientation('landscape')->setWarnings(false)->save(public_path().'/pdf/'.'laporan_stok_barang.pdf')->stream('Laporan Stok Barang.pdf');
         }  
         // ok
         elseif(Input::get('option_group') === 'all' AND Input::get('option_items') === 'item_group'){
            $loc_cat = ItemGroup::select('id')->where('code', '=', Input::get('group'))->value('id');
            $groupReports = ItemGroup::where('code', '=', Input::get('group'))->get();
            $locReports = Location::all();
            $invReports = Item::where('fk_cat','=', $loc_cat)->get();
            // $this->set_cart($invReports);
            // return view('report.stock_items')->with('invReport',$invReports);
            $this->set_cart($invReports);
            $this->set_group($groupReports);
            $this->set_location($locReports);
            $items = Session::get('items');  
            $group = Session::get('group');  
            $location = Session::get('location');  
            return PDF::loadView('report/pdf',array('items'=> $items, 'group'=> $group, 'location' => $location))->setPaper('a4')->setOrientation('landscape')->setWarnings(false)->save(public_path().'/pdf/'.'laporan_stok_barang.pdf')->stream('Laporan Stok Barang.pdf');
         }  elseif(Input::get('option_group') === 'location' AND Input::get('option_items') === 'all'){
            $locReports = Location::where('code', '=', Input::get('location'))->get();
            $loc_id = Location::select('id')->where('code', '=', Input::get('location'))->value('id');
            $invReports = Item::where('fk_location','=', $loc_id)->get();
            $groupReports = ItemGroup::all();
            // $this->set_cart($invReports);
            // return view('report.stock_items')->with('invReport',$invReports);
            $this->set_cart($invReports);
            $this->set_group($groupReports);
            $this->set_location($locReports);
            $items = Session::get('items');  
            $group = Session::get('group');  
            $location = Session::get('location');  
            return PDF::loadView('report/pdf',array('items'=> $items, 'group'=> $group, 'location' => $location))->setPaper('a4')->setOrientation('landscape')->setWarnings(false)->save(public_path().'/pdf/'.'laporan_stok_barang.pdf')->stream('Laporan Stok Barang.pdf');
         }  elseif(Input::get('option_group') === 'location' AND Input::get('option_items') === 'item_group'){
            $locReports = Location::where('code', '=', Input::get('location'))->get();
            $groupReports = ItemGroup::where('code', '=', Input::get('group'))->get();
            $loc_id = Location::select('id')->where('code', '=', Input::get('location'))->value('id');
            $loc_cat = ItemGroup::select('id')->where('code', '=', Input::get('group'))->value('id');
            $invReports = Item::where('fk_location','=', $loc_id, 'AND')->where('fk_cat','=', $loc_cat)->get();
            $this->set_cart($invReports);
            $this->set_group($groupReports);
            $this->set_location($locReports);
            $items = Session::get('items');  
            $group = Session::get('group');  
            $location = Session::get('location');  
            return PDF::loadView('report/pdf',array('items'=> $items, 'group'=> $group, 'location' => $location))->setPaper('a4')->setOrientation('landscape')->setWarnings(false)->save(public_path().'/pdf/'.'laporan_stok_barang.pdf')->stream('Laporan Stok Barang.pdf');
            // return view('report.stock_items')->with('invReport',$invReports);
        }   elseif(Input::get('option_group') === 'location' AND Input::get('option_items') === 'items'){
            $code = Input::get('code');
            $locReports = Location::where('code', '=', Input::get('location'))->get();
            $loc_id = Location::select('id')->where('code', '=', Input::get('location'))->value('id');
            $invReports = Item::where('fk_location','=',$loc_id)->where('barcode','=', $code)->get();
            $group_id = Item::where('fk_location','=', $loc_id)->where('barcode','=',$code)->value('fk_cat');
            $groupReports = ItemGroup::where('id', '=', $group_id)->get();
            // return view('report.stock_items')->with('invReport',$invReports);
            $this->set_cart($invReports);
            $this->set_group($groupReports);
            $this->set_location($locReports);
            $items = Session::get('items');  
            $group = Session::get('group');  
            $location = Session::get('location');  
            return PDF::loadView('report/pdf',array('items'=> $items, 'group'=> $group, 'location' => $location))->setPaper('a4')->setOrientation('landscape')->setWarnings(false)->save(public_path().'/pdf/'.'laporan_stok_barang.pdf')->stream('Laporan Stok Barang.pdf');
        }   
         $invReports = Item::all();
        $locReports = Location::all(); 
        $groupReports = ItemGroup::all(); 
        
        $this->set_cart($invReports);
        $this->set_group($groupReports);
        $this->set_location($locReports);
        $items = Session::get('items');  
        $group = Session::get('group');  
        $location = Session::get('location');  
        return PDF::loadView('report/pdf',array('items'=> $items, 'group'=> $group, 'location' => $location))->setPaper('a4')->setOrientation('landscape')->setWarnings(false)->save(public_path().'/pdf/'.'laporan_stok_barang.pdf')->stream('Laporan Stok Barang.pdf');
        return view('report.stock_items')->with('invReport',$invReports);
    }
            
    public function stock()
    {
        $this->rem_ses('');
        $invReports = Item::all();
        // $locReports = Location::all(); 
        // $groupReports = ItemGroup::all();
        // $this->set_cart($invReports);
        // $this->set_group($groupReports);
        // $this->set_location($locReports);
        return view('report.stock_items')->with('invReport', $invReports);
    }

    public function cetakPdf()
    {
        $items = Session::get('items');  
        $group = Session::get('group');  
        $location = Session::get('location');  
        return PDF::loadView('report/pdf',array('items'=> $items, 'group'=> $group, 'location' => $location))->setPaper('a4')->setOrientation('landscape')->setWarnings(false)->save(public_path().'/pdf/'.'cetak.pdf')->stream('download.pdf');
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

    function get_in($in)
    {
        return Input::get("$in");
    }

    function get_ses($ses)
    {
        return Session::get("$ses");
    }

    function rem_ses($ses)
    {
       if(empty($ses)){
            $ses = ['master','trans','total','items','id_trans'];
            foreach($ses as $ses){
            Session::forget("$ses");
            }
        }   
        else {
        Session::forget("$ses"); 
        }
    }

     function set_flash($msg)
    {
        return Session::flash('message',"$msg");
    }

    function get_cart()
    {
        if(!Session::get('items'))
            $this->set_cart(array());

        return Session::get('items');
    }

    function set_cart($cart_data)
    {
        Session::put('items',$cart_data);
    }

    function set_location($cart_data)
    {
        Session::put('location',$cart_data);
    }

    function set_group($cart_data)
    {
        Session::put('group',$cart_data);
    }

    function rem_cart($cart_data)
    {
        Session::forget("items.$cart_data");
    }
}
