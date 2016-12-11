<?php namespace App\Repositories\Chapter;
use App\Chapter;
use Auth;

class EloquentChapter  implements ChapterRepository 
{

    private $model;

    public function __construct(Chapter $model)
    {
        $this->model = $model;
    }

    public function getAllForCompany($company)
    {
        return $this
            ->model
            ->with('category')
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
        $chapter = $this->model->findOrFail($id);
        $chapter->update($attributes);
        return $chapter;

    }

    public function delete($id)
    {
        $this->model->findOrFail($id)->delete();
        return "true";
    }
    
}