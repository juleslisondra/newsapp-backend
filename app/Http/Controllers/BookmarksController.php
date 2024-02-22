<?php

namespace App\Http\Controllers;

use App\Http\Resources\BookmarkResource;
use App\Models\Bookmark;
use App\Models\User;
use App\Http\Requests\BookmarkCreateRequest;
use App\Http\Requests\BookmarkUpdateRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookmarksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bookmarks = Bookmark::with(['user'])->paginate(10);

        return BookmarkResource::collection($bookmarks);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BookmarkCreateRequest $request)
    {
        $data = $request->validated();
        $data['published_date'] = Carbon::parse($data['published_date'])->format('Y-m-d');
        $data['user_id'] = Auth::user()->id;

        $bookmark = Bookmark::create($data);

        return new BookmarkResource($bookmark);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $bookmark = Bookmark::with(['user'])->where('id', $id)->first();
        
        return new BookmarkResource($bookmark);
    }

    public function bookmarks(Request $request,string $id)
    {
        $marks = Bookmark::where('user_id', $id)->get();
        
        return response()->json([
            "status" => true,
            "search" => $marks
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BookmarkUpdateRequest $request, string $id)
    {
        $data = $request->validated();
        $data = array_filter($data);
        $bookmark = Bookmark::where('id', $id)->first();
        $bookmark->update($data);

        return response()->json(['message' => 'Bookmark updated successfully']);
    }

    /**t 
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Bookmark::where('id', $id)->delete();
        
        return response()->json(['message' => 'Bookmark deleted successfully']);
    }
}
