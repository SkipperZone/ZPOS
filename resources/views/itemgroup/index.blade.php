@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">{{trans('itemgroup.list_itemgroups')}}</div>

				<div class="panel-body">
				<a class="btn btn-small btn-success" href="{{ URL::to('item_group/create') }}">{{trans('itemgroup.new_itemgroup')}}</a>
				<hr />
@if (Session::has('message'))
    <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
@endif

<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>{{trans('itemgroup.itemgroup_code')}}</th>
            <th>{{trans('itemgroup.name')}}</th>
            <th>{{trans('itemgroup.desc')}}</th>
            <th></td>
        </tr>
    </thead>
    <tbody>
    @foreach($itemgroup as $value)
        <tr>
            <td>{{ $value->code }}</td>
            <td>{{ $value->name }}</td>
            <td>{{ $value->desc }}</td>
            <td>
                {!! Form::open(array('url' => 'warehouse/' . $value->id, 'class' => 'pull-right')) !!}
                    {!! Form::hidden('_method', 'DELETE') !!}
                <a class="btn btn-warning btn-xs" href="{{ URL::to('item_group/' . $value->id . '/edit') }}" title="{{trans('itemgroup.edit')}}" ><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
                <button  onclick="return confirm('Are you sure want to delete group {{ $value->name }} ?'); if (ok) return true; else return false" type="submit"class="btn btn-danger btn-xs" title="{{trans('itemgroup.delete')}}" ><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                    <!-- {!! Form::submit(trans('itemgroup.delete'), array('class' => 'btn btn-warning btn-xs', 'title' => 'Delete')) !!} -->
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