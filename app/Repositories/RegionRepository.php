<?php
/**
 * Created by PhpStorm.
 * User: jayben
 * Date: 01/07/2018
 * Time: 19:16
 */

namespace App\Repositories;


use App\Models\Region;

class RegionRepository
{
    protected $region;

    public function __construct(Region $region)
    {
        $this->region = $region;
    }

    public function getAll()
    {
        return $this->region->paginate(9);
    }
}