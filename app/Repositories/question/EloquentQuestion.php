<?php namespace App\Repositories\Question;
use App\Question;
use Auth;

class EloquentQuestion  implements QuestionRepository 
{

    private $model;

    public function __construct(Question $model)
    {
        $this->model = $model;
    }

    public function getAllForCompany($company)
    {
        return $this
            ->model
            ->with('user')
            ->with('company')
            ->forCompany($company)
            ->get();
    }

    public function getById($id)
    {
        return $this->model->findById($id);
    }

    public function create(array $attributes)
    {
        return $this->model->create($attributes);
    }

    public function update($id, array $attributes)
    {
        $question = $this->model->findOrFail($id);
        $question->update($attributes);
        return $question;

    }

    public function delete($id)
    {
        $this->model->findOrFail($id)->delete();
        return "true";
    }
}