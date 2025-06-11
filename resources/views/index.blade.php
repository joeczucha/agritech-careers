@extends('layouts.app')

@section('content')
    @include('components.masthead')
    @include('components.intro')
    @include('components.spotlight')
    @include('components.spec')
    @include('components.testimonials')
    @include('components.message')
    <livewire:form />
@endsection
