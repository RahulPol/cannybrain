<?php namespace App\Http\Controllers\Admin\Configuration;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\Category\CategoryRepository;

use Request;
use Response;
use Auth;

class CategoriesController extends Controller {

	private $category;

	public function __construct(CategoryRepository $category)
	{
		$this->category = $category; 
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return view('admin.partials.configuration.categories');
	}

	public function getAllCategories()
	{
		if(Request::ajax())
		{
			return $this->category->getAll();
		}
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		if(Request::ajax()) 
		{
			sleep(5);
			if(Auth::check() && Auth::user()->role->name == "user")
			{
				$attributes = array();
				$attributes['name'] = Request::input('categoryName');	
				$attributes['user_id'] = Auth::user()->id;
				$attributes['is_active'] = true;

				return $this->category->create($attributes);
			}

					
			return Response::json(array('code'=>401, 'message'=> "Not authorized to create category"),401);
		}
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}