@extends('layouts.app')

@section('content')
    @include('partials.masthead')
    {{-- @include('partials.intro') --}}
    @include('partials.spotlight')
    @include('partials.spec')
    @include('partials.cta')
    @include('partials.testimonials')
    <livewire:form />
    @include('partials.message')
@endsection
