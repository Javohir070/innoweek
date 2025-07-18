@extends('layouts.admin')
@push('style')
    <!-- Datetimepicker CSS -->
    <link rel="stylesheet" href="{{ asset('/admin/assets/css/bootstrap-datetimepicker.min.css') }}">
@endpush

@section('content')
    <div class="page-header">
        <div class="add-item d-flex">
            <div class="page-title">
                <h4>Tashkilot qo'shish</h4>
                <h6>InnoWeek haftaligi doirasida ishtirok etuvchi tashkilot ma'lumotlarini kiritish</h6>
            </div>
        </div>
        <ul class="table-top-head">
            <li>
                <a data-bs-toggle="tooltip" data-bs-placement="top" title="Collapse" id="collapse-header"><i
                        data-feather="chevron-up" class="feather-chevron-up"></i></a>
            </li>
            <li>
                <div class="page-btn">
                    <a href="{{ route('admin.companies.index') }}" class="btn btn-secondary"><i data-feather="arrow-left"
                            class="me-2"></i>Orqaga qaytish</a>
                </div>
            </li>
        </ul>
    </div>
    @include('admin.components.alert')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <ul class="nav nav-tabs nav-tabs-top mb-3">
                        <li class="nav-item"><a class="nav-link active" href="#tab-profile" data-bs-toggle="tab">Asosiy ma'lumotlar</a></li>
                        <li class="nav-item"><a class="nav-link" href="#tab-history" data-bs-toggle="tab">Kirishlar tarixi</a></li>
                        <li class="nav-item"><a class="nav-link" href="#tab-cerf" data-bs-toggle="tab">Sertifikat</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane show active" id="tab-profile">
                            <form action="{{ route('admin.guests.store') }}" enctype="multipart/form-data" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{ $data->id ?? null }}">
                                <div class="row mt-3">
                                    <div class="col-lg-4 col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Ismi *</label>
                                            <input type="text" class="form-control" name="first_name" value="{{ $data->first_name ?? null }}" placeholder="Eshonboy" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Familyasi *</label>
                                            <input type="text" class="form-control" name="last_name" value="{{ $data->last_name ?? null }}" placeholder="Toshmatov" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Otasining ismi</label>
                                            <input type="text" class="form-control" name="middle_name" value="{{ $data->middle_name ?? null }}" placeholder="Toshmatovich" >
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6" id="email-div">
                                        <div class="mb-3">
                                            <label class="form-label">Elektron pochta</label>
                                            <input type="email" class="form-control" id="email" name="email" value="{{ $data->email ?? null }}" placeholder="user@mail.com">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6" id="phone-div">
                                        <div class="mb-3">
                                            <label class="form-label">Telefon raqam</label>
                                            <input type="text" class="form-control" id="phone_number" name="phone" value="{{ $data->phone ?? null }}" placeholder="+998900368988">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6">
                                        <div class="input-blocks">
                                            <label class="form-label">Tug'ulgan sana</label>
                                
                                            <div class="input-groupicon calender-input">
                                                <i data-feather="calendar" class="info-img"></i>
                                                <input type="text" class="datetimepicker form-control" placeholder="Sanani tanlang" name="birth_date" value="{{ isset($data->birth_date) ? \Carbon\Carbon::parse($data->birth_date)->format('d-m-Y') : null }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Davlat *</label>
                                            <select name="country_id" id="country" class="js-example-basic-single select2" required>
                                                <option value="{{null}}">- Tanlang -</option>
                                                @foreach ($countries as $item)
                                                <option value="{{ $item->id }}" @if (isset($data->country_id) && $data->country_id == $item->id ) selected @endif>{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Jinsi</label>
                                            <select class="select" name="gender">
                                                <option value="{{null}}">- Tanlang -</option>
                                                <option value="1" @if (isset($data->gender) && $data->gender == 1) selected @endif>Erkak</option>
                                                <option value="2" @if (isset($data->gender) && $data->gender == 2) selected @endif>Ayol</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Tashkilot</label>
                                            <input type="text" class="form-control" name="organization" value="{{ $data->organization ?? null }}" placeholder="GSD Group" >
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Professiya</label>
                                            <select class="select" name="profession_id">
                                                <option value="{{null}}">- Tanlang -</option>
                                                @foreach ($professions as $item)
                                                <option value="{{ $item->id }}" @if (isset($data->profession_id) && $data->profession_id == $item->id ) selected @endif>{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-end mb-3 mt-5">
                                    <button type="submit" class="btn btn-submit">Ma'lumotlarni saqlash</button>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane" id="tab-history">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5 class="card-title">Tadbirga tashriflar tarixi</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table mb-0">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Kirgan sanasi</th>
                                                            <th>Holati</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @isset($data->visits)
                                                            @foreach ($data->visits as $k => $item)
                                                            <tr>
                                                                <td>{{ $k+1 }}</td>
                                                                <td>{{ $item->created_at }}</td>
                                                                <td>{{ $item->status }}</td>
                                                            </tr>
                                                            @endforeach
                                                        @endisset
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab-cerf">
                            Tab content 3
                        </div>
                    </div>
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

    <!-- Datetimepicker JS -->
    <script src="{{ asset('/admin/assets/js/moment.min.js') }}"></script>
    <script src="{{ asset('/admin/assets/js/bootstrap-datetimepicker.min.js') }}"></script>

    <script src="{{ asset('/admin/assets/js/custom-select2.js') }}"></script>
    
    <script type="text/javascript">
    $(document).ready(function(e) {
        $("#country").change(function(){
            var country_id = $("#country").val();
            if (country_id == 1) {
                $.ajax({
                    type: "GET",
                    url: "{{ route('json.get.regions') }}",
                    data: {
                        country_id: country_id
                    },
                    success: function(result){
                        $("#region").html(result);
                        $("#district option[value]").remove();
                    },
                    error: function(xhr) {
                        console.log(xhr);
                    }
                });
            }
        });
    });
    
    $(document).ready(function(e) {
        $("#region").change(function(){
            var region_id = $("#region").val();
            $.ajax({
                type: "GET",
                url: "{{ route('json.get.districts') }}",
                data: {
                    region_id: region_id
                },
                success: function(result){
                    $("#district").html(result);
                },
                error: function(xhr) {
                    console.log(xhr);
                }
            });
        });
    });
    
    </script>
@endpush
