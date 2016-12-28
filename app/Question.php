<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model {

	protected $table = 'question';

	protected $fillable = ['title','body','footer','optionA','optionB','optionC','optionD','optionE','optionF',
			'marks','answer','answer_description','answer_type','negative_weightage','chapter_id','category_id',
			'answer_selection','user_id','company_id','is_active'];

	//A category must be created by user(admin).
	public function user()
	{
		return $this -> belongsTo('App\User');
	}

	public function company()
	{
		return $this -> belongsTo('App\Company');
	}

	public function scopeForCompany($query,$company)
	{
		return $query->where('company_id',$company);
	}
}
