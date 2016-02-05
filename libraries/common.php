<?php
/*
For the sun begin alternated.
*/
use ZPos\TutaposSetting;
use ZPos\LocationMovingTr;
use ZPos\LocationMovingItem;
use ZPos\Item;
use ZPos\Location;
use ZPos\Sale;
use ZPos\SaleTemp;
use ZPos\Receiving;
// use App, DB;\\
class Common {

	public static function get_today($today = '') {
        if(TutaposSetting::where('id', 1)->first()->languange === 'id') {
        $array_hari = array(1=>"Senin","Selasa","Rabu","Kamis","Jum'at","Sabtu","Minggu");
        $hari =	$array_hari[date("N")];
        $tanggal =	date("j");
        $array_bulan =	array(1=>"Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
        $bulan = $array_bulan[date("n")];
        $tahun = date("Y");
        $today = ("$hari, $tanggal $bulan $tahun");
        } else {
            $hari = date("l");
            $tanggal = date("j");
            $bulan = date("F");
            $tahun = date("Y");
            $today = ("$hari, $tanggal $bulan $tahun");
        }
        return $today;
    }

    public static function check_data($user) {
        if ($user == 'moving') {
        $data = LocationMovingTr::count();
        } elseif ($user == 'items') {
        $data = Item::count();
        } elseif ($user == 'location') {
        $data = Location::count();
        } elseif ($user == 'sale') {
        $data = Sale::count();
        } elseif ($user == 'receiving') {
        $data = Receiving::count();
        }  elseif ($user == 'saletemp') {
        $data = SaleTemp::count();
        }
        return $data;
    }

    public static function no_auto($user){
        if($user == 'moving') {
            $jumlah = LocationMovingTr::count();
            if($jumlah > 0){
            $all = LocationMovingTr::select('no')->orderBy('no', 'desc')->first();
            $no = $all->no;
            $hasil = substr($no, 2, 9);
            $kode = $hasil  .  ($jumlah +1);
            } else {
                $hasil = 000000000;
                $kode = $hasil .  ($jumlah +1);
            } 

            $pre = 'MB';
        } 
        // return $hasil;
        return $pre.$kode;
    }

    public function suggest($keyword)
    {
        $models = DB::table('items')->where('name', 'like', '%'. $keyword. '%')->get();
        $suggest=array();
        foreach($models as $model) {
            $suggest[] = array(
                'label'=>$model->name.' - '.$model->barcode.' - '.$model->quantity,  // label for dropdown list
                'value'=>$model->name,  // value for input field
                'id'=>$model->id,       // return values from autocomplete
                'barcode'=>$model->barcode,
                // 'call_code'=>$model->call_code,
            );
        }
        return $suggest;
    }

    public function getCancha(Request $request){

        $cancha = $request->input('term');
        $canchas = Item::all();
        $result = [];

        foreach ($canchas as $sede) {
            if(strpos(Str::lower($sede),$cancha) !== false){
                $result[] = $sede;
            }
        }
        return $result;
    }

    

}
?>