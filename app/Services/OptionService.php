<?php

namespace App\Services;

use App\Repositories\Option\OptionRepository;

class OptionService
{
    protected $repository;

    public function __construct(OptionRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getOptionList()
    {
        return $this->repository->getOptionList();
    }
}