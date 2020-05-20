<?php


namespace App\Repositories;


use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository implements IBaseRepository
{
    //Abstract class that implements IBaseRepository interface/
    //Handles basic repository-common logic like resolving the lists of entities(models) and fetching one single entity

    public ?Model $instance = null; //eloquent Model instance

    /**
     * Display a listing of the resource.
     * Here will be displayed the list of this controller entity - Astrologist
     *
     * @param array $whereConditions
     * @param array $orderConditions
     * @param int|null $start
     * @param int|null $length
     * @return Collection
     */
    public function parametrizedResult(array $whereConditions = [], array $orderConditions = [], int $start = null, int $length = null):Collection{

        //initially loading only fillable columns
        $fillable = $this->model->getFillable();
        $query = $this->model->select($fillable);

        //if pagination info is present - than add pagination
        if(isset($start,$length)){
            $query->skip($start)->take($length);
        }

        //if search conditions are present - than make search
        if(isset($whereConditions)) {

            foreach ($whereConditions as $column => $search) {
                if (in_array($column, $fillable, true)) {
                    $operatorAndValue = $this->resolveOperatorAndValue($search);
                    $query->where($column, $operatorAndValue['operator'], $operatorAndValue['value']);
                }

            }
        }

        //if order conditions are present - than make ordering
        if(!blank($orderConditions)){
            $column = $orderConditions['column'];
            $direction = $orderConditions['dir'];

            if (in_array($column, $fillable, true)) {
                if($direction==='desc'||$direction==='DESC'){
                    $query->orderByDesc($column);
                }elseif($direction==='asc'||$direction==='ASC'){
                    $query->orderBy($column);
                }else{
                    $query->orderBy($column);
                }
            }

        }


        return $query->get();
    }

    /**
     * Fetch one entity/model by id
     *
     * @param int $id
     * @return Model
     */
    public function find($id = 0): Model
    {
        //if instance have already been set - than work with it, else - make usual request to DB
        return $this->instance ?? $this->model->where('id', $id)->first();
    }

    public function getCount(): int
    {
        return $this->model->count();
    }

    public function setInstance(Model $instance): void
    {
        $this->instance = $instance;
    }

    protected function resolveOperatorAndValue($value):array {
        $result = [
            'operator' => '',
            'value' => ''
        ];

        //proper comparision operator for searching is to be etched here
        if(is_string($value)){
            $result['operator'] = 'LIKE';
            $result['value'] = '%' . $value . '%';
        }else{
            $result['operator'] = '=';
            $result['value'] = $value;
        }

        return $result;
    }
}
