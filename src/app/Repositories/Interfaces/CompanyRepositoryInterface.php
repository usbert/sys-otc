<?php

namespace App\Repositories\Interfaces;

interface CompanyRepositoryInterface
{
    public function getAll();
    public function update(array $data, $id);
    public function delete($id);
}
