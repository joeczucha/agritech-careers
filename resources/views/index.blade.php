@extends('layouts.app')

@section('content')
    @include('partials.masthead')
    @include('partials.intro')
    @include('partials.spotlight')
    @include('partials.spec')
    @include('partials.testimonials')
    @include('partials.message')
    <livewire:form />
@endsection
