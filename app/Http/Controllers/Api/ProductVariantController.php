<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\ProductVariantRepository;
use Illuminate\Http\Request;

class ProductVariantController extends Controller
{
    protected ProductVariantRepository $productVariantRepository;
    public function __construct(ProductVariantRepository $productVariantRepository)
    {
        $this->productVariantRepository = $productVariantRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $rules = [
            'product_id' => 'numeric',
            'is_active' => 'boolean'
        ];
        $params = $request->validate($rules);
        return apiSuccessRes($this->productVariantRepository->getAll($params));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
