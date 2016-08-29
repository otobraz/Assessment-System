@extends('dashboard.dashboard_base')

@section('sidebar')
   @include('admin.sidebar')
@endsection

@section('content')
   @include('department.departments_list')
@endsection
