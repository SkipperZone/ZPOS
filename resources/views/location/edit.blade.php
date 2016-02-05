@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">{{trans('location.update_location')}}</div>

				<div class="panel-body">
					{!! Html::ul($errors->all()) !!}

					{!! Form::model($location, array('route' => array('warehouse.update', $location->id), 'method' => 'PUT', 'files' => true)) !!}

					<div class="form-group">
					{!! Form::label('code', trans('location.code').' *') !!}
					{!! Form::text('code', null, array('class' => 'form-control')) !!}
					</div>

					<div class="form-group">
					{!! Form::label('name', trans('location.name').' *') !!}
					{!! Form::text('name', null, array('class' => 'form-control')) !!}
					</div>

					<div class="form-group">
					{!! Form::label('desc', trans('location.desc')) !!}
					{!! Form::text('desc', null, array('class' => 'form-control')) !!}
					</div>

					{!! Form::submit(trans('location.submit'), array('class' => 'btn btn-primary')) !!}

					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection