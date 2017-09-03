@extends('canteen/layouts/layout2') @section('body')
<div class="container-fluid">
    <div class="row no_padding">
        <div class="col-xl-4">
            <div class="container-fluid table">
                <div class="row back_header">
                    <div class="col-xl-7">Shop Management</div>
                    <div class="col-xl-2"></div>
                    <div class="col-xl-3">
                        <button type="button" class="btn btn-success">New Shop+</button>
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
                            <tr>
                                <th scope="row">1</th>
                                <td>เหนียวไก่</td>
                                <td>I-Canteen</td>
                                <td class="btn-group">
                                    <button type="button" class="btn btn-warning"><i class="fa fa-wrench" aria-hidden="true"></i></button>
                                    <button type="button" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-xl-8">
            <div class="container-fluid" style="">
                <div class="row">
                    <div class="col-lg-1"></div>
                    <div class="col-lg-10">
                        <div class="container-fluid store ">
                            <div class="row">
                                <div class="col-lg-4 no_padding">
                                    <div class="row">
                                        <div class="img">
                                            <img alt="Card image cap" src="img/food/test.jpg">
                                        </div>
                                    </div>
                                    <div class="row upload ">
                                        <div class="container-fluid no_padding">
                                            <label class="custom-file" id="customFile">
                                                <input type="file" class="custom-file-input" id="exampleInputFile" aria-describedby="fileHelp">
                                                <span class="custom-file-control form-control-file"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="row submit">
                                        <div class="container-fluid">
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <button type="button" class="btn btn-success btn-lg">Submit</button>
                                                <button type="button" class="btn btn-secondary btn-lg">Clear</button>
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
                                                        <span class="input-group-addon" id="lat">Lat</span>
                                                        <input type="text" class="form-control" aria-describedby="Lat">
                                                        <span class="input-group-addon" id="lng">Lng</span>
                                                        <input type="text" class="form-control" aria-describedby="Lng">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="container-fluid recommended no_padding">
                                            <div class="row">
                                                <div class="col-xl-3">Recommend </div>
                                                <div class="col-xl-9">
                                                    <input class="form-control" type="text" name="name" placeholder="Null" readonly/>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="container-fluid description">
                                            <div class="row">
                                                <label for="description">
                                                    <h4>Description</h4></label>
                                                <textarea class="form-control" id="description" placeholder="Description Here." rows="3"></textarea>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="container-fluid items">
                                            <div class="form-group">
                                                <label for="food">Foods</label>
                                                <select multiple class="form-control" id="food">
                                                    <option>1</option>
                                                    <option>2</option>
                                                    <option>3</option>
                                                    <option>4</option>
                                                    <option>5</option>
                                                </select>
                                            </div>
                                            <div class="row">
                                                <div class="col-xl-6">
                                                    <input type="text" class="form-control" id="foodname" placeholder="Foodname">
                                                </div>
                                                <div class="col-xl-2">
                                                    <button type="submit" class="btn btn-success">Add</button>
                                                </div>
                                                <div class="col-xl-3">
                                                    <button type="submit" class="btn btn-danger">Delete Selected</button>
                                                </div>
                                                <div class="col-xl-1"></div>
                                            </div>
                                            <hr>
                                            <div class="row special">
                                                <div class="col-xl-2 no_padding">
                                                    <p>Special</p>
                                                </div>
                                                <div class="col-xl-4">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" type="checkbox" value=""> Vegetarian
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-xl-4">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" type="checkbox" value=""> Halal
                                                        </label>
                                                    </div>
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