@extends('layouts.admin')
@push('style')
    <!-- Datatable CSS -->
    <link rel="stylesheet" href="{{ asset('/admin/assets/css/dataTables.bootstrap5.min.css') }}">
@endpush
@section('content')
    <div class="page-header">
        <div class="add-item d-flex">
            <div class="page-title">
                <h4>Foto/Video lavhalar ro'yxati</h4>
                <h6>Innoweek ko'rgazmasi doirasida o'tkazilayotgan ko'rgazmalar bo'yicha video va foto lavhalar.</h6>
            </div>
        </div>
        <ul class="table-top-head">
            <li>
                <a data-bs-toggle="tooltip" data-bs-placement="top" title="Pdf"><img src="/admin/assets/img/icons/pdf.svg"
                        alt="img"></a>
            </li>
            <li>
                <a data-bs-toggle="tooltip" data-bs-placement="top" title="Excel"><img
                        src="/admin/assets/img/icons/excel.svg" alt="img"></a>
            </li>
            <li>
                <a data-bs-toggle="tooltip" data-bs-placement="top" title="Print"><i data-feather="printer"
                        class="feather-rotate-ccw"></i></a>
            </li>
            <li>
                <a data-bs-toggle="tooltip" data-bs-placement="top" title="Refresh"><i data-feather="rotate-ccw"
                        class="feather-rotate-ccw"></i></a>
            </li>
            <li>
                <a data-bs-toggle="tooltip" data-bs-placement="top" title="Collapse" id="collapse-header"><i
                        data-feather="chevron-up" class="feather-chevron-up"></i></a>
            </li>
        </ul>
        <div class="page-btn">
            <a href="#" class="btn btn-added" data-bs-toggle="modal" data-bs-target="#add-archive"><i data-feather="plus-circle" class="me-2"></i> Yangi kiritish</a>
        </div>
    </div>

    <div class="card table-list-card">
        @include('admin.components.alert')
        <div class="card-body pb-0">
            <div class="table-top table-top-two table-top-new">

                <div class="search-set mb-0">
                    <div class="total-employees">
                        <h6><i data-feather="users" class="feather-user"></i>Jami loyihalar soni <span>{{$data_count}}</span></h6>
                    </div>
                    <div class="search-input">
                        <a href="" class="btn btn-searchset"><i data-feather="search" class="feather-search"></i></a>
                    </div>

                </div>
                <div class="search-path d-flex align-items-center search-path-new">
                    <div class="d-flex">
                        <a class="btn btn-filter" id="filter_search">
                            <i data-feather="filter" class="filter-icon"></i>
                            <span><img src="/admin/assets/img/icons/closes.svg" alt="img"></span>
                        </a>
                    </div>
                    <div class="form-sort">
                        <i data-feather="sliders" class="info-img"></i>
                        <select class="select" id="sort_by">
                            <option>Tartiblash</option>
                            <option value="{{ route('admin.projects.index') }}">Barcha loyihalar</option>
                            <option value="{{ route('admin.projects.index', ['cooperation'=>1]) }}">Cooperation loyihalar</option>
                        </select>
                    </div>
                </div>
            </div>
            <!-- /Filter -->
            <div class="card" id="filter_inputs">
                <div class="card-body pb-0">
                    <div class="row">
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="input-blocks">
                                <i data-feather="user" class="info-img"></i>
                                <select class="select">
                                    <option>Choose Name</option>
                                    <option>Mitchum Daniel</option>
                                    <option>Susan Lopez</option>
                                    <option>Robert Grossman</option>
                                    <option>Janet Hembre</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="input-blocks">
                                <i data-feather="stop-circle" class="info-img"></i>
                                <select class="select">
                                    <option>Choose Status</option>
                                    <option>Active</option>
                                    <option>Inactive</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12 ms-auto">
                            <div class="input-blocks">
                                <a class="btn btn-filters ms-auto"> <i data-feather="search" class="feather-search"></i>
                                    Search </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Filter -->

            <div class="table-responsive">
                {{ $dataTable->table(['class' => 'table align-middle table-hover m-0 truncate', 'style' => 'width: 100%;']) }}
            </div>
        </div>
    </div>


    <!-- MODAL ADD-->
    <div class="modal fade" id="add-archive">
        <div class="modal-dialog modal-dialog-centered text-center" role="document">
            <div class="modal-content modal-content-demo">
                <form action="{{ route('admin.archive.store') }}" method="POST" enctype="multipart/form-data" class="was-validated">
                    @csrf
                <div class="modal-header">
                    <h4 class="modal-title">Tadbir yilini qo'shish</h4><button aria-label="Close" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body text-start">
                    <div class="row">
                        <div class="col-lg-6 col-sm-6 col-12">
                            <div class="input-blocks">
                                <label>Yil *</label>
                                <select name="year" id="year" class="js-example-basic-single select2" required>
                                    <option value="2018">2018</option>
                                    <option value="2019">2019</option>
                                    <option value="2020">2020</option>
                                    <option value="2021">2021</option>
                                    <option value="2022">2022</option>
                                    <option value="2023">2023</option>
                                    <option value="2024">2024</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Ma'lumotlarni saqlash</button>
                </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<!-- Datatable JS -->
<script src="{{ asset('/admin/assets/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('/admin/assets/js/dataTables.bootstrap5.min.js') }}"></script>
<script src="{{ asset('/admin/assets/js/custom-select2.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function(e) {
        $("#sort_by").change(function(){
            var sort_type = $("#sort_by").val();
            if (sort_type !== null) {
                window.location.href = sort_type;
            }
        });
    });
</script>
{{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush
