<?php

namespace App\Library\NewRepositoriesPattern\Contracts;


use Illuminate\Database\Eloquent\Builder;

interface Criteria {

    /**
     * Apply Criteria
     *
     * @param Builder $model
     * @return mixed
     */
    public function apply(Builder $model);
}