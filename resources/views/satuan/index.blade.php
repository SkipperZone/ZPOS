@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">{{trans('satuan.list_satuans')}}</div>

				<div class="panel-body">
				<a class="btn btn-small btn-success" href="{{ URL::to('satuan/create') }}">{{trans('satuan.new_satuan')}}</a>
				<hr />
@if (Session::has('message'))
    <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
@endif

<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>{{trans('satuan.name')}}</th>
            <th>{{trans('satuan.desc')}}</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
    @foreach($satuan as $value)
        <tr>
            <td>{{ $value->name }}</td>
            <td>{{ $value->desc }}</td>
            <td>
                {!! Form::open(array('url' => 'satuan/' . $value->id, 'class' => 'pull-right')) !!}
                    {!! Form::hidden('_method', 'DELETE') !!}
                <a class="btn btn-warning btn-xs" href="{{ URL::to('satuan/' . $value->id . '/edit') }}" title="{{trans('satuan.edit')}}" ><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
                <button  onclick="return confirm('Are you sure want to delete satuan {{ $value->name }} ?'); if (ok) return true; else return false" type="submit"class="btn btn-danger btn-xs" title="{{trans('satuan.delete')}}" ><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                    <!-- {!! Form::submit(trans('satuan.delete'), array('class' => 'btn btn-warning btn-xs', 'title' => 'Delete')) !!} -->
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