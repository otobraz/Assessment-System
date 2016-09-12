@extends('dashboard.dashboard_base')

@section('title')
   {{session()->get('role')}} | Home
@endsection

@section('userType')
   Professor
@endsection

@section('sidebar')
   @include('professor.sidebar')
@endsection

@section('content')

@endsection
