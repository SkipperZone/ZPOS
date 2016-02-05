@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">{{trans('location.list_locations')}}</div>

				<div class="panel-body">
				<a class="btn btn-small btn-success" href="{{ URL::to('warehouse/create') }}">{{trans('location.new_location')}}</a>
				<hr />
@if (Session::has('message'))
    <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
@endif

<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>{{trans('location.code')}}</th>
            <th>{{trans('location.name')}}</th>
            <th>{{trans('location.desc')}}</th>
            {{-- <th>{{trans('location.quantity')}}</th> --}}
            <th>{{trans('location.quantity_stock')}}</th>
            <th></td>
        </tr>
    </thead>
    <tbody>
    @foreach($location as $value)
        <tr>
            <td>{{ $value->code }}</td>
            <td>{{ $value->name }}</td>
            <td>{{ $value->desc }}</td>
            {{-- <td>{{ DB::table('items')->where('fk_location', $value->id)->count() }} {{ trans('item.items')}}</td> --}}
            <td>{{ DB::table('items')->where('fk_location', $value->id)->sum('quantity') }} </td>
            <td>
                {!! Form::open(array('url' => 'warehouse/' . $value->id, 'class' => 'pull-right')) !!}
                    {!! Form::hidden('_method', 'DELETE') !!}
                <a class="btn btn-warning btn-xs" href="{{ URL::to('warehouse/' . $value->id . '/edit') }}" title="{{trans('location.edit')}}" ><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
                <button  onclick="return confirm('Are you sure want to delete warehouse {{ $value->name }} ?'); if (ok) return true; else return false" type="submit"class="btn btn-danger btn-xs" title="{{trans('location.delete')}}" ><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                    <!-- {!! Form::submit(trans('location.delete'), array('class' => 'btn btn-warning btn-xs', 'title' => 'Delete')) !!} -->
                {!! Form::close() !!}
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