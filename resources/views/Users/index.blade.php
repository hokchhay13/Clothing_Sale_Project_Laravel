@extends('layouts.app')

@section('title' , 'Users Data')

@section('content')
    <div class="container mt-3">
        <div class="card rounded-0">
            <div class="card-body">
                <div class="row m-2 align-items-center">
                    <div class="col-8 p-0">
                        <h1>User Data</h1>
                    </div>
                    <div class="col-4">
                        <div class="row align-items-center">

                            <nav
                                class="navbar navbar-header-left navbar-expand-lg navbar-form nav-search p-0 d-none d-lg-flex">
                                <div class="input-group rounded-5">
                                    <div class="input-group-prepend">
                                        <button type="submit" class="btn btn-search pe-1">
                                            <i class="fa fa-search search-icon"></i>
                                        </button>
                                    </div>
                                    <input type="text" id="search" placeholder="Search ..." class="form-control" />
                                </div>
                            </nav>
                        </div>
                    </div>
                </div>
                {{-- @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif --}}

                <table class="table table-responsive table-sm table-hover" id="userTable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Profile</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>
                                    @if ($user->profile_picture)
                                        <img src="{{ asset('storage/' . $user->profile_picture) }}"
                                            alt="{{ $user->name }}" class="avatar-lg rounded-5 "
                                            width="100">
                                    @else
                                        No picture
                                    @endif
                                </td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ ucfirst($user->role) }}</td>

                                <td>{{ $user->created_at }}</td>
                                <td>
                                    <div class="dropdown ">
                                        <button class="btn btn-secondary btn-sm dropdown-toggle" type="button"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            Action
                                        </button>
                                        <ul class="dropdown-menu">
                                            <div class=" d-flex align-items-center justify-content-center gap-1"> 
                                            <li> <a href="{{ route('users.show', $user->id) }}"
                                                    class="btn btn-info btn-sm rounded-5"><i class="bi bi-eye"></i></a></li>
                                            <li> <a href="{{ route('users.edit', $user->id) }}"
                                                    class="btn btn-warning btn-sm rounded-5"><i class="bi bi-pencil-square"></i></a>
                                            </li>
                                            <li>
                                                <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                                    style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm rounded-5"
                                                        onclick="return confirm('Are you sure you want to delete this user?')"><i
                                                            class="bi bi-trash"></i></button>
                                                </form>
                                            </li>

                                            </div>
                                        </ul>
                                    </div>
            
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('search').addEventListener('keyup', function() {
            let filter = this.value.toUpperCase();
            let rows = document.querySelector("#userTable tbody").rows;

            for (let i = 0; i < rows.length; i++) {
                let name = rows[i].cells[1].textContent.toUpperCase();
                let email = rows[i].cells[2].textContent.toUpperCase();
                let role = rows[i].cells[3].textContent.toUpperCase();

                if (name.indexOf(filter) > -1 || email.indexOf(filter) > -1 || role.indexOf(filter) > -1) {
                    rows[i].style.display = "";
                } else {
                    rows[i].style.display = "none";
                }
            }
        });
    </script>
@endsection
