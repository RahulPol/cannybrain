<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Chapter extends Model {

	protected $table = 'chapter';

	protected $fillable = ['name','category_id', 'user_id','company_id','is_active'];

	
	public function category()
	{
		return $this->belongsTo('App\Category');
	}

	public function user()
	{
		return $this->belongsTo('App\User');
	}

	public function company()
	{
		return $this->belongsTo('App\Company');
	}	

	public function scopeForCompany($query,$company)
	{
		return $query->where('company_id',$company);
	}

}
