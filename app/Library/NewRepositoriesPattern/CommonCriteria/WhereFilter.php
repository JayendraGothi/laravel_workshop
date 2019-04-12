<?php

namespace App\Library\NewRepositoriesPattern\CommonCriteria;

use App\Library\NewRepositoriesPattern\Contracts\Criteria;
use Illuminate\Database\Eloquent\Builder;

class WhereFilter implements Criteria {

    /**
     * field, value
     *
     * @var
     */
    private $field;
    private $value;

    /**
     * Constructor.
     *
     * @param $field
     * @param $value
     */
    public function __construct($field, $value) {
        $this->field = $field;
        $this->value = $value;
    }

    /**
     * Apply filter for status
     *
     * @param Builder $model
     * @return Builder
     */
    public function apply(Builder $model) {
        // get table
        $table = $model->getModel()->getTable();

        // filter for status
        $model->where("$table.$this->field", $this->value);

        return $model;
    }
}