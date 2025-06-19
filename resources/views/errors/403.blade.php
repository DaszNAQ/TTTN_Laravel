@extends('admin.layout')

@section('content')
    <div class="alert alert-danger mt-5">
        <h4>403 - Bạn không có quyền truy cập chức năng này!</h4>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-primary mt-3">Quay về Dashboard</a>
    </div>
@endsection
