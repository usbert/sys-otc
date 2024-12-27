<?php

namespace App\Services;

use App\Repositories\Interfaces\PcoRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class PcoService
{

    public function __construct(PcoRepositoryInterface $pcoRepository)
    {
        $this->pcoRepository = $pcoRepository;
    }

    public function getAll()
    {
        return $this->pcoRepository->getAll();
    }


    public function getDataToCreate()
    {
        return $this->pcoRepository->getDataToCreate();
    }

}
