@extends('layouts.admin')
@push('style')
    <!-- Datatable CSS -->
    <link rel="stylesheet" href="{{ asset('/admin/assets/css/dataTables.bootstrap5.min.css') }}">
@endpush
@section('content')
    <div class="page-header">
        <div class="add-item d-flex">
            <div class="page-title">
                <h4>Tashkilotlar ro'yxati</h4>
                <h6>InnoWeek doirasida ishtirok etuvchi tashkilotlar boshqaruvi.</h6>
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
            <a href="{{ route('admin.companies.info') }}" class="btn btn-added"><i data-feather="plus-circle"
                    class="me-2"></i>Tashkilot qo'shish</a>
        </div>
    </div>
    <!-- /product list -->
    <div class="card table-list-card">
        @include('admin.components.alert')
        <div class="card-body pb-0">
            <div class="table-top table-top-two table-top-new">

                <div class="search-set mb-0">
                    <div class="total-employees">
                        <h6><i data-feather="users" class="feather-user"></i>Jami tashkilotlar soni <span>{{ $company_count }}</span></h6>
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
                        <select class="select">
                            <option>Sort by Date</option>
                            <option>Newest</option>
                            <option>Oldest</option>
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
    <!-- /product list -->
@endsection
@push('scripts')
    <!-- Datatable JS -->
    <script src="{{ asset('/admin/assets/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('/admin/assets/js/dataTables.bootstrap5.min.js') }}"></script>
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush
