<?php
namespace App\Interfaces;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

interface EloquentInterface
{
    public function getById(int $id);

    public function getAll();

    public function store(Request $request);

    public function update(Request $request, int $id);
}