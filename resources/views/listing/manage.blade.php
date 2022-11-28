@extends('layout')

@section('content')

	@include('includes/_search')

	<div class="mx-4">
	    <div class="bg-gray-50 border border-gray-200 p-10 rounded">
	        <header>
	            <h1
	                class="text-3xl text-center font-bold my-6 uppercase"
	            >
	                Manage Jobs
	            </h1>
	        </header>

	        <table class="w-full table-auto rounded-sm">
	            <tbody>
	            	@foreach($listings as $listing)
	                <tr class="border-gray-300">
	                    <td
	                        class="px-2 py-4 border-t border-b border-gray-300 text-lg"
	                    >
	                        <a href="show.html">
	                            {{$listing->title}}
	                        </a>
	                    </td>
	                    <td
	                        class="px-2 py-4 border-t border-b border-gray-300 text-lg"
	                    >
	                        <a
	                            href="{{route('listing.edit', $listing->id)}}"
	                            class="text-blue-400 px-6 py-2 rounded-xl"
	                            ><i
	                                class="fa-solid fa-pen-to-square"
	                            ></i>
	                            Edit</a
	                        >
	                    </td>
	                    <td
	                        class="px-2 py-4 border-t border-b border-gray-300 text-lg"
	                    >
	                        
                            <a href="{{route('listing.destroy', $listing->id)}}" class="text-red-600">
                                <i
                                    class="fa-solid fa-trash-can"
                                ></i>
                                Delete
                            </a>
                        
	                    </td>
	                </tr>
	                @endforeach
	              
	            </tbody>
	        </table>
	        <div class="pt-6">
	        	{{ $listings->links()}}
	        </div>
	        
	    </div>

	</div>
@endsection