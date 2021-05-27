@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <div style="float: left">
                <div class="input-group">
                    <a href="{{ route('add_user') }}">
                        <button type="submit" class="btn btn-md btn-primary" style="font-size: 13">
                        <i class="fas fa-user-plus"></i>
                        Add User
                    </button>
                    </a>
                </div>
            </div>
    
            <div style="float: right">
                <form action="{{ route('search') }}" method="get">
                    @csrf
                    <div class="input-group">
                        <input type="search" size=35 name="tag" class="form-control" placeholder="Search for user" required >
                        <span class="input-group-prepend">
                            <button type="submit" class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-search"></i>
                                Search
                            </button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="row mt-1 justify-content-center">
        <div class="col">
            <div class="card">
                <table class="table table-bordered"
                    style="margin-bottom: 0px; font-size: 13px">
                    <thead>
                        <tr>
                            <th>UID</th>
                            <th>Name</th>
                            <th>Employee ID</th>
                            <th>E-mail</th>
                            <th>Role</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    @if (count($userList))
                    <tbody>
                        @foreach ($userList as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->empID }}</td>
                            <td><a href="mailto: {{ $user->email }}">{{ $user->email }}</a></td>
                            <td>
                                @if ($user->hasRole('user'))
                                    {{ 'User' }}
                                @else
                                    {{ 'Admin' }}
                                @endif
                            </td>
                            <td>{{ date('d/m/Y', strtotime($user->created_at)) }}</td>
                            <td>{{ date('d/m/Y', strtotime($user->updated_at)) }}</td>
                            <td>
                                @if ($user->id == auth()->user()->id)
                                    <p>Current Admin</p>
                                @else
                                    <form action="manage_users/{{ $user->id }}" method="post">
                                        <a href="manage_users/{{ $user->id }}" class="btn btn-success btn-sm">
                                        <i class="far fa-edit"></i>
                                        Edit</a>

                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm delete-confirm ml-1">
                                        <i class="far fa-trash-alt"></i>
                                        Delete</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    @else
                        <tbody>
                            <tr>
                                <td colspan="9" align="center">No Such User.</td>
                            </tr>
                        </tbody>
                    @endif
                </table>
            </div>
        </div>
    </div>
</div>
<div class="mt-3 d-flex justify-content-center">
    {{ $userList->links() }}
</div>

<div class="mt-1 d-flex justify-content-center">
    @if (count($userList))
        Viewing {{ $userList->firstItem() }} - {{ $userList->lastItem() }} of {{ $userList->total() }} entries
    @else
        Viewing 0 entries
    @endif
</div>
@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
@endpush
@stack('scripts')