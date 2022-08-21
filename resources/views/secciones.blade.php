@extends('layouts.app')

@section('content')

@php
    $token=csrf_token();
@endphp
<section-list :routes="{{Illuminate\Support\Js::from([
    'create'=>[
        'url'=>route('secciones.store'),
        'method'=>'POST',
        'csrf'=>$token
    ],
    'edit'=>[
        'url'=>route('secciones.update','?'),
        'method'=>'POST',
        'csrf'=>$token
    ],
    'delete'=>[
        'url'=>route('secciones.destroy','?'),
        'method'=>'POST',
        'csrf'=>$token
    ],

])}}" 
:courses="{{ Illuminate\Support\Js::from($asignaturas)}}"
/>


@endsection

