<?php

namespace App\Services;

use App\Repositories\Interfaces\BrandRepositoryInterface;
// use Illuminate\Support\Facades\Auth;

class BrandService
{

    public function __construct(BrandRepositoryInterface $brandRepository)
    {
        $this->brandRepository = $brandRepository;
    }

    public function getAll()
    {
        return $this->brandRepository->getAll();
    }
    public function create(array $data)
    {
        return false;
    }

    public function store(array $data)
    {
        // MAIN TABLE
        $brand = array(
            'name' => $data['name'],
            // 'user_id' => Auth::user()->id,
        );
        $brand_id = $this->brandRepository->store($brand);
        // end MAIN TABLE

    }

    public function edit($id) {
        return $this->brandRepository->edit($id);
    }

    public function update(array $data)
    {
        $brand = array(
            'id'    => $data['id'],
            'name'  => $data['name'],
        );
        $updateBrad = $this->brandRepository->update($brand);
    }


    public function delete(array $data)
    {
        $project = $this->brandRepository->delete($data['id']);

    }


}
