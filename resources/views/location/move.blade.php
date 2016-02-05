@extends('app')

@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-12 ">
			<div class="panel panel-default">
				<div class="panel-heading">{{trans('location.list_location_moving')}}</div>

				<div class="panel-body">
                     @if (Alert::has('error'))
                    <div class="alert alert-danger">
                    {{ Alert::first('error') }}
                    </div>
                    @endif
                    {!! Html::ul($errors->all()) !!}
                    @if (Common::check_data('moving') > 0)
                <form method="GET" action="/warehouse_move_items/search">
                 <table width="100%">
                    <tr>  
                        <td width="40%">
                            {!! Form::text('code', Input::old('code'), array('class' => 'form-control', 'placeholder'=> 'Ketik No. Bukti disini !', 'id'=>'readNo', 'data'=>'typeahead', 'autocomplete' => 'off')) !!}
                        </td>
                        <td>&nbsp</td>
                        <td>
                            {!! Form::submit('Search', array('class' => 'btn btn-primary')) !!}
                        </td>
                    </tr>
                </table>
                 </form>
                <hr /> 
                    @endif
				<a class="btn btn-small btn-success" href="{{ URL::to('warehouse_move_items/create') }}">{{trans('location.new_mutation')}}</a>
				<hr />
                @if (Session::has('message'))
                    <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
                @endif

<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>{{trans('location.no')}}</th>
            <th>{{trans('location.date')}}</th>
            <th>{{trans('location.from_location')}}</th>
            <th>{{trans('location.to_location')}}</th>
            <th>{{trans('location.remarks')}}</th>
            <th>{{trans('location.quantity')}}</th>
            <th>Action</td>
            <th></td>
        </tr>
    </thead>
    <tbody>
    @foreach($location as $value)
        <tr>
            <td>{{ $value->no }}</td>
            <td>{{ $value->date }}</td>
            <td>{{ $value->loc_from_rel->code }} - {{ $value->loc_from_rel->name }}</td>
            <td>{{ $value->loc_to_rel->code }} - {{ $value->loc_to_rel->name }}</td>
            <td>{{ $value->remarks }}</td>
            <td>{{ DB::table('location_move_items')->where('loc_id', $value->id)->count() }} {{trans('item.items')}}</td>
            <td>
                {!! Form::open(array('url' => 'warehouse/' . $value->id, 'class' => 'pull-right')) !!}
                    {!! Form::hidden('_method', 'DELETE') !!}
                <a class="btn btn-warning btn-xs" href="{{ URL::to('warehouse/' . $value->id . '/edit') }}" title="{{trans('location.edit')}}" ><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
                <button  onclick="return confirm('Are you sure want to delete warehouse {{ $value->name }} ?'); if (ok) return true; else return false" type="submit"class="btn btn-danger btn-xs" title="{{trans('location.delete')}}" ><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                    <!-- {!! Form::submit(trans('location.delete'), array('class' => 'btn btn-warning btn-xs', 'title' => 'Delete')) !!} -->
                {!! Form::close() !!}
            </td>
             <td>
                <a class="btn btn-info btn-xs" data-toggle="collapse" href="#detailedMoving{{ $value->id }}" aria-expanded="false" aria-controls="detailedMoving">
                    {{trans('report-sale.detail')}}</a>
            </td>
        </tr>
           <tr class="collapse" id="detailedMoving{{ $value->id }}">
                <td colspan="10">
                    <table class="table">
                        <tr>
                            <th>{{trans('location.barcode')}}</th>
                            <th>{{trans('item.item_name')}}</th>
                            <th>{{trans('location.qty')}}</th>
                        </tr>
                        @foreach(LocationMovingDetailed::moving_detailed($value->id) as $MoveDetailed)
                        <tr>
                            <td>{{ $MoveDetailed->item->barcode }}</td>
                            <td>{{ $MoveDetailed->item->item_name }}</td>
                            <td>{{ $MoveDetailed->qty_in_out }} {{ DB::table('satuan')->select('name')->where('id',$MoveDetailed->item->satuan)->value('name') }} </td>
                        </tr>
                        @endforeach
                    </table>
                </td>
            </tr>
    @endforeach
    </tbody>
</table>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection