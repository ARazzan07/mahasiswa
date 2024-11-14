@extends('layout.menu')

@section('konten')

{{-- Menampilkan pesan jika login berhasil --}}
@if(session('success'))
    <div class="alert alert-success mt-3">
        {{ session('success') }}
    </div>
@endif

{{-- Menampilkan pesan jika login gagal --}}
@if($errors->any())
    <div class="alert alert-danger mt-3">
        @foreach($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif

{{-- Menampilkan pesan jika logout berhasil --}}
@if(session('logout'))
    <div class="alert alert-success mt-3">
        {{ session('logout') }}
    </div>
@endif

<form action="{{ route('login_proses') }}" method="POST">
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
