@extends('layouts.admin')
@section('content')
<div class="row">
  <div class="col-xl-3 col-sm-6 col-12 d-flex">
    <div class="dash-count">
      <div class="dash-counts">
        <h4>{{ $total_projects_count }}</h4>
        <h5>Kelib tushgan Loyihalar soni</h5>
      </div>
      <div class="dash-imgs">
        <i data-feather="briefcase"></i>
      </div>
    </div>
  </div>
  <div class="col-xl-3 col-sm-6 col-12 d-flex">
    <div class="dash-count das1">
      <div class="dash-counts">
        <h4>{{ $approved_projects_count}}</h4>
        <h5>Tasdiqlangan loyihalar soni</h5>
      </div>
      <div class="dash-imgs">
        <i data-feather="layers"></i>
      </div>
    </div>
  </div>

  <div class="col-xl-3 col-sm-6 col-12 d-flex">
    <div class="dash-count das4">
      <div class="dash-counts">
        <h4>{{ $canceled_projects_count }}</h4>
        <h5>Qaytarilgan loyihalar soni</h5>
      </div>
      <div class="dash-imgs">
        <i data-feather="archive"></i>
      </div>
    </div>
  </div>
  <div class="col-xl-3 col-sm-6 col-12 d-flex">
    <div class="dash-count das2">
      <div class="dash-counts">
        <h4>{{ $coop_projects_count }}</h4>
        <h5>Cooperation loyihalar</h5>
      </div>
      <div class="dash-imgs">
        <i data-feather="map-pin"></i>
      </div>
    </div>
  </div>
</div>
<!-- Button trigger modal -->

<div class="row">
  <!-- Chart -->
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <h5 class="card-title">Ma'sul boshqarmalar kesimi bo'yicha statistika</h5>
      </div>
      <div class="card-body">
        <div id="projects-dept-chart" class="chart-set"></div>
      </div>
    </div>
  </div>
  <!-- /Chart -->

  <!-- Chart -->
  <div class="col-md-4">
    <div class="card">
      <div class="card-header">
        <h5 class="card-title">Jami boshqarmalar statistikasi</h5>
      </div>
      <div class="card-body">
        <div id="project-dept-per-chart" class="chart-set"></div>
      </div>
    </div>
  </div>
  <!-- /Chart -->
  
  <!-- Chart -->
  <div class="col-md-4">
    <div class="card">
      <div class="card-header">
        <h5 class="card-title">Loyiha yo'nalishlar kesimi bo'yicha statistika</h5>
      </div>
      <div class="card-body">
        <div id="projects-chart" class="chart-set"></div>
      </div>
    </div>
  </div>
  <!-- /Chart -->

  <!-- Chart -->
  <div class="col-md-4">
    <div class="card">
      <div class="card-header">
        <h5 class="card-title">Jami loyihalar statistikasi</h5>
      </div>
      <div class="card-body">
        <div id="project-per-chart" class="chart-set"></div>
      </div>
    </div>
  </div>
  <!-- /Chart -->


  <div class="col-xl-12 col-sm-12 col-12 d-flex">
    <div class="card flex-fill default-cover mb-4">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h4 class="card-title mb-0">Hududlar bo'yicha ma'lumot</h4>
        <div class="view-all-link">
          <a href="{{ route('admin.projects.index') }}" class="view-all d-flex align-items-center">
            Batafsil ko'rish<span class="ps-2 d-flex align-items-center"><i data-feather="arrow-right" class="feather-16"></i></span>
          </a>
        </div>
      </div>
      <div class="card-body">
        <div class="table-responsive dataview">
          <table class="table dashboard-recent-products">
            <thead>
              <tr>
                <th>#</th>
                <th>Hudud</th>
                <th>Tijoratlashtirish</th>
                <th>Startup</th>
                <th>Ilmiy</th>
                <th>Mahalliy</th>
                <th>Jami Loyihalar</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($region_projects as $k => $item)
                  <tr>
                    <td>{{ $k+1 }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->com_projects_count }}</td>
                    <td>{{ $item->startup_projects_count }}</td>
                    <td>{{ $item->edu_projects_count }}</td>
                    <td>{{ $item->local_projects_count }}</td>
                    <td>{{ $item->projects_count }}</td>
                  </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

</div>
{{-- <div class="card">
  <div class="card-header">
    <h4 class="card-title">Yangi kelib tushgan loyihalar</h4>
  </div>
  <div class="card-body">
    <div class="table-responsive dataview">
      <table class="table dashboard-expired-products">
        <thead>
          <tr>
            <th class="no-sort">
              <label class="checkboxs">
                <input type="checkbox" id="select-all">
                <span class="checkmarks"></span>
              </label>
            </th>
            <th>Loyiha nomi</th>
            <th>Loyiha turi</th>
            <th>Muallif (F.I.Sh)</th>
            <th>Yuborilgan vaqti</th>
            <th>Holati</th>
            <th class="no-sort"></th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>
              <label class="checkboxs">
                <input type="checkbox">
                <span class="checkmarks"></span>
              </label>
            </td>
            <td><a href="javascript:void(0);">Innovatsion usulda paxta yetishtirish va uni sotish</a></td>
            <td>Grant loyiha</td>
            <td>Eshonov Eshmat Toshmatovich</td>
            <td>20.08.2024</td>
            <td><span class="badge badge-bgdanger">Ko'rib chiqilmagan</span></td>
            <td class="action-table-data">
              <div class="edit-delete-action">
                <a class="me-2 p-2" href="#">
                  <i data-feather="eye" class="feather-edit"></i>
                </a>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div> --}}
@endsection
@push('scripts')
    <!-- Chart JS -->
    <script src="{{ asset('/admin/assets/plugins/apexchart/apexcharts.min.js') }}"></script>
    @include('admin.components.home.projectsChart')
    <script src="{{ asset('/admin/assets/plugins/apexchart/chart-data.js') }}"></script>
@endpush