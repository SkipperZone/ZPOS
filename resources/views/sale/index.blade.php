@extends('app')
@section('content')
{!! Html::script('js/angular.min.js', array('type' => 'text/javascript')) !!}
{!! Html::script('js/sale.js', array('type' => 'text/javascript')) !!}

<div class="container-fluid">
   <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"><span class="glyphicon glyphicon-inbox" aria-hidden="true"></span> {{trans('sale.sales_register')}}</div>

            <div class="panel-body">

                @if (Session::has('message'))
                    <div class="alert alert-success">{{ Session::get('message') }}</div>
                @endif
                {!! Html::ul($errors->all()) !!}
                
                <div class="row" ng-controller="SearchItemCtrl">


                    <div class="col-md-12">

                       
                       <div class="row" style="border-bottom: 2px solid #dddddd">
                            
                            {!! Form::open(array('url' => 'sales', 'class' => 'form-horizontal')) !!}
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="invoice" class="col-sm-3 control-label">{{trans('sale.invoice')}}</label>
                                        <div class="col-sm-9">
                                        <input type="text" class="form-control" id="invoice" value="@if ($sale) SL0000{{$sale->id + 1}} @else 1 @endif" readonly tabindex="-1" />
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="employee" class="col-sm-3 control-label">{{trans('sale.employee')}}</label>
                                        <div class="col-sm-9">
                                        <input type="text" class="form-control" id="employee" value="{{ Auth::user()->name }}" readonly tabindex="-1"/>
                                        </div>
                                    </div>

                                        <div class="form-group">
                                        <label for="customer_id" class="col-sm-3 control-label">{{trans('sale.customer')}}</label>
                                        <div class="col-sm-9">
                                            {!! Form::text('customer_name', Input::old('customer_name'), array('class' => 'form-control', 'required'=>'', 'tabindex'=>'1')) !!}
                                        {{-- {!! Form::select('customer_id', $customer, Input::old('customer_id'), array('class' => 'form-control')) !!}  --}}
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="payment_type" class="col-sm-5 control-label">{{trans('sale.payment_type')}}</label>
                                        <div class="col-sm-7">
                                        {!! Form::select('payment_type', array('Cash' => 'Cash', 'Check' => 'Check', 'Debit Card' => 'Debit Card', 'Credit Card' => 'Credit Card'), Input::old('payment_type'), array('class' => 'form-control','tabindex'=>'-1')) !!}
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="supplier_id" class="col-sm-3 control-label">{{trans('sale.grand_total')}}</label>
                                        <div class="col-sm-9">
                                             <div class="input-group">
                                                <div class="input-group-addon">Rp</div>
                                                <input style="height: 100px" type="text" class="form-control input-lg" id="grand_total" value="@{{sum(saletemp) | currency}}" readonly/ name="grand_total" tabindex="-1">
                                            </div>
                                         
                                        </div>
                                    </div>

                                   <div class="form-group">
                                        <label for="total" class="col-sm-3 control-label">{{trans('sale.add_payment')}}</label>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                <div class="input-group-addon">Rp</div>
                                               {{--  <input type="text" class="form-control input-md" id="add_payment" ng-model="add_payment"/> --}}
                                               {!! Form::text('add_payment', Input::old('add_payment'), array('class' => 'form-control', 'required'=>'', 'ng-model'=>"add_payment",'tabindex'=>'3')) !!}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                            <label for="amount_due" class="col-sm-3 control-label">{{trans('sale.amount_due')}}/Kembali</label>
                                            <div class="col-sm-9">
                                                <div class="input-group">
                                                <div class="input-group-addon">Rp</div>
                                            {{-- <p class="form-control-static">@{{add_payment - sum(saletemp) | currency}}</p> --}}
                                             <input type="text" name="amount_due" class="form-control input-md" id="amount_due" value="@{{add_payment - sum(saletemp) | currency}}" readonly tabindex="-1"/>
                                                </div>
                                            </div>
                                    </div>
    

                                    
                                </div>
                            
                        </div>
                    </div>
                   
                    <div class="col-md-6" style="margin-top: 20px"> 
                     <label>{{trans('sale.search_item')}} <input tabindex="2" size='50' ng-model="searchKeyword" name="mysearch" class="form-control"  ng-enter="getValue($event)" placeholder = "Scan barcode or type item code here !"></label>

                        <table class="table table-hover">
                        <tr ng-repeat="item in items  | filter: searchKeyword | limitTo:3">

                        <td>@{{item.item_name}}</td>
                        <td><button class="btn btn-success btn-xs" type="button" ng-click="addSaleTemp(item, newsaletemp)"><span class="glyphicon glyphicon-share-alt" aria-hidden="true"></span></button></td>

                        </tr>
                        </table>                       
                    </div> 
                     
                    <div class="col-md-12" style="margin-top: 20px">
                    <div class="row">  
                        <div class="col-sm-12">      
                        <table class="table table-bordered">
                            <tr><th>{{trans('sale.item_id')}}</th><th>{{trans('sale.item_name')}}</th><th>{{trans('sale.price')}}</th><th>{{trans('sale.quantity')}}</th><th>{{trans('sale.total')}}</th><th>&nbsp;</th></tr>
                            <tr ng-repeat="newsaletemp in saletemp">
                            <td>@{{newsaletemp.item_id}}</td><td>@{{newsaletemp.item.item_name}}</td><td>@{{newsaletemp.item.selling_price | currency}}</td><td><input type="text" style="text-align:center" autocomplete="off" name="quantity" ng-change="updateSaleTemp(newsaletemp)" ng-model="newsaletemp.quantity" size="2"></td><td>@{{newsaletemp.item.selling_price * newsaletemp.quantity | currency}}</td><td><button class="btn btn-danger btn-xs" type="button" ng-click="removeSaleTemp(newsaletemp.id)"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button></td>
                            </tr>
                            <?php if(Common::check_data('saletemp') == 0 ) { ?>
                            <tr>
                                <td colspan="6" align="center">Silahkan Tambahkan Item</td>
                            </tr>
                            <?php } ?>
                        </table>
                        </div>
                    </div>

                        <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="employee" class="col-sm-3 control-label">{{trans('sale.comments')}}</label>
                                        <div class="col-sm-9">
                                        <input tabindex="4" type="text" class="form-control" name="comments" id="comments" />
                                        </div>
                                    </div>
                                 
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <button tabindex="5" type="submit" class="btn btn-success btn-block">{{trans('sale.submit')}}</button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            {!! Form::close() !!}
                            
                        

                    </div>

                </div>

            </div>
            </div>
        </div>
    </div>
</div>
@endsection