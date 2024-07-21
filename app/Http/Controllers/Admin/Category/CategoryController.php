<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Admin\CrudController;
use App\Http\Requests\CategoryCreateRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Repositories\EloquentRepository;
use App\Repositories\CategoryRepository;
use Illuminate\Http\Request;

class CategoryController extends CrudController
{
    /**
     * @var CategoryRepository
     */
    private CategoryRepository $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @return CategoryRepository
     */
    public function getRepository(): EloquentRepository
    {
        return $this->categoryRepository;
    }

    public function getViewFolder(): string
    {
        return 'admin.categories';
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
            'image' => '',
        ],
            [
                'name.required' => 'Name không được trống'
            ]
        );
        $validatedData['is_active'] = true;
        $validatedData['slug'] = makeSlug($validatedData['name']);

        return $validatedData;
    }
}
