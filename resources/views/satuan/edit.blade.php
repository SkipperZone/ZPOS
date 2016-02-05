@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">{{trans('satuan.update_satuan')}}</div>

				<div class="panel-body">
					{!! Html::ul($errors->all()) !!}

					{!! Form::model($satuan, array('route' => array('satuan.update', $satuan->id), 'method' => 'PUT', 'files' => true)) !!}

					<div class="form-group">
					{!! Form::label('name', trans('satuan.name').' *') !!}
					{!! Form::text('name', null, array('class' => 'form-control', 'required')) !!}
					</div>

					<div class="form-group">
					{!! Form::label('desc', trans('satuan.desc')) !!}
					{!! Form::text('desc', null, array('class' => 'form-control')) !!}
					</div>

					{!! Form::submit(trans('satuan.submit'), array('class' => 'btn btn-primary')) !!}

					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection