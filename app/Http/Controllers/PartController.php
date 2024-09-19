<?php

namespace App\Http\Controllers;

use App\Http\Requests\Parts\StoreRequest;
use App\Models\Part;
use Illuminate\Http\Request;

class PartController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        dd($request->all());
        $part = new Part();
        $part->part_name = $request->name;
        $part->position = $request->position;

        $part->save();

        $leftParts = Part::where('position', 'left')->get();
        $rightParts = Part::where('position', 'right')->get();

        $view = view('pages.quotation.partials.parts_form', ['quote' => $request->quote_id, 'leftParts' => $leftParts, 'rightParts' => $rightParts])->render();

        return response(['view' => $view]);
    }
}
