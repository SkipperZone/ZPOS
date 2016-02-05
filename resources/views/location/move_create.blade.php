@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">{{trans('location.new_mutation')}}</div>
				<div class="panel-body">
					{!! Html::ul($errors->all()) !!}
					<?php $data = Session::all(); //print_r($data)?>
					@if(!Session::has('master'))
					{!! Form::open(array('url' => 'warehouse_move_items/create')) !!}

					<div class="form-group col-md-6">
					{!! Form::label('no', trans('location.no') .' *') !!}
					<!-- {!! Form::text('no', Input::old('no'), array('class' => 'form-control', 'required', 'value' =>Common::no_auto('moving') )) !!} -->
					<input class="form-control" required="required" name="no" type="text" id="no" value="{!! Common::no_auto('moving') !!}">
					</div>

					<div class="form-group col-md-6">
					{!! Form::label('date', trans('location.date') .' *') !!}
					{!! Form::date('date', \Carbon\Carbon::now(), array('class' => 'form-control', 'required')) !!}
					</div>

					<div class="form-group col-md-6">
					{!! Form::label('loc_from', trans('location.from_location') .' *') !!}
					{!! Form::select('loc_from', $loc, 'null', array('class' => 'form-control', 'required', 'id'=>'loc_from')) !!}
					</div>

					<div class="form-group col-md-6">
					{!! Form::label('loc_to', trans('location.to_location') .' *') !!}
					{!! Form::select('loc_to', $loc, 'null', array('class' => 'form-control', 'required', 'id'=>'loc_to')) !!}
					</div>

					<div class="form-group col-md-10">
					{!! Form::label('desc', trans('location.desc')) !!}
					{!! Form::text('desc', Input::old('desc'), array('class' => 'form-control', 'required')) !!}
					</div>
					
					<div class="form-group col-md-2">
					{!! Form::label('') !!}
						<div class="input-group">
						{!! Form::submit(trans('location.submit'), array('class' => 'btn btn-primary', 'name' => 'next')) !!}
						</div>
					</div>
					
					{!! Form::close() !!}
				@else

					<table class="table table-bordered">
                         <tr>
                             <th>{{trans('location.no')}}</th>
                             <th style="color: red; font-size: large">{{ Session::get("master.no") }}</th>
                         	<th>{{trans('location.date')}}</th>
                              <?php $date = date_create(Session::get("master.date"))?>
                             <td>{{ date_format($date,"d M Y") }}</td>
                         </tr>
                       
                         <tr>
                             <th>{{trans('location.from_location')}}</th>
                             <td>{{ Session::get("master.loc_from_name") }}</td>
                             <th>{{trans('location.to_location')}}</th>
                             <td>{{ Session::get("master.loc_to_name") }}</td>
                         </tr>
                         <tr>
                         	<th>{{trans('location.desc')}}</th>
                         	<td colspan="3">{{ Session::get("master.desc") }}</td>
                         </tr>
                    </table>
                   
                    <HR>

				<div class="panel panel-default" id="entry">
                  <div class="panel-heading"><strong>Entry your items below !</strong></div> 
                    <div class="panel-body">

                    
                    {!! Form::open(['url' => 'warehouse_move_items/create/additems','id'=>'item_form']) !!}
                     <div class="form-group col-md-6">
                        {!! Form::label('barcode', trans('location.barcode')) !!}
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="glyphicon glyphicon-barcode"></i>
                            </span>
                        <input type="text" name="barcode" class="form-control" id="readBarcode" required>
                        </div>
                    </div>

                    <div class="form-group col-md-4">
                        {!! Form::label('qty', trans('location.qty')) !!}
                            <div class="input-group">
                                    <span class="input-group-addon">
                                            <i class="glyphicon glyphicon-euro"></i>
                                    </span>
                                 {!! Form::text('qty', null, ['required'=>true, 'id'=>'qty','class' => 'form-control']) !!}                                
                            </div>
                    </div>
                    
                    <div class="form-group col-md-2">
                        {!! Form::label('') !!}
                    	<div class="input-group">
         	             {!! Form::submit('Add', ['class' => 'btn btn-primary','name' => 'additems']) !!}
                  		</div>
                  	</div>
            
                    {!! Form::close() !!}

                </div>  
                {{-- end of panel body --}}
			</div>
			  @if(Session::has('master'))
                    <table class="table table-striped table-bordered table-hover sortable">
                             <thead>
                             <tr class="bg-info">
                                <th>No.</th>
                                 <th>{{trans('item.item_name')}}</th>
                                 <th>{{trans('location.qty')}}</th>
                                 <th>Actions</th>
                             </tr>
                             </thead>
                             <tbody>
                            <?php $items = Session::get('items'); $no =1; ?>
                            <?php $cses = count(Session::get('items')); ?>
                            @if($cses > 0)
                            @foreach ($items as $item)
                            <tr>
                                <td>{{ $no }}</td>
                                <td>{{ $item['barcode'] }}</td>
                                <td>{{ $item['qty'] }} <input type="hidden" class="price" value="{{ $item['qty'] }}"></td>
                                <td>
                                     {!! Form::open(['url'=>["warehouse_move_items/removeitem/".$item['line']]]) !!}
                                     <div class="btn-group">
                                        <button type="submit" class="btn btn-danger glyphicon glyphicon-trash btn-sm" alt="Trash" title="Trash this" name="deleteitem" onclick="return confirm('Are you sure you want to delete this item?');"></button>                            
                                     </div>
                                     {!! Form::close() !!}
                                </td>
                            </tr>
                            <?php $no++?>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="4" align="center">No Items !</td>
                            </tr>
                            @endif
                             </tbody>

                         </table>
                         @if($cses > 0)
                         <div class="form-group">
                         {!! Form::open(['url' => 'warehouse_move_items/saveall']) !!}
                             {!! Form::submit('Save', ['class' => 'btn btn-warning form-control','name' => 'saveall','onclick' => "return confirm('Are you sure you want to post this items? This action will permanently store on database and can not undo !');"]) !!}
                         {!! Form::close() !!}    
                         </div>
                         @endif
                    @endif
			@endif
			  </div>          
		</div>
	</div>
</div>
@endsection


<script>
        $( "#canchas" ).autocomplete({
            source: 'http://localhost:8888/getCancha',
            minLength:1,
        });
</script>