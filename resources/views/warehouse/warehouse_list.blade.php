@extends('template.tmp')
@section('title', 'WareHouse Listing')
@section('content')
 <div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">WareHouse Listing</h4>

                        <div class="page-title-right">
                             <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addWareHouseModal">Add WareHouse</button>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->
            <div class="row">
                <div class="col-xl-12">
                     @if (session('error'))
                        <div class="alert alert-{{ Session::get('class') }} p-3">
                                        
                                      <strong>{{ Session::get('error') }} </strong>
                                    </div>
                    @endif

                    @if (count($errors) > 0) 
                        <div >
    <div class="alert alert-danger pt-3 pl-0   border-3 bg-danger text-white">
       <p class="font-weight-bold"> There were some problems with your input.</p>
        <ul>
            
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>

            @endforeach
        </ul>
    </div>
    </div>
                    @endif


        <!-- Add Modal -->
        <div class="modal fade" id="addWareHouseModal" tabindex="-1" role="dialog" aria-labelledby="addWareHouseModalTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="addWareHouseModalTitle">Add Ware House</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                </button>
              </div>
              <div class="modal-body">
                <form action="{{url('storeWareHouse')}}" method="POST">
                    @csrf
                    <div class="row col-md-12">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="Name" class="form-control" placeholder="Ware House Name" required>
                        </div>
                        
                    </div>
                    <div class="row col-md-12 mt-3">
                        <div class="form-group">
                            <label for="phone">Phone Number</label>
                            <input type="text" name="Phone" class="form-control" placeholder="Phone Number" required>
                        </div>
                        
                    </div>
                    <div class="row col-md-12 mt-3">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="Email" class="form-control" placeholder="example@example.com" required>
                        </div>
                        
                    </div>
                    <div class="row col-md-12 mt-3">
                        <div class="form-group">
                            <label for="address">Address</label>
                            <textarea required class="form-control" rows="3" name="Address"></textarea>
                        </div>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="sumbit" class="btn btn-success">Save</button>
                    </div>
                </form>
              </div>
            </div>
          </div>
        </div>


        <!-- Edit Modal -->
        <div class="modal fade" id="editWareHouseModal" tabindex="-1" role="dialog" aria-labelledby="editWareHouseModalTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="editWareHouseModalTitle">Edit Ware House</h5>
                


                  
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form action="{{url('updateWareHouse')}}" method="POST">
                    @csrf
                    <input type="hidden" name="warehouse_id" value="" id="wareHouseId">
                    <div class="row col-md-12">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="Name" id="Name" class="form-control" value="" required>
                        </div>
                        
                    </div>
                    <div class="row col-md-12 mt-3">
                        <div class="form-group">
                            <label for="phone">Phone Number</label>
                            <input type="text" name="Phone" class="form-control" id="Phone" value="" required>
                        </div>
                        
                    </div>
                    <div class="row col-md-12 mt-3">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="Email" class="form-control" id="Email" value="" required>
                        </div>
                        
                    </div>
                    <div class="row col-md-12 mt-3">
                        <div class="form-group">
                            <label for="address">Address</label>
                            <textarea required class="form-control" rows="3" id="Address" name="Address"></textarea>
                        </div>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="sumbit" class="btn btn-success">Update</button>
                    </div>
                </form>
              </div>
            </div>
          </div>
        </div>

            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Ware Houses</h4>


                    <table class="table datatable table-hover dt-responsive nowrap w-100 table-sm">
                        <thead>
                        <tr>
                            <th scope="col" >S.No</th>
                            <th scope="col">Warehouse</th>
                            <th scope="col">Phone Number</th>
                            <th scope="col">Email</th>
                            <th scope="col">Address</th>
                   
                            <th scope="col">Action</th>
                        </tr>
                        </thead>


                        <tbody>
                            
                        </tbody>
                    </table>
                          
                </div>
                <!-- end card body -->
            </div>
                    <!-- end card -->
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->  
        </div> <!-- container-fluid -->
    </div>
 <script type="text/javascript">
     $(document).ready(function(){

        $('.datatable').DataTable({
            "processing": true,
            "serverSide": true,
            "pageLength":50,
            "ajax": "{{ url('wareHouseList') }}",
            "columns":[
                {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable:false, searchable: false},
                { "data": "Name" },
                { "data": "Phone" },
                { "data": "Email" },
                { "data": "Address" },
                 
                { "data": "action" }
            ]
             
         });


        $(document.body).on('click','.edit_warehouse',function(){
           
                        $('#wareHouseId').val($(this).attr("data-id"));
                        $('#Name').val($(this).attr("data-name"));
                        $('#Phone').val($(this).attr("data-phone"));
                        $('#Email').val($(this).attr("data-email"));
                        $('#Address').val($(this).attr("data-address"));
                
                        $('#editWareHouseModal').modal('show');
       

        });


     });
 </script>   
@endsection