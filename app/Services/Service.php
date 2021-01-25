<?php

namespace App\Services;

abstract class Service
{
    protected $model;

    public function all()
    {
        return $this->model->all();
    }
}
