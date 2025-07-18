@extends('layouts.admin')
@push('style')
<!-- Datetimepicker CSS -->
<link rel="stylesheet" href="{{ asset('/admin/assets/css/bootstrap-datetimepicker.min.css') }}">

<!-- Summernote CSS -->
<link rel="stylesheet" href="{{ asset('/admin/assets/plugins/summernote/summernote-bs4.min.css') }}">

@endpush
@section('content')
<div class="page-header">
    <div class="add-item d-flex">
        <div class="page-title">
            <h4>{{ isset($data->id ) ? "Ma'lumotlarni tahrirlash" : "Kategoriya qo'shish"}}</h4>
            <h6>
                yangiliklar kategoriyalarini kiritish va tahrirlash
            </h6>
        </div>
    </div>
    <ul class="table-top-head">
        <li>
            <a data-bs-toggle="tooltip" data-bs-placement="top" title="Collapse" id="collapse-header"><i data-feather="chevron-up" class="feather-chevron-up"></i></a>
        </li>
        <li>
            <div class="page-btn">
                <a href="{{ route('admin.nc.index') }}" class="btn btn-secondary"><i data-feather="arrow-left" class="me-2"></i>Orqaga
                    qaytish</a>
            </div>
        </li>
    </ul>
</div>
@include('admin.components.alert')
<!-- /add -->
<form action="{{ route('admin.nc.store') }}" method="POST" enctype="multipart/form-data" class="was-validated">
    @csrf
    <input type="hidden" name="id" value="{{ $data->id ?? null }}">
    <div class="card">
        <div class="card-body add-product pb-0">
            <div class="accordion-card-one accordion" id="accordionExample">
                <div class="accordion-item">
                    <div class="accordion-header" id="headingOne">
                        <div class="accordion-button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-controls="collapseOne">
                            <div class="addproduct-icon">
                                <h5>
                                    <i data-feather="info" class="add-info"></i><span>Asosiy ma'lumotlar</span>
                                </h5>
                                <a href="javascript:void(0);"><i data-feather="chevron-down" class="chevron-down-add"></i></a>
                            </div>
                        </div>
                    </div>
                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <div class="row">
                                <div class="col-lg-6 col-sm-6 col-12">
                                    <div class="input-blocks">
                                        <label>Tegishli kategoriya</label>
                                        <select name="parent_id" id="parent_area" class="js-example-basic-single select2">
                                            <option value="{{null}}">- Tanlang -</option>
                                            @foreach ($categories as $item)
                                            <option value="{{ $item->id }}" @if (isset($data->parent_id) && $data->parent_id == $item->id ) selected @endif>{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-sm-12 col-12">
                                    <div class="input-blocks">
                                        <label>Nomi (O'z) *</label>
                                        <div class="input-groupicon select-code">
                                            <input type="text" name="name_uz" value="{{ $data->name_uz ?? null }}" placeholder="O'zbekcha nomini kiriting..." required class="p-2" />
                                        </div>
                                        @error('name_uz')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-12 col-sm-12 col-12">
                                    <div class="input-blocks">
                                        <label>Nomi (Ру) *</label>
                                        <div class="input-group">
                                            <input type="text" name="name_ru" value="{{ $data->name_ru ?? null }}" placeholder="Введите русское название..." />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-sm-12 col-12">
                                    <div class="input-blocks">
                                        <label>Nomi (Eng) *</label>
                                        <div class="input-group">
                                            <input type="text" name="name_en" value="{{ $data->name_en ?? null }}" placeholder="Enter english version" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="btn-addproduct mb-4">
            <button type="submit" class="btn btn-submit">
                Ma'lumotlarni saqlash
            </button>
        </div>
    </div>
</form>
<!-- /add -->
@endsection

@push('scripts')
<!-- Summernote JS -->
<script src="{{ asset('/admin/assets/plugins/summernote/summernote-bs4.min.js') }}"></script>

<!-- Datetimepicker JS -->
<script src="{{ asset('/admin/assets/js/moment.min.js') }}"></script>
<script src="{{ asset('/admin/assets/js/bootstrap-datetimepicker.min.js') }}"></script>

<script src="{{ asset('/admin/assets/js/custom-select2.js') }}"></script>
@endpush