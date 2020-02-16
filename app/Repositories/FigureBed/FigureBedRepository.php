<?php

namespace App\Repositories\FigureBed;

use App\Models\FigureBed;
use App\Repositories\Repository;

class FigureBedRepository extends Repository
{
    /**
     * @param string $url
     * @param string $ip
     * @return FigureBed
     */
    public function store(string $url, string $ip)
    {
        $data = [
            'url' => $url,
            'date' => date('Y-m-d'),
            'ip' => ip2long($ip),
            'ctime' => time(),
        ];
        return FigureBed::create($data);
    }

    /**
     * @param $date
     * @param $ip
     * @return int
     */
    public function getImageCount($date, $ip = '')
    {
        $where = ['date' => $date];
        if (!empty($ip)) {
            $where['ip'] = ip2long($ip);
        }
        $count = FigureBed::where($where)->count();
        return intval($count);
    }
}