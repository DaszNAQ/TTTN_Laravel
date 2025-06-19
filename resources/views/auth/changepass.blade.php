@extends('admin.layout')

@section('content')
    <div class="d-flex justify-content-center">
        <div class="card p-4" style="min-width: 400px;">
            <h4 class="text-center mb-4">Đổi mật khẩu</h4>

            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif


            <form action="{{ route('password.update') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label>Mật khẩu hiện tại</label>
                    <input type="password" name="current_password" class="form-control" placeholder="Nhập mật khẩu hiện tại">
                </div>

                <div class="mb-3">
                    <label>Mật khẩu mới</label>
                    <input type="password" name="new_password" class="form-control" placeholder="Nhập mật khẩu mới">
                </div>

                <div class="mb-3">
                    <label>Xác nhận mật khẩu mới</label>
                    <input type="password" name="new_password_confirmation" class="form-control"
                        placeholder="Nhập lại mật khẩu mới">
                </div>

                <button type="submit" class="btn btn-primary w-100">Đổi mật khẩu</button>
            </form>
        </div>
    </div>
@endsection
