<?php namespace ZPos\Http\Controllers;

use ZPos\Http\Requests;
use ZPos\Http\Controllers\Controller;
use ZPos\Item, ZPos\ItemKit, ZPos\ItemKitItem, ZPos\ItemTemp;
use \Auth, \Redirect, \Validator, \Input, \Session, \Response;
use Illuminate\Http\Request;

class ReceivingApiController extends Controller {

	public function __construct()
	{
		$this->middleware('auth');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//$items = Item::get();
		//$itemkits = ItemKit::with('itemkititem')->get();
		//$array = array_merge($items->toArray(), $itemkits->toArray());
		//return Response::json($array);
		return Response::json(Item::get());
	}
	public function scan($id)
	{
		// $id = Input::get('item_id');
		return Response::json(
			Item::where('id', $id)
			->orWhere('barcode', $id)
			->orWhere('upc_ean_isbn', $id)
			->orWhere('item_name', $id)
			
			->get());
	}

	public function scanitem()
	{
		$code = Input::get('mysearch');

		$item = Item::where('barcode',$code)->firts();

		$SaleTemps = new ItemTemp;
		$SaleTemps->item_id = $item->id;
		$SaleTemps->cost_price = $item->cost_price;
        $SaleTemps->selling_price = $item->selling_price;
		$SaleTemps->quantity = Input::get('myquantity');
		$SaleTemps->total_cost = $item->cost_price;
        $SaleTemps->total_selling = $item->selling_price;
		$SaleTemps->save();

		return Redirect::to('sales');
	}

	/**
	 * Show the form for creating a new resource. 
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
