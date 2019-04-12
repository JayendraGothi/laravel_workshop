<?php

namespace App\Library\NewRepositoriesPattern\Abstracts;


use App\Library\NewRepositoriesPattern\Contracts\ServiceContract;
use Illuminate\Database\DatabaseManager;
use Illuminate\Support\Facades\Log;

/**
 * Class ServiceAbstract
 *
 * @package Andersonef\Repositories\Abstracts
 */
abstract class Service implements ServiceContract {

    protected $Repository;
    protected $db;

    /**
     * Service constructor.
     *
     * @param \App\Library\NewRepositoriesPattern\Abstracts\Repository $ra
     * @param DatabaseManager $db
     */
    function __construct(Repository $ra, DatabaseManager $db) {
        $this->Repository = $ra;
        $this->db = $db;
    }

    /**
     * Create new
     *
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model
     * @throws \Exception
     */
    public function create(array $data) {
        try {
            $this->db->beginTransaction();
            $entity = $this->Repository->create($data);
            $this->db->commit();
        } catch (\Exception $e) {
            $this->db->rollback();
            Log::error($e);
        }
        return $entity;
    }

    /**
     * Update
     *
     * @param array $data
     * @param $id
     * @return mixed
     * @throws \Exception
     */
    public function update(array $data, $id) {
        try {
            $this->db->beginTransaction();
            $retorno = $this->Repository->update($data, $id);
            $this->db->commit();
            return $retorno;
        } catch (\Exception $e) {
            $this->db->rollback();
            throw $e;
        }
    }

    /**
     * First or Create
     *
     * @param $fields
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function firstOrCreate($fields) {
        try {
            return $this->Repository->firstOrCreate($fields);
        } catch (\Exception $e) {
            Log::error($e);
        }
        return null;
    }

    /**
     * First or New
     *
     * @param $fields
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function firstOrNew($fields) {
        try {
            return $this->Repository->firstOrNew($fields);
        } catch (\Exception $e) {
            Log::error($e);
        }
        return null;
    }

    /**
     * Delete
     *
     * @param $id
     * @throws \Exception
     */
    public function destroy($id) {
        try {
            $this->db->beginTransaction();
            $this->Repository->delete($id);
            $this->db->commit();
        } catch (\Exception $e) {
            $this->db->rollback();
            throw $e;
        }
    }
}