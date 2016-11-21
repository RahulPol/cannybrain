<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model {

	protected $table = 'roles';

	protected $fillable = ['name'];

	//this allows us to block all attributes from mass assignment
	//protected $guarded = ['*']; 

}
