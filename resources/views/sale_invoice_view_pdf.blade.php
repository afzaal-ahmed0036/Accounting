



<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title>Invoice</title>
        <style type="text/css">
            @font-face {
                font-family: 'Open Sans';
                font-style: normal;
                font-weight: normal;
             }
            @font-face {
                font-family: 'Open Sans';
                font-style: normal;
                font-weight: bold;
             }
            @font-face {
                font-family: 'Open Sans';
                font-style: italic;
                font-weight: normal;
             }
            @font-face {
                font-family: 'Open Sans';
                font-style: italic;
                font-weight: bold;
             }
            @page {
                margin-top: 0.5cm;
                margin-bottom: 0.5cm;
                margin-left: 0.5cm;
                margin-right: 0.5cm;
            }
            body {
	background: #fff;
	color: #000;
	margin: 0.02cm;
	font-family: 'Open Sans', sans-serif;
	font-size: 11pt;
	line-height: 100%;
             }
            h1, h2, h3, h4 {
                font-weight: bold;
                margin: 0;
            }
            h1 {
                font-size: 16pt;
                margin: 5mm 0;
            }
            h2 {
                font-size: 14pt;
            }
            h3, h4 {
                font-size: 9pt;
            }
            ol,
            ul {
                list-style: none;
                margin: 0;
                padding: 0;
            }
            li,
            ul {
                margin-bottom: 0.75em;
            }
            p {
                margin: 0;
                padding: 0;
            }
            p + p {
                margin-top: 1.25em;
            }
            a {
                border-bottom: 1px solid;
                text-decoration: none;
            }
            /* Basic Table Styling */
            table {
                border-collapse: collapse;
                border-spacing: 0;
                page-break-inside: always;
                border: 0;
                margin: 0;
                padding: 0;
            }
            th, td {
                vertical-align: top;
                text-align: left;
            }
            table.container {
                width:100%;
                border: 0;
            }
            tr.no-borders,
            td.no-borders {
                border: 0 !important;
                border-top: 0 !important;
                border-bottom: 0 !important;
                padding: 0 !important;
                width: auto;
            }
            /* Header */
            table.head {
                margin-bottom: 2mm;
            }
            td.header img {
                max-height: 3cm;
                width: auto;
            }
            td.header {
                font-size: 16pt;
                font-weight: 700;
            }
            td.shop-info {
                width: 40%;
            }
            .document-type-label {
                text-transform: uppercase;
            }
            table.order-data-addresses {
                width: 100%;
                margin-bottom: 0.5mm;
            }
            td.order-data {
                width: 30%;
            }
            .invoice .shipping-address {
                width: 30%;
            }
            .packing-slip .billing-address {
                width: 30%;
            }
            td.order-data table th {
                font-weight: normal;
                padding-right: 2mm;
            }

            table.order-details {
                width:100%;
                margin-bottom: 8mm;
            }
            .quantity,
            .price {
                width: 8%;
            }
            .product {
                width: 33%;
            }
            .sno {
                width: 3%;
            }
            .order-details tr {
                page-break-inside: always;
                page-break-after: auto;
            }
            .order-details td,
            .order-details th {
                border-bottom: 1px #ccc solid;
                border-top: 1px #ccc solid;
                padding: 0.375em;
            }
            .order-details th {
                font-weight: bold;
                text-align: left;
            }
            .order-details thead th {
                color: black;
                background-color: #b8b8b8;
                border-color: #b8b8b8;

            }

            .order-details tr.bundled-item td.product {
                padding-left: 5mm;
            }
            .order-details tr.product-bundle td,
            .order-details tr.bundled-item td {
                border: 0;
            }
            dl {
                margin: 4px 0;
            }
            dt, dd, dd p {
                display: inline;
                font-size: 7pt;
                line-height: 7pt;
            }
            dd {
                margin-left: 5px;
            }
            dd:after {
                content: "\A";
                white-space: pre;
            }

            .customer-notes {
                margin-top: 5mm;
            }
            table.totals {
                width: 100%;
                margin-top: 5mm;
            }
            table.totals th,
            table.totals td {
                border: 0;
                border-top: 1px solid #ccc;
                border-bottom: 1px solid #ccc;
            }
            table.totals th.description,
            table.totals td.price {
                width: 50%;
            }
            table.totals tr:last-child td,
            table.totals tr:last-child th {
                border-top: 2px solid #000;
                border-bottom: 2px solid #000;
                font-weight: bold;
            }
            table.totals tr.payment_method {
                display: none;
            }

            #footer {
                position: absolute;
                bottom: -2cm;
                left: 0;
                right: 0;
                height: 2cm;
                text-align: center;
                border-top: 0.1mm solid gray;
                margin-bottom: 0;
                padding-top: 2mm;
            }

            .pagenum:before {
                content: counter(page);
            }
            .pagenum,.pagecount {
                font-family: sans-serif;
            }

            #xyz_main {
    width: 1000px;
    border: 0px solid #666666;
    text-align: center;
    position: absolute;
    top: 50%;
    left: 50%;
    margin-left: -500px;
     z-index:1000;
}

  /*          #bg_logo {
    width: 1000px;
    height: 500px;
    border: 0px solid #666666;
    text-align: center;
    position: absolute;
    top: 33%;
    left: 25%;
    opacity: 0.3;
     z-index:-1000;
     background-repeat: no-repeat;

     background-image: url({{URL('/documents/'.$company[0]->BackgroundLogo)}});
    
     
}*/
             body
{
background-position: center;
background-repeat: no-repeat;
opacity: 0.15;
z-index:-1000;
opacity: 0.3;
background-image: url({{URL('/documents/'.$company[0]->BackgroundLogo)}});
  background-size: 300px 300px;

}

        </style>
</head>
<body class="invoice"  >

<div id="bg_logo"> </div>

    @if(($invoice_master[0]->GrandTotal-$invoice_master[0]->Paid)==0)
<div id="xyz_main"><img src="{{asset('assets/images/paid.png')}}" alt="" ></div>
@endif
        <table class="head container">
            <tr>
                <td class="header">
                    <img src="{{URL('/documents/'.$company[0]->Logo)}}" width="246" height="246" />                </td>
                <td class="shop-info">
                    <div class="shop-name">
                        <div align="right"><div style="font-size: 16pt;line-height: 20pt;"><strong> {{$company[0]->Name}}<br>{{$company[0]->Name2}}</strong></div> 
      {{$company[0]->Address}}<br />
      Contact:{{$company[0]->Contact}}<br />
      TRN:{{$company[0]->TRN}}<br />
      Email:{{$company[0]->Email}}<br />
      Website:{{$company[0]->Website}}<br />
    </div>
                    </div>
                   
                    
                    <div class="shop-address"></div>                </td>
            </tr>
            <tr>
              <td colspan="2" class="header"><div align="center">
                <h2><u>{{strtoupper($invoice_master[0]->InvoiceType)}}</u></h2>
                 <h3 style="margin-top: 5px;"><u>CUSTOMER COPY</u></h3>
              </div></td>
            </tr>
</table>
        <table class="order-data-addresses">
            <tr>
                <td valign="bottom" class="address billing-address">
				<strong>Buyer</strong><br>
                    <strong>{{$invoice_master[0]->PartyName}}  {{($invoice_master[0]->WalkinCustomerName==1) ? ' -'.$invoice_master[0]->WalkinCustomerName : ''}}</strong><br />
                     @if($invoice_master[0]->PartyID !=1)
            
                Address: {{$invoice_master[0]->Address}}<br />
          Phone: {{$invoice_master[0]->Phone}}<br />
          TRN: {{$invoice_master[0]->TRN}}<br /> 
            @endif

            <br />          </td>
                <td class="order-data">
                    <table align="right">
                        <tr class="order-number">
                            <th><strong>Invoice # </strong></th>
                            <td><div align="right">{{$invoice_master[0]->InvoiceNo}}</div></td>
                        </tr>
                        <tr class="order-date">
                            <th><strong>Date:</strong></th>
                            <td><div align="right">{{dateformatman($invoice_master[0]->Date)}}</div></td>
                        </tr>
                        <tr class="payment-method">
                            <th><strong>Due Date :</strong></th>
                            <td><div align="right">{{dateformatman($invoice_master[0]->DueDate)}}</div></td>
                        </tr>
                        <tr class="payment-method">
                          <th><strong>Ref (L.P.O) #: </strong></th>
                          <td><div align="right">{{$invoice_master[0]->ReferenceNo}}</div></td>
                        </tr>
                        <tr class="payment-method">
                          <th><strong>Payment: </strong></th>
                          <td><div align="right">{{$invoice_master[0]->PaymentMode}}-{{$invoice_master[0]->PaymentDetails}}</div></td>
                        </tr>
                    </table>                </td>
            </tr>
            <tr>
              <td colspan="2" valign="bottom" class="billing-address address"><strong>Subject : </strong>{{$invoice_master[0]->Subject}}</td>
            </tr>
        </table>
    <table class="order-details">
        <thead>
            <tr>
                  <th width="5%" class="sno">S#</th>
                <th width="20%" class="product">Item</th>
                <th width="10%" class="quantity">Qty</th>
                <th width="10%" class="price">Rate</th>
                <th width="10%" class="price">Tax</th>
                <th width="10%" class="price">Amount</th>
            </tr>
        </thead>
        <tbody>

            <?php 

            $Qty=0;
            $Discount=0;
             ?>
            @foreach($invoice_detail as $key => $value)


            <?php 

            $Qty = $Qty + $value->Qty;
            $Discount = $Discount + $value->Discount;

             ?>
            <tr>
                  <td height="15px">{{$key+1}}</td>
                <td>{{$value->ItemName}}</td>
                <td>{{$value->Qty}}</td>
                <td>{{number_format($value->Rate,2)}}</td>
                <td>{{number_format($value->Tax,2)}}</td>
                <td>{{number_format($value->Total,2)}}</td>
      </tr>
       <tr>
                
            @endforeach
            <?php  for($i = 11; $i>=count($invoice_detail);$i--) { ?>

            <tr>
                   <td height="15px"></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>

            <?php } ?>

        </tbody>
        <tfoot>
            <tr class="no-borders">
              <td colspan="3" class="no-borders">
                  <div class="customer-notes"><strong>Total Quantity</strong> : {{$Qty}} <br><Br>
                    <strong>Item Discount</strong> : {{number_format($Discount)}} <br><Br>
                    <strong>Customer Notes: </strong>{{$invoice_master[0]->CustomerNotes}}. </div>                    
                  <div class="customer-notes"><strong>Description Notes: </strong>{{$invoice_master[0]->DescriptionNotes}}. </div>

                  <div style="padding-top: 10px;"><strong>In words </strong>: <em>{{ucwords(convert_number_to_words($invoice_master[0]->GrandTotal))}} only/-</em></div>              </td>
                <td class="no-borders" colspan="3">
                    <table class="totals">
                        <tfoot>
                          <tr class="cart_subtotal">
                              <td class="no-borders"></td>
                              <th class="description">Subtotal</th>
                              <td class="price"><span class="totals-price"><span class="amount"> {{number_format($invoice_master[0]->SubTotal,2)}}</span></span></td>
                          </tr>
                          <tr class="order_total">
                              <td class="no-borders"></td>
                              <th class="description">Tax <span style="font-size: 10px;">({{(substr($invoice_master[0]->TaxType,3,10))}})</span> </th>
                              <td class="price"><span class="totals-price"><span class="amount">{{number_format($invoice_master[0]->Tax,2)}}</span></span></td>
                          </tr>
                          <tr class="order_total">
                              <td class="no-borders"></td>
                              <th class="description">Total</th>
                              <td class="price"><span class="totals-price"><span class="amount">{{number_format($invoice_master[0]->SubTotal,2)}}</span></span></td>
                          </tr>
                          <tr class="order_total">
                              <td class="no-borders"></td>
                              <th class="description">Dis {{$invoice_master[0]->DiscountPer}}%</th>
                              <td class="price"><span class="totals-price"><span class="amount">{{number_format($invoice_master[0]->DiscountAmount,2)}}</span></span></td>
                          </tr>
                          <tr class="order_total">
                              <td class="no-borders"></td>
                              <th class="description">Shipping</th>
                              <td class="price"><span class="totals-price"><span class="amount">{{number_format($invoice_master[0]->Shipping,2)}}</span></span></td>
                          </tr>
                          <tr class="order_total">
                              <td class="no-borders"></td>
                              <th class="description">Grand Total</th>
                              <td class="price"><span class="totals-price"><span class="amount">{{number_format($invoice_master[0]->GrandTotal,2)}}</span></span></td>
                          </tr>  
                         
@if($invoice_master[0]->Paid>0)
                          <tr class="order_total">
                              <td class="no-borders"></td>
                              <th class="description">Paid</th>
                              <td class="price"><span class="totals-price"><span class="amount">{{number_format($invoice_master[0]->Paid,2)}}</span></span></td>
                          </tr>
                          <tr class="order_total" style="background: #eee;">
                              <td class="no-borders"></td>
                              <th class="description">Due  </th>
                              <td class="price"><span class="totals-price"><span class="amount"> {{number_format($invoice_master[0]->GrandTotal-$invoice_master[0]->Paid,2)}}</span></span></td>
                          </tr>

@endif
                        </tfoot>
                    </table> <br><br><br><br><br><br>              </td>
            </tr>
			 

           
        </tfoot>
    </table>
    <table width="100%" border="0"  >
        <tr>
            <td><div align="center">..............................................</div></td>
            <td><div align="center">..............................................</div></td>
        </tr>

        <tr>
            <td><div align="center">Customer's Signature</div></td>
            <td><div align="center">Company Signature</div></td>
        </tr>
</table>
    <div style="page-break-after: always;"></div>
<div id="bg_logo"> </div>

    @if(($invoice_master[0]->GrandTotal-$invoice_master[0]->Paid)==0)
<div id="xyz_main"><img src="{{asset('assets/images/paid.png')}}" alt="" ></div>
@endif
        <table class="head container">
            <tr>
                <td class="header">
                    <img src="{{URL('/documents/'.$company[0]->Logo)}}" width="246" height="246" />                </td>
                <td class="shop-info">
                    <div class="shop-name">
                        <div align="right"><div style="font-size: 16pt;line-height: 20pt;"><strong> <?php echo $company[0]->Name; ?> <br><?php echo $company[0]->Name2; ?></strong></div> <br />
      {{$company[0]->Address}}<br />
      Contact:{{$company[0]->Contact}}<br />
      TRN:{{$company[0]->TRN}}<br />
      Email:{{$company[0]->Email}}<br />
      Website:{{$company[0]->Website}}<br />
    </div>
                    </div>
                   
                    
                    <div class="shop-address"></div>                </td>
            </tr>
            <tr>
              <td colspan="2" class="header"><div align="center">
                <h2><u>{{strtoupper($invoice_master[0]->InvoiceType)}}</u></h2>
                 <h3 style="margin-top: 5px;"><u>OFFICE COPY</u></h3>
              </div></td>
            </tr>
</table>
        <table class="order-data-addresses">
            <tr>
                <td valign="bottom" class="address billing-address">
                <strong>Buyer</strong><br>
                    <strong>{{$invoice_master[0]->PartyName}}   {{($invoice_master[0]->WalkinCustomerName==1) ? ' -'.$invoice_master[0]->WalkinCustomerName : ''}}</strong><br />
          
 @if($invoice_master[0]->PartyID !=1)
            
                Address: {{$invoice_master[0]->Address}}<br />
          Phone: {{$invoice_master[0]->Phone}}<br />
          TRN: {{$invoice_master[0]->TRN}}<br /> 
            @endif
          <br />          </td>
                <td class="order-data">
                    <table align="right">
                        <tr class="order-number">
                            <th><strong>Invoice # </strong></th>
                            <td><div align="right">{{$invoice_master[0]->InvoiceNo}}</div></td>
                        </tr>
                        <tr class="order-date">
                            <th><strong>Date:</strong></th>
                            <td><div align="right">{{dateformatman($invoice_master[0]->Date)}}</div></td>
                        </tr>
                        <tr class="payment-method">
                            <th><strong>Due Date :</strong></th>
                            <td><div align="right">{{dateformatman($invoice_master[0]->DueDate)}}</div></td>
                        </tr>
                        <tr class="payment-method">
                          <th><strong>Ref (L.P.O) #: </strong></th>
                          <td><div align="right">{{$invoice_master[0]->ReferenceNo}}</div></td>
                        </tr>
                        <tr class="payment-method">
                          <th><strong>Payment: </strong></th>
                          <td><div align="right">{{$invoice_master[0]->PaymentMode}}-{{$invoice_master[0]->PaymentDetails}}</div></td>
                        </tr>
                    </table>                </td>
            </tr>
            <tr>
              <td colspan="2" valign="bottom" class="billing-address address"><strong>Subject : </strong>{{$invoice_master[0]->Subject}}</td>
            </tr>
        </table>
    <table class="order-details">
        <thead>
            <tr>
                  <th width="5%" class="sno">S#</th>
                <th width="20%" class="product">Item</th>
                <th width="10%" class="quantity">Qty</th>
                <th width="10%" class="price">Rate</th>
                <th width="10%" class="price">Tax</th>
                <th width="10%" class="price">Amount</th>
            </tr>
        </thead>
        <tbody>
            @foreach($invoice_detail as $key => $value)

            <tr>
                  <td height="15px">{{$key+1}}</td>
                <td>{{$value->ItemName}}</td>
                <td>{{$value->Qty}}</td>
                <td>{{number_format($value->Rate,2)}}</td>
                <td>{{number_format($value->Tax,2)}}</td>
                <td>{{number_format($value->Total,2)}}</td>
      </tr>
            @endforeach
            <?php  for($i = 12; $i>=count($invoice_detail);$i--) { ?>

            <tr>
                  <td height="15px"></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>

            <?php } ?>
        </tbody>
        <tfoot>
            <tr class="no-borders">
              <td colspan="3" class="no-borders">
                  <div class="customer-notes"><strong>Total Quantity</strong> : {{$Qty}} <br><Br>
                     <strong>Item Discount</strong> : {{number_format($Discount)}} <br><Br>
                     <strong>Customer Notes: </strong>{{$invoice_master[0]->CustomerNotes}}. </div>                    
                  <div class="customer-notes"><strong>Description Notes: </strong>{{$invoice_master[0]->DescriptionNotes}}. </div>

                  <div style="padding-top: 10px;"><strong>In words </strong>: <em>{{ucwords(convert_number_to_words($invoice_master[0]->GrandTotal))}} only/-</em></div>              </td>
                <td class="no-borders" colspan="3">
                    <table class="totals">
                        <tfoot>
                          <tr class="cart_subtotal">
                              <td class="no-borders"></td>
                              <th class="description">Subtotal</th>
                              <td class="price"><span class="totals-price"><span class="amount"> {{number_format($invoice_master[0]->SubTotal,2)}}</span></span></td>
                          </tr>
                          <tr class="order_total">
                              <td class="no-borders"></td>
                              <th class="description">Tax <span style="font-size: 10px;">({{(substr($invoice_master[0]->TaxType,3,10))}})</span> </th>
                              <td class="price"><span class="totals-price"><span class="amount">{{number_format($invoice_master[0]->Tax,2)}}</span></span></td>
                          </tr>
                          <tr class="order_total">
                              <td class="no-borders"></td>
                              <th class="description">Total</th>
                              <td class="price"><span class="totals-price"><span class="amount">{{number_format($invoice_master[0]->SubTotal,2)}}</span></span></td>
                          </tr>
                          <tr class="order_total">
                              <td class="no-borders"></td>
                              <th class="description">Dis {{$invoice_master[0]->DiscountPer}}%</th>
                              <td class="price"><span class="totals-price"><span class="amount">{{number_format($invoice_master[0]->DiscountAmount,2)}}</span></span></td>
                          </tr>
                          <tr class="order_total">
                              <td class="no-borders"></td>
                              <th class="description">Shipping</th>
                              <td class="price"><span class="totals-price"><span class="amount">{{number_format($invoice_master[0]->Shipping,2)}}</span></span></td>
                          </tr>
                          <tr class="order_total">
                              <td class="no-borders"></td>
                              <th class="description">Grand Total</th>
                              <td class="price"><span class="totals-price"><span class="amount">{{number_format($invoice_master[0]->GrandTotal,2)}}</span></span></td>
                          </tr>  
                         
@if($invoice_master[0]->Paid>0)
                          <tr class="order_total">
                              <td class="no-borders"></td>
                              <th class="description">Paid</th>
                              <td class="price"><span class="totals-price"><span class="amount">{{number_format($invoice_master[0]->Paid,2)}}</span></span></td>
                          </tr>
                          <tr class="order_total" style="background: #eee;">
                              <td class="no-borders"></td>
                              <th class="description">Due  </th>
                              <td class="price"><span class="totals-price"><span class="amount"> {{number_format($invoice_master[0]->GrandTotal-$invoice_master[0]->Paid,2)}}</span></span></td>
                          </tr>

@endif
                        </tfoot>
                    </table> <br><br><br><br><br><br>              </td>
            </tr>
             

           
        </tfoot>
    </table>
    <table width="100%" border="0"  >
        <tr>
            <td><div align="center">..............................................</div></td>
            <td><div align="center">..............................................</div></td>
        </tr>

        <tr>
            <td><div align="center">Customer's Signature</div></td>
            <td><div align="center">Company Signature</div></td>
        </tr>
</table>
</body>
</html>