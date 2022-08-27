@extends('layouts.app')

@section('content')

@php
    $token=csrf_token();
@endphp
<imparts-list :routes="{{Illuminate\Support\Js::from([
    'create'=>[
        'url'=>route('imparte.store'),
        'method'=>'POST',
        'csrf'=>$token
    ],
    'edit'=>[
        'url'=>route('imparte.update','?'),
        'method'=>'POST',
        'csrf'=>$token
    ],
    'delete'=>[
        'url'=>route('imparte.destroy','?'),
        'method'=>'POST',
        'csrf'=>$token
    ],

])}}" 
:users="{{ Illuminate\Support\Js::from($users)}}"
:courses="{{ Illuminate\Support\Js::from($asignaturas)}}"
/>

@endsection

