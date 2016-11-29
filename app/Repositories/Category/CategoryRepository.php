<?php namespace App\Repositories\Category;

interface CategoryRepository
{
    public function getAllForUser($user);

    public function getById($id);

    public function create(array $attributes);

    public function update($id, array $attributes);

    public function delete($id);
}

