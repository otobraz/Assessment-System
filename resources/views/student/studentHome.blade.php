@extends('dashboard.dashboard_base')

@section('title')
   {{session()->get('role')}} | Home
@endsection

@section('userType')
   Aluno
@endsection

@section('sidebar')
   @include('student.sidebar')
@endsection

@section('content')

@endsection
