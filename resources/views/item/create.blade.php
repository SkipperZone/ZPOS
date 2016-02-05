@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">{{trans('item.new_item')}}</div>

				<div class="panel-body">
					@if (Session::has('message'))
					<div class="alert alert-info">{{ Session::get('message') }}</div>
					@endif
					{!! Html::ul($errors->all()) !!}

					{!! Form::open(array('url' => 'items', 'files' => true)) !!}

					<div class="form-group col-md-6">
					{!! Form::label('upc_ean_isbn', trans('item.upc_ean_isbn').' *') !!}
					{!! Form::text('upc_ean_isbn', Input::old('upc_ean_isbn'), array('class' => 'form-control', 'required')) !!}
					</div>

					{{-- <div class="form-group col-md-6">
					{!! Form::label('barcode', trans('item.barcode').' *') !!}
					{!! Form::text('barcode', Input::old('barcode'), array('class' => 'form-control', 'required')) !!}
					</div> --}}

					<div class="form-group col-md-9">
					{!! Form::label('item_name', trans('item.item_name').' *') !!}
					{!! Form::text('item_name', Input::old('item_name'), array('class' => 'form-control', 'required')) !!}
					</div>

					<div class="form-group col-md-3">
					{!! Form::label('Location', trans('location.name').' *') !!}
					{!! Form::select('fk_location', $location, null, array('class' => 'form-control', 'required')) !!}
					</div>

					<div class="form-group col-md-3">
					{!! Form::label('Item Group', trans('item.group').' *') !!}
					{{-- {!! Form::select('fk_cat', $group, null, array('class' => 'form-control', 'required')) !!} --}}
					{!! Form::text('itemgroup', Input::old('item_name'), array('class' => 'form-control', 'required', 'id'=>'readGroup')) !!}
					<input type="hidden" name="fk_cat" id="idGroup">
					</div>
					
					<div class="form-group col-md-3">
					{!! Form::label('Item Group', trans('itemgroup.name')) !!}
					{!! Form::text('group_name', Input::old('group_name'), array('class' => 'form-control', 'readonly', 'id'=>'nameGroup')) !!}
					</div>

					<div class="form-group col-md-3">
					{!! Form::label('Satuan', trans('satuan.name').' *') !!}
					{!! Form::select('satuan', $satuan, 'Pilih Kategori Artikel', array('class' => 'form-control', 'required')) !!}
					</div>

					<div class="form-group col-md-3">
					{!! Form::label('size', trans('item.size')) !!}
					{!! Form::text('size', Input::old('size'), array('class' => 'form-control')) !!}
					</div>

					<div class="form-group col-md-6">
					{!! Form::label('description', trans('item.description')) !!}
					{!! Form::textarea('description', Input::old('description'), array('class' => 'form-control')) !!}
					</div>

					<div class="form-group col-md-3">
					{!! Form::label('cost_price', trans('item.cost_price').' *') !!}
					{!! Form::text('cost_price', Input::old('cost_price'), array('class' => 'form-control')) !!}
					</div>

					<div class="form-group col-md-3">
					{!! Form::label('grocery_price', trans('item.grocery_price').' *') !!}
					{!! Form::text('grocery_price', Input::old('grocery_price'), array('class' => 'form-control')) !!}
					</div>

					<div class="form-group col-md-3">
					{!! Form::label('selling_price', trans('item.selling_price').' *') !!}
					{!! Form::text('selling_price', Input::old('selling_price'), array('class' => 'form-control')) !!}
					</div>

					<div class="form-group col-md-3">
					{!! Form::label('qty_min', trans('item.qty_min').' *') !!}
					{!! Form::text('qty_min', Input::old('qty_min'), array('class' => 'form-control')) !!}
					</div>

					<div class="form-group col-md-3">
					{!! Form::label('selling_price2', trans('item.selling_price2').' *') !!}
					{!! Form::text('selling_price2', Input::old('selling_price2'), array('class' => 'form-control')) !!}
					</div>

					<div class="form-group col-md-3">
					{!! Form::label('qty_min', trans('item.qty_min').' *') !!}
					{!! Form::text('qty_min_2', Input::old('qty_min_2'), array('class' => 'form-control')) !!}
					</div>

					<div class="form-group col-md-3">
					{!! Form::label('selling_price3', trans('item.selling_price3').' *') !!}
					{!! Form::text('selling_price3', Input::old('selling_price3'), array('class' => 'form-control')) !!}
					</div>

					<div class="form-group col-md-3">
					{!! Form::label('qty_min', trans('item.qty_min').' *') !!}
					{!! Form::text('qty_min_3', Input::old('qty_min_3'), array('class' => 'form-control')) !!}
					</div>

					<div class="form-group col-md-3">
					{!! Form::label('quantity', trans('item.quantity')) !!}
					{!! Form::text('quantity', Input::old('quantity'), array('class' => 'form-control')) !!}
					</div>
					
					<div class="form-group col-md-3">
					{!! Form::label('disc_currency', trans('item.disc_currency')) !!}
					{!! Form::text('disc_currency', Input::old('disc_currency'), array('class' => 'form-control')) !!}
					</div>

					<div class="form-group col-md-3">
					{!! Form::label('disc_persen', trans('item.disc_persen')) !!}
					{!! Form::text('disc_persen', Input::old('disc_persen'), array('class' => 'form-control')) !!}
					</div>
					
					<div class="form-group col-md-3">
					{!! Form::label('avatar', trans('item.choose_avatar')) !!}
					{!! Form::file('avatar', Input::old('avatar'), array('class' => 'form-control')) !!}
					</div>

					<div class="form-group col-md-12">
					{!! Form::submit(trans('item.submit'), array('class' => 'btn btn-primary')) !!}
					</div>

					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection