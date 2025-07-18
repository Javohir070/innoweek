@isset($CompanyID)
    <a href="{{ route('admin.companies.info', ['company_id'=> $id ]) }}">{{ $company_name }}</a>
@endisset
@isset($ProjectID)
    @if (!empty($passport_file))
        <a href="{{ route('admin.projects.info', ['project_id'=> $id, 'cooperation' => true ]) }}">{{ $project_title }}</a>
    @else
        <a href="{{ route('admin.projects.info', ['project_id'=> $id ]) }}">{{ $project_title }}</a>
    @endif
@endisset

@isset($ProjectCatID)
    <a href="{{ route('admin.pc.info', ['data_id'=> $id ]) }}">{{ $name_uz }}</a>
@endisset

@isset($ProjectTypeID)
    <a href="{{ route('admin.pt.info', ['data_id'=> $id ]) }}">{{ $name_uz }}</a>
@endisset

@isset($UserDeptID)
    <a href="{{ route('admin.ud.info', ['data_id'=> $id ]) }}">{{ $name_uz }}</a>
@endisset

@isset($ProjectAreaID)
    <a href="{{ route('admin.pa.info', ['data_id'=> $id ]) }}">{{ $name_uz }}</a>
@endisset

@isset($AreaProjectID)
    <a href="{{ route('admin.ap.info', ['data_id'=> $id ]) }}">{{ $project_title }}</a>
@endisset

@isset($NewsCatID)
    <a href="{{ route('admin.nc.info', ['data_id'=> $id ]) }}">{{ $name_uz }}</a>
@endisset

@isset($NewsID)
    <a href="{{ route('admin.news.info', ['data_id'=> $id ]) }}">{{ $title_uz }}</a>
@endisset

@isset($ArchiveGalleryID)
    <a href="{{ route('admin.gallery.info', ['archive_id'=> $id ]) }}">Foto/Video galereya {{ $year }}</a>
@endisset

@isset($InnoSpeakerID)
    <a href="{{ route('admin.speakers.info', ['data_id'=> $id ]) }}">{{ $full_name_uz }}</a>
@endisset

@isset($InnoScheduleID)
    <a href="{{ route('admin.schedules.info', ['data_id'=> $id ]) }}">{{ $title_uz }}</a>
@endisset

@isset($InnoLiveID)
    <a href="{{ route('admin.live.info', ['data_id'=> $id ]) }}">{{ $title_uz }}</a>
@endisset

@isset($InnoEventID)
    {{ $event['title_uz'] }} 
@endisset