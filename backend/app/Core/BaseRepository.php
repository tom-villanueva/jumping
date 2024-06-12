<?php

namespace App\Core;

use App\Core\Interfaces\Repository;
use Illuminate\Database\Eloquent\Model;
use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Http\Request;

class BaseRepository implements Repository
{
    protected Model $model;
    protected Request $request;

    /**
     * BaseRepository constructor.
     *
     * @param  Model  $model
     * @param  Request  $request
     */
    public function __construct(Model $model, Request $request)
    {
        $this->model = $model;
        $this->request = $request;
    }

    /**
     * Get all records.
     *
     * @return Collection
     * @throws \Exception
     */
    public function all()
    {
        return $this->model->all();
    }

    /**
     * Get records with options.
     *
     * @param  array  $options (e.g. ["filter" => ["name" => 'Juan"], "include" => "contravencion"])
     * @return LengthAwarePaginator|Collection
     * @throws \Exception
     */
    public function get(array $options = [])
    {
        if (!empty($options)) {
            // agrego manualmente al request los filtros, includes,etc
            $this->request->merge($options);
        }

        // filter, sort, includes
        $query = QueryBuilder::for($this->model)
            ->allowedFilters($this->getFilters())
            ->allowedSorts($this->getSorts())
            ->allowedIncludes($this->getIncludes());

        // paginated
        if ($this->request->has('page')) {
            // $q->limit(1);

            return $query->paginate($this->request->get('page_size', 10))->withQueryString();
            // return $query
            //     ->paginate($this->request->page_size ?? 10)
            //     ->withQueryString();
        }

        return $query->limit($this->request->get('limit'))->get();
        // return $q
        //     ->limit(request()->limit ?? null)
        //     ->get();
    }

    /**
     * Create a new record.
     *
     * @param  array  $data
     * @return Model
     * @throws \Exception
     */
    public function create(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * Update a record by ID.
     *
     * @param  int  $id
     * @param  array  $data
     * @return Model
     * @throws ModelNotFoundException
     */
    public function update(int $id, array $data)
    {
        $model = $this->model->findOrFail($id);
        $model->updateOrFail($data);
        return $model;
        // $model = $this->model::findOrFail($id);

        // $result = $model->updateOrFail($data);

        // if ($result) {
        //     return $model;
        // }

        // return null;
    }

     /**
     * Delete a record by ID.
     *
     * @param  int  $id
     * @return bool|null
     * @throws \Exception
     */
    public function delete(int $id)
    {
        $model = $this->model::findOrFail($id);
        return $model->deleteOrFail();
    }

    /**
     * Find a record by ID with options.
     *
     * @param  int  $id
     * @param  array  $options
     * @return Model
     * @throws ModelNotFoundException
     */
    public function find(int $id, array $options = [])
    {
        if (!empty($options)) {
            // agrego manualmente al request los filtros, includes,etc
            $this->request->merge($options);
        }

        $query = QueryBuilder::for($this->model)
            ->allowedFilters($this->getFilters())
            ->allowedIncludes($this->getIncludes());

        return $query->findOrFail($id);
    }

    /**
     * Get records by an array of IDs.
     *
     * @param  array  $ids
     * @return Collection
     */
    public function getByIds($ids)
    {
        return $this->model->whereIn('id', $ids)->get();
    }

     /**
     * Get the allowed filters for the model.
     *
     * @return array
     */
    private function getFilters()
    {
        return method_exists($this->model, 'allowedFilters')
            ? array_merge((new BaseModel)->allowedFilters(), $this->model->allowedFilters() ?? [])
            : (new BaseModel)->allowedFilters();

        // if (! method_exists($this->model, 'allowedFilters')) {
        //     return (new BaseModel)->allowedFilters();
        // }

        // $all_filters = [
        //     $this->model->allowedFilters() ?? [],
        //     (new BaseModel)->allowedFilters(),
        // ];

        // $filters = array_merge([], ...$all_filters);

        // return $filters;
    }

    /**
     * Get the allowed sorts for the model.
     *
     * @return array
     */
    private function getSorts()
    {
        return method_exists($this->model, 'allowedSorts')
            ? array_merge((new BaseModel)->allowedSorts(), $this->model->allowedSorts() ?? [])
            : (new BaseModel)->allowedSorts();
        // if (! method_exists($this->model, 'allowedSorts')) {
        //     return (new BaseModel)->allowedSorts();
        // }

        // $all_sorts = [
        //     $this->model->allowedSorts() ?? [],
        //     (new BaseModel)->allowedSorts(),
        // ];

        // $sorts = array_merge([], ...$all_sorts);

        // return $sorts;
    }

     /**
     * Get the allowed includes for the model.
     *
     * @return array
     */
    private function getIncludes()
    {
        return method_exists($this->model, 'allowedIncludes')
            ? array_merge((new BaseModel)->allowedIncludes(), $this->model->allowedIncludes() ?? [])
            : (new BaseModel)->allowedIncludes();
        // $model_includes = [];

        // if (method_exists($this->model, 'allowedIncludes')) {
        //     $model_includes = $this->model->allowedIncludes();
        // }

        // $includes = array_merge($model_includes, (new BaseModel)->allowedIncludes());

        // return $includes;
    }
}
