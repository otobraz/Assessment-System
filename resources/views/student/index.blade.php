@extends('dashboard.dashboard_base')

@section('title')
   Gerenciar - Alunos
@endsection

@section('sidebar')
   @include('admin.sidebar')
@endsection

@section('content')
   @include('student.students_list')
@endsection
