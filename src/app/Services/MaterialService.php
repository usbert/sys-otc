<?php

namespace App\Services;

use App\Repositories\Interfaces\MaterialRepositoryInterface;
// use Illuminate\Support\Facades\Auth;

class MaterialService
{

    public function __construct(MaterialRepositoryInterface $materialRepository)
    {
        $this->materialRepository = $materialRepository;
    }

    public function getAll()
    {
        return $this->materialRepository->getAll();
    }
    public function create(array $data)
    {
        return false;
    }


}
