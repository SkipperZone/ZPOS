@extends('app')
@section('content')
{!! Html::script('js/angular.min.js', array('type' => 'text/javascript')) !!}
{!! Html::script('js/app.js', array('type' => 'text/javascript')) !!}
<style>
table td {
    border-top: none !important;
}
table th {
    border-top: none !important;
}
tr.border_bottom{
  border-bottom: 5px solid black;
}

tr.border_top{
  border-top: 4px solid #dddddd;
}
</style>

<div class="container-fluid" style="background-color: #fff;">
   <div class="row">
        <div class="col-md-8" style="text-align:center; border-width:5px;   
    border-bottom-style:double;">
            <H3>NOTA PENJUALAN</H3>         
            <H5>TOKO BESI DAN BANGUNAN JOS</H5> 
            <p>Jl. Plewan III No. 40 Kel. Siwalan Kec. Gayamsari Semarang</p>        
        </div>
    </div>
    <div class="row" style=" margin-top: 10px">
        <div class="col-md-8">
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="invoice" class="col-sm-4 control-label">No. {{trans('sale.invoice')}}</label>
                        <div class="col-sm-4">
                            <p>: SL0000{{$saleItemsData->sale_id}}</p>
                        </div>
                </div>
            </div>
             <div class="col-sm-6">
                <div class="form-group">
                    <label for="invoice" class="col-sm-4 control-label">Tanggal</label>
                        <div class="col-sm-6">
                            <?php $datetime = explode(" ",$saleItemsData->created_at); ?>
                            <p>: {{ $datetime[0]}}</p>
                        </div>
                </div>
            </div>
                <div class="col-sm-6">
                <div class="form-group">
                    <label for="invoice" class="col-sm-4 control-label">Customer</label>
                        <div class="col-sm-4">
                            <p>: {{ $sales->customer_name}}s</p>
                        </div>
                </div>
            </div>
             <div class="col-sm-6">
                <div class="form-group">
                    <label for="invoice" class="col-sm-4 control-label">{{trans('sale.employee')}}</label>
                        <div class="col-sm-6">
                            <p>: {{$sales->user->name}}</p>
                        </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <div class="table-responsive">
           <table class="table table-bordered">
                <tr>
                    <th style="text-align: center">No.</td>
                    <th>{{trans('sale.item')}}</th>
                    <th style="text-align: center">{{trans('sale.price')}}</th>
                    <th style="text-align: center">{{trans('sale.qty')}}</th>
                    <th style="text-align: center">{{trans('sale.total')}}</th>
                </tr>
                <?php $no = 1; $total = 0; ?>
                <?php foreach($saleItems as $value) { ?>
                <?php $total += ($value->quantity * $value->selling_price) ?>
                <tr>
                    <td style="text-align: center">{{$no}}</td>
                    <td>{{$value->item->item_name}}</td>
                    <td style="text-align: right">{{$value->selling_price}}</td>
                    <td style="text-align: center">{{$value->quantity}}</td>
                    <td style="text-align: right">{{number_format(($value->total_selling),2,',','.')}}</td>
                    <?php $no++;?>
                </tr>
                <?php } ?>
             
                
            </table>
            <table class="table">
                <tr>
                   
                    <th style="text-align: right">Jumlah</th>
                    <td style="text-align: right" width="20%">{!!number_format(($total),2,',','.')!!}</td>
                </tr>
                 <tr>
                   
                    <th style="text-align: right">Bayar</th>
                    <td style="text-align: right">{!!number_format((Session::get('add_payment')),2,',','.')!!}</td>
                </tr>
                 <tr>
                  
                    <th style="text-align: right">Kembali</th>
                    <td style="text-align: right">{!!number_format((Session::get('add_payment') - $total),2,',','.')!!}</td>
                </tr>
            </table>
            <div class="col-md-8" style="position: absolute; margin-top: -120px; margin-left: 20px">
                <h5>Hormat Kami</h5>
                <br>
                <br>
                <p>___________</p>
            </div>
        </div>
        </div>
    </div>
 
    <hr class="hidden-print"/>
    <div class="row">
        <div class="col-md-8">
            &nbsp;
        </div>
        <div class="col-md-2">
            <button type="button" onclick="printInvoice()" class="btn btn-info pull-right hidden-print">{{trans('sale.print')}}</button> 
        </div>
        <div class="col-md-2">
            <a href="{{ url('/sales') }}" type="button" class="btn btn-info pull-right hidden-print">{{trans('sale.new_sale')}}</a>
        </div>
    </div>
</div>
<script>
function printInvoice() {
    window.print();
}
</script>
@endsection