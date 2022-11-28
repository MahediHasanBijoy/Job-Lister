@extends('layout')


@section('content')

	@include('includes._search')

	<a href="/" class="inline-block text-black ml-4 mb-4"
                ><i class="fa-solid fa-arrow-left"></i> Back
    </a>
    <div class="mx-4">
        <x-card class="p-10">
            <div
                class="flex flex-col items-center justify-center text-center"
            >
                <img
                    class="w-48 mr-6 mb-6"
                    src="{{$listing->logo ? asset('storage/logos/'.$listing->logo) : asset('images/no-image.png')}}"
                    alt="logo image"
                />

                <h3 class="text-2xl mb-2">{{ $listing->title }}</h3>
                <div class="text-xl font-bold mb-4">{{ $listing->company }}</div>
                {{-- tags component --}}
                <x-listing-tags :tags="$listing->tags"/>
                <div class="text-lg my-4">
                    <i class="fa-solid fa-location-dot"></i> {{$listing->location}}
                </div>
                <div class="border border-gray-200 w-full mb-6"></div>
                <div>
                    <h3 class="text-3xl font-bold mb-4">
                        Job Description
                    </h3>
                    <div class="text-lg space-y-6">
                        {{$listing->description}}

                        <a
                            href="mailto:{{$listing->email}}"
                            class="block bg-orange-500 text-white mt-6 py-2 rounded-xl hover:opacity-80"
                            ><i class="fa-solid fa-envelope"></i>
                            Contact Employer</a
                        >

                        <a
                            href="{{$listing->website}}"
                            target="_blank"
                            class="block bg-black text-white py-2 rounded-xl hover:opacity-80"
                            ><i class="fa-solid fa-globe"></i> Visit
                            Website</a
                        >
                    </div>
                </div>

                {{-- 
                <a class="block bg-blue-700 text-white mt-6 py-2 px-4 rounded-xl hover:opacity-80" href="{{route('listing.edit', $listing->id)}}">Edit</a>
                <a class="block bg-red-700 text-white mt-6 py-2 px-4 rounded-xl hover:opacity-80" href="{{route('listing.destroy', $listing->id)}}">Delete</a> --}}
            </div>

        </x-card>
    </div>
	


@endsection