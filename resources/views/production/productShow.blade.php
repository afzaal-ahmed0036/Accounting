@extends('template.tmp')
@section('title', $pagetitle)
@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">Product Deatails</h4>
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
                    <div class="card-body">
                        <div class="row">
                            <strong class="fst-italic text-info mb-3" align="center">Product Basic Information.</strong>
                            <div class="col-4">
                                <div class="card" align="center">
                                    <div class="card-header">
                                        <strong>Name</strong>
                                    </div>
                                    <div class="card-body">
                                        {{ $product->ItemName }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="card" align="center">
                                    <div class="card-header">
                                        <strong>Price</strong>
                                    </div>
                                    <div class="card-body">
                                        {{ $product->SellingPrice }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="card" align="center">
                                    <div class="card-header">
                                        <strong>Details</strong>
                                    </div>
                                    <div class="card-body">
                                        {{ $product->description }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col" align="center">
                                <strong class="fst-italic text-info mb-3">Materials that will be utilized in the
                                    manufacturing of the product.</strong>
                            </div>
                        </div>
                        <div class="table">
                            <table class="table table-striped text-center">
                                <thead>
                                    <tr>
                                        <th>Material Name</th>
                                        <th>Material Quantity</th>
                                        <th>Material Cost</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($product->productDetails as $item)
                                        <tr>
                                            <td>
                                                {{ $item->ItemName }}
                                            </td>
                                            <td>
                                                {{ $item->quantity }}
                                            </td>
                                            <td>
                                                {{ $item->itemCost }}

                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
