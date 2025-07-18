@extends('layouts.admin')
@push('style')
<!-- Datetimepicker CSS -->
<link rel="stylesheet" href="{{ asset('/admin/assets/css/bootstrap-datetimepicker.min.css') }}">
@endpush
@section('content')
<div class="page-header">
    <div class="add-item d-flex">
        <div class="page-title">
            <h4>Ma'lumotlarni kiritish</h4>
            <h6>
                InnoWeek haftaligi doirasida yangiliklarni boshqarish
            </h6>
        </div>
    </div>
    <ul class="table-top-head">
        <li>
            <a data-bs-toggle="tooltip" data-bs-placement="top" title="Collapse" id="collapse-header"><i data-feather="chevron-up" class="feather-chevron-up"></i></a>
        </li>
        <li>
            <div class="page-btn">
                <a href="{{ route('admin.news.index') }}" class="btn btn-secondary"><i data-feather="arrow-left" class="me-2"></i>Orqaga
                    qaytish</a>
            </div>
        </li>
    </ul>
</div>
@include('admin.components.alert')
<!-- /add -->
<form action="{{ route('admin.news.store') }}" method="POST" enctype="multipart/form-data" class="was-validated">
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
                        <div class="col-lg-12 col-sm-12 col-12">
                            <div class="input-blocks">
                                <label>Sarlavhasi *</label>
                                <div class="input-groupicon select-code">
                                    <input type="text" name="title_uz" value="{{ $data->title_uz ?? null }}" placeholder="Yangilik sarlavhasini..." required class="p-2" />
                                </div>
                                @error('title_uz')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-4 col-12 d-flex">
                            <div class="input-blocks">
                                <label>Kategoriya *</label>
                                <select name="category_id" class="js-example-basic-single select2" required>
                                    <option value="{{ null }}">- Tanlang -</option>
                                    @foreach ($categories as $item)
                                    <option value="{{ $item->id }}" @if (isset($data->category_id) && $data->category_id == $item->id ) selected @endif>{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-4 col-12">
                            <label class="form-label">Rasm *</label>
                            <div class="mb-3">
                                <input type="file" class="form-control" aria-label="file example" name="image" @if (!isset($data->image)) required @endif/>
                        
                                @if (isset($data->image) && !empty($data->image))
                                <div><a target="_blank" href="{{ asset($data->image) }}">{{ __("Rasmni ko'rish")}}</a></div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row g-3">
                        <div class="col-lg-8 col-md-8 col-12">
                            <div class="mb-3 summer-description-box">
                                <label class="form-label">To'liq ma'lumot *</label>
                                <textarea name="description_uz" rows="20">{!! $data->description_uz ?? null !!}</textarea>
                            </div>
                        </div>
                        <div class="col-lg-12 col-sm-12 col-12">
                            <div class="input-blocks">
                                <label>Kalit so'zlar</label>
                                <div class="input-groupicon select-code">
                                    <input type="text" name="keywords" value="{{ $data->keywords ?? null }}" placeholder="Qidiruv tizimlarida ishlatish uchun kalit so'zlarni kiriting" class="p-2" />
                                </div>
                                @error('keywords')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="tab-russian">
                    <div class="row g-3">
                        <div class="col-lg-12 col-sm-12 col-12">
                            <div class="input-blocks">
                                <label>Sarlavhasi (Ruscha)</label>
                                <div class="input-groupicon select-code">
                                    <input type="text" name="title_ru" value="{{ $data->title_ru ?? null }}" placeholder="Yangilik sarlavhasini..." class="p-2" />
                                </div>
                                @error('title_ru')
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
                                <textarea name="description_ru" rows="20">{!! $data->description_ru ?? null !!}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="tab-english">
                    <div class="row g-3">
                        <div class="col-lg-12 col-sm-12 col-12">
                            <div class="input-blocks">
                                <label>Sarlavhasi (Ingiliz tilida)</label>
                                <div class="input-groupicon select-code">
                                    <input type="text" name="title_en" value="{{ $data->title_en ?? null }}" placeholder="Yangilik sarlavhasini..." class="p-2" />
                                </div>
                                @error('title_en')
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
                                <textarea name="description_en" rows="20">{!! $data->description_en ?? null !!}</textarea>
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

<script src="{{ asset('/tinymce/tinymce.min.js')}}"></script>
    <script>
        var useDarkMode = window.matchMedia('(prefers-color-scheme: dark)').matches;
        tinymce.init({
            selector: 'textarea',
            plugins: 'preview importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media codesample table charmap pagebreak nonbreaking anchor insertdatetime advlist lists wordcount help charmap quickbars emoticons',
            imagetools_cors_hosts: ['picsum.photos'],
            image_title : true,
            automatic_uploads: true,
            images_upload_url : "{{ route('admin.news.io') }}",
            file_picker_types: 'image',

            menubar: 'file edit view insert format tools table help',
            toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media template link anchor codesample | ltr rtl',
            toolbar_sticky: true,
            autosave_ask_before_unload: true,
            autosave_interval: '30s',
            autosave_prefix: '{path}{query}-{id}-',
            autosave_restore_when_empty: false,
            autosave_retention: '2m',
            image_advtab: true,
            entity_encoding : "raw",
            protect: [
            /\<\/?(if|endif)\>/g,  // Protect <if> & </endif>
            /\<xsl\:[^>]+\>/g,  // Protect <xsl:...>
            /\<xml\:[^>]+\>/g,  // Protect <xsl:...>
            /<\?php.*?\?>/g  // Protect php code
        ],
        importcss_append: true,
        file_picker_callback: function (callback, value, meta) {
            var input = document.createElement('input');
            input.setAttribute('type', 'file');
            input.setAttribute('accept', 'image/*');
            input.onchange = function(){
                var file = this.files[0];
                var reader = new FileReader();
                reader.readAsDataURL(file);
                render.onload = function(){
                    var id = 'blobid'+(new Date()).getTime();
                    var blobCache = tinymce.activeEditor.editorUpload.blobCache;
                    var base64 = reader.result.split(',')[1];
                    var blobInfo = blobCache.create(id, file, base64);
                    blobCache.add(blobInfo);
                };
            };
            input.click();
        },
        height: 600,
        image_caption: true,
        quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
        noneditable_noneditable_class: 'mceNonEditable',
        toolbar_mode: 'sliding',
        contextmenu: 'link image imagetools table',
        skin: useDarkMode ? 'oxide-dark' : 'oxide',
        content_css: useDarkMode ? 'dark' : 'default',
        content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
});
</script>

@endpush