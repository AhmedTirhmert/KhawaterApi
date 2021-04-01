<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Note;
use App\Models\Category;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function Notes(Request $request)
    {
        $Notes= Note::where('author_id',$request->userId)->with(['Category','Project','Author'])->orderBy('created_at','DESC')->get();
        return response()->json([
            'Notes' => $Notes,
        ], 200);
    }
    public function publicNotes()
    {
        $Notes= Note::where('public',true)->with(['Category','Project','Author'])->orderBy('created_at','DESC')->get();
        return response()->json([
            'Notes' => $Notes,
        ], 200);
    }
    public function Categories()
    {
        $Categories= Category::withCount("Notes")->where('owner',Auth::user()->id)->get();
        return response()->json([
            'Categories' => $Categories,
        ], 200);
    }
    public function Projects()
    {
        $Projects= Project::withCount('Notes')->where('owner',Auth::user()->id)->get();
        return response()->json([
            'Projects' => $Projects,
        ], 200);
    }
}
