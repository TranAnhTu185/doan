@extends('layouts.admin')
@section('title')
Tài khoản
@endsection
@section('content')
<div class="content-wrapper">
    <div class="page-header">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Bảng điều khiển</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tài khoản</li>
            </ol>
        </nav>
        <a href="{{ route('admin.user.create') }}" class="mr-4">
            <button type="button" class="btn btn-primary btn-rounded btn-icon float-right">
                <i class="fa fa-plus"></i>
            </button>
        </a>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">
                        <div id="order-listing_wrapper"
                            class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer">
                            <div class="row">
                                <div class="col-sm-12">
                                    <table id="order-listing" class="table dataTable no-footer" role="grid"
                                        aria-describedby="order-listing_info">
                                        <thead>
                                            <tr role="row">
                                                <th>#</th>
                                                <th>Họ tên</th>
                                                <th>Email</th>
                                                <th>Thao tác</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php $i=1 @endphp
                                                @foreach($users as $user)
                                                    <tr>
                                                        <td>{{$i++}}</td>
                                                        <td>{{ ucwords($user->name) }}</td>
                                                        <td>{{$user->email}}</td>
                                                        <td>
                                                            {{-- <a
                                                                href="{{ route('admin.user.show', $user->id) }}">
                                                                <button type="button"
                                                                    class="btn btn-info btn-rounded btn-icon">
                                                                    <i class="fa fa-eye"></i>
                                                                </button>
                                                            </a> --}}
                                                            <a
                                                                href="{{ route('admin.user.edit', $user->id) }}">
                                                                <button type="button"
                                                                    class="btn btn-dark btn-rounded btn-icon">
                                                                    <i class="fa fa-edit"></i>
                                                                </button>
                                                            </a>
                                                            @if (count($users) != 1)
                                                            <a
                                                                href="{{ route('admin.user.destroy', $user->id) }}"onclick="return confirm('Do you want to delete this user?')">
                                                                <button type="button"
                                                                    class="btn btn-danger btn-rounded btn-icon">
                                                                    <i class="fa fa-trash-o"></i>
                                                                </button>
                                                            </a>
                                                            @endif
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
    </div>
</div>
@endsection
