<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>INVOICE</title>
<style type="text/css">


 

  @page {
                margin-top: 0.1cm;
                margin-bottom: 0.0cm;
                margin-left: 0.4cm;
                margin-right: 0.4cm;
            }

body,td,th {
	font-family: Arial, Helvetica, sans-serif;
  font-size: 10pt;
}
.style3 {color: #FFFFFF; font-weight: bold; }
 
 

    #footer {
                position: absolute;
                bottom: 4.5cm;
                left: 50%;
                right: 50%;
                height: 0cm;
                text-align: center;
                /*border-top: 0.1mm solid gray;*/
                margin-bottom: 0;
                padding-top: 2mm;
            }

th, td {
   padding-left: 10px;
  padding-right: 10px;
 
}

.rowborder
{
   border-top: 1px solid #e9e9e9;
  border-bottom: 1px solid #e9e9e9;
  height: 25px;
}

</style>

       
   
 
 
      

</head>

<body>
<div class="container">
  <div class="row">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td ><div align="center"><img src="{{asset('documents/'.$company[0]->Logo)}}" width="180"></div>
    </td>
  </tr>
  <tr>
    <td style="font-size: 28px !important;"><div align="center"><strong>INVOICE</strong></div></td>
  </tr>
   
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td style="padding-left: 0px !important; padding-right: 1px !important;">

      <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="50%" style="padding-left: 0px !important; padding-right: 1px !important;">


          <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td style="padding-left: 0px !important; padding-right: 1px !important;">{{$company[0]->Name}}</td>
          </tr>
          <tr>
            <td style="padding-left: 0px !important; padding-right: 1px !important;">Office: {{$company[0]->Address}} </td>
          </tr>
         
          <tr>
            <td style="padding-left: 0px !important; padding-right: 1px !important;">Contact: {{$company[0]->Contact}}</td>
          </tr>
         
          <tr>
            <td style="padding-left: 0px !important; padding-right: 1px !important;">TRN : {{$company[0]->TRN}}</td>
          </tr>
        </table></td>
        <td width="50%" valign="top" style="padding-left: 0px !important; padding-right: 1px !important;">

          <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td style="padding-left: 0px !important; padding-right: 1px !important;">

              <div align="right" style="font-size: 14pt;"># {{$invoice_master[0]->InvoiceNo}} </div></td>
          </tr>
          <tr>
            <td><div align="right"></div></td>
          </tr>
          <tr>
            <td style="padding-left: 0px !important; padding-right: 1px !important;"><div align="right">Balance Due </div></td>
          </tr>
          <tr>
            <td style="padding-left: 0px !important; padding-right: 1px !important;"><div align="right">{{session::get('Currency')}}{{$invoice_master[0]->GrandTotal}} </div></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>&nbsp;</td>
    <td valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td width="50%" style="padding-left: 0px !important; padding-right: 1px !important;">

      <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td style="padding-left: 0px !important; padding-right: 1px !important;">Bill To </td>
      </tr>
      <tr>
        <td style="padding-left: 0px !important; padding-right: 1px !important; font-weight: bolder;"> {{$invoice_master[0]->PartyName}} </td>
      </tr>

      <tr>
        <td style="padding-left: 0px !important; padding-right: 1px !important;">Office: {{$invoice_master[0]->Address}} </td>
      </tr>
      
      <tr>
        <td style="padding-left: 0px !important; padding-right: 1px !important;">{{$invoice_master[0]->Phone}}</td>
      </tr>
       
      
    </table></td>
    <td width="50%" valign="top" style="padding-left: 0px !important; padding-right: 1px !important;">

      <table width="100%" border="0" cellspacing="0" cellpadding="3">
      <tr>
        <td  style="padding-left: 0px !important; padding-right: 1px !important;"  width="80%"><div align="right">Invoice Date : </div></td>
        <td  style="padding-left: 0px !important; padding-right: 1px !important;"  width="20%"><div align="right">{{dateformatreport($invoice_master[0]->Date)}} </div></td>
      </tr>
      <tr>
        <td  style="padding-left: 0px !important; padding-right: 1px !important;" ><div align="right">Terms : </div></td>
        <td  style="padding-left: 0px !important; padding-right: 1px !important;" ><div align="right">Custom</div></td>
      </tr>
      <tr>
        <td  style="padding-left: 0px !important; padding-right: 1px !important;" ><div align="right">Due Date : </div></td>
        <td  style="padding-left: 0px !important; padding-right: 1px !important;" ><div align="right">{{dateformatreport($invoice_master[0]->DueDate)}} </div></td>
      </tr>
      <tr>
        <td  style="padding-left: 0px !important; padding-right: 1px !important;" ><div align="right">VAT No. : </div></td>
        <td  style="padding-left: 0px !important; padding-right: 1px !important;" ><div align="right">{{$invoice_master[0]->TRN}}</div></td>
      </tr>
    </table></td>
  </tr>
</table>
<br />
<table width="100%" border="0" cellspacing="0"   >
  <tr bgcolor="#333333" style="color: white;">
    <td width="1">#</td>
    <td width="150" height="30"><span class="style3">Item &amp; Description </span></td>
    <td width="5" align="right">Qty</td>
    <td width="10" align="right">Rate</td>
    <td width="10" align="right">Tax</td>
    <td width="10" align="right">Amount</td>
  </tr>
  
@foreach($invoice_detail as $key => $value)
  <tr valign="top" >
    <td style="padding-top: 5px;">{{$key+1}}</td>
    <td style="padding-top: 5px;">{{$value->ItemName}}<br />
      <?php echo $value->Description; ?>
      <p></p>
    </td>
    <td align="right" style="padding-top: 5px;">{{number_format($value->Qty,2)}}</td>
    <td align="right" style="padding-top: 5px;">{{number_format($value->Rate,2)}}</td>
    <td align="right" style="padding-top: 5px;">{{number_format($value->Tax,2)}}<br />
      {{number_format($value->TaxPer,2)}}%</td>
    <td align="right" style="padding-top: 5px;">{{number_format($value->Total,2)}}</td>
  </tr>
@endforeach

  <tr class="rowborder">
    <td height="35" align="right" colspan="4"  >Sub Total </td>
    <td width="10" height="35" align="right"  >{{number_format($invoice_master[0]->Tax,2)}}</td>
    <td width="10" height="35" align="right"  >{{number_format($invoice_master[0]->SubTotal,2)}}</td>
  </tr>
</table>


<table width="100%" border="0" cellpadding="3" cellspacing="0" style="margin-top: 5px;">
  <tr>
    <td colspan="3" valign="top" width="65%">BANK DETAILS<br />
      Account Name: Golden Pearl Real Estate Brokers<br />
      Account Number: 0123108891001<br />
      IBAN: AE020400000123108891001<br />
      Swift Code: NRAKAEAK XXX<br />
      Bank Name: National Bank of Ras Al-Khaimah<br />
      <!-- Branch: Al Rigga Deira Dubai UAE. -->
    </td>

   <td width="35%" valign="top">

       <table width="100%"  align="right" cellpadding="0" cellspacing="0" >
      <tr>
        <td width="50%" height="34"><div align="left">Total</div></td>
        <td width="50%" height="34"><div align="right">{{session::get('Currency')}}{{number_format($invoice_master[0]->GrandTotal,2)}} </div></td>
      </tr>
      <tr>
        <td width="50%" height="35" bgcolor="#CCCCCC"><div align="left">Due Balance </div></td>
        <td width="50%" height="35" bgcolor="#CCCCCC"><div align="right">{{session::get('Currency')}}{{number_format($invoice_master[0]->GrandTotal,2)}} </div></td>
      </tr>
    </table>


     </td>
  </tr>
</table>





<p>Tax Summary</p>

<table width="100%" border="0" cellpadding="0" cellspacing="0" >
  <tr bgcolor="#333333" >
    <td width="150" height="30"><span class="style3">Tax Details </span></td>
    <td width="50"><div align="right"><span class="style3">Taxable Amount ({{session::get('Currency')}}) </span></div></td>
    <td width="50"><div align="right"><span class="style3">Tax Amount ({{session::get('Currency')}}) </span></div></td>
  </tr>
  <tr>
    <td><p>Standard Rate (5%) </p></td>
    <td><div align="right">{{number_format($invoice_master[0]->SubTotal,2)}}</div></td>
    <td><div align="right">{{number_format($invoice_master[0]->Tax,2)}}</div></td>
  </tr>
  <tr class="rowborder" >
    <td height="35">Total</td>
    <td><div align="right">{{session::get('Currency')}}{{number_format($invoice_master[0]->SubTotal,2)}}</div></td>
    <td><div align="right">{{session::get('Currency')}}{{number_format($invoice_master[0]->Tax,2)}}</div></td>
  </tr>
</table>

  </div>
  <p>Notes</p>
<p>Thanks for your business  </p>
  <div id="footer" >
 <img src="{{asset('documents/'.$company[0]->Signature)}}" width="250">
  </div>
</div>
</body>
</html>
