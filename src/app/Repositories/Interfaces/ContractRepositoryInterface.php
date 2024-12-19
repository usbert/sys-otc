<?php

namespace App\Repositories\Interfaces;

interface ContractRepositoryInterface
{
    public function getAll();
    public function store(array $data);
    public function update(array $data);
    public function delete($id);

}
