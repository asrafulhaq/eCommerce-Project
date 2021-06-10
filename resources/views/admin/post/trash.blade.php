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
                            <h3 class="page-title">Welcome {{ Auth::user() -> name }}!</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item active">Tag</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- /Page Header -->


                <div class="row">

                    <div class="col-lg-12">

                        @include('validate')

                        <a class="btn btn-sm btn-primary" href="{{ route('post.create') }}">Add new Post</a>

                        <br>
                        <br>
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">All Posts (Trash)</h4>
                                <a class="badge badge-primary" href="{{ route('post.index') }}">Published {{ ($published == 0 ? '' : $published) }}</a>
                                <a class="badge badge-danger" href="{{ route('post.trash') }}">Trash {{ ($trash == 0 ? '' : $trash) }}</a>

                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped mb-0">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Title</th>
                                            <th>Post Type</th>

                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        @foreach( $all_data as $data )

                                            @php
                                                $featured_data = json_decode($data -> featured);
                                            @endphp

                                            <tr>
                                                <td>{{ $loop -> index + 1 }}</td>
                                                <td>{{ $data -> title }}</td>
                                                <td>{{ $featured_data -> post_type  }}</td>
                                                <td>
                                                    <a class="btn btn-sm btn-info" href="{{ route('post.trash.update', $data-> id) }}">Data Recover</a>
                                                    <form class="d-inline-block" action="{{ route('post.destroy', $data -> id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-danger btn-sm">Delete Permanently</button>
                                                    </form>
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
        </div>
        <!-- /Page Wrapper -->

    </div>
    <!-- /Main Wrapper -->


@endsection
