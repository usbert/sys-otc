<?php

namespace App\Services;

use App\Repositories\Interfaces\ToolRepositoryInterface;
// use Illuminate\Support\Facades\Auth;

class ToolService
{

    public function __construct(ToolRepositoryInterface $toolRepository)
    {
        $this->toolRepository = $toolRepository;
    }

    public function getAll()
    {
        return $this->toolRepository->getAll();
    }

    public function getDataToCreate()
    {
        return $this->toolRepository->getDataToCreate();
    }



}
