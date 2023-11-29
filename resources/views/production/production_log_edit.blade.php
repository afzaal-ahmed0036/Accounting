@extends('template.tmp')
@section('title', $pagetitle)
@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">Edit Production Log Deatails</h4>
                            <div class="page-title-right ">
                                <div class="btn-group  shadow-sm dropstart">
                                    <a href="{{ URL('Production/Logs') }}" class="btn btn-primary"> Back </a>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        @if (session('error'))
                            <div class="alert alert-{{ Session::get('class') }} p-1" id="success-alert">
                                <strong>{{ Session::get('error') }} </strong>
                            </div>
                        @endif
                        @if (count($errors) > 0)
                            <div>
                                <div class="alert alert-danger p-1 border-1 bg-danger text-white">
                                    <p class="font-weight-bold"> There were some problems with your input.</p>
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="card">
                    <form action="{{ url('ProductionLog/Update') }}" method="post">
                        @csrf
                        <input type="hidden" name="id" value="{{ $production->ProductionLogID}}">
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-2">
                                    <label class="col-form-label fw-bold" for="first-name">Batch/LOT #</label>
                                </div>
                                <div class="col-4">
                                    <input type="text" id="first-name" class="form-control" name="BatchNo"
                                        placeholder="Batch/LOT Number" required readonly value="{{ $production->BatchNo }}">
                                </div>
                                <div class="col-2">
                                    <label class="col-form-label fw-bold" for="first-name">Reference #</label>
                                </div>
                                <div class="col-4">
                                    <input type="number" step="0.001" id="first-name" class="form-control"
                                        name="ReferenceNo" placeholder="Reference Number" required
                                        value="{{ $production->ReferenceNo }}" readonly required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-2">
                                    <label class="col-form-label fw-bold" for="first-name">Production Date</label>
                                </div>
                                <div class="col-4">
                                    <div class="input-group" id="datepicker21">
                                        <input type="text" name="Date" autocomplete="off" class="form-control"
                                            placeholder="yyyy-mm-dd" data-date-format="yyyy-mm-dd"
                                            data-date-container="#datepicker21" data-provide="datepicker"
                                            data-date-autoclose="true" value="{{ $production->Date }}">
                                        <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <label class="col-form-label fw-bold" for="first-name">Description</label>
                                </div>
                                <div class="col-4">
                                    <input type="text" id="first-name" class="form-control" name="description"
                                        placeholder="Description" value="{{ $production->Date }}">
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-5">
                                    <label class="col-form-label fw-bold" for="first-name">Product</label>
                                </div>
                                <div class="col-2">
                                    <label class="col-form-label fw-bold" for="first-name">Qunatity</label>
                                </div>
                                <div class="col-2">
                                    <label class="col-form-label fw-bold" for="first-name">Price</label>
                                </div>
                                <div class="col-2">
                                    <label class="col-form-label fw-bold" for="first-name">Total Value</label>
                                </div>
                                <div class="col-1 d-flex justify-content-end">
                                    <label class="col-form-label fw-bold" for="first-name">Action</label>

                                </div>
                            </div>
                            @foreach ($production->productionLogDetails as $product)
                                <div class="row mb-2" id="inputFormRow">
                                    <div class="col-5">
                                        <select name="itemID[]" id="material_select" class="form-control" required>
                                            <option value="">--Select One--</option>
                                            @foreach ($items as $item)
                                                <option value="{{ $item->ProductID }}"
                                                    {{ $product->ProductID == $item->ProductID ? 'selected' : '' }}>
                                                    {{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-2">
                                        <input type="number" min="1" id="product_qty" step="1"
                                            class="form-control" required name="itemQty[]" value="{{ $product->Qty }}">
                                    </div>
                                    <div class="col-2">
                                        <input type="text" readonly class="form-control" id="item_price"
                                            name="rate[]" value="{{ $product->Rate }}">
                                    </div>
                                    <div class="col-2">
                                        <input type="text" readonly class="form-control" name="total_value[]"
                                            id="total_value" value="{{ $product->Total }}">
                                    </div>
                                    <div class="col-1 d-flex justify-content-end">
                                        <button type="button" id="removeRow" class="btn btn-sm btn-danger"><i
                                                class="fa fa-minus"></i></button>
                                    </div>
                                </div>
                            @endforeach
                            <div id="filesDiv">
                            </div>
                            <div class="row">
                                <div class="col">
                                    <button type="button" class="btn btn-success" id="add_new_row"><i
                                            class="fa fa-plus"></i>Add More</button>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-success">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- END: Content-->


    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
        crossorigin="anonymous"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#add_new_row').click(function() {
                var html = '';
                html += '<div class="row mb-2" id="inputFormRow">';
                html +=
                    '<div class="col-5"><select name="itemID[]" id="material_select" class="form-control" required><option value="">--Select One--</option>@foreach ($items as $item)<option value="{{ $item->ProductID }}">{{ $item->name }}</option>@endforeach</select></div>';
                html +=
                    '<div class="col-2"><input min="1" id="product_qty" name="itemQty[]" type="number" step="1" required class="form-control"></div>';
                html +=
                    '<div class="col-2"><input id="item_price" type="number" name="rate[]" readonly class="form-control"></div>'
                html +=
                    '<div class="col-2"><input id="total_value" name="total_value[]" type="text" readonly class="form-control"></div>'
                html +=
                    '<div class="col-1 d-flex justify-content-end"><button type="button" id="removeRow" class="btn btn-sm btn-danger"><i class="fa fa-minus"></i></button></div>'
                html += '</div>';

                var newRow = $(html);
                $('#filesDiv').append(newRow);
            })
            $(document).on('click', '#removeRow', function() {
                $(this).closest('#inputFormRow').remove();
            });
            $(document).on('change', '#material_select', function() {
                let productId = $(this).val();
                let costPrice = $(this).closest('#inputFormRow').find('#item_price');
                let productQty = $(this).closest('#inputFormRow').find('#product_qty').val();
                let totalValue = $(this).closest('#inputFormRow').find('#total_value');
                costPrice.val('');
                $.ajax({
                    url: "{{ url('getProductDetails') }}",
                    method: 'POST',
                    data: {
                        id: productId,
                    },
                    success: function(response) {
                        // alert(response.data.CostPrice);
                        costPrice.val(response.data.price);
                        totalValue.val(productQty * response.data.price);

                    },
                    error: function(xhr, textStatus, errorThrown) {
                        if (xhr.status == 422 && xhr.responseJSON && xhr.responseJSON.errors) {
                            // Handle validation errors
                            var errors = xhr.responseJSON.errors;
                            alert("Validation Error: " + Object.values(errors).flat().join(
                                ", "));
                        } else {
                            // Handle other types of errors
                            alert('Error: ' + errorThrown);
                        }
                    }
                })
                // $(this).closest('#inputFormRow').find('#item_price').val(materialId);
            });
            $(document).on('change keyup', '#product_qty', function() {
                let productQty = parseInt($(this).val());
                let Price = $(this).closest('#inputFormRow').find('#item_price').val();
                let totalValue = $(this).closest('#inputFormRow').find('#total_value');
                totalValue.val(productQty * Price);
            })
        });
    </script>
@endsection
