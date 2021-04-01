<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Note;

use Illuminate\Support\Facades\Validator;


class NotesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $NewNote=json_decode($request->input('Note'),true);
        $createdNote=Note::create([
            'title'=>$NewNote['title'],
            'body'=>$NewNote['body'],
            'public'=>$NewNote['public'],
            'category_id'=>$NewNote['category'],
            'project_id'=>$NewNote['project'],
            'author_id'=>$NewNote['userId'],
        ]);
        return response()->json([
            'newNote' => Note::with(['Project','Category','Author'])->find($createdNote->id),
            'Success' => true,
            'Message' => 'تمة إضافة المذكرة بنجاح'
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $EditedNote=json_decode($request->input('note'),true);
        $rules=[
            'body' => "required|min:16",
            'title' => "required|min:10",
        ];
        $validation = Validator::make($EditedNote,$rules);

        if ($validation->passes()) {
            $originalNote=Note::find($id);
        $originalNote->update([
            "title" => $EditedNote["title"],
            "body" => $EditedNote["body"],
            "public" => $EditedNote["public"],
            "category_id" => $EditedNote["category_id"],
            "project_id" => $EditedNote["project_id"],
        ]);
        $originalNote->save();
        return response()->json([
            'Message' => 'تم تحديت المذكرة بنجاح',
            "edittedNote" => Note::where("id",$id)->with(['Author','Category','Project'])->get()[0]
        ], 200);
        }else{
            return response()->json([
                'errors' => $validation->errors()->all()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $noteToDelete = Note::find($id);
        $noteToDelete->delete();
        return response()->json([
            'Message' => 'تم حذف المذكرة بنجاح'
        ], 200);
    }
}
