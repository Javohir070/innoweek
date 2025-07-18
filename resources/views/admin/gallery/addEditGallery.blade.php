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
<div class="row">
    <div class="col-md-6 col-sm-6 col-lg-6 col-12">
        <form action="{{ route('admin.gi.store') }}" method="POST" enctype="multipart/form-data" class="was-validated">
            @csrf
            <input type="hidden" name="archive_id" value="{{ $data->id ?? null }}">
            <div class="row">
                <div class="col-lg-4 col-sm-4 col-12">
                    <label class="form-label">Foto rasm *</label>
                    <div class="mb-3">
                        <input type="file" class="form-control" aria-label="file example" name="image" required />
                    </div>
                </div>
                <div class="col-lg-3 col-sm-3 col-md-3 col-12">
                    <label class="form-label">.</label>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-md btn-submit">
                            Saqlash
                        </button>
                    </div>
                </div>
            </div>
        </form>
        <div class="text-editor add-list add">
            <div class="row">
                @isset($data->gallery)
                @foreach ($data->gallery as $item)
                <div class="col-3 mb-3">
                    <div class="add-choosen ">
                        <div class="phone-img mb-5">
                            <img src="{{ asset($item->image) }}" alt="{{ $data->image }}" />
                            <a href="javascript:void(0);"><i data-feather="x" data-value="{{ $item->id }}" class="x-square-add remove-gallery-image"></i></a>
                        </div>
                    </div>
                </div>
                @endforeach
                @endisset
            </div>
        </div>
    </div>
    <div class="col-md-6 col-sm-6 col-lg-6 col-12">
        <form action="{{ route('admin.gi.store') }}" method="POST" enctype="multipart/form-data" class="was-validated">
            @csrf
            <input type="hidden" name="archive_id" value="{{ $data->id ?? null }}">
            <div class="row">
                <div class="col-lg-10">
                    <label class="form-label">Youtube Video (URL) *</label>
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon3">https://youtu.be/</span>
                        <input type="text" class="form-control" name="youtube_url" id="basic-url" aria-describedby="basic-addon3" placeholder="oR5OvcFKZak" required>
                    </div>
                </div>
                <div class="col-lg-2 col-sm-2 col-md-2 col-12">
                    <label class="form-label">.</label>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-md btn-submit">
                            Saqlash
                        </button>
                    </div>
                </div>
            </div>
        </form>
        <div class="text-editor add-list add">
            <div class="row">
                @isset($data->gallery)
                @foreach ($data->gallery as $item)
                @if (!empty($item->youtube_url))
                    <div class="col-3 mb-3">
                        <div class="add-choosen ">
                            <div class="phone-img mb-5">
                                <img src="{{ "https://img.youtube.com/vi/".$item->youtube_url."/hqdefault.jpg" }}" alt="{{ $data->image }}" />
                                <a href="javascript:void(0);"><i data-feather="x" data-value="{{ $item->id }}" class="x-square-add remove-gallery-image"></i></a>
                            </div>
                        </div>
                    </div>
                @endif
                @endforeach
                @endisset
            </div>
        </div>
    </div>
</div>
<!-- /add -->
@endsection

@push('scripts')
<!-- Summernote JS -->
<script src="{{ asset('/admin/assets/plugins/summernote/summernote-bs4.min.js') }}"></script>

<!-- Datetimepicker JS -->
<script src="{{ asset('/admin/assets/js/moment.min.js') }}"></script>
<script src="{{ asset('/admin/assets/js/bootstrap-datetimepicker.min.js') }}"></script>

<script src="{{ asset('/admin/assets/js/custom-select2.js') }}"></script>
<script type="text/javascript">
    // Remove Product
    $(document).on("click", ".remove-gallery-image", function (e) {
        //console.log($(this).data("value"));
        var _id = $(this).data("value");
        $(this).parent().parent().hide();
        
        $.ajax({
            type: "GET",
            url: "{{ route('json.gi.destroy') }}",
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
</script>
@endpush