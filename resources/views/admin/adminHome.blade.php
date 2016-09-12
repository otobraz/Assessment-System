@extends('dashboard.dashboard_base')

@section('title')
   {{session()->get('role')}} | Home
@endsection

@section('sidebar')
   @include('admin.sidebar')
@endsection

@section('content')

   @include('student.students_list')
   @include('major.majors_list')
   @include('department.departments_list')
   @include('admin.admins_list')

@endsection
