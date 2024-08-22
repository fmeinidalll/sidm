<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreHistoryDetailRequest;
use App\Http\Requests\UpdateHistoryDetailRequest;
use App\Models\HistoryDetail;

class HistoryDetailController extends Controller
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
     * @param  \App\Http\Requests\StoreHistoryDetailRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreHistoryDetailRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\HistoryDetail  $historyDetail
     * @return \Illuminate\Http\Response
     */
    public function show(HistoryDetail $historyDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\HistoryDetail  $historyDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(HistoryDetail $historyDetail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateHistoryDetailRequest  $request
     * @param  \App\Models\HistoryDetail  $historyDetail
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateHistoryDetailRequest $request, HistoryDetail $historyDetail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HistoryDetail  $historyDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(HistoryDetail $historyDetail)
    {
        //
    }
}
