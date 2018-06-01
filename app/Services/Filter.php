<?php

namespace App\Services;


use Illuminate\Database\Eloquent\Builder;

class Filter
{
    protected $builder;

    protected $params = [];

    protected $mode = [];

    /**
     * Filter constructor.
     * @param $builder
     * @param array $params
     * @param string string
     */
    public function __construct(Builder $builder, array $params = [], string $mode = 'default')
    {
        $this->builder = $builder;

        if (empty($params)) {
            $params = request()->all();
        }

        $this->params = $params;

        $this->mode = $mode;
    }

    public function make(): Filter
    {
        $rules = config('filter.' . $this->mode);

        foreach ($this->params as $key => $param) {
            if ($param === null) {
                continue;
            }

            if (array_key_exists($key, $rules)) {
                $rule = $rules[$key];

                $field = $rule[1] ?? $key;

                $comparison = $rule[0];

                $value = $comparison === 'like'
                    ? '%' . $param . '%'
                    : $param;

                is_array($field)
                    ? $this->builder->where(function (Builder $query) use ($field, $comparison, $value) {
                    foreach ($field as $f) {
                        $query->orWhere($f, $comparison, $value);
                    }

                    return $query;
                })
                    : $this->builder->where($field, $comparison, $value);
            }
        }

        return $this;
    }

    public function getBuilder(): Builder
    {
        return $this->builder;
    }

    protected function rule()
    {

    }
}