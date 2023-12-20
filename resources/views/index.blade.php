@extends('layouts.app')

@section('title')
    Principal
@endsection

@section('content')

    <x-listar-post :posts="$posts" />

@endsection
