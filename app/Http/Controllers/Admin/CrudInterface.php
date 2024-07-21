<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

interface CrudInterface
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, array $data);

    /**
     * Show the form for creating a new resource.
     */
    public function create(array $data);

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request);

    /**
     * Display the specified resource.
     */
    public function show(int $id);

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id, array $data);

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id);

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id);
}
