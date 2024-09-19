<?php

namespace App\Http\Controllers;

use App\Http\Requests\DamagedAreas\StoreRequest;
use App\Models\DamagedArea;
use Illuminate\Http\Request;

class DamageAreaController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $damagedArea = new DamagedArea();

        $damagedArea->panel_area_name = $request->name;

        $damagedArea->save();

        $damagedArea->quotes()->attach($request->quote_id);

        return response(compact('damagedArea'));
    }
}
