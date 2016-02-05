<?php $data = Session::all();
$barcode = Session::get('items','barcode') ;
echo "<pre>";
echo ($barcode);
echo "</pre>";

?>