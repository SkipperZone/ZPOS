@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">{{trans('itemgroup.new_itemgroup')}}</div>
				<div class="panel-body">
					{!! Html::ul($errors->all()) !!}

					{!! Form::open(array('url' => 'item_group', 'files' => true)) !!}

					<div class="form-group">
					{!! Form::label('code', trans('itemgroup.itemgroup_code') .' *') !!}
					{!! Form::text('code', Input::old('code'), array('class' => 'form-control', 'required')) !!}
					</div>

					<div class="form-group">
					{!! Form::label('name', trans('itemgroup.name') .' *') !!}
					{!! Form::text('name', Input::old('name'), array('class' => 'form-control', 'required')) !!}
					</div>

					<div class="form-group">
					{!! Form::label('desc', trans('itemgroup.desc')) !!}
					{!! Form::text('desc', Input::old('desc'), array('class' => 'form-control')) !!}
					</div>

					{!! Form::submit(trans('itemgroup.submit'), array('class' => 'btn btn-primary')) !!}

					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection