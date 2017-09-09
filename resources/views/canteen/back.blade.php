@extends('canteen/layouts/layout2') @section('body')
<div class="container-fluid">
    <div class="row no_padding">
        <div class="col-xl-4">
            <div class="container-fluid table">
                <div class="row back_header">
                    <div class="col-xl-7">Shop Management</div>
                    <div class="col-xl-2"></div>
                    <div class="col-xl-3">
                        <button type="button" class="btn btn-success" name="new">New Shop+</button>
                    </div>
                </div>
                <div class="container-fluid no_padding">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Canteen</th>
                                <th>Edit/Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $count = count($shops);
                            @endphp
                            @for ($i = 0; $i < $count; ++$i)
                            <tr>
                                <th scope="row">{{ $shops[$i]['shop_id'] }}</th>
                                <td>{{ $shops[$i]['shop_name'] }}</td>
                                <td>{{ $shops[$i]['shop_location'] }}</td>
                                <td class="btn-group">
                                    <button type="button" class="btn btn-warning" name="edit" data-id={{ $shops[$i]['shop_id'] }}><i class="fa fa-wrench" aria-hidden="true"></i></button>
                                    <button type="button" class="btn btn-danger" name="delete" data-id={{ $shops[$i]['shop_id'] }}><i class="fa fa-trash" aria-hidden="true"></i></button>
                                </td>
                            </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-xl-8">
            <div class="container-fluid" style="display: none;">
                <div class="row">
                    <div class="col-lg-1"></div>
                    <div class="col-lg-10">
                        <div class="container-fluid store">
                            <div class="row">
                                <div class="col-lg-4 no_padding">
                                    <div class="row">
                                        <div class="img">
                                            <img alt="Card image cap" src="img/food/test.jpg">
                                        </div>
                                    </div>
                                    <div class="row upload ">
                                        <div class="container-fluid no_padding">
                                        <form action="{{  route('upload-post') }}" class="dropzone" id="real-dropzone">
                                            <label class="custom-file" id="customFile">
                                                <input type="file" class="custom-file-input" name="file" aria-describedby="fileHelp">
                                                <span class="custom-file-control form-control-file"></span>
                                            </label>
                                        </form>
                                        </div>
                                    </div>
                                    <div class="row submit">
                                        <div class="container-fluid">
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <button type="button" name="submit" class="btn btn-success btn-lg">Submit</button>
                                                <button type="button" name="clear" class="btn btn-secondary btn-lg">Clear</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-8 ">
                                    <div class="container-fluid title">
                                        <div class="container-fluid no_padding">
                                            <div class="row">
                                                <div class="col-xl-3">Name </div>
                                                <div class="col-xl-9">
                                                    <input class="form-control" type="hidden" name="id" disabled="" />
                                                    <input class="form-control" type="text" name="name" placeholder="Enter name here." />
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="container-fluid no_padding">
                                            <div class="row">
                                                <div class="col-xl-3">Canteen </div>
                                                <div class="col-xl-9">
                                                    <input class="form-control" type="text" name="canteen" placeholder="Enter name here." />
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="container-fluid no_padding">
                                            <div class="row">
                                                <div class="col-xl-3">Location </div>
                                                <div class="col-xl-9">
                                                    <div class="input-group">
                                                        <span class="input-group-addon">Lat</span>
                                                        <input type="text" class="form-control" aria-describedby="Lat"  name="lat">
                                                        <span class="input-group-addon">Lng</span>
                                                        <input type="text" class="form-control" aria-describedby="Lng"  name="lng">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="container-fluid no_padding">
                                            <div class="row">
                                                <div class="col-xl-3">Open time </div>
                                                <div class="col-xl-9">
                                                    <input class="form-control" type="text" name="time" placeholder="00:00 - 00:00" />
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="container-fluid no_padding">
                                            <div class="row">
                                                    <div class="col-xl-3">
                                                        <p>Special</p>
                                                    </div>
                                                    <div class="col-xl-4">
                                                        <div class="form-check">
                                                            <label class="form-check-label">
                                                                <input class="form-check-input" name="vege" type="checkbox" value=""> Vegetarian
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-4">
                                                        <div class="form-check">
                                                            <label class="form-check-label">
                                                                <input class="form-check-input" name="halal" type="checkbox" value=""> Halal
                                                            </label>
                                                        </div>
                                                    </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="container-fluid description">
                                            <div class="row">
                                                <label for="description">
                                                    <h4>Description</h4></label>
                                                <textarea class="form-control" name="description" placeholder="Description Here." rows="3"></textarea>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="container-fluid items">
                                            <div class="form-group">
                                                <label for="food">Foods</label>
                                                <select multiple class="form-control" name="food">
                                                    <option>1</option>
                                                    <option>2</option>
                                                    <option>3</option>
                                                    <option>4</option>
                                                    <option>5</option>
                                                </select>
                                            </div>
                                            <div class="row">
                                                <div class="col-xl-6">
                                                    <input type="text" class="form-control" name="foodname" placeholder="Foodname">
                                                </div>
                                                <div class="col-xl-2">
                                                    <button type="submit" class="btn btn-success" name="add">Add</button>
                                                </div>
                                                <div class="col-xl-3">
                                                    <button type="submit" class="btn btn-danger" name="food_delete">Delete Selected</button>
                                                </div>
                                                <div class="col-xl-1"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-1"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection