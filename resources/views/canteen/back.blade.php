@extends('canteen/layouts/layout2')

@section('body')

<!-- Logged In -->
    <br>
    <div class="row">
        <div class="col-lg-2"></div>
        <div class="col-lg-8">
            <div class="row content-box">
                <p class="display-4">Shop Management</p>
                <table class="table table-hover" id="myTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Canteen</th>
                            <th>Description</th>
                            <th>Card IMG</th>
                            <th>Header IMG</th>
                            <th>Edit/Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="table-dark">
                            <th scope="row"></th>
                            <td><input class="form-control" type="text" id="name" placeholder="ชื่อร้าน"></td>
                            <td><input class="form-control" type="text" id="location" placeholder="โรงอาหาร"></td>
                            <td><input class="form-control" type="text" id="description" placeholder="Description"></td>
                            <td>
                                <button type="button" class="btn btn-secondary">None</button>
                            </td>
                            <td>
                                <button type="button" class="btn btn-secondary">None</button>
                            </td>
                            <td class="btn-group">
                                <button type="button" class="btn btn-success" onclick="add();">Add</button>
                            </td>
                        </tr>
                        @for ($i = 0; $i < count($shops); $i++)
                        <tr class="clickable">
                            <th scope="row">{{ $shops[$i]['shop_id'] }}</th>
                            <td>{{ $shops[$i]['shop_name'] }}</td>
                            <td>{{ $shops[$i]['shop_location'] }}</td>
                            <td>{{ $shops[$i]['shop_description'] }}</td>
                            <td>
                                <button type="button" class="btn btn-success">OK!</button>
                            </td>
                            <td>
                                <button type="button" class="btn btn-success">OK!</button>
                            </td>
                            <td class="btn-group">
                                <button type="button" class="btn btn-warning"><i class="fa fa-wrench" aria-hidden="true"></i></button>
                                <button type="button" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button>
                            </td>
                        </tr>
                        @endfor
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-lg-2"></div>
    </div>

@endsection