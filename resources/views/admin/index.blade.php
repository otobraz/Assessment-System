@extends('dashboard.dashboard_base')

@section('sidebar')
   @include('admin.sidebar')
@endsection

@section('content')
   @include('admin.admins_list')
@endsection
