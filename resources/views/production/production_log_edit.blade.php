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
                    <form action="{{ url('ProductionLog/Update') }}" method="post" id="productionLogForm">
                        @csrf
                        <input type="hidden" name="id" value="{{ $production->InvoiceMasterID }}">
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-2">
                                    <label class="col-form-label fw-bold" for="first-name">Batch/LOT #</label>
                                </div>
                                <div class="col-4">
                                    <input type="text" id="first-name" class="form-control" name="BatchNo"
                                        placeholder="Batch/LOT Number" required readonly value="{{ $production->InvoiceNo }}">
                                </div>
                                <div class="col-2">
                                    <label class="col-form-label fw-bold" for="first-name">Reference #</label>
                                </div>
                                <div class="col-4">
                                    <input type="text" id="first-name" class="form-control"
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
                                        placeholder="Description" value="{{ $production->Subject }}">
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
                            </div>
                            {{-- @foreach ($production->productionLogDetails as $product) --}}
                            <div class="row mb-2" id="inputFormRow">
                                <div class="col-5">
                                    <select name="itemID" id="material_select" class="form-control" required>
                                        <option value="">--Select One--</option>
                                        @foreach ($items as $item)
                                            <option value="{{ $item->ItemID }}"
                                                {{ $productDetails->ItemID == $item->ItemID ? 'selected' : '' }}>
                                                {{ $item->ItemName }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-2">
                                    <input type="number" min="1" id="product_qty" step="1"
                                        class="form-control" required name="itemQty"
                                        value="{{ $productDetails->Qty }}">
                                </div>
                                <div class="col-2">
                                    <input type="number" step="0.01" class="form-control" id="item_price"
                                        name="rate" value="{{ $productDetails->Rate }}">
                                </div>
                                <div class="col-3">
                                    <input type="text" readonly class="form-control" name="total_value"
                                        id="total_value" value="{{ $productDetails->Total }}">
                                </div>
                            </div>
                            {{-- @endforeach --}}
                            <hr>
                            <div class="" id="materialsDiv">
                                <div class="row">
                                    <div class="col-11 text-center">
                                        <h4>Material Details</h4>
                                    </div>
                                    <div class="col-1 d-flex justify-content-end"><button type="button"
                                            class="btn btn-success btn-sm m-1" id="addRow"><i
                                                class="fa fa-plus"></i></button></div>
                                </div>
                                <div class="row">
                                    <div class="col-4">
                                        <label class="col-form-label fw-bold" for="first-name">Material Name</label>
                                    </div>
                                    <div class="col-3">
                                        <label class="col-form-label fw-bold" for="first-name">Quantity Per Unit</label>
                                    </div>
                                    <div class="col-3">
                                        <label class="col-form-label fw-bold" for="first-name">Total Quantity</label>
                                    </div>
                                    <div class="col-2">
                                        <label class="col-form-label fw-bold" for="first-name">In Stock</label>
                                    </div>
                                    {{-- <div class="col-2">
                                        <label class="col-form-label fw-bold" for="first-name">Remaining Stock</label>
                                    </div> --}}
                                </div>
                                <div id="newDiv">
                                    @foreach ($materialDetails as $value)
                                        <div class="row mb-2">
                                            <div class="col-4">
                                                <select required name="materialID[]" id="materialID"
                                                    class="form-control materialID">
                                                    <option value = ""> --Select Material-- </option>
                                                    @foreach ($materials as $material)
                                                        <option value = "{{ $material->ItemID }}"
                                                            {{ $value->ItemID == $material->ItemID ? 'selected' : '' }}>
                                                            {{ $material->ItemName }} </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-2">
                                                <input name="materialUnitQty[]" id="materialUnitQty" type="number"
                                                    step="0.01" class="form-control"
                                                    value="{{ $value->Qty / $productDetails->Qty }}">
                                            </div>
                                            <div class="col-3">
                                                <input name="materialTotalQty[]" id="materialTotalQty" type="number"
                                                    readonly class="form-control" value="{{ $value->Qty }}">
                                            </div>
                                            @php
                                                $data = DB::table('v_inventory1')
                                                    ->select('Balance')
                                                    ->where('ItemID', $value->ItemID)
                                                    ->first();
                                                if ($data) {
                                                    $stock = $data->Balance;
                                                } else {
                                                    $stock = 0;
                                                }
                                            @endphp
                                            <div class="col-2">
                                                <input name="" type="number" id="materialStock" readonly
                                                    class="form-control stockQty" value="{{ $stock }}">
                                            </div>
                                            <div class="col-1 d-flex justify-content-end"><button type="button"
                                                    class="btn btn-danger btn-sm m-1" id="removeRow"><i
                                                        class="fa fa-minus"></i></button></div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="d-flex justify-content-end">
                                <button type="button" id="submitBtn" class="btn btn-success">Update</button>
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
            $('#addRow').click(function() {
                var html = '';
                html += '<div class="row mb-2">';
                html +=
                    '<div class="col-4"><select required name="materialID[]" id="materialID" class="form-control materialID"><option value = "" > --Select Material-- </option>@foreach ($materials as $material)<option value = "{{ $material->ItemID }}" > {{ $material->ItemName }} </option>@endforeach</select></div>';
                html +=
                    '<div class="col-2"><input required name="materialUnitQty[]" id="materialUnitQty" type="number" step="0.01" class="form-control" value=""></div>';
                html +=
                    '<div class="col-3"><input name="materialTotalQty[]" id="materialTotalQty" type="number" readonly class="form-control" value=""></div>'
                html +=
                    '<div class="col-2"><input id="materialStock" name="" type="number" readonly class="form-control stockQty" value=""></div>'
                html +=
                    '<div class="col-1 d-flex justify-content-end"><button type="button" class="btn btn-danger btn-sm m-1" id="removeRow"><i class="fa fa-minus"></i></button></div>'
                html += '</div>';
                var newRow = $(html);
                $('#newDiv').append(newRow);
            })
            $(document).on('change', '#material_select', function() {
                let productId = $(this).val();
                let costPrice = $('#item_price');
                let productQty = $('#product_qty');
                let totalValue = $('#total_value');
                costPrice.val('');
                productQty.val('');
                totalValue.val('');
                $('#materialsDiv').addClass('d-none');
                $('#newDiv').empty();
                if (productId != '') {
                    $.ajax({
                        url: "{{ url('getProductDetails') }}",
                        method: 'POST',
                        data: {
                            id: productId,
                        },
                        success: function(response) {
                            // console.log(response.items);
                            let items = response.items;
                            costPrice.val(response.data.SellingPrice);
                            items.forEach(item => {
                                $.ajax({
                                    url: '/getMaterialStock/' + item.ItemID,
                                    type: 'GET',
                                    success: function(stock) {
                                        // alert(stock);
                                        $('#materialsDiv').removeClass(
                                            'd-none');
                                        var html = '';
                                        html += '<div class="row mb-2">';
                                        html +=
                                            '<div class="col-4"><input name="" type="text" readonly class="form-control" value="' +
                                            item.ItemName +
                                            '"><input name="materialID[]" type="hidden" id="materialID" class="form-control materialID" value="' +
                                            item.ItemID + '"></div>';
                                        html +=
                                            '<div class="col-2"><input name="materialUnitQty[]" id="materialUnitQty" type="number" step="0.01" class="form-control" value="' +
                                            item.quantity + '"></div>';
                                        html +=
                                            '<div class="col-3"><input name="materialTotalQty[]" id="materialTotalQty" type="number" readonly class="form-control" value=""></div>'
                                        html +=
                                            '<div class="col-2"><input name="" type="number" readonly class="form-control stockQty" value="' +
                                            stock.stock + '"></div>'
                                        html +=
                                            '<div class="col-1 d-flex justify-content-end"><button type="button" class="btn btn-danger btn-sm m-1" id="removeRow"><i class="fa fa-minus"></i></button></div>'
                                        html += '</div>';

                                        var newRow = $(html);
                                        $('#newDiv').append(newRow);
                                    },
                                    error: function(xhr, textStatus,
                                        errorThrown) {
                                        if (xhr.status == 422 && xhr
                                            .responseJSON && xhr
                                            .responseJSON
                                            .errors) {
                                            // Handle validation errors
                                            var errors = xhr.responseJSON
                                                .errors;
                                            alert("Validation Error: " +
                                                Object.values(errors)
                                                .flat().join(
                                                    ", "));
                                        } else {
                                            // Handle other types of errors
                                            alert('Error: ' + errorThrown);
                                        }
                                    }
                                })
                            });
                        },
                        error: function(xhr, textStatus, errorThrown) {
                            if (xhr.status == 422 && xhr.responseJSON && xhr.responseJSON
                                .errors) {
                                // Handle validation errors
                                var errors = xhr.responseJSON.errors;
                                alert("Validation Error: " + Object.values(errors).flat().join(
                                    ", "));
                            } else {
                                // Handle other types of errors
                                alert('Error: ' + errorThrown);
                            }
                        }
                    });
                }
            });
            $(document).on('change keyup', '#product_qty', function() {
                let unitQtys = [];
                let Price = $('#item_price').val();
                let totalValue = $('#total_value');
                if ($(this).val() != '') {
                    let productQty = parseFloat($(this).val());
                    // alert(productQty)
                    totalValue.val((productQty * Price).toFixed(2));
                    $(document).find("input[name='materialUnitQty[]']").each(function() {
                        unitQtys.push($(this).val());
                    });
                    // console.log(unitQtys);
                    $("input[name='materialTotalQty[]']").each(function(i) {
                        $(this).val((unitQtys[i] * productQty).toFixed(2));
                    });
                } else {
                    totalValue.val('');
                    $("input[name='materialTotalQty[]']").each(function(i) {
                        $(this).val('');
                    });
                }

            });
            $(document).on('change keyup', '#item_price', function() {
                let productQty = $('#product_qty').val();
                let totalValue = $('#total_value');
                if ($(this).val() != '') {
                    let Price = parseFloat($(this).val());
                    totalValue.val((productQty * Price).toFixed(2));
                } else {
                    totalValue.val('');
                }
            })
            $(document).on('change keyup', '#materialUnitQty', function() {
                let productQty = $('#product_qty').val();
                let Qty = $(this).val();
                let materialTotalQty = $(this).closest('.row').find('#materialTotalQty');
                if (productQty != '') {
                    // alert(materialTotalQty.val());
                    materialTotalQty.val((productQty * Qty).toFixed(2));
                    // alert(productQty);
                }
            });
            $(document).on('click', '#removeRow', function() {
                $(this).closest('.row').remove();
            });
            $(document).on('change', '#materialID', function() {
                let selectedmaterialID = $(this).val();
                let selectedmaterialStock = $(this).closest('.row').find('#materialStock');
                $(this).closest('.row').find('#materialUnitQty').val('');
                $(this).closest('.row').find('#materialTotalQty').val('');
                selectedmaterialStock.val('');
                $.ajax({
                    url: '/getMaterialStock/' + selectedmaterialID,
                    type: 'GET',
                    success: function(stock) {
                        selectedmaterialStock.val(stock.stock)
                    },
                    error: function(xhr, textStatus,
                        errorThrown) {
                        if (xhr.status == 422 && xhr
                            .responseJSON && xhr
                            .responseJSON
                            .errors) {
                            // Handle validation errors
                            var errors = xhr.responseJSON
                                .errors;
                            alert("Validation Error: " +
                                Object.values(errors)
                                .flat().join(
                                    ", "));
                        } else {
                            // Handle other types of errors
                            alert('Error: ' + errorThrown);
                        }
                    }
                })

            });
            $('#submitBtn').click(function() {
                // alert('hahahahha');
                let stockQty = 0;
                let matCheck = 1;
                let QtyCheck = 1;
                let ProQty = $('#product_qty').val();
                let Product = $('#material_select').val();
                let materialCount = $(document).find('.materialID');
                if (Product == '') {
                    alert('Please Select Product');
                    $('#material_select').select();
                } else if (ProQty == '') {
                    alert('Please Add Product Quantity');
                    $('#product_qty').focus();
                } else if (materialCount.length < 2) {
                    alert('Please Select At least 2 materials for the Product');
                    $('#addRow').click();
                } else {
                    $(document).find('.materialID').each(function() {
                        if ($(this).val() == '') {
                            alert('Please Select the Material');
                            matCheck = 0;
                            return false;
                        } else {
                            matCheck = 1;
                        }
                    });
                    if (matCheck == 1) {
                        $(document).find("input[name='materialUnitQty[]").each(function() {
                            if ($(this).val() == '') {
                                alert('Please Add the Material Per Unit Quantity');
                                $(this).focus();
                                QtyCheck = 0;
                                return false;
                            } else {
                                QtyCheck = 1;
                            }
                        });
                    }
                    if (matCheck == 1 && QtyCheck == 1) {
                        $(document).find(".stockQty").each(function() {
                            if ($(this).val() == 0) {
                                stockQty = 0;
                                return false;
                            } else {
                                stockQty = $(this).val();
                            }
                        });
                        // if (stockQty == 0) {
                        //     alert("You Cannot Create This Product You Don't Have Enough Stock Of the Materials");
                        // } else {
                        $('#productionLogForm').submit();
                        // }
                    }

                }

            });
        });
    </script>
@endsection
