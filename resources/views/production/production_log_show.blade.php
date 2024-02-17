<style type="text/css">
    .style1 {
        font-weight: bold
    }
</style>
@extends('template.tmp')
@section('title', $pagetitle)
@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-print-block d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">Production Log</h4>
                            <a href="{{ url('Production/Logs') }}" class="btn btn-primary">Back</a>
                        </div>
                    </div>
                </div>
                @if (session('error'))
                    <div class="alert alert-{{ Session::get('class') }} p-1" id="success-alert">
                        {{ Session::get('error') }}
                    </div>
                @endif
                @if (count($errors) > 0)
                    <div>
                        <div class="alert alert-danger p-1   border-3">
                            <p class="font-weight-bold"> There were some problems with your input.</p>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif
                <div class="card ">
                    <div class="card-body border-3 border-top border-danger">
                        <div class="pcs-template-body">
                            <table style="width:100%;table-layout: fixed;">
                                <tbody>
                                    <tr>
                                        <td style="vertical-align: top; width:50%;">
                                            <div><span
                                                    class="style1 pcs-entity-title"><strong>{{ $company->Name }}</strong></span>
                                            </div>
                                            {{ $company->Address }}
                                        </td>

                                        <td style="vertical-align: top; text-align:right;width:50%;">

                                            <span class="pcs-entity-title style1">Production Log
                                            </span><span class="style1"><br>
                                                <b>Batch # : {{ $production->InvoiceNo }}</b>
                                                <br>
                                                <b>Date: {{ $production->Date }}</b></span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <hr>
                            <div class="row">
                                <div class="col text-center">
                                    <h5>Product Details</h5>
                                </div>
                            </div>

                            <table style="width:100%;margin-top:20px;table-layout:fixed;" class="pcs-itemtable"
                                border="0" cellspacing="0" cellpadding="0">
                                <thead>
                                    <tr style="height:32px;">
                                        <td width="33%" bgcolor="#CCCCCC"
                                            class="pcs-itemtable-breakword pcs-itemtable-header" id=""
                                            style="padding: 5px 10px 5px 20px;width: ;text-align: left;"><span
                                                class="pcs-itemtable-breakword pcs-itemtable-header"
                                                style="padding: 5px 10px 5px 20px;width: ;text-align: left;"><strong>Product
                                                    Name </strong></span></td>
                                        <td width="10%" bgcolor="#CCCCCC"
                                            class="pcs-itemtable-breakword pcs-itemtable-header" id=""
                                            style="padding: 5px 10px 5px 5px;width: 11%;text-align: right;"><strong>
                                                Qty </strong></td>
                                        <td width="14%" bgcolor="#CCCCCC"
                                            class="pcs-itemtable-breakword pcs-itemtable-header" id=""
                                            style="padding: 5px 10px 5px 5px;width: 11%;text-align: right;"><strong>
                                                Rate </strong></td>

                                        <td width="13%" bgcolor="#CCCCCC"
                                            class="pcs-itemtable-breakword pcs-itemtable-header" id=""
                                            style="padding: 5px 10px 5px 5px;width: 10%;text-align: right;"><strong>
                                                Value </strong></td>
                                    </tr>
                                </thead>
                                <tbody class="itemBody">

                                    {{-- @foreach ($productDetails as $key => $productDetail) --}}
                                        @php
                                            $item = DB::table('item')
                                                ->where('ItemID', $productDetails->ItemID)
                                                ->first();
                                        @endphp
                                        <tr class="breakrow-inside breakrow-after">
                                            <td valign="top" style="padding: 10px 0px 10px 20px;" class="pcs-item-row">
                                                <span class="pcs-item-row" style="padding: 10px 0px 10px 20px;">
                                                    {{ $item->ItemName }} </span>
                                            </td>

                                            <td valign="top"
                                                style="padding: 10px 10px 5px 10px;text-align:right;word-wrap: break-word;"
                                                class="pcs-item-row">
                                                <span id="tmp_item_qty">{{ $productDetails->Qty }}</span>
                                            </td>

                                            <td valign="top"
                                                style="padding: 10px 10px 5px 10px;text-align:right;word-wrap: break-word;"
                                                class="pcs-item-row">
                                                <span id="tmp_item_rate">{{ $productDetails->Rate }}</span>
                                            </td>


                                            <td valign="top"
                                                style="text-align:right;padding: 10px 10px 10px 5px;word-wrap: break-word;"
                                                class="pcs-item-row">
                                                <span id="tmp_item_amount">{{ $productDetails->Total }}</span>
                                            </td>
                                        </tr>
                                    {{-- @endforeach --}}
                                </tbody>
                            </table>
                            <hr>
                            <div class="row">
                                <div class="col text-center">
                                    <h5>Material Details</h5>
                                </div>
                            </div>
                            <table style="width:100%;margin-top:20px;table-layout:fixed;" class="pcs-itemtable"
                                border="0" cellspacing="0" cellpadding="0">
                                <thead>
                                    <tr style="height:32px;">
                                        <td width="0%" bgcolor="#CCCCCC"
                                            class="pcs-itemtable-breakword pcs-itemtable-header" id=""
                                            style="padding: 5px 10px 5px 5px;width: 10%;text-align: left;"><strong>
                                                #</strong></td>
                                        <td width="10%" bgcolor="#CCCCCC"
                                            class="pcs-itemtable-breakword pcs-itemtable-header" id=""
                                            style="padding: 5px 10px 5px 20px;width: ;text-align: left;"><span
                                                class="pcs-itemtable-breakword pcs-itemtable-header"
                                                style="padding: 5px 10px 5px 20px;width: ;text-align: left;"><strong>Material
                                                    Name </strong></span></td>
                                        <td width="10%" bgcolor="#CCCCCC"
                                            class="pcs-itemtable-breakword pcs-itemtable-header" id=""
                                            style="padding: 5px 10px 5px 5px;width: 11%;text-align: right;"><strong>
                                                Qty Per Unit </strong></td>
                                        <td width="10%" bgcolor="#CCCCCC"
                                            class="pcs-itemtable-breakword pcs-itemtable-header" id=""
                                            style="padding: 5px 10px 5px 5px;width: 11%;text-align: right;"><strong>
                                                Qty Consumed </strong></td>
                                        <td width="80%" bgcolor="#CCCCCC"
                                            class="pcs-itemtable-breakword pcs-itemtable-header" id=""
                                            style="padding: 5px 10px 5px 5px;width: 10%;text-align: right;"><strong>
                                                Value of Material Consumed </strong></td>
                                    </tr>
                                </thead>
                                <tbody class="itemBody">

                                    @foreach ($materialDetails as $key => $materialDetail)
                                        @php
                                            $item = DB::table('item')
                                                ->where('ItemID', $materialDetail->ItemID)
                                                ->first();
                                        @endphp
                                        <tr class="breakrow-inside breakrow-after">
                                            <td valign="top"
                                                style="padding: 10px 10px 5px 10px;text-align:left;word-wrap: break-word;"
                                                class="pcs-item-row">
                                                <span id="tmp_item_rate">{{ ++$key }}</span>
                                            </td>
                                            <td valign="top" style="padding: 10px 0px 10px 20px;" class="pcs-item-row">
                                                <span class="pcs-item-row" style="padding: 10px 0px 10px 20px;">
                                                    {{ $item->ItemName }} </span>
                                            </td>
                                            <td valign="top"
                                                style="padding: 10px 10px 5px 10px;text-align:right;word-wrap: break-word;"
                                                class="pcs-item-row">
                                                <span id="tmp_item_qty">{{ $materialDetail->Qty / $productDetails->Qty }}</span>
                                                {{-- <span id="tmp_item_qty">{{ $materialDetail->Qty }}</span> --}}

                                            </td>
                                            <td valign="top"
                                                style="padding: 10px 10px 5px 10px;text-align:right;word-wrap: break-word;"
                                                class="pcs-item-row">
                                                <span id="tmp_item_qty">{{ $materialDetail->Qty }}</span>
                                            </td>

                                            <td valign="top" style="padding: 10px 10px 5px 10px;text-align:right;"
                                                class="pcs-item-row">
                                                <span id="tmp_item_rate">{{ $materialDetail->Total }}</span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <hr>
                            <div style="width: 100%;margin-top: 1px;">
                                <div style="width: 45%;padding: 3px 10px 3px 3px;font-size: 9pt;float: left;">
                                    <div style="white-space: pre-wrap;">
                                        <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td width="50%"><strong>Description :</strong>
                                                    <br>
                                                    {{ $production->Subject }}
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <div style="width: 50%;float:right;">
                                    <table class="pcs-totals" cellspacing="0" border="0" width="100%">
                                        <tbody>
                                            {{-- <tr class="pcs-balance">
                                                <td height="25" align="right" valign="middle"><b>Total Quantity:</b>
                                                </td>
                                                <td height="25" align="right" valign="middle" id="tmp_total"
                                                    style="width:120px;;padding: 10px 10px 10px 5px;">
                                                    <div align="right"><b>{{ $production->TotalQty }}</b></div>
                                                </td>
                                            </tr> --}}

                                            <tr class="pcs-balance">
                                                <td height="25" align="right" valign="middle"><b>Total Value:</b>
                                                </td>
                                                <td height="25" align="right" valign="middle" id="tmp_total"
                                                    style="width:120px;;padding: 10px 10px 10px 5px;">
                                                    <div align="right"><b>{{ $production->GrandTotal }}</b></div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div style="clear: both;"></div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
    </div>
    <!-- END: Content-->

@endsection
