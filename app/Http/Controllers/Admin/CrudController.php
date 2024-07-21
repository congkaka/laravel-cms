<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\EloquentRepository;
use Illuminate\Http\Request;

abstract class CrudController extends Controller implements CrudInterface
{
    public abstract function getRepository(): EloquentRepository;

    public abstract function getViewFolder(): string;

    public function getViewWithFolder($view): string
    {
        return $this->getViewFolder() . '.' . $view;
    }

    public function redirectPage($page)
    {
        return redirect(route($this->getViewFolder() . '.' . $page));
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, $data = [])
    {
        $items = $this->getRepository()->getPaginate($request);
        $data['items'] = $items;

        return view($this->getViewWithFolder('index'), $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create($data = [])
    {
        return view($this->getViewWithFolder('create'), $data)->with('success', 'Thao tác thành công.');
    }

    /**
     * Validate form create
     * @param Request $request
     * @return array
     */
    public function storeValidated(Request $request): array
    {
//        $validatedData = $request->validate([
//            'name' => 'required'
//        ],
//            [
//                'name.required' => 'Name không được trống'
//            ]
//        );
//
//        $validatedData['is_active'] = true;
//        $validatedData['slug'] = makeSlug($validatedData['name']);
//
//        return $validatedData;
        return $request->except(['_token']);
    }

    /**
     * Store a newly created resource in storage.
     *Z
     */
    public function store(Request $request)
    {
        $data = $this->storeValidated($request);
        $this->getRepository()->create($data);

        return $this->redirectPage('index');
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     */
    public function show(int $id)
    {
        $item = $this->getRepository()->findById($id);

        return view($this->getViewWithFolder('detail'), compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     */
    public function edit(int $id, $data = [])
    {
//        dd(1);
        $item = $this->getRepository()->findById($id);
        $data['item'] = $item;

        return view($this->getViewWithFolder('edit'), $data);
    }

    /**
     * Validate form update
     * @param Request $request
     * @param int $id
     * @return array
     */
    public function updateValidated(Request $request, int $id): array
    {
//        $validatedData = $request->validate([
//            'name' => 'required'
//        ],
//            [
//                'name.required' => 'Name không được trống'
//            ]
//        );
//
//        $validatedData['is_active'] = true;
//        $validatedData['slug'] = makeSlug($validatedData['name']);
//
//        return $validatedData;
        return $request->except(['_token']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param $id
     */
    public function update(Request $request, $id)
    {
        $data = $this->updateValidated($request, $id);
        $this->getRepository()->update($id, $data);

        return $this->redirectPage('index')->with('success', 'Thao tác thành công.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     */
    public function destroy(int $id)
    {
        $this->getRepository()->delete($id);

        return back()->with('success', 'Thao tác thành công.');
    }
}
