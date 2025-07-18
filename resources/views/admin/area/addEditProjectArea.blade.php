@extends('layouts.admin')
@push('style')
<!-- Datetimepicker CSS -->
<link rel="stylesheet" href="{{ asset('/admin/assets/css/bootstrap-datetimepicker.min.css') }}">

<!-- Owl Carousel CSS -->
<link rel="stylesheet" href="{{ asset('/admin/assets/plugins/owlcarousel/owl.carousel.min.css') }}">
@endpush
@section('content')
<div class="page-header">
    <div class="add-item d-flex">
        <div class="page-title">
            <h4>Loyiha ma'lumotlari</h4>
            <h6>
                InnoWeek haftaligi doirasida ko'rgazmaga qo'yiladigan loyiiha
                ma'lumotlarini kiritish
            </h6>
        </div>
    </div>
    <ul class="table-top-head">
        <li>
            <a data-bs-toggle="tooltip" data-bs-placement="top" title="Collapse" id="collapse-header"><i data-feather="chevron-up" class="feather-chevron-up"></i></a>
        </li>
        <li>
            <div class="page-btn">
                <a href="{{ route('admin.ap.index') }}" class="btn btn-secondary"><i data-feather="arrow-left" class="me-2"></i>Orqaga
                    qaytish</a>
            </div>
        </li>
    </ul>
</div>
@include('admin.components.alert')
<!-- /add -->
<div class="row">
    <div class="col-lg-8 col-sm-12">
        <div class="card">
            <div class="card-body">
                <div class="productdetails">
                    <ul class="product-bar">
                        <li>
                            <h4>Loyiha nomi</h4>
                            <h6>{{ $data->project_title }} </h6>
                        </li>
                        <li>
                            <h4>Kategoriyasi</h4>
                            <h6>{{ $data->category->name_uz }}</h6>
                        </li>
                        <li>
                            <h4>Loyiha turi</h4>
                            <h6>{{ $data->project_type->name_uz}}</h6>
                        </li>
                        <li>
                            <h4>Amalga oshirilayotgan davolat</h4>
                            <h6>{{$data->country->name_uz}}</h6>
                        </li>
                        <li>
                            <h4>Tashkilot</h4>
                            <h6>{{$data->author->company_name}}</h6>
                        </li>
                        <li>
                            <h4>Ma'lumot</h4>
                            <h6>{!! $data->description !!}</h6>
                        </li>
                        <li>
                            <h4>Ajratilgan maydon</h4>
                            <h6>{{ $data->area->name_uz ?? "Maydon ajratilmagan."}}</h6>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-sm-12">
        <div class="card">
            <div class="card-body">
                <div class="slider-product-details">
                    <div class="owl-carousel owl-theme product-slide">
                        @foreach ($data->gallery as $k => $item)
                            <div class="slider-product">
                                <img src="{{ asset($item->image_url) }}" alt="{{ $data->project_title }}">
                                <h4>Loyiha rasmi {{ $k+1}}</h4>
                                <h6></h6>
                            </div>
                        @endforeach
                        
                    </div>
                </div>
                <form action="{{ route('admin.ap.store') }}" method="POST" enctype="multipart/form-data" class="was-validated">
                    @csrf
                    <input type="hidden" name="id" value="{{ $data->id ?? null }}">
                    <div class="row">
                        <div class="col-lg-12 col-sm-12 col-12">
                            <div class="input-blocks">
                                <label>Maydon *</label>
                                <select name="area_id" class="js-example-basic-single select2" @if (!isset($data->area_id))
                                    required
                                @endif>
                                    <option value="{{ null }}">- Tanlang -</option>
                                    @foreach ($parent_areas as $item)
                                    <option value="{{ $item->id }}" @if (isset($data->area_id) && $data->area_id == $item->id ) selected @endif>{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                @error('area_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="btn-addproduct mb-4">
                                <button type="submit" class="btn btn-submit">
                                    Ma'lumotlarni saqlash
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- /add -->
@endsection

@push('scripts')
<!-- Mask JS -->
<script src="{{ asset('/admin/assets/js/jquery.maskedinput.min.js') }}"></script>
<script src="{{ asset('/admin/assets/js/mask.js') }}"></script>

<!-- Owl JS -->
<script src="{{ asset('/admin/assets/plugins/owlcarousel/owl.carousel.min.js') }}"></script>

<!-- Datetimepicker JS -->
<script src="{{ asset('/admin/assets/js/moment.min.js') }}"></script>
<script src="{{ asset('/admin/assets/js/bootstrap-datetimepicker.min.js') }}"></script>

<script src="{{ asset('/admin/assets/js/custom-select2.js') }}"></script>

@endpush