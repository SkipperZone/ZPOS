<?php namespace ZPos\Http\Controllers;

use ZPos\Item, ZPos\Customer, ZPos\Sale;
use ZPos\Supplier, ZPos\Receiving, ZPos\User;
use App;


class HomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		$items = Item::where('type', 1)->count();
		$item_kits = Item::where('type', 2)->count();
		$customers = Customer::count();
		$suppliers = Supplier::count();
		$receivings = Receiving::count();
		$sales = Sale::count();
		$employees = User::count();
		// passing jam variable
		$array_hari = array(1=>"Senin","Selasa","Rabu","Kamis","Jum'at","Sabtu","Minggu");
		$hari = $array_hari[date("N")];
		$tanggal = date("j");
		$array_bulan = array(1=>"Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
		$bulan = $array_bulan[date("n")];
		$tahun = date("Y");
		$date = ("$tanggal $bulan $tahun");
		$time = date("H:i:s");
		//end jam 
		return view('home')
			->with('items', $items)
			->with('item_kits', $item_kits)
			->with('customers', $customers)
			->with('suppliers', $suppliers)
			->with('receivings', $receivings)
			->with('sales', $sales)
			->with('employees', $employees)
			->with('date', $date);
	}

}
