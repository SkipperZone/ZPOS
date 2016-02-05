<style type="text/css">
@media print {
    .input {
        display:none !important;
    }
}
</style>
<script>
function myPrint() {
    window.print();
}
</script>
<div class="input">
<form action="/items/barcode/print/{{ $item->id }}" action="post">
<input type="text" name="jumlah" placeholder="Masukan Jumlah">
<button type="submit">OK</button>

<button class="input" onclick="myPrint()">Cetak </button>
</form>
</div>

<?php if($qty > 0) { 
$i = 2;
while($i<=($qty)) {
	?>
<table>
<tr>
<td><div class="barcode">
<table width="50">
	<tr>
		<td align="center">
			<?php 

echo '<img src="data:image/png;base64,' . DNS1D::getBarcodePNG("$item->barcode", "EAN13", 1, 33	) . '" alt="barcode"   />';
?>
			<!-- {!! DNS1D::getBarcodeHTML("$item->barcode", "UPCA", 1, 33)!!} -->
			<a style="font-size: 10px;">{!! $item->barcode !!}</a	>
			<hr style="margin-top: 0px">
			<p style="font-size: 10px; margin-top: -7px; text-align: left">{!! 'Rp. '.number_format($item->selling_price,'2',',','.') !!}</p>
		 </td>
	</tr>	

</table>
</div></td>
<td><div class="barcode">
<table width="50">
	<tr>
		<td align="center">
			<?php 

echo '<img src="data:image/png;base64,' . DNS1D::getBarcodePNG("$item->barcode", "EAN13", 1, 33	) . '" alt="barcode"   />';
?>
			<!-- {!! DNS1D::getBarcodeHTML("$item->barcode", "UPCA", 1, 33)!!} -->
			<a style="font-size: 10px;">{!! $item->barcode !!}</a	>
			<hr style="margin-top: 0px">
			<p style="font-size: 10px; margin-top: -7px; text-align: left">{!! 'Rp. '.number_format($item->selling_price,'2',',','.') !!}</p>
		 </td>
	</tr>	

</table>
</div></td>	
</tr>
</table>
<br />
<?php $i++; } } else ?>

<table>
<tr>
<td><div class="barcode">
<table width="50">
	<tr>
		<td align="center">
			<?php 

echo '<img src="data:image/png;base64,' . DNS1D::getBarcodePNG("$item->barcode", "EAN13", 1, 33	) . '" alt="barcode"   />';
?>
			<!-- {!! DNS1D::getBarcodeHTML("$item->barcode", "UPCA", 1, 33)!!} -->
			<a style="font-size: 10px;">{!! $item->barcode !!}</a	>
			<hr style="margin-top: 0px">
			<p style="font-size: 10px; margin-top: -7px; text-align: left">{!! 'Rp. '.number_format($item->selling_price,'2',',','.') !!}</p>
		 </td>
	</tr>	

</table>
</div></td>
<td><div class="barcode">
<table width="50">
	<tr>
		<td align="center">
			<?php 

echo '<img src="data:image/png;base64,' . DNS1D::getBarcodePNG("$item->barcode", "EAN13", 1, 33	) . '" alt="barcode"   />';
?>
			<!-- {!! DNS1D::getBarcodeHTML("$item->barcode", "UPCA", 1, 33)!!} -->
			<a style="font-size: 10px;">{!! $item->barcode !!}</a	>
			<hr style="margin-top: 0px">
			<p style="font-size: 10px; margin-top: -7px; text-align: left">{!! 'Rp. '.number_format($item->selling_price,'2',',','.') !!}</p>
		 </td>
	</tr>	

</table>
</div></td>	
</tr>
</table>
<br />
