@extends('admin.layouts.app')

@section('main-content')

    <!-- Main Wrapper -->
    <div class="main-wrapper">

        @include('admin.layouts.header')
        @include('admin.layouts.menu')



        <!-- Page Wrapper -->
        <div class="page-wrapper">

            <div class="content container-fluid">

                <!-- Page Header -->
                <div class="page-header">
                    <div class="row">
                        <div class="col-sm-12">
                            <h3 class="page-title">Welcome {{ Auth::user()->name }}!</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item active">Product Brand</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- /Page Header -->


                <div class="row">

                    <div class="col-lg-12">

                        @include('validate')

                        <a class="btn btn-sm btn-primary" data-toggle="modal" href="#add_brand_modal">Add new
                            Brand</a>

                        <br>
                        <br>
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">All Brands</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="brand_table" class="table table-striped mb-0">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Brand Name</th>
                                                <th>Brand Slug</th>
                                                <th>Logo</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>

                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



            </div>
        </div>
        <!-- /Page Wrapper -->

    </div>
    <!-- /Main Wrapper -->


    <div id="add_brand_modal" class="modal fade">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <h2>Add new Brand</h2>
                    <hr>
                    <form id="brand_form" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="">Name</label>
                            <input name="name" type="text" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Logo</label>
                            <input name="logo" type="file" class="form-control">
                        </div>
                        <div class="form-group">
                            <input class="btn btn-primary btn-sm" type="submit">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>






    <div id="edit_brand_modal" class="modal fade">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <h2>Edit Category</h2>
                    <hr>
                    <form action="{{ route('category.update', 1) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="">Name</label>
                            <input name="name" type="text" class="form-control">
                            <input name="edit_id" type="hidden" class="form-control">
                        </div>
                        <div class="form-group">
                            <input class="btn btn-primary btn-sm" type="submit">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
