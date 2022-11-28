<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Listing;
use Illuminate\Support\Facades\Storage;

class ListingController extends Controller
{
    //show all listings
    public function index(){

        // when tag is selected as query string
        if(request('tag')){
            $search_str = request('tag');
            $listings = Listing::where('tags', 'like', '%'.$search_str.'%')->latest()->paginate(6);
            return view('listing.listings', compact('listings'));
        }
        // when search is used as query string
        else if(request('search')){
            $search_str = request('search');

            $listings = Listing::where('title', 'like', '%'.$search_str.'%')->orWhere('tags', 'like', '%'.$search_str.'%')->orWhere('description', 'like', '%'.$search_str.'%')->latest()->paginate(6);
            return view('listing.listings', compact('listings'));
        }
        // showing all listings
        else{
            $listings = Listing::latest()->paginate(6);
            return view('listing.listings', compact('listings'));
        }
    }

    // show single listing with route model binding
    public function show(Listing $listing){
        return view('listing.listing', compact('listing'));
    }

    /*// show single listing without route model binding
    public function show($id){
        $listing = Listing::find($id);
        return view('listing', ['listing'=>$listing]);
    }*/


    // show create listing form
    public function create(){
        return view('listing.create');
    }

    // store form data
    public function store(Request $request){
        // validate form data
        $validData =$request->validate([
            'company'=>'required',
            'title'=>'required',
            'location'=>'required',
            'email'=>['required', 'email'],
            'website'=>'required',
            'tags'=>'required',
            'description'=>'required',
        ]);
        // first change 'default' => env('FILESYSTEM_DISK', 'local'), to 'default' => env('FILESYSTEM_DISK', 'local') in config/filesystems.php to access files from public folder
        
        if($request->file('logo')){
            // upload logo in storage/app/public/logos
            $path = $request->logo->store('logos', 'public');

            // filename of the uploaded file
            $filename = $request->file('logo')->hashName();

            $validData['logo']=$filename;
        }
        
        // store current authenticated user id
        $validData['user_id'] = auth()->id();


        // store form data
        Listing::create($validData);

        // redirect and flash message
        return redirect('/')->with('success', 'You posted a job successfully');
    }


    // Edit listing show
    public function edit(Listing $listing){
        return view('listing.edit', compact('listing'));
    }

    // Update listing
    public function update(Request $request, Listing $listing){
        // check if the user is authorized before update
        if($listing->user_id != auth()->id()){
            abort('403', 'Unauthorized action');
        }
        //validation rules
        $validData = $request->validate([
            'company'=>'required',
            'title'=>'required',
            'location'=>'required',
            'email'=>['required', 'email'],
            'website'=>'required',
            'tags'=>'required',
            'description'=>'required',
        ]);

        // file update
        if($request->hasFile('logo')){

            // delete old logo from storage
            if(!is_null($listing->logo)){
                $files = Storage::delete('public/logos/'.$listing->logo);
            }
            // store file in storage
            $path =  $request->file('logo')->store('public/logos');

            // filename of the uploaded file
            $filename = $request->file('logo')->hashName();

            $validData['logo'] = $filename;
        }

        //update listing data
        $listing->update($validData);

        // redirect and flash message
        return redirect('/listing/'.$listing->id)->with('success', 'You update a job successfully');
    }

    // Delete listing
    public function destroy(Listing $listing){
        // check if the user is authorized before delete
        if($listing->user_id != auth()->id()){
            abort('403', 'Unauthorized action');
        }

        // remove file from storage
        if(!is_null($listing->logo)){
            Storage::delete('public/logos/'.$listing->logo);
        }
        $listing->delete();
        return redirect('/');
    }

    // Manage Listing
    public function manage(){
        $user = auth()->user();
        // user listing relationship
        $listings = $user->listings()->latest()->paginate(6);

        return view('listing.manage', compact('listings'));
    }
}
