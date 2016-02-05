@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-14 ">
			<div class="panel panel-default">
				<div class="panel-heading">{{trans('item.list_items')}}</div>
               
				<div class="panel-body">
                    @if (Session::has('error'))
                    <div class="alert alert-danger">{{ Session::get('error') }}</div>
                    @endif

                    @if (Alert::has('error'))
                    <div class="alert alert-danger">
                    {{ Alert::first('error') }}
                    </div>
                    @endif
                    {!! Html::ul($errors->all()) !!}
                @if (Common::check_data('items') > 0)
                <form method="GET" action="/items/search">
                 <table width="100%">
                    <tr>  
                        <td width="40%">
                            {!! Form::text('code', Input::old('code'), array('class' => 'form-control', 'placeholder'=>'Scan barcode or type item code ','required' => '', 'id'=>'readBarcode', 'data'=>'typeahead', 'autocomplete' => 'off')) !!}
                        </td>
                        <td>&nbsp</td>
                        <td>
                            {!! Form::submit('Search', array('class' => 'btn btn-primary')) !!}
                        </td>
                    </tr>
                </table>
                 </form>
				<hr />
                @endif
                <a class="btn btn-small btn-success" href="{{ URL::to('items/create') }}">{{trans('item.new_item')}}</a>
				<hr />
                    @if (Session::has('message'))
                    	<div class="alert alert-info">{{ Session::get('message') }}</div>
                    @endif

                    <table class="table table-striped table-bordered " style='font-size: 13px'>
                        <thead>
                            <tr>
                                <!-- <td>{{trans('item.item_id')}}</td> -->
                                <th>{{trans('item.upc_ean_isbn')}}</th>
                                <th>{{trans('item.item_name')}}</th>
                                <th>{{trans('item.group')}}</th>
                                <th>{{trans('item.size')}}</th>
                                <th>{{trans('item.cost_price')}}</th>
                                <th>{{trans('item.selling_price')}}</th>
                                <th>{{trans('item.quantity')}}</th>
                                <th>&nbsp;</th>
                                <th>Barcode</th>
                                <th>{{trans('item.avatar')}}</th>
                               
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($item as $value)
                            <tr>
                                <!-- <td>{{ $value->id }}</td> -->
                                <td>{{ $value->upc_ean_isbn }}</td>
                                <td>{{ $value->item_name }}</td>
                                <td>{{ $value->kategori->code }}</td>
                                <td>{{ $value->size }}</td>
                                <td>{{ number_format($value->cost_price,0,',','.') }}</td>
                                <td>{{ number_format($value->selling_price,0,',','.') }}</td>
                                <td>{{ $value->quantity }}</td>
                                <td>

                                    <a class="btn btn-warning btn-xs" href="{{ URL::to('inventory/' . $value->id . '/edit') }}" title="{{trans('item.inventory')}}"><span class="glyphicon glyphicon-th" aria-hidden="true"></span></a>
                                    <a class="btn btn-info btn-xs" href="{{ URL::to('items/' . $value->id . '/edit') }}" title="{{trans('item.edit')}}"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
                                    {!! Form::open(array('url' => 'items/' . $value->id, 'class' => 'pull-right')) !!}
                                       {!! Form::hidden('_method', 'DELETE') !!}
                                       <button type="submit"class="btn btn-danger btn-xs" title="{{trans('item.delete')}}"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                                        <!-- {!! Form::submit(trans('item.delete'), array('class' => 'btn btn-warning')) !!} -->
                                    {!! Form::close() !!}
                                </td>
                                <!-- <td> <div id="{{ $value->upc_ean_isbn }}"></div><input type="button" onclick='$("#{{$value->upc_ean_isbn}}").barcode("00000000000{{$value->id}}", "ean13",{barWidth:2, barHeight:30});' value="Print Barcode"></td> -->
                                {{-- <td><a class="btn btn-default btn-xs" title="{{trans('item.barcode')}}" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-barcode" aria-hidden="true"></span> {{trans('item.barcode')}}</a></td> --}}
                                <td><a class="btn btn-default btn-xs" title="{{trans('item.barcode')}}" href="{{ URL::to('items/barcode/print/' . $value->id ) }}"><span class="glyphicon glyphicon-barcode" aria-hidden="true"></span> {{trans('item.barcode')}}</a></td>
                                <td>{!! Html::image(url() . '/images/items/' . $value->avatar, 'a picture', array('class' => 'thumb','width'=>'20')) !!}</td>
                            </tr>

                        @endforeach
                        </tbody>
                    </table>
				</div>
			</div>
   
        {{-- {!! $item->render() !!} --}}
        </div>
	</div>
</div>
@endsection


