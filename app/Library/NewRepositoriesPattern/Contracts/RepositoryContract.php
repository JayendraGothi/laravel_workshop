<?php

namespace App\Library\NewRepositoriesPattern\Contracts;


use App\Library\NewRepositoriesPattern\Abstracts\CriteriaBuilder;

interface RepositoryContract {

    public function all(CriteriaBuilder $builder);

    public function paginate(CriteriaBuilder $builder, $perPage = 15);

    public function create(array $data);

    public function update(array $data, $id);

    public function delete($id);

    public function get(CriteriaBuilder $builder, $id);

    public function first(CriteriaBuilder $builder);

    public function firstOrNew(array $fields);

    public function firstOrCreate(array $fields);
}