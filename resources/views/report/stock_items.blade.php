@extends('app')
<?php $data = Session::all(); //print_r($data)?>
@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">{{trans('report-stock.reports')}} - {{trans('report-stock.stocks_report')}}</div>

				<div class="panel-body">
                <form method="GET" action="/reports/stock_items/search" id="mainform" target="_blank">
                 <table class="table table-bordered">
                    <tr>
                        <th colspan="4">Filter Gudang</th>
                    </tr>
                    <tr>
                        <td colspan="4">{!!Form::radio('option_group', 'all', true, array('id'=>'all', 'onclick'=>"ClearFields1();"));!!} {{ trans('report-stock.find_all')}}</td>
                    </tr>
                     <tr>
                        <td width="30%">{!!Form::radio('option_group', 'location', false, array('id'=>'location'));!!} {{ trans('report-stock.find_location')}}
                        </td>
                         <td >
                            {!! Form::text('location', Input::old('location'), array('class' => 'form-control input-sm', 'placeholder'=> 'Type location or code here !', 'id'=>'readLocation', 'data'=>'typeahead', 'autocomplete' => 'off', 'disabled'=>"disabled", 'required')) !!}
                        </td>
                        <td width="20%"></td>
                       
                    </tr>
                </table>
                <table class="table table-bordered">
                    <tr>
                        <th colspan="4">Filter Barang</th>
                    </tr>
                     <tr>
                        <td colspan="4">{!!Form::radio('option_items', 'all', true, array('id'=>'allitem','onclick'=>"ClearFields2();"));!!} {{ trans('report-stock.find_all')}}</td>
                    </tr>
                    <tr>
                        <td width="30%">{!!Form::radio('option_items', 'item_group', false, array('id'=>'group'));!!} {{ trans('report-stock.find_group')}}
                        </td>
                        <td >
                            {!! Form::text('group', Input::old('group'), array('class' => 'form-control input-sm', 'placeholder'=> 'Type group or code here !', 'id'=>'readGroup', 'data'=>'typeahead', 'autocomplete' => 'off', 'disabled'=>"disabled", 'required')) !!}
                        </td>
                        <td></td>
                      
                    </tr>   <tr>
                        <td>{!!Form::radio('option_items', 'items', false, array('id'=>'code'));!!} {{ trans('report-stock.find_items')}}
                        </td>
                        <td >
                            {!! Form::text('code', Input::old('code'), array('class' => 'form-control input-sm', 'placeholder'=> 'Scan item or type code here !', 'id'=>'readBarcode', 'data'=>'typeahead', 'autocomplete' => 'off', 'disabled'=>"disabled", 'required')) !!}
                        </td>
                        <td></td>
                      
                    </tr>    
                </table>
                {!! Form::submit('Search', array('class' => 'btn btn-primary', 'target'=>'blank')) !!}
               @if(count(Session::get('items')) > 0)
                <a type="button" class="btn btn-default" href="/reports/stock_items/print" target=_new>Cetak</a> @endif
                 </form>
                    
				 </div>
			</div>
		</div>
	</div>
</div>
@endsection