<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\CannedComments\StoreRequest;
use App\Http\Resources\CannedCommentCollection;
use App\Models\CannedComment;

class CannedCommentController extends Controller
{
    public function getCannedComments()
    {
        return new CannedCommentCollection(CannedComment::orderBy('created_at', 'desc')->paginate());
    }

    public function getAllCannedComments()
    {
        $comments = CannedComment::select('id', 'title', 'comment')->get();

        return response()->json([
            'response_code' => 200,
            'data' => [
                'canned_comments' => $comments
            ]
        ]);
    }

    public function createCannedComment(StoreRequest $request)
    {
        $cannedComment = CannedComment::create([
            'user_id' => auth()->user()->id,
            'title' => $request->title,
            'comment' => $request->comment
        ]);

        return response()->json([
            'response_code' => 200,
            'message' => 'Canned Comment created successfully.',
            'data' => [
                'canned_comment' => $cannedComment
            ]
        ]);
    }

    public function deleteCannedComment($id)
    {
        CannedComment::destroy($id);

        return response()->json([
            'response_code' => 200,
            'message' => 'Canned Comment deleted successfully.',
            'data' => []
        ]);
    }
}
