<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\CannedComments\StoreRequest;
use App\Models\CannedComment;
use App\Models\PreExistingCondition;

class PreExistingConditionController extends Controller
{
    public function getPreExistingConditions()
    {
        $preExistingCondition = PreExistingCondition::orderBy('name')->get();

        return response()->json([
            'response_code' => 200,
            'data' => $preExistingCondition
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
