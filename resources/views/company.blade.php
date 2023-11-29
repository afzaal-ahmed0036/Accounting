@extends('template.tmp')

@section('title')


@section('content')
<div class="main-content">

  <div class="page-content">
    <div class="container-fluid">

      <div class="row">
        <div class="col-12">

          @if (session('error'))

          <div class="alert alert-{{ Session::get('class') }} p-1" id="success-alert">

            {{ Session::get('error') }}
          </div>

          @endif

          @if (count($errors) > 0)

          <div>
            <div class="alert alert-danger p-2 border-1">
              <p class="font-weight-bold"> There were some problems with your input.</p>
              <ul>

                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>

                @endforeach
              </ul>
            </div>
          </div>

          @endif


@if(count($company)==0)

<div class="card">
            <div class="card-body">
              <form action="{{URL('/SaveCompany')}}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                <div>
                  <div>

                    <h4 class="card-title">Add Company</h4>
                    <p class="card-title-desc"></p>



                    <input type="hidden" name="CompanyID">

                    <div class="mb-1 row">
                      <label for="example-email-input" class="col-md-2 col-form-label fw-bold ">Company Name</label>
                      <div class="col-md-4">
                      <input class="form-control" type="text" name="Name">
                      </div>
                    </div>


                     <div class="mb-1 row">
                      <label for="example-email-input" class="col-md-2 col-form-label fw-bold "> Name (Next Line)</label>
                      <div class="col-md-4">
                      <input class="form-control" type="text" name="Name2">
                      </div>
                    </div>

                    <div class="mb-1 row">
                      <label for="example-email-input" class="col-md-2 col-form-label fw-bold text-danger">TRN # </label>
                      <div class="col-md-4">
                      <input class="form-control" type="text" name="TRN">
                      </div>
                    </div>


                    <div class="mb-2 row">
                      <label for="example-url-input" class="col-md-2 col-form-label fw-bold">Email</label>
                      <div class="col-md-4">
                        <input class="form-control" type="text" name="Email">
                      </div>

                    </div>


                     <div class="mb-2 row">
                      <label for="example-url-input" class="col-md-2 col-form-label fw-bold">Website</label>
                      <div class="col-md-4">
                        <input class="form-control" type="text" name="Website">
                      </div>

                    </div>

                    <div class="mb-2 row">
                      <label for="example-url-input" class="col-md-2 col-form-label fw-bold">Phone</label>
                      <div class="col-md-4">
                        <input class="form-control" type="text" name="Contact">
                      </div>

                    </div>

                    <div class="mb-2 row">
                      <label for="example-url-input" class="col-md-2 col-form-label fw-bold">Mobile</label>
                      <div class="col-md-4">
                        <input class="form-control" type="text" name="Mobile">
                      </div>

                    </div>
                   

                    <div class="mb-2 row">
                      <label for="example-url-input" class="col-md-2 col-form-label fw-bold">Address</label>
                      <div class="col-md-4">
                        <input class="form-control" type="text" name="Address">
                      </div>

                    </div>

                       <div class="mb-2 row">
                      <label for="example-url-input" class="col-md-2 col-form-label fw-bold">Website</label>
                      <div class="col-md-4">
                        <input class="form-control" type="text" name="Website">
                      </div>

                    </div>


                    <div class="mb-2 row">
                      <label for="example-url-input" class="col-md-2 col-form-label fw-bold">logo</label>
                      <div class="col-md-4">
                      <input class="form-control" type="file" name="Logo" id="Logo">
                      </div>

                    </div>


                    <div class="mb-2 row">
                      <label for="example-url-input" class="col-md-2 col-form-label fw-bold">Background Logo</label>
                      <div class="col-md-4">
                      <input class="form-control" type="file" name="BackgroundLogo" id="BackgroundLogo">
                      </div>

                    </div>

                    <div class="mb-2 row">
                      <label for="example-url-input" class="col-md-2 col-form-label fw-bold">Signature</label>
                      <div class="col-md-4">
                        <input class="form-control" type="file" name="Signature" id="Signature">
                      </div>

                    </div>
                    
                    <div class="mb-2 row">
                      <label for="example-url-input" class="col-md-2 col-form-label fw-bold">Digital Signature</label>
                      <div class="col-md-8">
                        <input class="form-control" name="DigitalSignature" type="text" name="InvoiceDueDays">
         <script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
                         <script>
    CKEDITOR.replace('DigitalSignature', {
      // Define the toolbar groups as it is a more accessible solution.
      toolbarGroups: [{
          "name": "basicstyles",
          "groups": ["basicstyles"]
        },
        {
          "name": "links",
          "groups": ["links"]
        },
        {
          "name": "paragraph",
          "groups": ["list", "blocks"]
        },
       
        {
          "name": "insert",
          "groups": ["insert"]
        },
        {
          "name": "styles",
          "groups": ["styles"]
        },
        
      ],
      // Remove the redundant buttons from toolbar groups defined above.
      removeButtons: 'Strike,Subscript,Superscript,Anchor,Styles,Specialchar,PasteFromWord'
    });
  </script>
                      </div>

                    </div>


                       <div class="mb-2 row">
                      <label for="example-url-input" class="col-md-2 col-form-label fw-bold">Estimate Invoice Title</label>
                      <div class="col-md-4">
                        <input class="form-control" type="textfield" name="EstimateInvoiceTitle" id="EstimateInvoiceTitle">
                      </div>

                    </div>

                     <div class="mb-2 row">
                      <label for="example-url-input" class="col-md-2 col-form-label fw-bold">Sale Invoice Title</label>
                      <div class="col-md-4">
                        <input class="form-control" type="textfield" name="SaleInvoiceTitle" id="SaleInvoiceTitle">
                      </div>

                    </div>

                
                     <div class="mb-2 row">
                      <label for="example-url-input" class="col-md-2 col-form-label fw-bold">Delivery Challan Title</label>
                      <div class="col-md-4">
                        <input class="form-control" type="textfield" name="DeliveryChallanTitle" id="DeliveryChallanTitle">
                      </div>

                    </div>

                      <div class="mb-2 row">
                      <label for="example-url-input" class="col-md-2 col-form-label fw-bold">Delivery Challan Title</label>
                      <div class="col-md-4">
                        <input class="form-control" type="textfield" name="DeliveryChallanTitle" id="DeliveryChallanTitle">
                      </div>

                    </div>


                      <div class="mb-2 row">
                      <label for="example-url-input" class="col-md-2 col-form-label fw-bold">Credit Note Title</label>
                      <div class="col-md-4">
                        <input class="form-control" type="textfield" name="CreditNoteTitle" id="CreditNoteTitle">
                      </div>

                    </div>


                      <div class="mb-2 row">
                      <label for="example-url-input" class="col-md-2 col-form-label fw-bold">Purchase Invoice</label>
                      <div class="col-md-4">
                        <input class="form-control" type="textfield" name="PurchaseInvoiceTitle" id="PurchaseInvoiceTitle">
                      </div>

                    </div>


                      <div class="mb-2 row">
                      <label for="example-url-input" class="col-md-2 col-form-label fw-bold">Debit Note Title</label>
                      <div class="col-md-4">
                        <input class="form-control" type="textfield" name="DebitNoteTitle" id="DebitNoteTitle">
                      </div>

                    </div>




                  </div>

                </div>



 


            </div>
            <div class="card-footer bg-light bg-soft">
              <button type="submit" class="btn btn-primary me-1 waves-effect waves-float waves-light">Submit</button>




              <button type="reset" class="btn btn-outline-secondary waves-effect">Reset</button>
            </div>
          </div>

          @endif

          
          <!-- card end here -->
          </form>

          <div class="row">
            <div class="col-lg-12">
 <h4 class="card-title ">Company Details</h4>
           
              </div>
            </div>



          </div>



           <div class="card">
                <div class="card-body">
                        

                         <div>
                            <div>

                             



                                <?php
$CompanyID        = old('CompanyID') ? old('CompanyID') : $company[0]->CompanyID;
$Name             = old('Name') ? old('Name') : $company[0]->Name;
$Name2             = old('Name2') ? old('Name2') : $company[0]->Name2;
$TRN             = old('TRN') ? old('TRN') : $company[0]->TRN;
$Currency             = old('Currency') ? old('Currency') : $company[0]->Currency;
$Contact          = old('Contact') ? old('Contact') : $company[0]->Contact;
$Email            = old('Email') ? old('Email') : $company[0]->Email;
$Website            = old('Website') ? old('Website') : $company[0]->Website;
$Address          = old('Address') ? old('Address') : $company[0]->Address;
$Logo             = old('Logo') ? old('Logo') : $company[0]->Logo;
$BackgroundLogo   = old('BackgroundLogo') ? old('BackgroundLogo') : $company[0]->BackgroundLogo;
$Signature        = old('Signature') ? old('Signature') : $company[0]->Signature;
$DigitalSignature = old('DigitalSignature') ? old('DigitalSignature') : $company[0]->DigitalSignature;

$EstimateInvoiceTitle = old('EstimateInvoiceTitle') ? old('EstimateInvoiceTitle') : $company[0]->EstimateInvoiceTitle;
$SaleInvoiceTitle     = old('SaleInvoiceTitle') ? old('SaleInvoiceTitle') : $company[0]->SaleInvoiceTitle;
$DeliveryChallanTitle = old('DeliveryChallanTitle') ? old('DeliveryChallanTitle') : $company[0]->DeliveryChallanTitle;
$CreditNoteTitle      = old('CreditNoteTitle') ? old('CreditNoteTitle') : $company[0]->CreditNoteTitle;
$PurchaseInvoiceTitle = old('PurchaseInvoiceTitle') ? old('PurchaseInvoiceTitle') : $company[0]->PurchaseInvoiceTitle;
$DebitNoteTitle       = old('DebitNoteTitle') ? old('DebitNoteTitle') : $company[0]->DebitNoteTitle;

?>



                        <input type="hidden" value="{{$CompanyID}}" name="CompanyID">
                       <div class="mb-1 row">
                      <label for="example-email-input" class="col-md-3 col-form-label fw-bold ">Company Name</label>
                      <div class="col-md-6">
                        {{$Name}}   <a href="{{URL('/CompanyEdit/'.$company[0]->CompanyID)}}" class="text-danger"  ><i class="mdi mdi-pencil font-size-15"></i></a>
                       </div>
                        
                    </div>

                      <div class="mb-1 row">
                      <label for="example-email-input" class="col-md-3 col-form-label fw-bold text-danger"> Company Name (Extra Line) </label>
                      <div class="col-md-6">
                        {{$Name2}}
                       </div>
                        
                    </div>


                     <div class="mb-1 row">
                      <label for="example-email-input" class="col-md-3 col-form-label fw-bold text-danger">TRN # </label>
                      <div class="col-md-6">
                        {{$TRN}}
                       </div>
                        
                    </div>


                     <div class="mb-1 row">
                      <label for="example-email-input" class="col-md-3 col-form-label fw-bold text-danger">Currency </label>
                      <div class="col-md-6">
                        {{$Currency}}
                       </div>
                        
                    </div>



                    <div class="mb-2 row">
                      <label for="example-url-input" class="col-md-3 col-form-label fw-bold">Email</label>
                      <div class="col-md-6">
                        {{$Email}}
                       </div>
                        

                    </div>


                       <div class="mb-2 row">
                      <label for="example-url-input" class="col-md-3 col-form-label fw-bold">Website</label>
                      <div class="col-md-6">
                        {{$Website}}
                       </div>

                    </div>



                    <div class="mb-2 row">
                      <label for="example-url-input" class="col-md-3 col-form-label fw-bold">Phone</label>
                      <div class="col-md-6">
                        {{$Contact}}
                       </div>

                    </div>


                    <div class="mb-2 row">
                      <label for="example-url-input" class="col-md-3 col-form-label fw-bold">Address</label>
                      <div class="col-md-6">
                        {{$Address}}
                       </div>

                    </div>

                    <div class="mb-2 row">
                      <label for="example-url-input" class="col-md-3 col-form-label fw-bold">logo</label>



                      <div class="col-md-6">
                        
                        <img src="{{ URL('/documents/' . $company[0]->Logo) }}" alt="" width="150">
                       </div>

                    </div>


                    <div class="mb-2 row">
                      <label for="example-url-input" class="col-md-3 col-form-label fw-bold">BackgroundLogo</label>
                      <div class="col-md-6">
                        
                        <img src="{{ URL('/documents/' . $company[0]->BackgroundLogo) }}" alt="" width="150">
                      
                       </div>

                    </div>

                    <div class="mb-2 row">
                      <label for="example-url-input" class="col-md-3 col-form-label fw-bold">Signature</label>
                      <div class="col-md-6">
                        

                      <img src="{{ URL('/documents/' . $company[0]->Signature) }}" alt="" width="150">

                       </div>

                    </div>

                    <div class="mb-2 row">
                      <label for="example-url-input" class="col-md-3 col-form-label fw-bold">Digital Signature</label>
                      <div class="col-md-6">

                         {!! $DigitalSignature !!}
                          
                      </div>

                    </div>


                 

                    </div>


                            </div>

                        </div>

                </div>
              
            </div>




        </div>
      </div>
    </div>
  </div>
</div>


<!-- END: Content-->
<script type="text/javascript">
  $(document).ready(function() {
    $('#student_table').DataTable();
  });
</script>



@endsection