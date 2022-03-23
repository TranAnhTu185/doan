@extends('layouts.admin')
@section('title', 'Thông tin cửa hàng')
@section('css')
<style>
    .input-sm {
        height: 30px;
        padding: 5px 10px;
        font-size: 12px;
        line-height: 3;
        border-radius: 3px;
    }

    .form-control {
        display: block;
        width: 100%;
        height: 34px;
        padding: 6px 12px;
        font-size: 14px;
        color: #555555;
        vertical-align: middle;
        background-color: #ffffff;
        border: 1px solid #cccccc;
        border-radius: 4px;
        -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
        box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
        -webkit-transition: border-color ease-in-out 0.15s, box-shadow ease-in-out 0.15s;
        transition: border-color ease-in-out 0.15s, box-shadow ease-in-out 0.15s;
    }
</style>
@endsection
@section('content')
<div class="content-wrapper">
    <div class="page-header">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Bảng điều khiển</a></li>
                <li class="breadcrumb-item active" aria-current="page">Thông tin cửa hàng</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                @if ($contact == null)
                <div class="card-body">
                    <h4 class="card-title">Thông tin cửa hàng</h4>
                        <fieldset>
                            <form action="{{ route('admin.contact.create') }}" method="post">
                                @csrf
                                <table class="table table-bordered table-striped">
                                    <tr>
                                        <td style="width:35%">Tên cửa hàng</td>
                                        <td style="width:65%">
                                            <input type="text" name="name" class="form-control" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width:35%">Số điện thoại</td>
                                        <td style="width:65%">
                                            <input type="number" name="phone" class="form-control" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width:35%">Số điện thoại bàn</td>
                                        <td style="width:65%">
                                            <input type="number" name="phone_other" class="form-control" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width:35%">Thời gian làm việc</td>
                                        <td style="width:65%">
                                            <input type="text" name="work_time" class="form-control">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width:35%">Địa chỉ</td>
                                        <td style="width:65%">
                                            <input type="text" name="address" class="form-control">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width:35%">Email</td>
                                        <td style="width:65%">
                                            <input type="email" name="email" class="form-control">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width:35%">Mô tả</td>
                                        <td style="width:65%">
                                            <input type="text" name="description" class="form-control">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width:35%">Facebook Page</td>
                                        <td style="width:65%">
                                            <input type="text" name="facebook" class="form-control">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width:35%">
                                            Logo
                                        </td>
                                        <td style="width:65%">
                                                <div class="form-group mb-0 d-inline-block w-100">
                                                    <input type="file" class="form-control w-50 float-left" name="logo" data-role="preview-image">
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <label class="w-100">
                                                <h5 class="float-left">Ghi chú trang liên hệ</h5>
                                            </label>
                                            <textarea class="form-control" id="note"
                                                name="note"></textarea>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <button type="submit" class="ml-1 btn btn-gradient-primary btn-icon-text btn-sm">
                                                <i class="mdi mdi-file-check btn-icon-prepend"></i>
                                                Lưu
                                            </button>
                                        </td>
                                    </tr>
                                </table>
                            </form>
                        </fieldset>
                    </div>
                    @else
                    <div class="card-body">
                        <h4 class="card-title">Thông tin cửa hàng</h4>
                        <fieldset>
                            <table class="table table-bordered table-striped">
                                <tr>
                                    <td style="width:35%">Tên cửa hàng</td>
                                    <td style="width:65%">
                                        <a href="#" class="editable editable-click" data-type="text" data-pk="contacts" data-name="name">{{ $contact->name }}</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:35%">Số điện thoại</td>
                                    <td style="width:65%">
                                        <a href="#" class="editable editable-click" data-type="number" data-pk="contacts" data-name="phone">{{ $contact->phone }}</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:35%">Số điện thoại bàn</td>
                                    <td style="width:65%">
                                        <a href="#" class="editable editable-click" data-type="number" data-pk="contacts" data-name="phone_other">{{ $contact->phone_other }}</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:35%">Thời gian làm việc</td>
                                    <td style="width:65%">
                                        <a href="#" class="editable editable-click" data-name="work_time" data-type="text" data-pk="contacts">{{ $contact->work_time }}</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:35%">Địa chỉ</td>
                                    <td style="width:65%">
                                        <a href="#" class="editable editable-click" data-name="address" data-type="text" data-pk="contacts">{{ $contact->address }}</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:35%">Email</td>
                                    <td style="width:65%">
                                        <a href="#" class="editable editable-click" data-name="email" data-type="email" data-pk="contacts">{{ $contact->email }}</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:35%">Mô tả</td>
                                    <td style="width:65%">
                                        <a href="#" class="editable editable-click" data-name="description" data-type="text" data-pk="contacts">{{ $contact->description }}</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:35%">Facebook Page</td>
                                    <td style="width:65%">
                                        <a href="#" class="editable editable-click" data-name="facebook" data-type="text" data-pk="contacts">{{ $contact->facebook }}</a>
                                    </td>
                                </tr>
                                <form class="cmxform" id="signupForm" method="post"
                                    action="{{ route('admin.contact.store') }}" enctype="multipart/form-data">
                                    @csrf
                                <tr>
                                    <td style="width:35%">
                                        Logo
                                        <img class="ml-2 img-logo" src="{{ asset('backend/images/logo/'.$contact->logo) }}" alt="">
                                    </td>
                                    <td style="width:65%">
                                            <input type="hidden" name="id" value="{{ $contact->id }}">
                                            <div class="form-group mb-0 d-inline-block w-100">
                                                <input type="file" class="form-control w-50 float-left" name="logo" data-role="preview-image">
                                                <div>
                                                    <button type="submit" class="ml-1 btn btn-gradient-primary btn-icon-text btn-sm">
                                                        <i class="mdi mdi-file-check btn-icon-prepend"></i>
                                                        Lưu ảnh
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <label class="w-100">
                                            <h5 class="float-left">Ghi chú trang liên hệ</h5>
                                            <button type="submit" class="float-right ml-1 btn btn-gradient-primary btn-icon-text btn-sm">
                                                <i class="mdi mdi-file-check btn-icon-prepend"></i>
                                                Lưu ghi chú
                                            </button>
                                        </label>
                                        <textarea class="form-control" id="note"
                                            name="note">{{ $contact->note }}</textarea>
                                    </td>
                                </tr>
                            </form>
                            </table>
                        </fieldset>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script src="{{ asset('backend/vendors/ckeditor/ckeditor.js') }}"></script>
<script src="{{ asset('backend/vendors/bootstrap3-editable/js/bootstrap-editable.js') }}"></script>
@isset($contact)
<script>
    CKEDITOR.replace('note');
    $.fn.editable.defaults.mode = 'inline';
    $.fn.editable.defaults.url = '{{ route('admin.contact.update', $contact->id) }}';
    $(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': csrf_token
            }
        });

        $('.editable').editable();
    });
</script>
@endisset
@endsection
