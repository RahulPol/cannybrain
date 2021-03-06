<?php namespace App\Repositories\Question;

interface QuestionRepository
{
    public function getAllForCompany($company,$answerType,$category);

    public function getById($id);

    public function create(array $attributes);

    public function update($id, array $attributes);

    public function delete($id);    
}

