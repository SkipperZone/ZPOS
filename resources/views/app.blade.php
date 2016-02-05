<!DOCTYPE html>
<html ng-app="tutapos">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>TB POS</title>

	<link href="{{ asset('/css/app.css') }}" rel="stylesheet">
	<link href="{{ asset('/css/jquery-ui.css') }}" rel="stylesheet">
	<link href="{{ asset('/css/autocomplete.css') }}" rel="stylesheet">
	<link href="{{ asset('/css/grid.css') }}" rel="stylesheet">
	<link href="{{ asset('/css/footer.css') }}" rel="stylesheet">
	<link href="{{ asset('/css/angular-flash.min.css') }}" rel="stylesheet">
	<!-- Fonts -->
	<!-- <link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'> -->
	<link rel="shortcut icon" href="http://tutahosting.net/wp-content/uploads/2015/01/tutaico.png" type="image/x-icon" />

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body >
	<nav class="navbar navbar-default">
		<div class="container-fluid">

			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle Navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="http://www.skipperzone.org">TB POS</a>
			</div>

			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
					<!-- <li><a href="{{ url('/') }}">{{trans('menu.dashboard')}}</a></li> -->
					@if (Auth::check())
					<!-- Persediaan -->
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{trans('menu.stock_menu')}} <span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="{{ url('/warehouse') }}">{{trans('menu.root')}} {{trans('menu.warehouse')}}</a></li>
								<li><a href="{{ url('/item_group') }}">{{trans('menu.root')}} {{trans('menu.item_groups')}}</a></li>
								<li><a href="{{ url('/items') }}">{{trans('menu.root')}} {{trans('menu.items')}}</a></li>
								<!-- <li><a href="{{ url('/item_pricelist') }}">{{trans('menu.root')}} {{trans('menu.item_pricelist')}}</a></li> -->
								{{-- <li class="divider"></li>
								@if (Common::check_data('location') > 1)
								<li><a href="{{ url('/warehouse_move_items') }}">{{trans('menu.move_warehouse')}}</a></li>
								@endif
								<li><a href="{{ url('/stock_corrections') }}">{{trans('menu.stock_corrections')}}</a></li> --}}
								<li class="divider"></li>
								<li><a href="{{ url('/reports/stock_items') }}">{{trans('menu.rep')}} {{trans('menu.stock_items')}}</a></li>
								{{-- <li><a href="{{ url('/reports/warehouse_move_items') }}">{{trans('menu.rep')}} {{trans('menu.move_warehouse')}}</a></li>
								<li><a href="{{ url('/reports/stock_corrections') }}">{{trans('menu.rep')}} {{trans('menu.stock_corrections')}}</a></li>
								<li><a href="{{ url('/reports/stock_cards') }}">{{trans('menu.rep')}} {{trans('menu.stock_cards')}}</a></li> --}}
							</ul>
						</li>
					<!-- Pembelian -->
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{trans('menu.purchase')}} <span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="{{ url('/receivings') }}">{{trans('menu.trans')}} {{trans('menu.purchase')}}</a></li>
								<li class="divider"></li>
								<li><a href="{{ url('/suppliers') }}">{{trans('menu.root')}} {{trans('menu.suppliers')}}</a></li>
				{{-- 				<li><a href="{{ url('/return/purchase') }}">{{trans('menu.return')}} {{trans('menu.purchase')}}</a></li>
								<li><a href="{{ url('/payment/hutang') }}">{{trans('menu.payment_hutang')}}</a></ li>--}}
								<li class="divider"></li>
								<li><a href="{{ url('/reports/receivings') }}">{{trans('menu.rep')}} {{trans('menu.purchase')}}</a></li>
								{{-- <li><a href="{{ url('/reports/return_purchase') }}">{{trans('menu.rep')}} {{trans('menu.return')}} {{trans('menu.purchase')}}</a></li>
								<li><a href="{{ url('/reports/hutang') }}">{{trans('menu.rep')}} {{trans('menu.hutang')}}</a></li>
								<li><a href="{{ url('/reports/payment_hutang') }}">{{trans('menu.rep')}} {{trans('menu.payment_hutang')}}</a></li> --}}
							</ul>
						</li>
					<!-- PENJUALAN -->
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{trans('menu.sales')}} <span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="{{ url('/sales') }}">{{trans('menu.trans')}} {{trans('menu.sales')}}</a></li>
								{{-- <li><a href="{{ url('/sale_person') }}">{{trans('menu.root')}} {{trans('menu.sale_person')}}</a></li> --}}
								<li class="divider"></li>
								<li><a href="{{ url('/customers') }}">{{trans('menu.root')}} {{trans('menu.customers')}}</a></li>
								{{-- <li><a href="{{ url('/sales') }}">{{trans('menu.sales')}} {{trans('menu.grocery')}}</a></li>
								<li><a href="{{ url('/return/sales') }}">{{trans('menu.return')}} {{trans('menu.sales')}}</a></li>
								<li><a href="{{ url('/receivings/piutang') }}">{{trans('menu.receivings_piutang')}}</a></li> --}}
								<li class="divider"></li>
								<li><a href="{{ url('/reports/sales') }}">{{trans('menu.rep')}} {{trans('menu.sales')}}</a></li>
								{{-- <li><a href="{{ url('/reports/return_sales') }}">{{trans('menu.rep')}} {{trans('menu.return')}} {{trans('menu.sales')}}</a></li>
								<li><a href="{{ url('/reports/piutang') }}">{{trans('menu.rep')}} {{trans('menu.piutang')}}</a></li>
								<li><a href="{{ url('/reports/receivings_piutang') }}">{{trans('menu.rep')}} {{trans('menu.receivings_piutang')}}</a></li> --}}
							</ul>
						</li>
						<!-- <li><a href="{{ url('/customers') }}">{{trans('menu.customers')}}</a></li>
						<li><a href="{{ url('/items') }}">{{trans('menu.items')}}</a></li>
						<li><a href="{{ url('/item-kits') }}">{{trans('menu.item_kits')}}</a></li>
						<li><a href="{{ url('/suppliers') }}">{{trans('menu.suppliers')}}</a></li>
						<li><a href="{{ url('/receivings') }}">{{trans('menu.receivings')}}</a></li>
						<li><a href="{{ url('/sales') }}">{{trans('menu.sales')}}</a></li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{trans('menu.reports')}} <span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="{{ url('/reports/receivings') }}">{{trans('menu.receivings_report')}}</a></li>
								<li><a href="{{ url('/reports/sales') }}">{{trans('menu.sales_report')}}</a></li>
							</ul>
						</li>
						<li><a href="{{ url('/employees') }}">{{trans('menu.employees')}}</a></li> -->
					@endif
				</ul>

				<ul class="nav navbar-nav navbar-right">
					@if (Auth::guest())
						<li><a href="{{ url('/auth/login') }}">Login</a></li>
					@else
					<li><a href="#"><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span> {{ Common::get_today() }}</a></li>
					<li><a href="#"><span class="glyphicon glyphicon-time" aria-hidden="true"></span> <i id='jam'></i></a></li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="{{ url('/tutapos-settings') }}">{{trans('menu.application_settings')}}</a></li>
								<li class="divider"></li>
								<li><a href="{{ url('/auth/logout') }}">{{trans('menu.logout')}}</a></li>
							</ul>
						</li>
					@endif
				</ul>
			</div>
		</div>
	
	</nav>
	@yield('content')

	<footer class="footer hidden-print">
      <div class="container">
        
        <p class="text-muted">You are using <a href="http://www.skipperzone.org">Zero POS</a> v1.0 by <a href="https://twitter.com/wisnuagungpro">Zero Skipper</a>.
        </p>
    </footer>
	<!-- Scripts -->
	{!! Html::script('js/jquery.min.js', array('type' => 'text/javascript')) !!}
	{!! Html::script('js/jquery-ui.js', array('type' => 'text/javascript')) !!}
	{!! Html::script('js/bootstrap.min.js', array('type' => 'text/javascript')) !!}
	{!! Html::script('js/angular-flash.min.js', array('type' => 'text/javascript')) !!}
	{!! Html::script('js/jquery-barcode-last.min.js', array('type' => 'text/javascript')) !!}
	{!! Html::script('js/barcode.js', array('type' => 'text/javascript')) !!}
	{!! Html::script('js/utility.js', array('type' => 'text/javascript')) !!}
	{!! Html::script('js/typehead.min.js', array('type' => 'text/javascript')) !!}

</body>
</html>
