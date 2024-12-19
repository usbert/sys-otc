<?php

namespace App\Repositories\Interfaces;

interface AddressRepositoryInterface
{
    public function getAll();
    public function update(array $data, $id);
    public function delete($id);
}
