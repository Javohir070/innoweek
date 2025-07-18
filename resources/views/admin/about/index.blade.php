@extends('layouts.admin')
@push('style')
    <!-- Datatable CSS -->
    <link rel="stylesheet" href="{{ asset('/admin/assets/css/dataTables.bootstrap5.min.css') }}">
@endpush
@section('content')
    <div class="page-header">
        <div class="add-item d-flex">
            <div class="page-title">
                <h4>Biz haqimizda</h4>
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
            <a href="{{ route('admin.about.info') }}" class="btn btn-added"><i data-feather="plus-circle" class="me-2"></i>Kiritish</a>
        </div>
    </div>

    <div class="card table-list-card">
        @include('admin.components.alert')
        <div class="card-body pb-0">
            <div class="table-top table-top-two table-top-new">

                <div class="search-set mb-0">
                    <div class="total-employees">
                        <h6><i data-feather="users" class="feather-user"></i>Jami <span>{{$data_count}}</span></h6>
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
                </div>
            </div>

            <div class="table-responsive">
                {{ $dataTable->table(['class' => 'table align-middle table-hover m-0 truncate', 'style' => 'width: 100%;']) }}
            </div>
        </div>
    </div>


    <!-- MODAL ADD-->
    <div class="modal fade" id="add-project">
        <div class="modal-dialog modal-dialog-centered text-center" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h4 class="modal-title">Qo'shish</h4><button aria-label="Close" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-footer">
                    <a class="btn btn-primary" href="{{ route('admin.about.info') }}">Qo'shish</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <!-- Datatable JS -->
    <script src="{{ asset('/admin/assets/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('/admin/assets/js/dataTables.bootstrap5.min.js') }}"></script>
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
