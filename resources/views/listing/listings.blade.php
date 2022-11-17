
@extends('layout')

@section('content')
@include('includes._hero')
@include('includes._search')

<div class="lg:grid lg:grid-cols-2 gap-4 space-y-4 md:space-y-0 mx-4">

    @foreach($listings as $listing)
    <!-- Item 1 -->
    <x-listing_card :listing="$listing" />
    @endforeach
</div>


<div class="pt-3 px-5 bg-black-200">
        {{-- adding additional query strings to pagination query string  when search or tags used --}}
        {{ $listings->appends(request()->query())->links() }}
</div>

    @if(session()->has('success'))
    <div class="create-listing-success fixed top-0 left-1/2 px-3 py-1 -translate-x-1/2 bg-orange-500">
        {{session('success')}}
    </div>
        
    @endif
@endsection