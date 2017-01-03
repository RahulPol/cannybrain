<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model {

	protected $table = 'question';

	protected $fillable = ['id','title','body','footer','optionA','optionB','optionC','optionD','optionE','optionF',
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

	public function chapter()
	{
		return $this -> belongsTo('App\Chapter');
	}

	public function category()
	{
		return $this -> belongsTo('App\Category');
	}

	public function scopeForCompany($query,$company,$answerType,$category)
	{
		$query = $query->where('company_id',$company);
		if($answerType != 'all'){
			$query = $query->where('answer_type',$answerType);
		}

		if($category != 'all'){
			$query = $query->where('category_id',$category);
		}

		return $query;


	}
}
