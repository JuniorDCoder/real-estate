@extends('layouts.default')

@section('content')
 @include('includes.breadcrumb', [
        'title' => 'About Us',
        'backgroundImage' => 'img/bg-img/hero1.jpg'
    ])
    @include('includes.property-search')
    @include('includes.about-content')
    @include('includes.team')
@endsection
