@extends('layout.layout')
@section('title','Managemen User')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <span class="h1">
                    Edit data Managemen User
                </span>
            </div>
            <div class="card-body">
                <form method="POST" action="/managemen-user/user/update" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-success">Update</button>
                        </div>
                        <p>
                            <hr>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <input type="hidden" class="form-control" name="id_user" value="{{ $data->id_user }}" />
                                <label>Username</label>
                                <input type="text" class="form-control" name="username" value="{{ $data->username }}" />
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="text" class="form-control" name="password" value="" />
                            </div>
                            <div class="form-group">
                                <label>Role</label>
                                <select class="form-select" name="role" aria-label="Default select example">
                                    @if($data->role == 'admin')
                                        <option selected value="admin">Admin</option>
                                    @else
                                        <option value="admin">Admin</option>
                                    @endif
                                    @if($data->role == 'operator')
                                        <option selected value="operator">Operator</option>
                                    @else
                                        <option value="operator">Operator</option>
                                    @endif
                                  </select>
                            </div>
                            @csrf
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
@endsection