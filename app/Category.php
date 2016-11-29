<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model {

	protected $table = 'category';

	protected $fillable = ['name','user_id','is_active'];

	//A category must be created by user(admin).
	public function user()
	{
		return $this -> belongsTo('App\User');
	}

}
