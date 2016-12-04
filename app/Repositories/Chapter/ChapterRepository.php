<?php namespace App\Repositories\Chapter;

interface ChapterRepository
{
    public function getAllForCompany($company);

    public function getById($id);

    public function create(array $attributes);

    public function update($id, array $attributes);

    public function delete($id);    
}

