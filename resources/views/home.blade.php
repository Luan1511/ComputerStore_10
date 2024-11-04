@extends('layouts.app')

@section('content')
    {{-- Banner --}}
    @include('components.banner')
    
    {{-- List product --}}
    @include('components.list-product')
@endsection
