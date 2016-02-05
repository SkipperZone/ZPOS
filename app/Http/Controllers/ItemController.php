<?php

namespace ZPos\Http\Controllers;

use ZPos\Http\Requests;
use ZPos\Http\Controllers\Controller;

use ZPos\Item;
use ZPos\ItemGroup;
use ZPos\Satuan;
use ZPos\Location;
use ZPos\Inventory;
use ZPos\Http\Requests\ItemRequest;
use \Auth, \Redirect, \Validator, \Input, \Session;
use Image;
use Illuminate\Http\Request;

class ItemController extends Controller
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
        $items = Item::where('type', 1)->paginate(15);
        return view('item.index')->with('item', $items);
    }
    public function barcode($id)
    {
        if(Input::get('jumlah')){
            $jumlah = Input::get('jumlah');
            $items = Item::find($id);
            return view('item.barcode')
            ->with('item', $items)
            ->with('qty', $jumlah);
        }
        $items = Item::find($id);
        $jumlah = 0;
        return view('item.barcode')
        ->with('item', $items)
        ->with('qty', $jumlah);
      
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $groups = ['' => '-- Please select a group !'] + ItemGroup::lists('name', 'id')->toArray();
        $locations =  Location::lists('name', 'id')->toArray();
        // $locations = ['' => '-- Please select a location !'] + Location::lists('name', 'id')->toArray();
        $satuans = Satuan::lists('name', 'id');
        return view('item.create')
        ->with('satuan', $satuans)
        ->with('location', $locations)
        ->with('group', $groups);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $items = new Item;
            $items->upc_ean_isbn = Input::get('upc_ean_isbn');
            // $items->barcode = Input::get('barcode');
            $items->barcode = time();
            $items->item_name = Input::get('item_name');
            $items->size = Input::get('size');
            $items->fk_cat = Input::get('fk_cat');
            $items->fk_location = Input::get('fk_location');
            $items->satuan = Input::get('satuan');
            $items->description = Input::get('description');
            $items->cost_price = Input::get('cost_price');
            $items->grocery_price = Input::get('grocery_price');
            $items->selling_price = Input::get('selling_price');
            $items->selling_price2 = Input::get('selling_price2');
            $items->selling_price3 = Input::get('selling_price3');
            $items->qty_min = Input::get('qty_min');
            $items->qty_min_2 = Input::get('qty_min_2');
            $items->qty_min_2 = Input::get('qty_min_3');
            $items->disc_currency = Input::get('disc_currency');
            $items->disc_persen = Input::get('disc_persen');
            
            $items->quantity = Input::get('quantity');
            $items->save();
            // process inventory
            if(!empty(Input::get('quantity')))
            {
                $inventories = new Inventory;
                $inventories->item_id = $items->id;
                $inventories->user_id = Auth::user()->id;
                $inventories->in_out_qty = Input::get('quantity');
                $inventories->remarks = 'Manual Edit of Quantity';
                $inventories->save();
            }
            // process avatar
            $image = $request->file('avatar');
            if(!empty($image))
            {
                $avatarName = 'item' . $items->id . '.' . 
                $request->file('avatar')->getClientOriginalExtension();

                $request->file('avatar')->move(
                base_path() . '/public/images/items/', $avatarName
                );
                $img = Image::make(base_path() . '/public/images/items/' . $avatarName);
                $img->resize(100, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $img->save();
                $itemAvatar = Item::find($items->id);
                $itemAvatar->avatar = $avatarName;
                $itemAvatar->save();
            }
            Session::flash('message', 'You have successfully added item');
            return Redirect::to('items/create');
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
        $items = Item::find($id);
            return view('item.edit')
                ->with('item', $items);
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
       $items = Item::find($id);
            // process inventory
            $inventories = new Inventory;
            $inventories->item_id = $id;
            $inventories->user_id = Auth::user()->id;
            $inventories->in_out_qty = Input::get('quantity')- $items->quantity;
            $inventories->remarks = 'Manual Edit of Quantity';
            $inventories->save();
            // save update
            $items->upc_ean_isbn = Input::get('upc_ean_isbn');
            $items->item_name = Input::get('item_name');
            $items->size = Input::get('size');
            $items->satuan = Input::get('satuan');
            $items->fk_cat = Input::get('fk_cat');
            $items->fk_location = Input::get('fk_location');
            $items->description = Input::get('description');
            $items->cost_price = Input::get('cost_price');
            $items->grocery_price = Input::get('grocery_price');
            $items->selling_price = Input::get('selling_price');
            $items->selling_price2 = Input::get('selling_price2');
            $items->selling_price3 = Input::get('selling_price3');
            $items->qty_min = Input::get('qty_min');
            $items->qty_min_2 = Input::get('qty_min_2');
            $items->qty_min_2 = Input::get('qty_min_3');
            $items->disc_currency = Input::get('disc_currency');
            $items->disc_persen = Input::get('disc_persen');
            
            $items->quantity = Input::get('quantity');

            $items->save();
            // process avatar
            $image = $request->file('avatar');
            if(!empty($image)) {
                $avatarName = 'item' . $id . '.' . 
                $request->file('avatar')->getClientOriginalExtension();

                $request->file('avatar')->move(
                base_path() . '/public/images/items/', $avatarName
                );
                $img = Image::make(base_path() . '/public/images/items/' . $avatarName);
                $img->resize(100, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $img->save();
                $itemAvatar = Item::find($id);
                $itemAvatar->avatar = $avatarName;
                $itemAvatar->save();
            }
            Session::flash('message', 'You have successfully updated item');
            return Redirect::to('items');
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
