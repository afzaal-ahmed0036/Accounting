@extends('template.tmp')
@section('title', $pagetitle)
@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">Update Product Deatails</h4>
                            <div class="page-title-right ">

                                <div class="btn-group  shadow-sm dropstart">
                                    <a href="{{ URL('Products') }}" class="btn btn-primary"> Back </a>

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
                    <form action="{{ url('ProductUpdate') }}" method="post">
                        @csrf
                        <input type="hidden" name="id" value="{{ $product->ItemID }}">
                        <div class="card-body">
                            <div class="row mb-3">
                                <strong class="fst-italic text-info">Product Basic Information:</strong>
                                <div class="col-4">
                                    <label class="col-form-label fw-bold" for="first-name">Name</label>
                                    <input type="text" id="first-name" class="form-control" name="name"
                                        placeholder="Product Name" required value="{{ $product->ItemName }}">
                                </div>
                                <div class="col-4">
                                    <label class="col-form-label fw-bold" for="first-name">Price</label>
                                    <input type="number" step="0.001" id="first-name" class="form-control" name="price"
                                        placeholder="Product Price" required value="{{ $product->SellingPrice }}">
                                </div>
                                <div class="col-4">
                                    <label class="col-form-label fw-bold" for="first-name">Details</label>
                                    <input type="text" id="first-name" class="form-control" name="details"
                                        placeholder="Product Details" value="{{ $product->description }}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-11">
                                    <strong class="fst-italic text-info">Select the materials that will be utilized in the
                                        manufacturing of the product.</strong>
                                </div>
                                <div class="col-1 d-flex justify-content-end">
                                    <button type="button" class="btn btn-sm btn-success" id="add_new_row"><i
                                            class="fa fa-plus"></i></button>
                                </div>
                            </div>
                            @foreach ($product->productDetails as $pro)
                            <div class="row mb-2" id="inputFormRow">
                                <div class="col-4">
                                    <label class="col-form-label fw-bold" for="first-name">Material</label>
                                    <select name="itemID[]" id="material_select" class="form-control" required>
                                        <option value="">--Select One--</option>
                                        @foreach ($items as $item)
                                            <option value="{{ $item->ItemID }}" {{ $pro->ItemID == $item->ItemID ? 'selected' : '' }}>{{ $item->ItemName }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-2">
                                    <label class="col-form-label fw-bold" for="first-name">Cost Price</label>
                                    <input type="text" readonly class="form-control" id="item_price" value="{{ $pro->item->CostPrice }}">
                                </div>
                                <div class="col-4">
                                    <label class="col-form-label fw-bold" for="first-name">Qunatity</label>
                                    <input type="number" step="any" class="form-control" required name="itemQty[]" value="{{ $pro->quantity }}">
                                </div>
                                <div class="col-1">
                                    <label class="col-form-label fw-bold" for="first-name">Unit</label>
                                    <input type="text" readonly class="form-control" id="item_unit" value="{{ $pro->item->UnitName }}">
                                </div>
                                <div class="col-1 mt-4 p-2 d-flex justify-content-end">
                                    <button type="button" id="removeRow" class="btn btn-sm btn-danger"><i
                                            class="fa fa-minus"></i></button>
                                </div>
                            </div>
                            @endforeach

                            <div id="filesDiv">
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
                    '<div class="col-4"><label class="col-form-label fw-bold" for="first-name">Material</label><select name="itemID[]" id="material_select" class="form-control" required><option value="">--Select One--</option>@foreach ($items as $item)<option value="{{ $item->ItemID }}">{{ $item->ItemName }}</option>@endforeach</select></div>';
                html +=
                    '<div class="col-2"><label class="col-form-label fw-bold" for="first-name">Cost Price</label><input id="item_price" type="text" readonly class="form-control"></div>'
                html +=
                    '<div class="col-4"><label class="col-form-label fw-bold" for="first-name">Qunatity</label><input name="itemQty[]" type="number" step="any" required class="form-control"></div>';
                html +=
                    '<div class="col-1"><label class="col-form-label fw-bold" for="first-name">Unit</label><input id="item_unit" type="text" readonly class="form-control"></div>'
                html +=
                    '<div class="col-1 mt-4 p-2 d-flex justify-content-end"><button type="button" id="removeRow" class="btn btn-sm btn-danger"><i class="fa fa-minus"></i></button></div>'
                html += '</div>';
                var newRow = $(html);
                $('#filesDiv').append(newRow);
            })
            $(document).on('click', '#removeRow', function() {
                $(this).closest('#inputFormRow').remove();
            });
            $(document).on('change', '#material_select', function() {
                var materialId = $(this).val();
                var costPrice = $(this).closest('#inputFormRow').find('#item_price');
                var Unit = $(this).closest('#inputFormRow').find('#item_unit');

                costPrice.val('');
                Unit.val('');
                $.ajax({
                    url: "{{ url('getMaterialDetails') }}",
                    method: 'POST',
                    data: {
                        id: materialId,
                    },
                    success: function(response) {
                        // alert(response.data.CostPrice);
                        costPrice.val(response.data.CostPrice);
                        Unit.val(response.data.UnitName);

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
            })
        });
    </script>
@endsection
