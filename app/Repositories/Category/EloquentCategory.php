<?php namespace App\Repositories\Category;
use App\Category;
use Auth;

class EloquentCategory  implements CategoryRepository 
{

    private $model;

    public function __construct(Category $model)
    {
        $this->model = $model;
    }

    public function getAllForUser($user)
    {
        return $this
            ->model
            ->with('user')
            ->authorizedForUser($user)
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
        $category = $this->model->findOrFail($id);
        $category->update($attributes);
        return $category;

    }

    public function delete($id)
    {
        $this->getById($id)->delete();
        return true;
    }
}