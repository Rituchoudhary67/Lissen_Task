<!DOCTYPE html>
<html>
<head>
    <title>Users List</title>
    <link rel="stylesheet" href="{{ asset('css/user.css') }}">
</head>
<body>
<div class="container">
    <div class="header">
        <h1>Registered Users</h1>
        <a href="{{ url('register') }}" style="display:inline-block; margin-bottom:10px; padding:8px 12px; background:#28a745; color:white; text-decoration:none; border-radius:4px;">
            + Add New User
        </a>
    </div>
<!-- Search Form -->
<form method="GET" action="{{ url('users') }}">
    <input name="email" placeholder="Search by email" value="{{ request('email') }}">
    <input name="name" placeholder="Search by name" value="{{ request('name') }}">
    <button type="submit">Search</button>

     @if(request('email') || request('name'))
        <a href="{{ url('users') }}" style="margin-left:10px; padding:5px 10px; background:#dc3545; color:white; text-decoration:none; border-radius:4px;">
            Clear Filters
        </a>
    @endif

</form>
<!-- Users Table -->
<table border="1" cellpadding="5" cellspacing="0">
    <tr>
        <th>Profile Picture</th>
        <th>Name</th>
        <th>Email</th>
        <th>Country</th>
        <th>Gender</th>
    </tr>
    @foreach($users as $u)
    <tr>
        <td>
            @if($u->profile && $u->profile->pic)
                <img src="{{ asset('storage/'.$u->profile->pic) }}" width="50">
            @else
                N/A
            @endif
        </td>
        <td>{{ $u->profile->first_last_name ?? 'N/A' }}</td>
        <td>{{ $u->email }}</td>
        <td>{{ $u->profile->country ?? 'N/A' }}</td>
        <td>{{ $u->profile->gender ?? 'N/A' }}</td>
    </tr>
    @endforeach
</table>

<!-- Pagination -->
{{ $users->links() }}

<a href="{{ url('logout') }}">Logout</a>
</div>
</body>
</html>