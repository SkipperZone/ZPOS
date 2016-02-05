@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">{{trans('itemgroup.update_itemgroup')}}</div>

				<div class="panel-body">
					{!! Html::ul($errors->all()) !!}

					{!! Form::model($itemgroup, array('route' => array('item_group.update', $itemgroup->id), 'method' => 'PUT', 'files' => true)) !!}

					<div class="form-group">
					{!! Form::label('code', trans('itemgroup.itemgroup_code').' *') !!}
					{!! Form::text('code', null, array('class' => 'form-control')) !!}
					</div>

					<div class="form-group">
					{!! Form::label('name', trans('itemgroup.name').' *') !!}
					{!! Form::text('name', null, array('class' => 'form-control')) !!}
					</div>

					<div class="form-group">
					{!! Form::label('desc', trans('itemgroup.desc')) !!}
					{!! Form::text('desc', null, array('class' => 'form-control')) !!}
					</div>

					{!! Form::submit(trans('itemgroup.submit'), array('class' => 'btn btn-primary')) !!}

					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection