@extends('admin.layout')

@section('content')
<div class="d-flex justify-content-center">
    <div class="card p-4" style="min-width: 400px;">
        <h4 class="text-center mb-4">Đăng nhập hệ thống</h4>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
                @foreach($errors->all() as $err)
                    <div>{{ $err }}</div>
                @endforeach
            </div>
        @endif

        <form action="{{ url('login') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" placeholder="Nhập email">
            </div>

            <div class="mb-3">
                <label>Mật khẩu</label>
                <input type="password" name="password" class="form-control" placeholder="Nhập mật khẩu">
            </div>

            <button type="submit" class="btn btn-primary w-100">Đăng nhập</button>
        </form>

        <div class="mt-2 text-center">
            <a href="{{ route('forgotpass') }}">Quên mật khẩu?</a> 
        </div>
    </div>
</div>
@endsection
