<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

abstract class EloquentRepository
{
    /**
     * @var Model
     */
    protected Model $_model;

    /**
     * EloquentRepository constructor.
     */
    public function __construct()
    {
        $this->setModel();
    }

    /**
     * get model
     * @return Model
     */
    abstract public function getModel(): Model;

    /**
     * Set model
     */
    public function setModel(): void
    {
        $this->_model = $this->getModel();
        $this->_model->setPerPage(15);
    }

    /**
     * Get first
     * @return Collection|static[]
     */
    public function getFirst()
    {
        return $this->_model::first();
    }

    /**
     * Get All
     * @return Collection|Builder[]
     */
    public function getAll($query = [], $select = [], $limit = null)
    {
        $items = $this->_model::query();
        if ($query) {
            foreach ($query as $q => $v) {
                if (in_array($q, $this->_model->getFillable()) && $v) {
                    $items->where($q, $v);
                }
            }
        }
        if ($select) {
            $items->select($select);
        }
        $items->orderByDesc('id');
        if ($limit) {
            $items->limit($limit);
        }

        return $items->get();
    }

    /**
     * Get All
     */
    public function getPaginate(Request $request, $select = [])
    {
        $query = $request->all();
        $items = $this->_model::query();
        foreach ($query as $q => $v) {
            if (in_array($q, $this->_model->getFillable()) && $v) {
                $items->where($q, 'ilike', '%'.$v.'%');
            }
        }
        if ($select) {
            $items->select($select);
        }
        $items->orderByDesc('id');

        $size = $request->size ? $request->size : 15;

        return $items->paginate($size);
    }

    /**
     * Get one
     * @param $id
     * @return mixed
     */
    public function findById($id)
    {
        return $this->_model::with($this->_model->getRelations())->find($id);
    }

    /**
     * Create
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes)
    {

        return $this->_model->create($attributes);
    }

    /**
     * Create
     * @param array $attributes
     * @return mixed
     */
    public function insert(array $data)
    {

        return $this->_model->insert($data);
    }

    /**
     * Update
     * @param $id
     * @param array $attributes
     * @return bool|mixed
     */
    public function update($id, array $attributes)
    {
        $result = $this->findById($id);
        if ($result) {
            $result->update($attributes);
            return $result;
        }

        return false;
    }

    /**
     * Delete
     *
     * @param $id
     * @return bool
     */
    public function delete($id): bool
    {
        $result = $this->findById($id);
        if ($result) {
            $result->delete();

            return true;
        }

        return false;
    }

    public function findByIdIn($ids, $select = [])
    {
        $items = $this->_model::query()->whereIn('id', $ids);
        if ($select) {
            $items->select($select);
        }

        return $items->get();
    }

    public function nativeQuery($sql)
    {
        $items = DB::select($sql);
        return $this->_model::from($items);
    }

    public function queryBuilder()
    {
        return $this->_model::query();
    }
}
