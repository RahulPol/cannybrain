<?php namespace App\Http\Controllers\Admin\Configuration;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\Chapter\ChapterRepository;

use Request;
use Response;
use Auth;
use Validator;
use Input;

class ChaptersController extends Controller {

	private $chapter;
    
    private $createvalidationRules = array('name' => 'required|max:255','category_id'=>'required|integer');
	private $updatevalidationRules = array('name' => 'required|max:255','category_id'=>'required|integer','chapter_id'=>'required|integer');

	public function __construct(ChapterRepository $chapter)
    {
        $this->chapter = $chapter;
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return view('admin.partials.configuration.chapters');
	}


	public function getAllChapters()
    {                  
        if (Request::ajax()) {                       
            return $this->chapter->getAllForCompany(Auth::user()->company->id);
        }
    }

    public function getChaptersDropdownForCategory($category)
    {
        if(Request::ajax())
        {
            return $this->chapter->getChaptersDropdownForCategory(Auth::user()->company->id,$category);
        }
    }

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		if (Request::ajax()) {
            $validator = Validator::make(Input::all(), $this->createvalidationRules);

            if ($validator->fails())
            {
                return Response::json(array(
                    'success' => false,
                    'errors' => $validator->getMessageBag()->toArray()
                ), 400); 
            }        

            $attributes = array();
            $attributes['name'] = Request::input('name');
			$attributes['category_id'] = Request::input('category_id');
            $attributes['user_id'] = Auth::user()->id;
            $attributes['company_id'] = Auth::user()->company->id;
            $attributes['is_active'] = true;
            
            try{
                return $this->chapter->create($attributes);

            }catch (\Illuminate\Database\QueryException $e){            
                $errorCode = $e->errorInfo[1];
                if($errorCode == 1062){
                    return Response::json(array(
                        'success' => false,
                        'errors' => "Chapter already exists."
                    ), 400);
                }

                return Response::json(array(
                        'success' => false,
                        'errors' => "Database error, please contact admin."
                    ), 400);            
            }catch(\Exception $e){
                return Response::json(array(
                        'success' => false,
                        'errors' => "Error while creating chapter"
                    ), 400);
            }                        
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
	public function update()
	{
		if (Request::ajax()) {      
            $validator = Validator::make(Input::all(), $this->updatevalidationRules);

            if ($validator->fails())
            {
                return Response::json(array(
                    'success' => false,
                    'errors' => $validator->getMessageBag()->toArray()
                ), 400); 
            } 

            $attributes = array();
            $id  = Request::input('chapter_id');
			$attributes['category_id']  = Request::input('category_id');
            $attributes['name'] = Request::input('name');
            $attributes['user_id'] = Auth::user()->id;
            $attributes['company_id'] = Auth::user()->company->id;
            $attributes['is_active'] = true;
                        
            try{
                return $this->chapter->update($id, $attributes); 

            }catch (\Illuminate\Database\QueryException $e){ 
				$errorCode = $e->errorInfo[1];
                if($errorCode == 1062){
                    return Response::json(array(
                        'success' => false,
                        'errors' => "Chapter for given category already exists."
                    ), 400);
                }

                return Response::json(array(
                        'success' => false,
                        'errors' => "Database error, please contact admin."
                    ), 400);            
            }catch(\Exception $e){
                return Response::json(array(
                        'success' => false,
                        'errors' => "Error while creating category"
                    ), 400);
            }            
        }
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		if (Request::ajax()) {                                         
            $id  = Request::input('chapter_id');            
            
            return $this->chapter->delete($id);            
        }
	}

}
