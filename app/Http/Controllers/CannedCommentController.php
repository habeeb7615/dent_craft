<?php

namespace App\Http\Controllers;

use App\Http\Requests\CannedComments\StoreRequest;
use App\Models\CannedComment;
use App\Models\User;

class CannedCommentController extends Controller
{
    public function index()
    {
        $comments =  CannedComment::all();

        return datatables()->of($comments)
                        ->addIndexColumn()
                        ->editColumn('title', function ($row)
                        {
                            return $row->title;
                        })
                        ->editColumn('comment', function ($row)
                        {
                            return $row->comment;
                        })
                        ->editColumn('date_added', function ($row)
                        {
                            return $row->created_at->format('d-m-Y h:i:s A');
                        })
                        ->addColumn('actions', function ($row)
                        {
                            $actions = '<a href="#" class="text-danger" onclick="delete_comment('.$row->id.')"><i class="far fa-trash-alt"></i></a>';

                            return $actions;
                        })
                        ->rawColumns(['actions'])
                        ->make();
    }

    public function store(StoreRequest $request)
    {
        $comment = new CannedComment();

        $comment->user_id = auth()->user()->id;
        $comment->title = $request->title;
        $comment->comment = $request->comment;

        $comment->save();

        $cannedComments = CannedComment::orderBy('created_at', 'desc')->get();

        $view = view('pages.partials.canned_comments', compact('cannedComments'))->render();

        return response()->json([
            'view' => $view
        ]);
    }

    // public function update(UpdateRequest $request, $id)
    // {
    //     $comment = CannedComment::whereId($id)->first();

    //     $comment->user_id = auth()->user()->id;
    //     $comment->title = $request->title;
    //     $comment->comment = $request->comment;

    //     $comment->save();

    //     return redirect()->back();
    // }

    public function destroy($id)
    {
        CannedComment::destroy($id);

        $cannedComments = CannedComment::orderBy('created_at', 'desc')->get();

        $view = view('pages.partials.canned_comments', compact('cannedComments'))->render();

        return response()->json([
            'view' => $view
        ]);
    }
}
