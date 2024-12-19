<?php

namespace App\Services;

use App\Repositories\Interfaces\CompanyRepositoryInterface;

class CompanyService
{

    public function __construct(CompanyRepositoryInterface $companyRepository)
    {
        $this->companyRepository = $companyRepository;
    }

    public function getAll()
    {
        return $this->companyRepository->getAll();
    }

    public function store(array $data)
    {
        // MAIN TABLE
        $company = array(
            'name'          => $data['name'],
            'segment'       => $data['segment'],
            'fantasy_name'  => $data['fantasy_name'],
        );
        $company_id = $this->companyRepository->store($company);
        // end MAIN TABLE

    }

    public function update(array $data, $id)
    {
        return false;
    }

    public function delete($id)
    {
        return false;
    }




}
