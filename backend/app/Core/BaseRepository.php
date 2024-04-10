<?php

namespace App\Core;

use App\Core\Interfaces\Repository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Spatie\QueryBuilder\QueryBuilder;

class BaseRepository implements Repository
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        try {
            return $this->model->all();
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    /**
     * @param  array  $options  (e.g. ["filter" => ["name" => 'Juan"], "include" => "contravencion"])
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function get($options = [])
    {
        try {
            if (count($options) > 0) {
                // agrego manualmente al request los filtros, includes,etc
                request()->merge($options);
            }

            // filter, sort, includes
            $q = QueryBuilder::for($this->model)
                ->allowedFilters($this->getFilters())
                ->allowedSorts($this->getSorts())
                ->allowedIncludes($this->getIncludes());

            // paginated
            if (request()->has('page')) {
                $q->limit(1);

                return $q
                    ->paginate(request()->page_size ?? 10)
                    ->withQueryString();
            }

            return $q
                ->limit(request()->limit ?? null)
                ->get();
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function create(array $data)
    {
        try {
            return $this->model->create($data);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function update($id, array $data)
    {
        $model = $this->model::findOrFail($id);

        $result = $model->updateOrFail($data);

        if ($result) {
            return $model;
        }

        return null;
    }

    public function delete($id)
    {
        $model = $this->model::findOrFail($id);

        return $model->deleteOrFail();
    }

    public function find($id, $options = [])
    {
        if (count($options) > 0) {
            // agrego manualmente al request los filtros, includes,etc
            request()->merge($options);
        }

        $q = QueryBuilder::for($this->model)
            ->allowedFilters($this->getFilters())
            ->allowedIncludes($this->getIncludes());

        $instance = $q->findOrFail($id);
        // if (null == $instance = $q->find($id)) {
        //     throw new ModelNotFoundException('No se encuentra registro con ese id');
        // }

        if (count($options) > 0) {
            $instance->load($options);
        }

        return $instance;
    }

    public function getByIds($ids)
    {
        return $this->model->whereIn('id', $ids)->get();
    }

    /**
     * Devuelve los filtros disponibles:
     *      - Filtros del modelo actual (inyectado)
     *      - Filtros del modelo base
     */
    private function getFilters()
    {
        if (! method_exists($this->model, 'allowedFilters')) {
            return (new BaseModel)->allowedFilters();
        }

        $all_filters = [
            $this->model->allowedFilters() ?? [],
            (new BaseModel)->allowedFilters(),
        ];

        $filters = array_merge([], ...$all_filters);

        return $filters;
    }

    /**
     * Devuelve los sorts del modelo inyectado
     * y los del modelo base
     */
    private function getSorts()
    {
        if (! method_exists($this->model, 'allowedSorts')) {
            return (new BaseModel)->allowedSorts();
        }

        $all_sorts = [
            $this->model->allowedSorts() ?? [],
            (new BaseModel)->allowedSorts(),
        ];

        $sorts = array_merge([], ...$all_sorts);

        return $sorts;
    }

    /**
     * Devuelve los sorts del modelo inyectado
     * y los del modelo base
     */
    private function getIncludes()
    {
        $model_includes = [];

        if (method_exists($this->model, 'allowedIncludes')) {
            $model_includes = $this->model->allowedIncludes();
        }

        $includes = array_merge($model_includes, (new BaseModel)->allowedIncludes());

        return $includes;
    }
}
