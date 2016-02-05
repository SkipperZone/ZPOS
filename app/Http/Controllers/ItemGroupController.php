<?php

namespace ZPos\Http\Controllers;

use Illuminate\Http\Request;
use ZPos\ItemGroup;
use ZPos\Http\Requests;
use ZPos\Http\Requests\ItemGroupRequest;
use ZPos\Http\Controllers\Controller;
use \Auth, \Redirect, \Validator, \Input, \Session;


class ItemGroupController extends Controller
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
        $ItemGroups = ItemGroup::all();
        return view('itemgroup.index')->with('itemgroup', $ItemGroups);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('itemgroup.create');
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
                $ItemGroups = new ItemGroup;
                $ItemGroups->code = Input::get('code');
                $ItemGroups->name = Input::get('name');
                $ItemGroups->desc = Input::get('desc');
                $ItemGroups->save();
                Session::flash('message', 'You have successfully added item group');
                return Redirect::to('item_group');
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
        $ItemGroups = ItemGroup::find($id);
        return view('itemgroup.edit')
            ->with('itemgroup', $ItemGroups);
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
                $ItemGroups = ItemGroup::find($id);
                $ItemGroups->code = Input::get('code');
                $ItemGroups->name = Input::get('name');
                $ItemGroups->desc = Input::get('desc');
                $ItemGroups->save();
                Session::flash('message', 'You have successfully updated item group');
                return Redirect::to('item_group');
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
            
            $ItemGroups = ItemGroup::find($id);
            $ItemGroups->delete();
            // redirect
            Session::flash('message', 'You have successfully deleted item group');
            return Redirect::to('item_group');
        }
        catch(\Illuminate\Database\QueryException $e)
        {
            Session::flash('message', 'Integrity constraint violation: You Cannot delete a parent row');
            Session::flash('alert-class', 'alert-danger');
            return Redirect::to('item_group');   
        }
    }
}
