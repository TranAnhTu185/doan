@extends('layouts.admin')
@section('title')
Slideshow
@endsection
@section('script')
<script type="text/javascript" src="{{ asset('backend/js/owl-carousel.js') }}"></script>
{{-- <script>
    $(document).ready(function () {
        $(".page-header button").click(function(){
            $(".create-sld").addClass("d-block");
        });
    });
</script> --}}
@endsection
@section('content')
<div class="content-wrapper">
    <div class="page-header">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Carousel</li>
            </ol>
        </nav>
        <div class="dropdown">
            <button type="button" class="btn btn-primary btn-rounded btn-icon float-right mr-4" id="dropdownGradientButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                <i class="fa fa-plus"></i>
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownGradientButton1">
                <div class="create-sld">
                    <form action="{{ route('admin.slide.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="file" class="form-control" name="name[]" data-role="preview-image" multiple>
                        @error('image')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div id="preview-image"></div>
                        <div class="dropdown-item">
                            <button type="submit" class="btn btn-gradient-primary btn-icon-text w-100">
                                <i class="mdi mdi-check"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="grid-margin stretch-card w-100">
            <div class="card">
                <div class="card-body col-lg-8 m-auto">
                    <div class="owl-carousel owl-theme full-width">
                        @foreach ($slide as $item)
                        <div class="item position-relative">
                            <div class="card text-white">
                                <img class="card-img"
                                    src="{{ asset('backend/images/carousel/'.$item->name) }}"
                                    alt="Card image">
                            </div>
                            <div class="position-absolute mr-2" style="top:0; left: 0">
                                <a href="{{ route('admin.slide.destroy',$item->id) }}">
                                    <button class="btn btn-gradient-danger btn-icon">
                                        <i class="mdi mdi-close-circle-outline"></i>
                                    </button>
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- content-wrapper ends -->
@endsection
