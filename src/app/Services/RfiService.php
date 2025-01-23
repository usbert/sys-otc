<?php

namespace App\Services;

use App\Repositories\Interfaces\RfiRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class RfiService
{

    public function __construct(RfiRepositoryInterface $rfiRepository)
    {
        $this->rfiRepository = $rfiRepository;
    }

    public function getAll()
    {
        return $this->rfiRepository->getAll();
    }

}
