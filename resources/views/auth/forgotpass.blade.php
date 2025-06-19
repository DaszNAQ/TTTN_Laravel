@extends('admin.layout')

@section('content')
<div class="d-flex justify-content-center">
    <div class="card p-4" style="min-width: 400px;">
        <h4 class="text-center mb-4">Quên mật khẩu</h4>

        @if($errors->any())
            <div class="alert alert-danger">
                @foreach($errors->all() as $err)
                    <div>{{ $err }}</div>
                @endforeach
            </div>
        @endif

        <form action="{{ route('forgotpasspost') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" placeholder="Nhập email đăng ký">
            </div>

            <button type="submit" class="btn btn-primary w-100">Đặt lại mật khẩu</button>
        </form>

        <div class="mt-2 text-center">
            <a href="{{ route('login') }}">← Quay về đăng nhập</a>
        </div>
    </div>
</div>
@endsection

