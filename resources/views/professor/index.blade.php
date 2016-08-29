@extends('dashboard.dashboard_base')

@section('sidebar')
   @include('admin.sidebar')
@endsection

@section('content')
   @include('professor.professors_list')
@endsection
