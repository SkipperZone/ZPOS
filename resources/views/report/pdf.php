<html>
<head>
	<title>Laporan Stok Barang</title>
<style type="text/css">
	th { padding: 3px 10px; }

	.stripped {
  padding: 2.25em 1.6875em;
  background-image: -webkit-repeating-linear-gradient(135deg, rgba(0,0,0,.3), rgba(0,0,0,.3) 1px, transparent 2px, transparent 2px, rgba(0,0,0,.3) 3px);
  background-image: -moz-repeating-linear-gradient(135deg, rgba(0,0,0,.3), rgba(0,0,0,.3) 1px, transparent 2px, transparent 2px, rgba(0,0,0,.3) 3px);
  background-image: -o-repeating-linear-gradient(135deg, rgba(0,0,0,.3), rgba(0,0,0,.3) 1px, transparent 2px, transparent 2px, rgba(0,0,0,.3) 3px);
  background-image: repeating-linear-gradient(135deg, rgba(0,0,0,.3), rgba(0,0,0,.3) 1px, transparent 2px, transparent 2px, rgba(0,0,0,.3) 3px);
  -webkit-background-size: 4px 4px;
  -moz-background-size: 4px 4px;
  background-size: 4px 4px;
  }

</style>
</head>

<div>
	<center><p style="font-size: 15pt;"><b>Laporan Stok Barang</b></p></center>
<?php foreach ($location as $loc) { ?>
<b>Gudang : <?php echo $loc->name ?></b>
<table border="1px" style="margin-bottom: 20px; font-size: 10pt; border-collapse: collapse; text-align: left; width: 100%; " align="center">
	<tr style="background-color: lightblue">
		<th style="width: 20px">No.</th>
		<th>Barcode</th>
		<th style="width: 150px">Nama Barang</th>
		<th>Harga Jual 1</th>
		<th>Harga Jual 2</th>
		<th>Harga Jual 3</th>
		<th>Harga Grosir</th>
		<th>Diskon (Rp.)</th>
		<th>Diskon (%)</th>
		<th style="width: 10px">Stok</th>
		<th>Jumlah Harga</th>
		<th style="width: 10px">Satuan</th>
	</tr>
	<?php foreach ($group as $key) { ?>
	<?php $check = DB::table('items')->where('fk_cat', $key->id)->where('fk_location', $loc->id)->count(); if(($check) > 0) { ?>
	<!-- group barang disini -->
	<tr style=" background-color: #F5F5F5"> 
		<td colspan="12"><b style="margin-left: 4%;">Group Barang >> <?php echo $key->name ?></b></td>
	</tr>
	<!-- end group barang -->
	<?php $no = 1; $total = 0;	

	foreach (ReportStockDetailed::item_detailed($key->id, $loc->id) as $value) { 
	$total += ($value->quantity * $value->selling_price);
	
	?>

	<tr>
		<td style="text-align: center; valign: middle"><?php echo $no ?></td>
		<td style="text-align: center; valign: middle"><?php echo $value->barcode ?></td>
		<td style="valign: middle"><?php echo $value->item_name ?></td>
		<td align="right" style="valign: middle"><?php echo number_format(($value->selling_price),0,',','.') ?></td>
		<td align="right" style="valign: middle"><?php echo number_format(($value->selling_price2),0,',','.') ?></td>
		<td align="right" style="valign: middle"><?php echo number_format(($value->selling_price3),0,',','.') ?></td>
		<td align="right" style="valign: middle"><?php echo number_format(($value->grocery_price),0,',','.') ?></td>
		<td align="center" style="valign: middle"><?php echo $value->disc_currency ?></td>
		<td align="center" style="valign: middle"><?php echo $value->disc_persen ?></td>
		<td align="center" style="valign: middle"><?php echo $value->quantity ?></td>
		<td align="right" style="valign: middle"><?php echo number_format(($value->quantity * $value->selling_price),0,',','.') ?></td>
		<td align="center" style="valign: middle"><?php echo $value->satuan_name->name ?></td>
	</tr>
	
	<?php $no++; } ?>
	<tr >
		<td style="background-color: #ccc" colspan="9" align="right"><b>Sub Total</b></td>
		<!-- <td align="right" style="valign: middle"><?php echo number_format(DB::table('items')->where('fk_cat', $key->id)->sum('selling_price')) ?></td>
		<td colspan="5"></td> -->
		<!-- <td style="background-color: #ccccc0" align="right"><b>Sub Total </b></td> -->
		<td style="background-color: #ccccc0" align="center" style="valign: middle"><?php echo DB::table('items')->where('fk_cat', $key->id)->where('fk_location', $loc->id)->sum('quantity') ?></td>
		<td style="background-color: #ccccc0" align="right" style="valign: middle"><?php echo number_format(($total),0,',','.')?></td>
		<td style="background-color: #ccc"></td>
	</tr>
	

 <?php } }?>

</table>
<?php } ?>
</div>
</html>