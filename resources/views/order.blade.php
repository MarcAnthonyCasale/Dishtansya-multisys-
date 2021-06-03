@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Place Order now</div>

                <div class="card-body">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>Products No.</th>
                                <th>Product Name</th>
                                <th>Available_stocks</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $prod)
                            <tr>
                                <td>{{ $prod->id }}</td>
                                <td>{{ $prod->name }}</td>
                                <td>{{ $prod->available_stocks }}</td>
                                <td>
                                    <div class="card-body">
                                        <form method="POST" action="api/order">
                                            <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">  
                                            <div class="form-group row">
                                                <input type="hidden" id="product_id" name = "product_id" value={{$prod->id}}>  
                                                <input type="number" id="quantity" class="form-control" name="quantity" style="width:80px">
                                                <button type="submit" class="btn btn-primary">Order Now</button>
                                            </div>
                                        </form>   
                                    </div>     
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
@endsection
