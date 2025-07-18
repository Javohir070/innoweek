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
            <h4>Loyiha ma'lumotlarini kiritish</h4>
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
                <a href="{{ route('admin.projects.index') }}" class="btn btn-secondary"><i data-feather="arrow-left" class="me-2"></i>Orqaga
                    qaytish</a>
            </div>
        </li>
    </ul>
</div>
@include('admin.components.alert')
<!-- /add -->
<form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data" class="was-validated">
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
                                <div class="col-lg-12 col-sm-12 col-12">
                                    <div class="input-blocks">
                                        <label>Loyiha nomi *</label>
                                        <div class="input-groupicon select-code">
                                            <input type="text" name="project_title" value="{{ $data->project_title ?? null }}" placeholder="Loyiha nomini kiriting..." required class="p-2" />
                                        </div>
                                        @error('project_title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-12 col-sm-12 col-12 d-flex">
                                    <div class="input-blocks">
                                        <label>Tashkilot *</label>
                                        <select name="author_id" class="js-example-basic-single select2" required>
                                            <option value="{{ null }}">- Tanlang -</option>
                                            @foreach ($companies as $item)
                                                <option value="{{ $item->id }}" @if (isset($data->author_id) && $data->author_id == $item->id ) selected @endif>{{ $item->company_name }}</option>
                                            @endforeach
                                        </select>
                                        @error('author_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-4 col-12">
                                    <div class="input-blocks">
                                        <label>Loyiha turi *</label>
                                        <select name="type_id" class="js-example-basic-single select2" required>
                                            <option value="{{ null }}">- Tanlang -</option>
                                            @foreach ($project_types as $item)
                                            <option value="{{ $item->id }}" @if (isset($data->type_id) && $data->type_id == $item->id ) selected @endif>{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-4 col-12">
                                    <div class="input-blocks">
                                        <label>Kategoriyasi *</label>
                                        <select name="category_id" class="js-example-basic-single select2" required>
                                            <option value="{{ null }}">- Tanlang -</option>
                                            @foreach ($project_categories as $item)
                                            <option value="{{ $item->id }}" @if (isset($data->category_id) && $data->category_id == $item->id ) selected @endif>{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-sm-2 col-12">
                                    <div class="input-blocks">
                                        <label>Muxandislik loyiha</label>
                                        <select name="is_engineering" id="is_engineering" class="js-example-basic-single select2" required>
                                            <option value="{{ null }}">- Tanlang -</option>
                                            <option value="1" @if (isset($data->is_engineering) && $data->is_engineering == 1) selected @endif>Ha</option>
                                            <option value="0" @if (isset($data->is_engineering) && $data->is_engineering == 0) selected @endif>Yo'q</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-sm-2 col-12">
                                    <div class="input-blocks">
                                        <label>Amalga oshirilgan yili *</label>
                                        <div class="input-group">
                                            <input type="text" name="publish_year" value="{{ $data->publish_year ?? null }}" placeholder="2021" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-4 col-12">
                                    <div class="input-blocks">
                                        <label>Loyiha summasi *</label>
                                        <div class="input-group">
                                            <input type="text" name="amount" value="{{ $data->amount ?? null }}" placeholder="1000000" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-4 col-12">
                                    <div class="input-blocks">
                                        <label>Davlat *</label>
                                        <select name="country_id" id="country" class="js-example-basic-single select2" required>
                                            <option value="{{ null }}">- Tanlang -</option>
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
                                            <option value="{{ null }}">- Tanlang -</option>
                                            @foreach ($regions as $item)
                                            <option value="{{ $item->id }}" @if (isset($data->region_id) && $data->region_id == $item->id ) selected @endif>{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-4 col-12">
                                    <div class="input-blocks">
                                        <label>Tuman *</label>
                                        <select name="district_id" id="district" class="js-example-basic-single select2" required>
                                            <option value="{{ null }}">- Tanlang -</option>
                                            @foreach ($districts as $item)
                                            <option value="{{ $item->id }}" @if (isset($data->district_id) && $data->district_id == $item->id ) selected @endif>{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="mb-3 summer-description-box">
                                        <label class="form-label">Loyiha haqida ma'lumot *</label>
                                        <textarea id="description" name="description" rows="10">{!! $data->description ?? null !!}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="accordion-card-one accordion" id="accordionExample3">
                <div class="accordion-item">
                    <div class="accordion-header" id="headingThree">
                        <div class="accordion-button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-controls="collapseThree">
                            <div class="addproduct-icon list">
                                <h5>
                                    <i data-feather="image" class="add-info"></i><span>Loyiha rasmi va video lavhasi</span>
                                </h5>
                                <a href="javascript:void(0);"><i data-feather="chevron-down" class="chevron-down-add"></i></a>
                            </div>
                        </div>
                    </div>
                    <div id="collapseThree" class="accordion-collapse collapse show" aria-labelledby="headingThree" data-bs-parent="#accordionExample3">
                        <div class="accordion-body">
                            <div class="text-editor add-list add">
                                <div class="col-lg-12">
                                    <div class="add-choosen">
                                        <div class="input-blocks">
                                            <div class="image-upload">
                                                <input type="file" name="images[]" class="form-control" multiple @if (!isset($data->id)) required @endif accept="image/jpg, image/jpeg, image/png">
                                                <div class="image-uploads">
                                                    <i data-feather="plus-circle" class="plus-down-add me-0"></i>
                                                    <h4>Rasm</h4>
                                                </div>
                                            </div>
                                        </div>
                                        @isset($data->gallery)
                                            @foreach ($data->gallery as $item)
                                            <div class="phone-img">
                                                <img src="{{ asset($item->image_url) }}" alt="{{ $data->project_title }}" />
                                                <a href="javascript:void(0);"><i data-feather="x" data-value="{{ $item->id }}" class="x-square-add remove-product-image"></i></a>
                                            </div>
                                            @endforeach
                                        @endisset
                                        
                                    </div>
                                </div>

                                <div class="col-lg-12 col-sm-12 col-12">
                                    <label class="form-label">Video lavha *</label>
                                    <div class="mb-3">
                                        <input type="file" class="form-control" aria-label="file example" name="video_url" accept="video/mp4"/>

                                        @if (isset($data->video_url) && !empty($data->video_url))
                                            <div><a target="_blank" href="{{ asset($data->video_url) }}">{{ __("Video lavha faylini ko'rish")}}</a></div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @if ($cooperation)
            <input type="hidden" name="cooperation" value="{{ $cooperation ?? null}}" >
                <div class="accordion-card-one accordion" id="accordionExample">
                    <div class="accordion-item">
                        <div class="accordion-header" id="headingOne">
                            <div class="accordion-button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-controls="collapseOne">
                                <div class="addproduct-icon">
                                    <h5>
                                        <i data-feather="info" class="add-info"></i><span>Qo'shimcha ma'lumotlar</span>
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
                                            <label>Sertifikat raqami *</label>
                                            <div class="input-groupicon select-code">
                                                <input type="text" name="certificate_number" value="{{ $data->certificate_number ?? null }}" placeholder="12345678" class="p-2"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-8 col-sm-8 col-12">
                                        <div class="input-blocks">
                                            <label>Sertifikat fayli *</label>
                                            <div class="mb-3">
                                                <input type="file" name="certificate_url" class="form-control" accept="application/pdf,application/vnd.ms-excel" />
                                                @if (isset($data->certificate_url) && !empty($data->certificate_url))
                                                <div><a target="_blank" href="{{ asset($data->certificate_url) }}">{{ __("Sertifikat faylini ko'rish")}}</a></div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-sm-4 col-12">
                                        <div class="input-blocks">
                                            <label>Tovar belgisi *</label>
                                            <div class="input-groupicon select-code">
                                                <input name="trademark" value="{{ $data->trademark ?? null }}" type="text" placeholder="CoCacola" class="p-2" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-sm-4 col-12">
                                        <div class="input-blocks">
                                            <label>O'lchov birligi *</label>
                                            <select class="select" name="unit_type_id">
                                                <option value="{{ null }}">- Tanlang -</option>
                                                <option value="1" @if (isset($data->unit_type_id) && $data->unit_type_id == 1 ) selected @endif>Dona</option>
                                                <option value="2" @if (isset($data->unit_type_id) && $data->unit_type_id == 2 ) selected @endif>Kg</option>
                                                <option value="3" @if (isset($data->unit_type_id) && $data->unit_type_id == 3 ) selected @endif>M</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-sm-4 col-12">
                                        <div class="input-blocks">
                                            <label>Sotuvda mavjud *</label>
                                            <div class="input-groupicon select-code">
                                                <input name="amount_per" value="{{ $data->amount_per ?? null }}" type="text" placeholder="100" class="p-2" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-sm-4 col-12">
                                        <div class="input-blocks">
                                            <label>Minimum yetkazib berish *</label>
                                            <div class="input-groupicon select-code">
                                                <input name="min_order_value" value="{{ $data->min_order_value ?? null }}" type="text" placeholder="10" class="p-2" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-sm-4 col-12">
                                        <div class="input-blocks">
                                            <label>Maksimum yetkaizb berish *</label>
                                            <div class="input-groupicon select-code">
                                                <input type="text" name="max_order_value" value="{{ $data->max_order_value ?? null }}" placeholder="100" class="p-2" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-sm-4 col-12">
                                        <div class="input-blocks">
                                            <label>Narxi (dona) *</label>
                                            <div class="input-groupicon select-code">
                                                <input type="text" name="amount_per" value="{{ $data->amount_per ?? null }}" placeholder="1000" class="p-2" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-sm-4 col-12">
                                        <div class="input-blocks">
                                            <label>Narxi (Ulgurchi)</label>
                                            <div class="input-groupicon select-code">
                                                <input type="text" name="amount_total" value="{{ $data->amount_total ?? null }}" placeholder="900" class="p-2" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-sm-2 col-12">
                                        <div class="input-blocks">
                                            <label>Yaroqlilik muddati</label>
                                            <div class="input-groupicon calender-input">
                                                <i data-feather="calendar" class="info-img"></i>
                                                <input type="text" name="expiration_date" value="{{ isset($data->expiration_date) ? \Carbon\Carbon::parse($data->expiration_date)->format('d-m-Y') : null }}" class="datetimepicker" placeholder="Choose" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-sm-3 col-12">
                                        <div class="input-blocks">
                                            <label>Yetkazib berish vaqt *</label>
                                            <div class="input-groupicon select-code">
                                                <input type="text" name="delivery_date" value="{{ $data->delivery_date ?? null }}" placeholder="900" class="p-2" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-sm-3 col-12">
                                        <div class="input-blocks">
                                            <label>Yetkazib berish muddati *</label>
                                            <select name="delivery_type_id" class="select">
                                                <option value="{{ null }}">- Tanlang -</option>
                                                <option value="1" @if (isset($data->delivery_type_id) && $data->delivery_type_id == 1 ) selected @endif>Kun</option>
                                                <option value="2" @if (isset($data->delivery_type_id) && $data->delivery_type_id == 2 ) selected @endif>Oy</option>
                                            </select>
                                        </div>
                                    </div>
                
                                    <div class="col-lg-4 col-sm-4 col-12">
                                        <div class="input-blocks">
                                            <label>Kafolat berish vaqt *</label>
                                            <div class="input-groupicon select-code">
                                                <input type="text" name="warranty_period" value="{{ $data->warranty_period ?? null }}" placeholder="900" class="p-2" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-sm-4 col-12">
                                        <div class="input-blocks">
                                            <label>Kafolat berish muddati *</label>
                                            <select name="wp_type_id" class="select">
                                                <option value="{{ null }}">- Tanlang -</option>
                                                <option value="1" @if (isset($data->wp_type_id) && $data->wp_type_id == 1 ) selected @endif>Kun</option>
                                                <option value="2" @if (isset($data->wp_type_id) && $data->wp_type_id == 2 ) selected @endif>Oy</option>
                                                <option value="3" @if (isset($data->wp_type_id) && $data->wp_type_id == 3 ) selected @endif>Yil</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-sm-4 col-12">
                                        <div class="input-blocks">
                                            <label>Kafolat berish shartlari</label>
                                            <div class="input-group">
                                                <input type="text" name="warranty_policy" value="{{ $data->warranty_policy ?? null }}" placeholder="Toza sharoitda saqlash..." />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-6 col-12">
                                        <div class="input-blocks">
                                            <label>Loyiha passporti *</label>
                                            <div class="mb-3">
                                                <input type="file" name="passport_file" class="form-control" @if (!isset($data->id)) required @endif accept="application/pdf,application/vnd.ms-excel"/>
                                                @if (isset($data->passport_file) && !empty($data->passport_file))
                                                    <div><a target="_blank" href="{{ asset($data->passport_file) }}">{{ __("Loyiha passporti faylini ko'rish")}}</a></div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-6 col-12">
                                        <div class="input-blocks">
                                            <label>Mahalliylashganlik darajasi *</label>
                                            <div class="mb-3">
                                                <input type="file" name="locality_file" class="form-control" @if (!isset($data->id)) required @endif accept="application/pdf,application/vnd.ms-excel"/>
                                                @if (isset($data->locality_file) && !empty($data->locality_file))
                                                <div><a target="_blank" href="{{ asset($data->locality_file) }}">{{ __("Mahalliylashtirish faylini ko'rish")}}</a></div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="input-blocks summer-description-box transfer mb-3">
                                            <label>Innovatsionligi nimada *</label>
                                            <textarea class="form-control h-100" rows="3" name="innovation_desc" required>{{ $data->innovation_desc ?? null}}</textarea>
                                            <p class="mt-1">Maksimum 255 ta belgi</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
    <div class="col-lg-12">
        <div class="btn-addproduct mb-4">
            @role('super-admin', 'admin', 'moderator', 'organizer')
            @if (isset($data->id))
            <button type="button" class="btn btn-cancel" data-bs-toggle="modal" data-bs-target="#add-project">
                Loyiha holatini o'zgartirish
            </button>
            @endif
            @endrole
            <button type="submit" class="btn btn-submit">
                Ma'lumotlarni saqlash
            </button>
        </div>
    </div>
</form>
<!-- /add -->

<!-- MODAL ADD-->
@isset($data->id)
    <div class="modal fade" id="add-project">
        <div class="modal-dialog modal-dialog-centered text-center" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h4 class="modal-title">Loyiha holatini o'zgartirish</h4><button aria-label="Close" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body text-start">
                    <p class="text-muted mb-0">Loyiha holatini belgilang. Agar tasdiqlansa loyiha tashqi saytda ko'rsatiladi.</p>
                </div>
                <div class="modal-footer">
                    <a class="btn btn-primary" href="{{ route('admin.projects.status', ['data_id' => $data->id, 'status' => 'editing']) }}">Loyihani faolsizlashtirish</a>
                    <a class="btn btn-cancel" href="{{ route('admin.projects.status', ['data_id' => $data->id, 'status' => 'publish']) }}">Loyihani tasdiqlash</a>
                </div>
            </div>
        </div>
    </div>
@endisset

@endsection

@push('scripts')
<!-- Mask JS -->
<script src="{{ asset('/admin/assets/js/jquery.maskedinput.min.js') }}"></script>
<script src="{{ asset('/admin/assets/js/mask.js') }}"></script>

<!-- Summernote JS -->
<script src="{{ asset('/admin/assets/plugins/summernote/summernote-bs4.min.js') }}"></script>

<!-- Datetimepicker JS -->
<script src="{{ asset('/admin/assets/js/moment.min.js') }}"></script>
<script src="{{ asset('/admin/assets/js/bootstrap-datetimepicker.min.js') }}"></script>

<script src="{{ asset('/admin/assets/js/custom-select2.js') }}"></script>

<script type="text/javascript">
$(document).ready(function() {
    // Display image preview
    function readURL(input) {
        if (input.files && input.files[0]) {
            for (var i = 0; i < input.files.length; i++) {
                var imgData = input.files[i];
                var reader = new FileReader();
                reader.onload = function(e) {
                    //var html = '<img src="' + e.target.result + '">';
                    var html ='<div class="phone-img"> <img src="' + e.target.result + '" alt="image" /> <a href="javascript:void(0);"><i data-feather="x" class="x-square-add remove-product"></i></a></div>';
                    $('.add-choosen').append(html);
                    feather.replace(); // display the icons
                }
                reader.readAsDataURL(imgData);
            }
            // var reader = new FileReader();
            // reader.onload = function(e) {
            //     //var html = '<img src="' + e.target.result + '">';
            //     var html ='<div class="phone-img"> <img src="' + e.target.result + '" alt="image" /> <a href="javascript:void(0);"><i data-feather="x" class="x-square-add remove-product"></i></a></div>';
            //     $('.add-choosen').append(html);
            //     feather.replace(); // display the icons
            // }
            // reader.readAsDataURL(input.files[0]);
        }
    }

    // Remove Product
    $(document).on("click", ".remove-product-image", function (e) {
        //console.log($(this).data("value"));
        var _id = $(this).data("value");
        $(this).parent().parent().hide();
        
        $.ajax({
            type: "GET",
            url: "{{ route('json.pg.destroy') }}",
            data: {
                id: _id
            },
            success: function(result){
                console.log(result);
            },
            error: function(xhr) {
                console.log(xhr);
            }
        });

    });

    // Trigger image preview when file input changes
    $("input[name='images[]']").change(function() {
        readURL(this);
    });

});


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