<?php

namespace ZPos\Http\Controllers;

use Illuminate\Http\Request;

use ZPos\Http\Requests;
use ZPos\Http\Controllers\Controller;
use ZPos\Item;
use ZPos\Inventory;
use ZPos\Http\Requests\InventoryRequest;
use \Auth, \Redirect, \Validator, \Input, \Session;


class InventoryController extends Controller
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
        $items = Item::find($id);
            $inventories = Inventory::all();
            return view('inventory.edit')
                ->with('item', $items)
                ->with('inventory', $inventories);
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
                $items->quantity = $items->quantity + Input::get('in_out_qty');
                $items->save();
                
                $inventories = new Inventory;
                $inventories->item_id = $id;
                $inventories->user_id = Auth::user()->id;
                $inventories->in_out_qty = Input::get('in_out_qty');
                $inventories->remarks = Input::get('remarks');
                $inventories->save();
                

                Session::flash('message', 'You have successfully updated item');
                return Redirect::to('inventory/' . $id . '/edit');
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
