<?php

namespace ZPos\Http\Controllers;

use Illuminate\Http\Request;
use ZPos\Item;
use ZPos\Location;
use ZPos\LocationMovingTr;
use ZPos\LocationMovingItem;
use ZPos\Http\Requests;
use ZPos\Http\Requests\LocationRequest;
use ZPos\Http\Controllers\Controller;
use \Auth, \Redirect, \Validator, \Input, \Session;
use Alert;

class LocationController extends Controller
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
    public function index()
    {
        $this->rem_ses('');
        $locations = Location::all();
        return view('location.index')->with('location', $locations);
    }

    public function move()
    {
        if(Location::count() > 1) {
        $this->rem_ses('');    
        $locations = LocationMovingTr::all();
        return view('location.move')->with('location', $locations);
        } else {
        Alert::error('Anda hanya memiliki satu gudang ! Tambah gudang baru untuk menggunakan menu ini !');
        return Redirect::to('/');
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('location.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // store
                $locations = new Location;
                $locations->code = Input::get('code');
                $locations->name = Input::get('name');
                $locations->desc = Input::get('desc');
                $locations->save();
                Session::flash('message', 'You have successfully added warehouse');
                return Redirect::to('warehouse');
    }
  
  /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function move_create()
    {
        $locs = ['' => '-- Please select a location !'] + Location::lists('name', 'id')->toArray();
        return view('location.move_create')->with('loc', $locs);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function move_store(Request $request)
    {
         if(Input::has('next')){
            $loc_from = Location::select('name')->where('id', '=', $this->get_in('loc_from'))->value('name');
            $loc_to = Location::select('name')->where('id', '=', $this->get_in('loc_to'))->value('name');
            
                Session::put('master', [
                    'no'    => $this->get_in('no'),
                    'date'  => $this->get_in('date'),
                    'loc_to' => $this->get_in('loc_to'),
                    'loc_from'   => $this->get_in('loc_from'),
                    'loc_to_name'   => $loc_to,
                    'loc_from_name'   => $loc_from,
                    'desc'     => $this->get_in('desc'),
                ]);
            }
                // Session::flash('message', 'You have successfully added warehouse');
                return Redirect::to('warehouse_move_items/create');
    }

     //hapus items dalam table cart
    public function removeitem($key)
    {
        $this->rem_cart($key);
        return redirect('warehouse_move_items/create');
    }

      //tambah items ke dalam table cart on demand
    public function additems()
    {
        //scenario di dalam create transaksi
        if(Input::has('additems')){
            //Get all items in the cart so far...
            $items = $this->get_cart();

            $maxkey = 0; //nilai tertinggi
            $insertkey = 0;

            foreach ($items as $item)
            {
              //looping index key nya biar bisa nambah banyak
                if($maxkey <= $item['line'])
                {
                    $maxkey = $item['line'];
                }
            }
            
            $insertkey=$maxkey+1;
            // cari id items barang
            $id = Item::select('id')->where('barcode', '=', $this->get_in('barcode'))->value('id'); 
                 //bentukan data session
                $item = array(($insertkey)=>
                array(
                    'id'    => $id,
                    'barcode'=>$this->get_in('barcode'),
                    'qty'=>$this->get_in('qty'),
                    'line'=>$insertkey,
                    )
                );      
        
            $items+=$item; //add items 
            //storing ke session
            $this->set_cart($items);

            return redirect('warehouse_move_items/create');
        }  //end of add items new transaksi

        //scenario datam detail transaksi
       
    }

    // untuk menyimpan semua items ke dalam transaksi . tidak bisa dibatalkan !
    // FUNCTION PENTING UNTUK TRANSAKSI
    public function saveall()
    {
        if(Input::has('saveall'))
        {
            // Save ke dalam transaksi model
            $trans = new LocationMovingTr();
            $trans->no = $this->get_ses('master.no');
            $trans->date = $this->get_ses('master.date');
            $trans->loc_from = $this->get_ses('master.loc_from');
            $trans->loc_to = $this->get_ses('master.loc_to');
            $trans->remarks = $this->get_ses('master.desc');
            $trans->user_id = 1;
            if($trans->save()){
                //save items-items nya disini
                Session::put('id_trans',$trans->id);

                $id_trans = $this->get_ses('id_trans');
                $numberOfitems = $this->get_ses('line');
                $items = $this->get_ses('items');
                foreach($items as $item){
                    $t_items = new LocationMovingItem();
                    $t_items->loc_id        = $id_trans;
                    $t_items->item_id       = $item['id'];
                    $t_items->qty_in_out    = $item['qty'];
                    $t_items->save();
                }
                //update total transaksi
                // $this->update_total($id_trans);
                //set message sukses
                $this->set_flash('Successfully created transaksi !');
                return redirect('warehouse_move_items');
            } else {
                //set message gagal
                $this->set_flash('Failed create transaksi !');
                return redirect('warehouse_move_items/create');
            }

        }
    }

    public function move_edit($id)
    {
        $locations = LocationMovingTr::find($id);
        return view('location.move_edit')
            ->with('location', $locations);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function move_update(Request $request, $id)
    {
        //update
                $locations = LocationMovingTr::find($id);
                $locations->code = Input::get('code');
                $locations->name = Input::get('name');
                $locations->desc = Input::get('desc');
                $locations->save();
                Session::flash('message', 'You have successfully updated warehouse');
                return Redirect::to('warehouse');
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
        $locations = Location::find($id);
        return view('location.edit')
            ->with('location', $locations);
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
        //update
                $locations = Location::find($id);
                $locations->code = Input::get('code');
                $locations->name = Input::get('name');
                $locations->desc = Input::get('desc');
                $locations->save();
                Session::flash('message', 'You have successfully updated warehouse');
                return Redirect::to('warehouse');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try
        {
            
            $locations = Location::find($id);
            $locations->delete();
            // redirect
            Session::flash('message', 'You have successfully deleted warehouse');
            return Redirect::to('warehouse');
        }
        catch(\Illuminate\Database\QueryException $e)
        {
            Session::flash('message', 'Integrity constraint violation: You Cannot delete a parent row');
            Session::flash('alert-class', 'alert-danger');
            return Redirect::to('warehouse');   
        }
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

    function rem_cart($cart_data)
    {
        Session::forget("items.$cart_data");
    }

}
