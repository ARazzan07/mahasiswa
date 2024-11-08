@extends('layout.menu')
@section('konten')

<form action="{{ route('login_proses') }}" method="post">
    @csrf
    <div class="form-group">
        <label class="form-control-label">Username : </label>
        <input type="text" name="username" class="form-control" placeholder="Enter your username">
    <div>
    @error('username')
        <span style="color:crimson">{{ $message }}</span>
    @enderror
    </div>
    </div>
    <div class="form-group">
        <label class="form-control-label">Password :</label>
        <input type="password" name="password" class="form-control" placeholder="Enter your password">
    <div>
    @error('password')
        <span style="color:crimson">{{ $message }}</span>
    @enderror
    </div>
    </div>
    <br />
    <button type="submit" class="btn btn-block">Login</button>
</form>

@endsection
