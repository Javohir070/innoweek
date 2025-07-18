@extends('layouts.admin')
@push('style')
    <!-- Datatable CSS -->
    <link rel="stylesheet" href="{{ asset('/admin/assets/css/datatable/datatable.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('/admin/assets/css/dataTables.bootstrap5.min.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('/admin/assets/css/datatable/button.css') }}">
@endpush
@section('content')
    <div class="page-header">
        <div class="add-item d-flex">
            <div class="page-title">
                <h4>Mehmonlar ro'yxati</h4>
                <h6>InnoWeek doirasida ishtirok etuvchi mehmonlar boshqaruvi.</h6>
            </div>
        </div>
        <ul class="table-top-head">
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
            <a href="{{ route('admin.guests.info') }}" class="btn btn-added"><i data-feather="plus-circle"
                    class="me-2"></i>Mehmon qo'shish</a>
        </div>
    </div>
    <!-- /product list -->
    <div class="card table-list-card">
        @include('admin.components.alert')
        <div class="card-body pb-0">
            <div class="table-top table-top-two table-top-new">

                <div class="search-set mb-0">
                    <div class="total-employees">
                        <h6><i data-feather="users" class="feather-user"></i>Jami ro'yxatdan o'tgan mehmonlar soni <span>{{ $guest_count }}</span></h6>
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
                            <option>Filterlash</option>
                            <option value="{{ route('admin.guests.index') }}">Barchasi</option>
                            <option value="{{ route('admin.guests.index', ['user_type'=>1]) }}">Mahalliy</option>
                            <option value="{{ route('admin.guests.index', ['user_type'=>2]) }}">Xalqaro</option>
                        </select>
                    </div>
                </div>
            </div>
            <!-- /Filter -->
            <div class="card" id="filter_inputs">
                <div class="card-body pb-0">
                    <form action="{{ route('admin.guests.index') }}" method="get">
                        @csrf
                        <div class="row">
                            <div class="col-lg-3 col-sm-6 col-12">
                                <div class="input-blocks">
                                    <i data-feather="user" class="info-img"></i>
                                    <select class="select" name="profession_id">
                                        <option value="{{ null }}">Faoliyat turini tanlang</option>
                                        @foreach ($professions as $item)
                                        <option value="{{ $item->id }}" @if (isset($inputs['profession_id']) && $inputs["profession_id"] == $item->id) selected @endif>{{ $item->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6 col-12">
                                <div class="input-blocks">
                                    <i data-feather="stop-circle" class="info-img"></i>
                                    <select class="select" name="country_id">
                                        <option value="{{ null }}">Davlatni tanlang</option>
                                        @foreach ($countries as $item)
                                        <option value="{{ $item->id }}" @if (isset($inputs['country_id']) && $inputs["country_id"] == $item->id) selected @endif>{{ $item->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6 col-12 ms-auto">
                                <div class="input-blocks">
                                    <button type="submit" class="btn btn-filters ms-auto"> <i data-feather="search" class="feather-search"></i>
                                        Filterlash </button>
                                </div>
                            </div>
                        </div>
                    </form>
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
    <script src="{{ asset('/admin/assets/js/datatable/datatable.js') }}"></script>
    
    {{-- <script src="{{ asset('/admin/assets/js/jquery.dataTables.min.js') }}"></script> --}}
    <script src="{{ asset('/admin/assets/js/dataTables.bootstrap5.min.js') }}"></script>
    
    <script src="{{ asset('/admin/assets/js/datatable/button.js') }}"></script>
    <script src="{{ asset('/admin/assets/js/datatable/datatable.button.js') }}"></script>
    <script src="{{ asset('/admin/assets/js/datatable/jszip.js') }}"></script>
    <script src="{{ asset('/admin/assets/js/datatable/html5.js') }}"></script>
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
