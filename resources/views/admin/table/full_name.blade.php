@isset($CompanyID)
    {{ $last_name }} {{ $first_name }} 
@endisset
@isset($ProjectID)
    {{ $author['company_name'] }}
@endisset

@isset($UserID)
    <a href="{{ route('admin.users.info', ['user_id'=>$id]) }}">{{ $last_name }} {{ $first_name }}</a>
@endisset

@isset($AreaProjectID)
    {{ $author['company_name'] }}
@endisset

@isset($GuestUserID)
    <a href="{{ route('admin.guests.info', ['data_id'=>$id]) }}">{{ $last_name }} {{ $first_name }}</a>
@endisset

@isset($InnoEventID)
    {{ $user['last_name'] ?? "" }} {{ $user['first_name'] ?? "" }} 
@endisset

@isset($CheckerUserID)
    {{ $last_name }} {{ $first_name }} 
@endisset
