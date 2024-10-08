@extends('layouts.menu')
@section('title','Users')

@section('content')
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-4">
                @foreach($users as $user)
                    <div class="card">
                        <div class="card-body text-center">
                            <img src="data:image/png;base64,{{$user->image}}" alt="User Image" class="rounded-circle mb-3" width="100" height="100">
                            <h5 class="card-title">{{$user->name}}</h5>
                            <p class="card-text">{{$user->email}}</p>
                            <form method="post">
                                @csrf
                                <input hidden name="id" value="{{$user->id}}">
                                <div class="form-group mb-3">
                                    <label for="roleSelect" class="form-label">Give role:</label>
                                    <select name="role" class="form-select" id="roleSelect">
                                        <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
                                        <option value="moderator" {{ $user->role == 'moderator' ? 'selected' : '' }}>Moderator</option>
                                        <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                    </select>
                                </div>

                                <button type="submit" name="type" value="update" class="btn btn-primary" id="saveRoleBtn">Save</button>
                                <button type="submit" name="type" value="delete" class="btn btn-danger" id="saveRoleBtn">Delete</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>



@endsection

