<?php

namespace App\Services;

use App\Repositories\Interfaces\TypeDocumentRepositoryInterface;
use App\DTO\TypeDocumentDTO;

class TypeDocumentService
{

    public function __construct(TypeDocumentRepositoryInterface $typeDocumentRepository)
    {
        $this->typeDocumentRepository = $typeDocumentRepository;
    }

    public function getAll()
    {
        return $this->typeDocumentRepository->getAll();
    }

    public function find($id) {
        return $this->typeDocumentRepository->find($id);
    }

    public function create(TypeDocumentDTO $dto)
    {
        return $this->typeDocumentRepository->create(get_object_vars($dto));
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
