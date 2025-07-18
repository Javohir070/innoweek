@if ($status == 'active' || $status == 'activated')
    <span class="badge rounded-pill bg-success">Faol</span>
@endif
@if ($status == 'inactive')
<span class="badge rounded-pill bg-warning">Faol emas</span>
@endif
@if ($status == 'deleted')
<span class="badge rounded-pill bg-danger">O'chirilgan</span>
@endif

@if ($status == 'waiting')
<span class="badge bg-secondary">Ko'rib chiqilmoqda</span>
@endif
@if ($status == 'editing')
<span class="badge bg-warning">Tahrirlash uchun qaytarilgan</span>
@endif
@if ($status == 'approved')
<span class="badge bg-success">Tasdiqlangan</span>
@endif
@if ($status == 'publish')
    <span class="badge bg-success">Chop etishga ruxsat berilgan</span>
@endif
@if ($status == 'canceled')
<span class="badge bg-danger">Rad etilgan</span>
@endif