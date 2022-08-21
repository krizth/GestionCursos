@extends('layouts.app')

@section('content')

@php
    $token=csrf_token();
@endphp
<course-list :routes="{{Illuminate\Support\Js::from([
    'create'=>[
        'url'=>route('asignaturas.store'),
        'method'=>'POST',
        'csrf'=>$token
    ],
    'edit'=>[
        'url'=>route('asignaturas.update','?'),
        'method'=>'POST',
        'csrf'=>$token
    ],
    'delete'=>[
        'url'=>route('asignaturas.destroy','?'),
        'method'=>'POST',
        'csrf'=>$token
    ],

])}}" 
:courses="{{ Illuminate\Support\Js::from($asignaturas)}}"
/>

@endsection
