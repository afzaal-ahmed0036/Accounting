@extends('template.tmp')
@section('title', $pagetitle)
@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">Add Production Log Deatails</h4>
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
                    <form action="{{ url('Production/Log/Save') }}" method="post" id="productionLogForm">
                        @csrf
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-2">
                                    <label class="col-form-label fw-bold" for="first-name">Batch/LOT #</label>
                                </div>
                                <div class="col-4">
                                    <input type="text" id="first-name" class="form-control" name="BatchNo"
                                        placeholder="Batch/LOT Number" required readonly value="{{ $invoice_no }}">
                                </div>
                                <div class="col-2">
                                    <label class="col-form-label fw-bold" for="first-name">Reference #</label>
                                </div>
                                <div class="col-4">
                                    <input type="number" step="0.001" id="first-name" class="form-control"
                                        name="ReferenceNo" placeholder="Reference Number" required
                                        value="{{ $referenceNo }}" readonly required>
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
                                            data-date-autoclose="true" value="{{ date('Y-m-d') }}">
                                        <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <label class="col-form-label fw-bold" for="first-name">Description</label>
                                </div>
                                <div class="col-4">
                                    <input type="text" id="first-name" class="form-control" name="description"
                                        placeholder="Description" value="{{ old('description') }}">
                                </div>
                            </div>
                            <hr>
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col d-flex justify-content-between">
                                            <h4>Input Consumtion</h4>
                                            <button type="button" class="btn btn-success"
                                                id="addMatRow"><strong>+</strong></button>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-3">
                                            <label class="col-form-label fw-bold" for="first-name">Material
                                                Name</label>
                                        </div>
                                        <div class="col-2">
                                            <label class="col-form-label fw-bold" for="first-name">Stock Value</label>
                                        </div>
                                        <div class="col-2">
                                            <label class="col-form-label fw-bold" for="first-name">Quantity</label>
                                        </div>
                                        <div class="col-2">
                                            <label class="col-form-label fw-bold" for="first-name">Cost</label>
                                        </div>

                                        <div class="col-2">
                                            <label class="col-form-label fw-bold" for="first-name">Amount</label>
                                        </div>
                                        <div class="col-1 d-flex justify-content-end">
                                            <label class="col-form-label fw-bold" for="first-name">Action</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-3">
                                            <select required name="materialID[]" id="materialID"
                                                class="form-control materialID Item">
                                                <option value = ""> --Select Material-- </option>
                                                @foreach ($materials as $material)
                                                    <option value = "{{ $material->ItemID }}"> {{ $material->ItemName }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-2">
                                            <input id="materialStock" name="" type="number" readonly
                                                class="form-control stockQty" value="">
                                        </div>
                                        <div class="col-2">
                                            <input name="materialQty[]" id="matQty" type="number"
                                                class="form-control totalCalcQty" required step="any" value="">
                                        </div>
                                        <div class="col-2">
                                            <input name="materialCost[]" id="matCost" type="number" step="any"
                                                class="form-control totalCalcCost" value="" required>
                                        </div>
                                        <div class="col-2">
                                            <input name="materialAmount[]" id="matAmount" type="number" step="any"
                                                class="form-control totalCalcAmount" value="" readonly required>
                                        </div>
                                        <div class="col-1 d-flex justify-content-end">
                                            <button type="button" class="btn btn-danger btn-sm m-1" id="removeRow"><i
                                                    class="fa fa-minus"></i></button>
                                        </div>
                                    </div>
                                    <div id="matDiv">
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col d-flex justify-content-between">
                                            <h4>Output Production</h4>
                                            <button type="button" class="btn btn-success"
                                                id="addProdRow"><strong>+</strong></button>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-3">
                                            <label class="col-form-label fw-bold" for="first-name">Product
                                                Name</label>
                                        </div>
                                        <div class="col-2">
                                            <label class="col-form-label fw-bold" for="first-name">Quantity</label>
                                        </div>
                                        <div class="col-2">
                                            <label class="col-form-label fw-bold" for="first-name">Unit Quantity</label>
                                        </div>
                                        <div class="col-2">
                                            <label class="col-form-label fw-bold" for="first-name">Cost</label>
                                        </div>

                                        <div class="col-2">
                                            <label class="col-form-label fw-bold" for="first-name">Amount</label>
                                        </div>
                                        <div class="col-1 d-flex justify-content-end">
                                            <label class="col-form-label fw-bold" for="first-name">Action</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-3">
                                            <select required name="productID[]" id="productID"
                                                class="form-control productID Item">
                                                <option value = ""> --Select Product-- </option>
                                                @foreach ($items as $product)
                                                    <option value = "{{ $product->ItemID }}"> {{ $product->ItemName }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-2">
                                            <input name="productQty[]" id="prodQty" type="number"
                                                class="form-control totalCalcQty" step="any" value="" required>
                                        </div>
                                        <div class="col-2">
                                            <select required name="productUnitQty[]" id="prodUnitQty"
                                                class="form-control prodUnitQty">
                                                <option value = ""> --Select Unit-- </option>
                                                @foreach ($units as $unit)
                                                    <option value = "{{ $unit->UnitID }}"> {{ $unit->UnitName }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-2">
                                            <input name="productCost[]" id="prodCost" type="number" step="any"
                                                class="form-control totalCalcCost" value="" required>
                                        </div>
                                        <div class="col-2">
                                            <input name="productAmount[]" id="prodAmount" type="number" step="any"
                                                class="form-control totalCalcAmount" value="" readonly required>
                                        </div>
                                        <div class="col-1 d-flex justify-content-end">
                                            <button type="button" class="btn btn-danger btn-sm m-1" id="removeRow"><i
                                                    class="fa fa-minus"></i></button>
                                        </div>
                                    </div>
                                    <div id="prodDiv">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="d-flex justify-content-end">
                                <button type="submit" id="submitBtn" class="btn btn-success">Save</button>
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
            $('#addMatRow').click(function() {
                var html = '';
                html += '<div class="row mt-2">';
                html +=
                    '<div class="col-3"><select required name="materialID[]" id="materialID" class="form-control materialID Item"><option value = ""> --Select Material-- </option>@foreach ($materials as $material) <option value = "{{ $material->ItemID }}"> {{ $material->ItemName }}</option>@endforeach</select></div>';
                html +=
                    '<div class="col-2"><input id="materialStock" name="" type="number" readonly class="form-control stockQty" value=""></div>';
                html +=
                    '<div class="col-2"><input id="matQty" name="materialQty[]" type="number" class="form-control totalCalcQty" step="any" value="" required></div>';
                html +=
                    '<div class="col-2"><input name="materialCost[]" id="matCost" type="number" step="any" class="form-control totalCalcCost" value="" required></div>';
                html +=
                    '<div class="col-2"><input id="matAmount" readonly name="materialAmount[]" type="number" step="any" class="form-control totalCalcAmount" value="" required></div>';
                html +=
                    '<div class="col-1 d-flex justify-content-end"><button type="button" class="btn btn-danger btn-sm m-1" id="removeRow"><i class="fa fa-minus"></i></button></div>';
                html += '</div>';
                var newRow = $(html);
                $('#matDiv').append(newRow);
            });
            $('#addProdRow').click(function() {
                var html = '';
                html += '<div class="row mt-2">';
                html +=
                    '<div class="col-3"><select required name="productID[]" id="productID" class="form-control productID Item"><option value = ""> --Select Product-- </option>@foreach ($items as $product)<option value = "{{ $product->ItemID }}"> {{ $product->ItemName }}</option>@endforeach</select></div>';
                html +=
                    '<div class="col-2"><input name="productQty[]" id="prodQty" type="number" class="form-control totalCalcQty" step="any" value="" required></div>';
                html +=
                    '<div class="col-2"><select required name="productUnitQty[]" id="prodUnitQty" class="form-control prodUnitQty"><option value = ""> --Select Unit-- </option>@foreach ($units as $unit)<option value = "{{ $unit->UnitID }}"> {{ $unit->UnitName }}</option>@endforeach</select></div>';
                html +=
                    '<div class="col-2"><input name="productCost[]" id="prodCost" type="number" step="any" class="form-control totalCalcCost" value="" required></div>';
                html +=
                    '<div class="col-2"><input name="productAmount[]" readonly id="prodAmount" required type="number" step="any" class="form-control totalCalcAmount" value=""></div>';
                html +=
                    '<div class="col-1 d-flex justify-content-end"><button type="button" class="btn btn-danger btn-sm m-1" id="removeRow"><i class="fa fa-minus"></i></button></div>';
                html += '</div>';
                var newRow = $(html);
                $('#prodDiv').append(newRow);
            });
            $(document).on('change', '#materialID', function() {
                let selectedmaterialID = $(this).val();
                let selectedmaterialStock = $(this).closest('.row').find('#materialStock');
                let selectedmaterialCost = $(this).closest('.row').find('#matCost');
                let selectedmaterialQty = $(this).closest('.row').find('#matQty');
                let selectedmaterialAmount = $(this).closest('.row').find('#matAmount');
                selectedmaterialStock.val('');
                selectedmaterialCost.val('');
                selectedmaterialQty.val('');
                selectedmaterialAmount.val('');
                if (selectedmaterialID != '') {
                    $.ajax({
                        url: '/getMaterialStock/' + selectedmaterialID,
                        type: 'GET',
                        success: function(stock) {
                            // alert(stock.item.CostPrice);
                            selectedmaterialStock.val(stock.stock);
                            selectedmaterialCost.val(stock.item.CostPrice);
                            selectedmaterialQty.val(1);
                            selectedmaterialAmount.val(stock.item.CostPrice * 1);
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

                }
            });
            $(document).on('change', '#productID', function() {
                let selectedProdID = $(this).val();
                let selectedProdCost = $(this).closest('.row').find('#prodCost');
                let selectedProdQty = $(this).closest('.row').find('#prodQty');
                let selectedProdAmount = $(this).closest('.row').find('#prodAmount');
                let selectedProdUnitQty = $(this).closest('.row').find('#prodUnitQty');
                selectedProdCost.val('');
                selectedProdQty.val('');
                selectedProdAmount.val('');
                selectedProdUnitQty.val('');
                if (selectedProdID != '') {
                    $.ajax({
                        url: '/getMaterialStock/' + selectedProdID,
                        type: 'GET',
                        success: function(stock) {
                            selectedProdCost.val(stock.item.SellingPrice);
                            selectedProdQty.val(1);
                            selectedProdAmount.val(stock.item.SellingPrice * 1);
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

                }
            });
            $(document).on('keyup', '#prodCost, #prodQty, #matCost, #matQty', function() {
                // alert('here');
                var total = 0;
                var cost = $(this).closest('.row').find('.totalCalcCost');
                var qty = $(this).closest('.row').find('.totalCalcQty');
                var amount = $(this).closest('.row').find('.totalCalcAmount');
                var item = $(this).closest('.row').find('.Item');
                if (item.val() === '') {
                    alert('Please the Item First');
                    item.focus();
                    cost.val('');
                    qty.val('');
                    amount.val('');
                } else {
                    if (cost.val() > 1 && qty.val() > 1) {
                        total = cost.val() * qty.val();
                        amount.val(total.toFixed(2));
                    } else {
                        cost.val('');
                        qty.val('');
                        amount.val('');
                    }
                }

            });
            function calculateTotal() {

            };
            $(document).on('click', '#removeRow', function() {
                $(this).closest('.row').remove();
            });
        });
    </script>
@endsection
