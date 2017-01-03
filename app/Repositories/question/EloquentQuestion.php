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

    public function getAllForCompany($company,$answerType,$category)
    {
        return $this
            ->model
            ->with('user')
            ->with('company')
            ->with('chapter')
            ->with('category')
            ->forCompany($company,$answerType,$category)
            ->get();
    }

    public function getById($id)
    {
        return $this->model->findOrFail($id);
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