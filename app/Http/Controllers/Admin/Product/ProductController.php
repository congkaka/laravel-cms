<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Admin\CrudController;
use App\Http\Requests\ProductCreateRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Repositories\CategoryRepository;
use App\Repositories\EloquentRepository;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;

class ProductController extends CrudController
{

    private ProductRepository $productRepository;

    private CategoryRepository $categoryRepository;

    public function __construct(ProductRepository $productRepository, CategoryRepository $categoryRepository)
    {
        $this->productRepository = $productRepository;
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @return ProductRepository
     */
    public function getRepository(): EloquentRepository
    {
        return $this->productRepository;
    }

    public function getViewFolder(): string
    {
        return 'admin.product';
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($data = [])
    {
        $data['categories'] = $this->categoryRepository->getAll();
        return parent::create($data);
    }

    /**
     * Validate form create
     * @param Request $request
     * @return array
     */
    public function storeValidated(Request $request): array
    {
        $validatedData = $request->validate([
            'category_id' => 'required',
            'type' => 'required',
            'name' => 'required',
            'image' => '',
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
        $item = $this->productRepository->findById($id);
        $item->is_active = !$item->is_active;
        return $item->save();
    }
}
