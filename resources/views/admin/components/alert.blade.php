@if ($errors->any())
<div class="row">
  <div class="col-xl-3">
    <div class="card border-0">
      <div class="alert alert-primary border border-primary mb-0 p-3">
        <div class="d-flex align-items-start">
          <div class="me-2">
            <i class="feather-info flex-shrink-0"></i>
          </div>
          <div class="text-primary w-100">
            <div class="fw-semibold d-flex justify-content-between">Xatolik yuz berdi!
              <button type="button" class="btn-close p-0" data-bs-dismiss="alert" aria-label="Close"><i class="fas fa-xmark"></i></button>
            </div>
            <div class="fs-12 op-8 mb-1">
              <ul class="m-0">
                @foreach ($errors->all() as $error)
                <li>{{$error}}</li>
                @endforeach
              </ul>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endif
@if(session('success'))
<div class="row">
  <div class="col-xl-3">
    <div class="card border-0">
      <div class="alert alert-secondary border border-secondary mb-0 p-3">
        <div class="d-flex align-items-start">
          <div class="me-2">
            <i class="feather-check-circle flex-shrink-0"></i>
          </div>
          <div class="text-secondary w-100">
            <div class="fw-semibold d-flex justify-content-between">Bajarildi!
              <button type="button" class="btn-close p-0" data-bs-dismiss="alert" aria-label="Close"><i class="fas fa-xmark"></i></button>
            </div>
            <div class="fs-12 op-8 mb-1">{{ session('success') }}</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endif
@if (session('warning') || session('error'))
<div class="row">
  <div class="col-xl-3">
    <div class="card border-0">
      <div class="alert alert-warning border border-warning mb-0 p-3">
        <div class="d-flex align-items-start">
          <div class="me-2">
            <i class="feather-alert-triangle flex-shrink-0"></i>
          </div>
          <div class="text-warning w-100">
            <div class="fw-semibold d-flex justify-content-between">Nimadir xato bajarildi!<button type="button" class="btn-close p-0" data-bs-dismiss="alert" aria-label="Close"><i class="fas fa-xmark"></i></button></div>
            <div class="fs-12 op-8 mb-1">{{ session('warning') ?? session('warning') }}</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endif