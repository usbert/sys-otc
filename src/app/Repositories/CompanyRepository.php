<?php

namespace App\Repositories;

use App\Models\Company;
use App\Repositories\Interfaces\CompanyRepositoryInterface;

class CompanyRepository implements CompanyRepositoryInterface
{
  public function getAll()
  {
    $companies = Company::where('is_activated', 1)
    ->get();

    return $companies;

  }

  public function store($data)
  {
    return Company::create($data)->id;
  }

  public function update($id, $data)
  {
    return false;
  }

  public function delete($id)
  {
    return false;
  }
}
