@extends('canteen/layout')

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
                            <td><input class="form-control" type="text" placeholder="ชื่อร้าน"></td>
                            <td><input class="form-control" type="text" placeholder="โรงอาหาร"></td>
                            <td><input class="form-control" type="text" placeholder="Description"></td>
                            <td>
                                <button type="button" class="btn btn-secondary">None</button>
                            </td>
                            <td>
                                <button type="button" class="btn btn-secondary">None</button>
                            </td>
                            <td class="btn-group">
                                <button type="button" class="btn btn-success">Add</button>
                            </td>
                        </tr>
                        <tr class="clickable">
                            <th scope="row">1</th>
                            <td>เหนียวไก่</td>
                            <td>I-Canteen</td>
                            <td>ใส่ข้อมูล เมนู ของร้านนั้นๆ</td>
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
                        <tr class="clickable">
                            <th scope="row">2</th>
                            <td>ก๋วยเตี๋ยวตึกจุล</td>
                            <td>โรงอาหารตึกจุล</td>
                            <td>ใส่ข้อมูล เมนู ของร้านนั้นๆ</td>
                            <td>
                                <button type="button" class="btn btn-success">OK!</button>
                            </td>
                            <td>
                                <button type="button" class="btn btn-secondary">None</button>
                            </td>
                            <td class="btn-group">
                                <button type="button" class="btn btn-warning"><i class="fa fa-wrench" aria-hidden="true"></i></button>
                                <button type="button" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button>
                            </td>
                        </tr>
                        <tr class="clickable">
                            <th scope="row">3</th>
                            <td>ปังเย็นครุ</td>
                            <td>โรงอาหารครุ</td>
                            <td>ใส่ข้อมูล เมนู ของร้านนั้นๆ</td>
                            <td>
                                <button type="button" class="btn btn-secondary">None</button>
                            </td>
                            <td>
                                <button type="button" class="btn btn-secondary">None</button>
                            </td>
                            <td class="btn-group">
                                <button type="button" class="btn btn-warning"><i class="fa fa-wrench" aria-hidden="true"></i></button>
                                <button type="button" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-lg-2"></div>
    </div>

@endsection