@extends('canteen/layouts/layout2')

@section('body')

<!-- Logged In -->
    <br>
    <div class="container">
    <br>
    <div class="row">
        <div class="col-lg-1"></div>
        <div class="col-lg-8">
            <div class="container-fluid store">
                <div class="row">
                    <div class="col-lg-4 no-padding">
                        <div class="img">
                            <img alt="Card image cap" src="img/food/test.jpg">
                        </div>
                        <!-- The fileinput-button span is used to style the file input field as button -->
                        <span class="btn btn-success fileinput-button">
                            <i class="glyphicon glyphicon-plus"></i>
                            <span>Add files...</span>
                            <!-- The file input field used as target for the file upload widget -->
                            <input id="fileupload" type="file" name="files[]" multiple>
                        </span>
                        <br>
                        <br>
                        <!-- The global progress bar -->
                        <div id="progress" class="progress">
                            <div class="progress-bar progress-bar-success"></div>
                        </div>
                        <!-- The container for the uploaded files -->
                        <div id="files" class="files"></div>
                        <br>
                    </div>
                    <div class="col-lg-8">
                        <div class="title" style="font-size: 1em; height: 100px;">
                            <div class="inlineLeft">
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">Store name:</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="name" placeholder="Store name" value="น้ำ" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="inlineRight goBack">
                                <a class="back" onclick="">Submit</i></a>
                            </div>
                            <br>
                            <hr>
                            <div class="recommended">
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">Recommeded : </label>
                                    <div class="col-sm-8">
                                        <input type="text" name="recomended" placeholder="Store name" value="Null" class="form-control" disabled="">
                                    </div>
                                </div>
                            </div>
                            <hr>
                        </div>
                        <div class="description">
                            <textarea name="description" class="form-control">test</textarea>
                        </div>
                        <div class="food">
                            <div class="form-group row" style="min-height:initial;">
                                <label class="col-sm-2">food:</label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                    <input type="text" class="form-control" name="food[]" value="ข้าวผัดกะเพรา">
                                    <span class="input-group-btn">
                                        <button class="btn btn-secondary" type="button">Add</button>
                                    </span>
                                </div>
                                </div>
                            </div>
                            <div class="row" style="min-height:initial;">
                                <div class="col-sm-6">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="food[]" value="ข้าวผัดกะเพรา" disabled="">
                                        <span class="input-group-btn">
                                            <button class="btn btn-secondary" type="button">Del</button>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="food[]" value="ข้าวผัดกะเพรา" disabled="">
                                        <span class="input-group-btn">
                                            <button class="btn btn-secondary" type="button">Del</button>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="food[]" value="ข้าวผัดกะเพรา" disabled="">
                                        <span class="input-group-btn">
                                            <button class="btn btn-secondary" type="button">Del</button>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="food[]" value="ข้าวผัดกะเพรา" disabled="">
                                        <span class="input-group-btn">
                                            <button class="btn btn-secondary" type="button">Del</button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="footer"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-1"></div>
    </div>
</div>
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