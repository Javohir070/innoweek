@extends('layouts.admin')
@push('style')
    <!-- Datetimepicker CSS -->
    <link rel="stylesheet" href="{{ asset('/admin/assets/css/bootstrap-datetimepicker.min.css') }}">
@endpush

@section('content')
    <div class="page-header">
        <div class="add-item d-flex">
            <div class="page-title">
                <h4>{{ isset($data->id ) ? "Ma'lumotlarni tahrirlash" : "Foydalanuvchi qo'shish"}}</h4>
                <h6>Tizimda ma'lumotlarni kiritishga maasul xodimlar ro'yxatini boshqarish</h6>
            </div>
        </div>
        <ul class="table-top-head">
            <li>
                <a data-bs-toggle="tooltip" data-bs-placement="top" title="Collapse" id="collapse-header"><i
                        data-feather="chevron-up" class="feather-chevron-up"></i></a>
            </li>
            <li>
                <div class="page-btn">
                    <a href="{{ route('admin.users.index') }}" class="btn btn-secondary"><i data-feather="arrow-left"
                            class="me-2"></i>Orqaga qaytish</a>
                </div>
            </li>
        </ul>
    </div>
    @include('admin.components.alert')
    <!-- /add -->
    <form action="{{ route('admin.users.store') }}" enctype="multipart/form-data" method="POST">
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
                                        <i data-feather="info" class="add-info"></i><span>Foydalanuvchi Asosiy Ma'lumotlari</span>
                                    </h5>
                                    <a href="javascript:void(0);"><i data-feather="chevron-down" class="chevron-down-add"></i></a>
                                </div>
                            </div>
                        </div>
                        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <div class="row">
                                    <div class="col-lg-4 col-sm-4 col-12">
                                        <div class="input-blocks">
                                            <label>Familiya *</label>
                                            <div class="input-groupicon select-code">
                                                <input type="text" name="last_name" value="{{ $data->last_name ?? null }}" placeholder="Toshmatov" class="p-2" />
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
                                            <label>Ism *</label>
                                            <div class="input-groupicon select-code">
                                                <input type="text" name="first_name" value="{{ $data->first_name ?? null }}" placeholder="Eshonboy" class="p-2" />
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
                                            <label>Otasining ismi</label>
                                            <div class="input-groupicon select-code">
                                                <input type="text" name="middle_name" value="{{ $data->last_name ?? null }}" placeholder="" class="p-2" />
                                            </div>
                                            @error('middle_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-sm-4 col-12">
                                        <div class="input-blocks">
                                            <label>Passport seriya *</label>
                                            <div class="input-groupicon select-code">
                                                <input type="text" name="passport_serial" value="{{ $data->passport_serial ?? null }}" placeholder="AA" class="p-2" />
                                            </div>
                                            @error('passport_serial')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-sm-4 col-12">
                                        <div class="input-blocks">
                                            <label>Passport raqami *</label>
                                            <div class="input-groupicon select-code">
                                                <input type="text" name="passport_number" value="{{ $data->passport_number ?? null }}" placeholder="123456" class="p-2" />
                                            </div>
                                            @error('passport_number')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-sm-4 col-12">
                                        <div class="input-blocks">
                                            <label>JShShIR *</label>
                                            <div class="input-groupicon select-code">
                                                <input type="text" name="pinfl" value="{{ $data->pinfl ?? null }}"
                                                    placeholder="12345678910123" class="p-2" />
                                            </div>
                                            @error('pinfl')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-sm-4 col-12">
                                        <div class="input-blocks">
                                            <label>Elektron pochta *</label>
                                            <div class="input-groupicon select-code">
                                                <input type="email" name="email" @if($data?->email) readonly @endif value="{{ $data->email ?? null }}"
                                                    placeholder="user@mail.com" class="p-2" />
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
                                                <input type="text" name="phone" value="{{ $data->phone ?? null }}"
                                                    placeholder="+998900368988" class="p-2" />
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
                                                <input type="text" name="username"
                                                    value="{{ $data->username ?? null }}" placeholder="+998900368988"
                                                    class="p-2" />
                                            </div>
                                            @error('username')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-sm-4 col-12">
                                        <div class="input-blocks">
                                            <label>Ma'sul boshqarma *</label>
                                            <select name="department_id" id="department" class="js-example-basic-single select2">
                                                <option value="{{ null }}">- Tanlang -</option>
                                                @foreach ($user_departments as $item)
                                                <option value="{{ $item->id }}" @if (isset($data->department_id) && $data->department_id == $item->id ) selected @endif>{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-sm-3 col-12">
                                        <div class="input-blocks">
                                            <label>Foydalanuvchi rasmi *</label>
                                            <div class="mb-3">
                                                <input type="file" class="form-control" aria-label="file example" name="avatar"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-sm-2 col-12">
                                        <div class="input-blocks">
                                            <label>Foydalanuvchi roli *</label>
                                            <select class="select" name="role_id" required>
                                                <option>- Tanlang -</option>
                                                <option value="4" @if (isset($data->role->id) && $data->role->id == 4 ) selected @endif>Moderator</option>
                                                <option value="3" @if (isset($data->role->id) && $data->role->id == 3 ) selected @endif>Organizator</option>
                                                <option value="9" @if (isset($data->role->id) && $data->role->id == 9 ) selected @endif>Rahbar</option>
                                                <option value="10" @if (isset($data->role->id) && $data->role->id == 10 ) selected @endif>Valiantor</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-sm-2 col-12">
                                        <div class="input-blocks">
                                            <label>Parol *</label>
                                            <div class="input-groupicon select-code">
                                                <input type="password" name="password" class="p-2" @if(!isset($data->id)) required @endif autocomplete="off"/>
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
