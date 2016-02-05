@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12 ">
			<div class="panel panel-default">
				<div class="panel-heading">{{trans('report-sale.reports')}} - {{trans('report-sale.sales_report')}}</div>

				<div class="panel-body">
                    @if (Session::has('error'))
                    <div class="alert alert-danger">{{ Session::get('error') }}</div>
                    @endif

                    @if (Alert::has('error'))
                    <div class="alert alert-danger">
                    {{ Alert::first('error') }}
                    </div>
                    @endif
                    <div class="row">
                        <div class="col-md-6" align="center">
                            <div class="well well-sm"><h3>{{trans('report-sale.grand_total')}}: {{ 'Rp '.number_format(DB::table('sale_items')->sum('total_selling'),2,',','.')}}</h3></div>
                        </div>
                        <div class="col-md-6" align="center">
                            <div class="well well-sm"><h3>{{trans('report-sale.grand_profit')}}: {{ 'Rp '. number_format(DB::table('sale_items')->sum('total_selling') - DB::table('sale_items')->sum('total_cost'),2,',','.')}}</h3></div>
                        </div>
                    </div>
                    @if (Common::check_data('sale') > 0)
                <form method="GET" action="/sales/search">
                <div class="row">
                    <div class="col-md-12 well">
                            <div class="form-group col-md-3">
                            {!! Form::label('date', 'Dari Tanggal') !!}
                            {!! Form::text('date', '', array('id' => 'date','class' => 'form-control') )!!}
                            </div>
                             <div class="form-group col-md-3">
                            {!! Form::label('date2', 'Ke Tanggal') !!}
                            {!! Form::text('date2', '', array('id' => 'date2','class' => 'form-control') )!!}
                            </div>
                       
                            <div class="form-group col-md-4 ">
                            {!! Form::label('date', 'ID atau Nama Customer') !!}
                            {!! Form::text('code', Input::old('code'), array('class' => 'form-control', 'placeholder'=>'Type sale code or customer name', 'id'=>'readSales', 'data'=>'typeahead', 'autocomplete' => 'off')) !!}

                            </div>
                            {!! Form::submit('Search', array('class' => 'btn btn-primary','style'=>'margin-top: 25px')) !!}
                        </div>
                   </div>     
                 </form>

                @endif
<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>{{trans('report-sale.date')}}</th>
            <th>{{trans('report-sale.sale_id')}}</th>
            <th>{{trans('report-sale.sold_by')}}</th>
            <th>{{trans('report-sale.sold_to')}}</th>
            <th>{{trans('report-sale.items_purchased')}}</th>
            <th >{{trans('report-sale.total')}}</th>
            <th>{{trans('report-sale.profit')}}</th>
            <th>{{trans('report-sale.payment_type')}}</th>
            <th>{{trans('report-sale.comments')}}</th>
            <td>&nbsp;</td>
        </tr>
    </thead>
    <tbody>
    @foreach($saleReport as $value)
    <?php $datetime = explode(" ",$value->created_at); ?>
        <tr>
            <td>{{ $datetime[0] }}</td>
            <td>{{ 'SL0000'.$value->id }}</td>
            <td>{{ $value->user->name }}</td>
            <td>{{ $value->customer_name }}</td>
            <td>{{DB::table('sale_items')->where('sale_id', $value->id)->sum('quantity')}}</td>
            <td align="right"><b>{{number_format(DB::table('sale_items')->where('sale_id', $value->id)->sum('total_selling'),0,',','.')}}</b></td>
            <td align="right"><b>{{ number_format(DB::table('sale_items')->where('sale_id', $value->id)->sum('total_selling') - DB::table('sale_items')->where('sale_id', $value->id)->sum('total_cost'),0,',','.') }}</b></td>
            <td>{{ $value->payment_type }}</td>
            <td>{{ $value->comments }}</td>
            <td>
                <a class="btn btn-small btn-info" data-toggle="collapse" href="#detailedSales{{ $value->id }}" aria-expanded="false" aria-controls="detailedReceivings">
                    {{trans('report-sale.detail')}}</a>
            </td>
        </tr>
        
            <tr class="collapse" id="detailedSales{{ $value->id }}">
                <td colspan="10">
                    <table class="table">
                        <tr>
                            <th>{{trans('report-sale.item_id')}}</th>
                            <th>{{trans('report-sale.item_name')}}</th>
                            <th>{{trans('report-sale.quantity_purchase')}}</th>
                            <th>{{trans('report-sale.total')}}</th>
                            <th>{{trans('report-sale.profit')}}</th>
                        </tr>
                        @foreach(ReportSalesDetailed::sale_detailed($value->id) as $SaleDetailed)
                        <tr>
                            <td>{{ $SaleDetailed->item->barcode }}</td>
                            <td>{{ $SaleDetailed->item->item_name }}</td>
                            <td>{{ $SaleDetailed->quantity }}</td>
                            <td align="right">{{ $SaleDetailed->selling_price * $SaleDetailed->quantity}}</td>
                            <td align="right">{{ ($SaleDetailed->quantity * $SaleDetailed->selling_price) - ($SaleDetailed->quantity * $SaleDetailed->cost_price)}}</td>
                        </tr>
                        @endforeach
                    </table>
                </td>
            </tr>

    @endforeach
    </tbody>
</table>
{!! $saleReport->render() !!}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection