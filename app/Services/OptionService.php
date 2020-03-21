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

    public function getOptionData()
    {
        $data = $this->getOptionList();
        if (empty($data)) {
            return $data;
        }

        $option = $data->mapWithKeys(function ($item) {
            return [$item['title'] => $item['value']];
        });

        $this->checkFigureBed($option);
        $option->put('open_figure_bed', $this->checkFigureBed($option));
        return $option;
    }

    /**
     * 检测图床功能是否可用
     * @param $option
     * @return int
     */
    protected function checkFigureBed($option)
    {
        $figueBed = $option->get('open_figure_bed');
        if (empty($figueBed) || $figueBed != 1) {
            return 0;
        }

        $upyun = config('filesystems.disks.upyun');
        if (empty($upyun)) {
            return 0;
        }



        if (empty($upyun['service']) || empty($upyun['service']) || empty($upyun['password']) || empty($upyun['domain'])) {
            return 0;
        }

        return $figueBed;
    }
}