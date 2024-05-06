@extends('kui::layouts.master')

@section('content')
    <h1>Hello World</h1>

    <p>Module: {!! config('kui.name') !!}</p>
@endsection
