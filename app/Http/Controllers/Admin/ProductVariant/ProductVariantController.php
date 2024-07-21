<?php

namespace App\Http\Controllers\Admin\ProductVariant;

use App\Http\Controllers\Admin\CrudController;
use App\Http\Requests\ProductVariantCreateRequest;
use App\Http\Requests\ProductVariantUpdateRequest;
use App\Repositories\EloquentRepository;
use App\Repositories\ProductRepository;
use App\Repositories\ProductVariantRepository;
use Illuminate\Http\Request;

class ProductVariantController extends CrudController
{
    /**
     * @var ProductVariantRepository
     */
    private ProductVariantRepository $productvariantRepository;

    private ProductRepository $productRepository;

    public function __construct(ProductVariantRepository $productvariantRepository, ProductRepository $productRepository)
    {
        $this->productvariantRepository = $productvariantRepository;
        $this->productRepository = $productRepository;
    }

    /**
     * @return ProductVariantRepository
     */
    public function getRepository(): EloquentRepository
    {
        return $this->productvariantRepository;
    }

    public function getViewFolder(): string
    {
        return 'admin.product_variant';
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, $data = [])
    {
        $items = $this->getRepository()->getPaginate($request);
        $data['items'] = $items;
        $products = $this->productRepository->getAll();
        $data['products'] = $products;

        return view($this->getViewWithFolder('index'), $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($data = [])
    {
        $data['products'] = $this->productRepository->getAll();
        return parent::create($data);
    }

    public function edit(int $id, $data = [])
    {
        $data['products'] = $this->productRepository->getAll();

        return parent::edit($id, $data);
    }

    /**
     * Validate form create
     * @param Request $request
     * @return array
     */
    public function storeValidated(Request $request): array
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'price' => 'required',
            'price_ctv' => 'required',
            'price_agency' => 'required',
            'min_sale_quantity' => 'required',
            'max_sale_quantity' => 'required',
            'product_id' => 'required',
            'is_active' => ''
        ]);
        $validatedData['is_active'] = isset($request['is_active']);
        $validatedData['slug'] = makeSlug($validatedData['name']);

        return $validatedData;
    }

    /**
     * Validate form update
     * @param Request $request
     * @param int $id
     * @return array
     */
    public function updateValidated(Request $request, int $id): array
    {
        $data = $request->except(['_token']);
        $data['is_active'] = isset($request['is_active']);
        if (isset($data['name'])) {
            $data['slug'] = makeSlug($data['name']);
        }

        return $data;
    }


    public function changeActive($id)
    {
        $item = $this->productvariantRepository->findById($id);
        $item->is_active = !$item->is_active;
        return $item->save();
    }
}
