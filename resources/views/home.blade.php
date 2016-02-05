@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
                  
				<div class="panel-heading">Dashboard</div>

				<div class="panel-body">
           @if (Session::has('error'))
                    <div class="alert alert-danger">{{ Session::get('error') }}</div>
            @endif
            @if (Alert::has('error'))
                    <div class="alert alert-danger">
                    {{ Alert::first('error') }}
                    </div>
                    @endif
					{{ trans('dashboard.welcome') }}
					<hr />
					<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">{{trans('dashboard.statistics')}}</h3>
  </div>
  <div class="panel-body">
    <div class="row">
    	<div class="col-md-4">
    		<div class="well">{{trans('dashboard.total_employees')}} : {{$employees}}</div>
    	</div>
    	<div class="col-md-4">
    		<div class="well">{{trans('dashboard.total_customers')}} : {{$customers}}</div>
    	</div>
    	<div class="col-md-4">
    		<div class="well">{{trans('dashboard.total_suppliers')}} : {{$suppliers}}</div>
    	</div>
    </div>
  
    <div class="row">
      <div class="col-md-3">
        <div class="well">{{trans('dashboard.total_items')}} : {{$items}}</div>
      </div>
      <div class="col-md-3">
        <div class="well">{{trans('dashboard.total_item_kits')}} : {{$item_kits}}</div>
      </div>
      <div class="col-md-3">
        <div class="well">{{trans('dashboard.total_receivings')}} : {{$receivings}}</div>
      </div>
      <div class="col-md-3">
        <div class="well">{{trans('dashboard.total_sales')}} : {{$sales}}</div>
      </div>
    </div>

</div>
</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
