@isset($CompanyID)
  <div class="edit-delete-action">
    <a class="me-2 p-2" href="{{ route('admin.companies.info', ['company_id'=> $id ]) }}">
      <i data-feather="edit" class="feather-edit"></i>
    </a>
    <a class="confirm-text p-2" href="{{ route('admin.companies.destroy', ['company_id'=> $id ]) }}">
      <i data-feather="trash-2" class="feather-trash-2"></i>
    </a>
  </div>
@endisset
@isset($ProjectID)
  <div class="edit-delete-action">
    @if (!empty($passport_file))
        <a class="me-2 p-2" href="{{ route('admin.projects.info', ['project_id'=> $id, 'cooperation' => true ]) }}">
          <i data-feather="edit" class="feather-edit"></i>
        </a>
    @else
        <a class="me-2 p-2" href="{{ route('admin.projects.info', ['project_id'=> $id ]) }}">
          <i data-feather="edit" class="feather-edit"></i>
        </a>
    @endif
    <a class="confirm-text p-2" href="{{ route('admin.projects.destroy', ['project_id'=> $id ]) }}">
      <i data-feather="trash-2" class="feather-trash-2"></i>
    </a>
  </div>
@endisset
@isset($UserID)
  <div class="edit-delete-action">
    <a class="me-2 p-2" href="{{ route('admin.users.info', ['user_id'=> $id ]) }}">
      <i data-feather="edit" class="feather-edit"></i>
    </a>
    <a class="confirm-text p-2" href="{{ route('admin.users.destroy', ['user_id'=> $id ]) }}">
      <i data-feather="trash-2" class="feather-trash-2"></i>
    </a>
  </div>
@endisset

@isset($ProjectCatID)
  <div class="edit-delete-action">
    <a class="me-2 p-2" href="{{ route('admin.pc.info', ['data_id'=> $id ]) }}">
      <i data-feather="edit" class="feather-edit"></i>
    </a>
    <a class="confirm-text p-2" href="{{ route('admin.pc.destroy', ['data_id'=> $id ]) }}">
      <i data-feather="trash-2" class="feather-trash-2"></i>
    </a>
  </div>
@endisset

@isset($ProjectTypeID)
  <div class="edit-delete-action">
    <a class="me-2 p-2" href="{{ route('admin.pt.info', ['data_id'=> $id ]) }}">
      <i data-feather="edit" class="feather-edit"></i>
    </a>
    <a class="confirm-text p-2" href="{{ route('admin.pt.destroy', ['data_id'=> $id ]) }}">
      <i data-feather="trash-2" class="feather-trash-2"></i>
    </a>
  </div>
@endisset

@isset($UserDeptID)
  <div class="edit-delete-action">
    <a class="me-2 p-2" href="{{ route('admin.ud.info', ['data_id'=> $id ]) }}">
      <i data-feather="edit" class="feather-edit"></i>
    </a>
    <a class="confirm-text p-2" href="{{ route('admin.ud.destroy', ['data_id'=> $id ]) }}">
      <i data-feather="trash-2" class="feather-trash-2"></i>
    </a>
  </div>
@endisset


@isset($ProjectAreaID)
  <div class="edit-delete-action">
    <a class="me-2 p-2" href="{{ route('admin.pa.info', ['data_id'=> $id ]) }}">
      <i data-feather="edit" class="feather-edit"></i>
    </a>
    <a class="confirm-text p-2" href="{{ route('admin.pa.destroy', ['data_id'=> $id ]) }}">
      <i data-feather="trash-2" class="feather-trash-2"></i>
    </a>
  </div>
@endisset

@isset($InnoSpeakerID)
  <div class="edit-delete-action">
    <a class="me-2 p-2" href="{{ route('admin.speakers.info', ['data_id'=> $id ]) }}">
      <i data-feather="edit" class="feather-edit"></i>
    </a>
    <a class="confirm-text p-2" href="{{ route('admin.speakers.destroy', ['data_id'=> $id ]) }}">
      <i data-feather="trash-2" class="feather-trash-2"></i>
    </a>
  </div>
@endisset

@isset($AreaProjectID)
  <div class="edit-delete-action">
    <a class="me-2 p-2" href="{{ route('admin.ap.info', ['data_id'=> $id ]) }}">
      <i data-feather="edit" class="feather-edit"></i>
    </a>
  </div>
@endisset


@isset($NewsCatID)
  <div class="edit-delete-action">
    <a class="me-2 p-2" href="{{ route('admin.nc.info', ['data_id'=> $id ]) }}">
      <i data-feather="edit" class="feather-edit"></i>
    </a>
    <a class="confirm-text p-2" href="{{ route('admin.nc.destroy', ['data_id'=> $id ]) }}">
      <i data-feather="trash-2" class="feather-trash-2"></i>
    </a>
  </div>
@endisset

@isset($NewsID)
  <div class="edit-delete-action">
    <a class="me-2 p-2" href="{{ route('admin.news.info', ['data_id'=> $id ]) }}">
      <i data-feather="edit" class="feather-edit"></i>
    </a>
    <a class="confirm-text p-2" href="{{ route('admin.news.destroy', ['data_id'=> $id ]) }}">
      <i data-feather="trash-2" class="feather-trash-2"></i>
    </a>
  </div>
@endisset

@isset($GalleryID)
  <div class="edit-delete-action">
    <a class="me-2 p-2" href="{{ route('admin.gallery.info', ['data_id'=> $id ]) }}">
      <i data-feather="edit" class="feather-edit"></i>
    </a>
    <a class="confirm-text p-2" href="{{ route('admin.gallery.destroy', ['data_id'=> $id ]) }}">
      <i data-feather="trash-2" class="feather-trash-2"></i>
    </a>
  </div>
@endisset

@isset($InnoScheduleID)
  <div class="edit-delete-action">
    <a class="me-2 p-2" href="{{ route('admin.schedules.info', ['data_id'=> $id ]) }}">
      <i data-feather="edit" class="feather-edit"></i>
    </a>
    <a class="confirm-text p-2" href="{{ route('admin.schedules.destroy', ['data_id'=> $id ]) }}">
      <i data-feather="trash-2" class="feather-trash-2"></i>
    </a>
  </div>
@endisset


@isset($GuestUserID)
  <div class="edit-delete-action">
    <a class="me-2 p-2" href="{{ route('admin.guests.info', ['data_id'=> $id ]) }}">
      <i data-feather="edit" class="feather-edit"></i>
    </a>
    <a class="confirm-text p-2" href="{{ route('admin.guests.destroy', ['data_id'=> $id ]) }}">
      <i data-feather="trash-2" class="feather-trash-2"></i>
    </a>
  </div>
@endisset


@isset($InnoLiveID)
  <div class="edit-delete-action">
    <a class="me-2 p-2" href="{{ route('admin.live.info', ['data_id'=> $id ]) }}">
      <i data-feather="edit" class="feather-edit"></i>
    </a>
    <a class="confirm-text p-2" href="{{ route('admin.live.destroy', ['data_id'=> $id ]) }}">
      <i data-feather="trash-2" class="feather-trash-2"></i>
    </a>
  </div>
@endisset
