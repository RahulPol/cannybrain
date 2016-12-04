<?php namespace App\Repositories\Category;

interface CategoryRepository
{
    public function getAllForCompany($company);

    public function getById($id);

    public function create(array $attributes);

    public function update($id, array $attributes);

    public function delete($id);

    public function getCategoriesDropdownForCompany($company);
}

