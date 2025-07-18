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
    <!-- /add -->
    <form action="{{ route('admin.companies.store') }}" enctype="multipart/form-data" method="POST">
        @csrf
        <input type="hidden" name="id" value="{{ $data->id ?? null }}">
        <div class="card">
            <div class="card-body add-product pb-0">
                <div class="accordion-card-one accordion" id="accordionExample">
                    <div class="accordion-item">
                        <div class="accordion-header" id="headingOne">
                            <div class="accordion-button" data-bs-toggle="collapse" data-bs-target="#collapseOne"
                                aria-controls="collapseOne">
                                <div class="addproduct-icon">
                                    <h5>
                                        <i data-feather="info" class="add-info"></i><span>Tashkilot ma'suli
                                            ma'lumotlari</span>
                                    </h5>
                                    <a href="javascript:void(0);"><i data-feather="chevron-down"
                                            class="chevron-down-add"></i></a>
                                </div>
                            </div>
                        </div>
                        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <div class="row g-3">
                                    <div class="col-lg-4 col-sm-4 col-12">
                                        <div class="input-blocks">
                                            <label>Ism *</label>
                                            <div class="input-groupicon select-code">
                                                <input type="text" name="first_name" value="{{ $data->first_name ?? null }}" placeholder="Eshonboy" class="p-2" required/>
                                            </div>
                                            @error('first_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-sm-4 col-12">
                                        <div class="input-blocks">
                                            <label>Familiya *</label>
                                            <div class="input-groupicon select-code">
                                                <input type="text" name="last_name" value="{{ $data->last_name ?? null }}" placeholder="Toshmatov" class="p-2" required/>
                                            </div>
                                            @error('last_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-sm-4 col-12">
                                        <div class="input-blocks">
                                            <label>Otasining ismi</label>
                                            <div class="input-groupicon select-code">
                                                <input type="text" name="middle_name" value="{{ $data->last_name ?? null }}" placeholder="Axmadovich" class="p-2" />
                                            </div>
                                            @error('middle_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-1 col-sm-1 col-12">
                                        <label class="form-label">Passport seriya *</label>
                                        <input type="text" class="form-control" id="passport_serial" name="passport_serial" value="{{ $data->passport_serial ?? null }}" placeholder="AA"/>
                                        <span class="form-text text-muted">Misol: "AA"</span>
                                        @error('passport_serial')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="col-lg-2 col-sm-2 col-12">
                                        <label class="form-label">Passport raqami *</label>
                                        <input type="text" class="form-control" id="passport_number" name="passport_number" value="{{ $data->passport_number ?? null }}" placeholder="1234567" />
                                        <span class="form-text text-muted">Misol: "1234567"</span>
                                        @error('passport_number')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    
                                    <div class="col-lg-4 col-sm-4 col-12">
                                        <label class="form-label">JShShIR *</label>
                                        <input type="text" class="form-control" id="passport_pinfl" name="pinfl" value="{{ $data->pinfl ?? null }}" placeholder="11 1111 1111 1111" />
                                        <span class="form-text text-muted">Misol: "11 1111 1111 1111"</span>
                                        @error('pinfl')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row g-3 mt-1">
                                    <div class="col-lg-4 col-sm-4 col-12">
                                        <div class="input-blocks">
                                            <label>Elektron pochta *</label>
                                            <div class="input-groupicon select-code">
                                                <input type="email" name="email" value="{{ $data->email ?? null }}" placeholder="user@mail.com" class="p-2" />
                                            </div>
                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-sm-4 col-12">
                                        <div class="input-blocks">
                                            <label>Telefon raqami *</label>
                                            <div class="input-groupicon select-code">
                                                <input type="text" name="phone" value="{{ $data->phone ?? null }}" placeholder="+998900368988" class="p-2" />
                                            </div>
                                            @error('phone')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-sm-4 col-12">
                                        <div class="input-blocks">
                                            <label>Foydalanuvchi nomi (login) *</label>
                                            <div class="input-groupicon select-code">
                                                <input type="text" name="username" value="{{ $data->username ?? null }}" placeholder="Masalan: korxona_nomi" class="p-2" />
                                            </div>
                                            @error('username')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-6 col-sm-6 col-12">
                                        <div class="input-blocks">
                                            <label>Foydalanuvchi rasmi *</label>
                                            <div class="mb-3">
                                                <input type="file" class="form-control" aria-label="file example" name="avatar" />
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-4 col-sm-4 col-12">
                                        <div class="input-blocks">
                                            <label>Parol *</label>
                                            <div class="input-groupicon select-code">
                                                <input type="password" name="password" class="p-2" required />
                                            </div>
                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="accordion-card-one accordion" id="accordionExample">
                    <div class="accordion-item">
                        <div class="accordion-header" id="headingOne">
                            <div class="accordion-button" data-bs-toggle="collapse" data-bs-target="#collapseOne"
                                aria-controls="collapseOne">
                                <div class="addproduct-icon">
                                    <h5><i data-feather="info" class="add-info"></i><span>Tashkilot ma'lumotlari</span>
                                    </h5>
                                    <a href="javascript:void(0);"><i data-feather="chevron-down"
                                            class="chevron-down-add"></i></a>
                                </div>
                            </div>
                        </div>
                        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <div class="row">
                                    <div class="col-lg-8 col-sm-8 col-12">
                                        <div class="input-blocks">
                                            <label>Tashkilot nomi *</label>
                                            <div class="input-groupicon select-code">
                                                <input type="text" name="company_name" value="{{ $data->company_name ?? null }}" placeholder="Eshonov Eshmat MChJ" class="p-2" required>
                                            </div>
                                            @error('company_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-sm-4 col-12">
                                        <label class="form-label">STIR *</label>
                                        <input type="text" class="form-control" id="company_inn" name="company_inn" value="{{ $data->company_inn ?? null }}" placeholder="1234157" required />
                                        <span class="form-text text-muted">Misol: "103 201 102"</span>
                                        @error('company_inn')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="col-lg-4 col-sm-4 col-12">
                                        <div class="input-blocks">
                                            <label>Davlat *</label>
                                            <select name="country_id" id="country" class="js-example-basic-single select2" required>
                                                <option value="{{null}}">- Tanlang -</option>
                                                @foreach ($countries as $item)
                                                <option value="{{ $item->id }}" @if (isset($data->country_id) && $data->country_id == $item->id ) selected @endif>{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-sm-4 col-12">
                                        <div class="input-blocks">
                                            <label>Viloyat *</label>
                                            <select name="region_id" id="region" class="js-example-basic-single select2" required>
                                                <option value="{{null}}">- Tanlang -</option>
                                                @foreach ($regions as $item)
                                                <option value="{{ $item->id }}" @if (isset($data->region_id) && $data->region_id == $item->id ) selected @endif>{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-sm-4 col-12">
                                        <div class="input-blocks">
                                            <label>Tuman *</label>
                                            <select name="district_id" id="district" class="js-example-basic-single select2">
                                                <option value="{{null}}">- Tanlang -</option>
                                                @foreach ($districts as $item)
                                                <option value="{{ $item->id }}" @if (isset($data->district_id) && $data->district_id == $item->id ) selected @endif>{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-sm-12 col-12">
                                        <div class="input-blocks">
                                            <label>Yuridik manzil *</label>
                                            <div class="input-groupicon select-code">
                                                <input type="text" name="address"
                                                    value="{{ $data->address ?? null }}"
                                                    placeholder="Tashkilot ro'yxatdan o'tgan manzil..." class="p-2">
                                            </div>
                                            @error('address')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-sm-6 col-12">
                                        <div class="input-blocks">
                                            <label>Logo *</label>
                                            <input type="file" class="form-control" aria-label="file example"
                                                name="company_logo">
                                            <div class="invalid-feedback">Loyiha uchun video lavha kiritish</div>
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
                <button type="submit" class="btn btn-submit">Ma'lumotlarni saqlash</button>
            </div>
        </div>
    </form>
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
