<?php

namespace App\Http\Controllers;

use App\Models\WebsiteSetting;
use App\Http\Requests\StoreWebsiteSettingRequest;
use App\Http\Requests\UpdateWebsiteSettingRequest;

class WebsiteSettingController extends Controller
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
     * @param  \App\Http\Requests\StoreWebsiteSettingRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreWebsiteSettingRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\WebsiteSetting  $websiteSetting
     * @return \Illuminate\Http\Response
     */
    public function show(WebsiteSetting $websiteSetting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\WebsiteSetting  $websiteSetting
     * @return \Illuminate\Http\Response
     */
    public function edit(WebsiteSetting $websiteSetting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateWebsiteSettingRequest  $request
     * @param  \App\Models\WebsiteSetting  $websiteSetting
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateWebsiteSettingRequest $request, WebsiteSetting $websiteSetting)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\WebsiteSetting  $websiteSetting
     * @return \Illuminate\Http\Response
     */
    public function destroy(WebsiteSetting $websiteSetting)
    {
        //
    }
}
