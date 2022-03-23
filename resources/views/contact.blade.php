@extends('layouts.home')
@section('title', 'Liên hệ')
@section('content')
<div class="breadcrumb-area mt-37 hm-4-padding">
    <div class="container-fluid">
        <div class="breadcrumb-content text-center border-top-2">
            <h2> Liên Hệ </h2>
            <ul>
                <li>
                    <a href="{{ route('home.contact') }}">Trang chủ</a>
                </li>
                <li>Liên hệ</li>
            </ul>
        </div>
    </div>
</div>
<div class="login-register-area hm-3-padding">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-7 ml-auto mr-auto">
                <h2 class="text-center text-uppercase">@isset($contact->name){{ $contact->name }}@endisset</h2>
                @isset($contact->note){!! $contact->note !!}@endisset
            </div>
        </div>
    </div>
</div>
@endsection
