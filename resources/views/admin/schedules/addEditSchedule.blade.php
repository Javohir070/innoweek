@extends('layouts.admin')
@push('style')
<!-- Datetimepicker CSS -->
<link rel="stylesheet" href="{{ asset('/admin/assets/css/bootstrap-datetimepicker.min.css') }}">

@endpush
@section('content')
<div class="page-header">
    <div class="add-item d-flex">
        <div class="page-title">
            <h4>Tadbir jadvali ma'lumotlarni kiritish</h4>
            <h6>
                InnoWeek haftaligi doirasida tashkil etiladigan tadbirlar jadvalini boshqarish
            </h6>
        </div>
    </div>
    <ul class="table-top-head">
        <li>
            <a data-bs-toggle="tooltip" data-bs-placement="top" title="Collapse" id="collapse-header"><i data-feather="chevron-up" class="feather-chevron-up"></i></a>
        </li>
        <li>
            <div class="page-btn">
                <a href="{{ route('admin.schedules.index') }}" class="btn btn-secondary"><i data-feather="arrow-left" class="me-2"></i>Orqaga
                    qaytish</a>
            </div>
        </li>
    </ul>
</div>
@include('admin.components.alert')
<!-- /add -->
<form action="{{ route('admin.schedules.store') }}" method="POST" enctype="multipart/form-data" class="was-validated">
    @csrf
    <input type="hidden" name="id" value="{{ $data->id ?? null }}">
    
    <div class="card">
        <div class="card-body">
            <ul class="nav nav-tabs nav-tabs-bottom nav-justified mb-3">
                <li class="nav-item"><a class="nav-link active" href="#tab-uzbek" data-bs-toggle="tab">O'zbekcha</a></li>
                <li class="nav-item"><a class="nav-link" href="#tab-russian" data-bs-toggle="tab">Ruscha</a></li>
                <li class="nav-item"><a class="nav-link" href="#tab-english" data-bs-toggle="tab">English</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane show active" id="tab-uzbek">
                    <div class="row g-3">
                        <div class="col-lg-9 col-sm-9 col-12">
                            <div class="input-blocks">
                                <label>Tadbir nomi *</label>
                                <div class="input-groupicon select-code">
                                    <input type="text" name="title_uz" value="{{ $data->title_uz ?? null }}" placeholder="Tadbir nomini kiriting..." required class="p-2" />
                                </div>
                                @error('title_uz')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-3 col-12">
                            <div class="input-blocks">
                                <label>Yil *</label>
                                <select name="archive_id" class="js-example-basic-single select2" required>
                                    <option value="{{ null }}">- Tanlang -</option>
                                    @foreach ($archives as $item)
                                    <option value="{{ $item->id }}" @if (isset($data->archive_id) && $data->archive_id == $item->id ) selected @endif>{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                @error('archive_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-3 col-md-3 col-12">
                            <div class="input-blocks">
                                <label>Tadbir sanasi *</label>
                                <div class="input-groupicon calender-input">
                                    <i data-feather="calendar" class="info-img"></i>
                                    <input type="text" name="date" value="{{ isset($data->date) ? \Carbon\Carbon::parse($data->date)->format('d-m-Y') : null }}" class="datetimepicker" placeholder="Sanani tanlang" required/>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-3 col-md-3 col-12">
                            <div class="input-blocks">
                                <label>Tadbir boshlanish vaqti *</label>
                                <div class="input-groupicon select-code">
                                    <input type="text" name="started_at" value="{{ $data->started_at ?? null }}" placeholder="10:00" required class="p-2" />
                                </div>
                                @error('started_at')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-3 col-md-3 col-12">
                            <div class="input-blocks">
                                <label>Tadbir tugash vaqti *</label>
                                <div class="input-groupicon select-code">
                                    <input type="text" name="stopped_at" value="{{ $data->stopped_at ?? null }}" placeholder="11:00" required class="p-2" />
                                </div>
                                @error('stopped_at')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row g-3">
                        <div class="col-lg-6 col-sm-6 col-12">
                            <div class="input-blocks">
                                <label>YouTube Live URL</label>
                                <div class="input-groupicon select-code">
                                    <input type="text" name="live_url" value="{{ $data->live_url ?? null }}" placeholder="eshonov_eshmat" class="p-2" />
                                </div>
                                @error('live_url')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-6 col-12">
                            <div class="input-blocks">
                                <label>Video URL</label>
                                <div class="input-groupicon select-code">
                                    <input type="text" name="innoweek_video" value="{{ $data->innoweek_video ?? null }}" placeholder="eshonov_eshmat" class="p-2" />
                                </div>
                                @error('innoweek_video')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-12 col-sm-12 col-12">
                            <div class="input-blocks">
                                <label>Tabir bo'lib o'tadigan manzil *</label>
                                <div class="input-groupicon select-code">
                                    <input type="text" name="address_uz" value="{{ $data->address_uz ?? null }}" placeholder="Toshkent shahar, Talabalar ko'chasi 7-uy" class="p-2" />
                                </div>
                                @error('address_uz')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-8 col-md-8 col-12">
                            <div class="mb-3 summer-description-box">
                                <label class="form-label">To'liq ma'lumot *</label>
                                <textarea class="form-control" name="description_uz" rows="3">{!! $data->description_uz ?? null !!}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="tab-russian">
                    <div class="row g-3">
                        <div class="col-lg-12 col-sm-12 col-12">
                            <div class="input-blocks">
                                <label>Tadbir nomi (Ruscha)</label>
                                <div class="input-groupicon select-code">
                                    <input type="text" name="title_ru" value="{{ $data->title_ru ?? null }}" placeholder="Tadbir nomini kiriting..." class="p-2" />
                                </div>
                                @error('title_ru')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-lg-12 col-sm-12 col-12">
                            <div class="input-blocks">
                                <label>Tabir bo'lib o'tadigan manzil (Ruscha) *</label>
                                <div class="input-groupicon select-code">
                                    <input type="text" name="address_ru" value="{{ $data->address_ru ?? null }}" placeholder="Toshkent shahar, Talabalar ko'chasi 7-uy" class="p-2" />
                                </div>
                                @error('address_uz')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row g-3">
                        <div class="col-lg-8 col-md-8 col-12">
                            <div class="mb-3 summer-description-box">
                                <label class="form-label">To'liq ma'lumot (Ruscha) *</label>
                                <textarea class="form-control" name="description_ru" rows="3">{!! $data->description_ru ?? null !!}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="tab-english">
                    <div class="row g-3">
                        <div class="col-lg-12 col-sm-12 col-12">
                            <div class="input-blocks">
                                <label>Tadbir nomi (Ingiliz tilida)</label>
                                <div class="input-groupicon select-code">
                                    <input type="text" name="title_en" value="{{ $data->title_en ?? null }}" placeholder="Tadbir nomini kiriting..." class="p-2" />
                                </div>
                                @error('title_en')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-lg-12 col-sm-12 col-12">
                            <div class="input-blocks">
                                <label>Tabir bo'lib o'tadigan manzil (Ingiliz tilida) *</label>
                                <div class="input-groupicon select-code">
                                    <input type="text" name="address_en" value="{{ $data->address_en ?? null }}" placeholder="Toshkent shahar, Talabalar ko'chasi 7-uy" class="p-2" />
                                </div>
                                @error('address_en')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row g-3">
                        <div class="col-lg-8 col-md-8 col-12">
                            <div class="mb-3 summer-description-box">
                                <label class="form-label">To'liq ma'lumot (Ingiliz tilida) *</label>
                                <textarea class="form-control" name="description_en" rows="3">{!! $data->description_en ?? null !!}</textarea>
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
<!-- Mask JS -->
<script src="{{ asset('/admin/assets/js/jquery.maskedinput.min.js') }}"></script>
<script src="{{ asset('/admin/assets/js/mask.js') }}"></script>

<!-- Datetimepicker JS -->
<script src="{{ asset('/admin/assets/js/moment.min.js') }}"></script>
<script src="{{ asset('/admin/assets/js/bootstrap-datetimepicker.min.js') }}"></script>

<script src="{{ asset('/admin/assets/js/custom-select2.js') }}"></script>

@endpush