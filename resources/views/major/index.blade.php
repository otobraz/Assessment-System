@extends('dashboard.dashboard_base')

@section('sidebar')
   @include('admin.sidebar')
@endsection

@section('content')
   @include('major.majors_list')
@endsection
