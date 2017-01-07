<?php namespace App\Http\Controllers\Admin\Configuration;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\Category\CategoryRepository;

use Request;
use Response;
use Auth;
use Debugbar;
use Validator;
use Input;

class CategoriesController extends Controller
{
    private $category;
    
    private $createValidationRules = array('name' => 'required|max:255');
    private $updateValidationRules = array('name' => 'required|max:255','category_id'=>'required|integer');
    private $destroyValidationRules = array('category_id'=>'required|integer');

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
        if (Request::ajax()) {                       
            return $this->category->getAllForCompany(Auth::user()->company->id);
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
            $validator = Validator::make(Input::all(), $this->createValidationRules);

            if ($validator->fails())
            {
                return Response::json(array(
                    'success' => false,
                    'errors' => $validator->getMessageBag()->toArray()
                ), 400); 
            }        

            $attributes = array();
            $attributes['name'] = Request::input('name');
            $attributes['user_id'] = Auth::user()->id;
            $attributes['company_id'] = Auth::user()->company->id;
            $attributes['is_active'] = true;
            
            try{
                return $this->category->create($attributes);

            }catch (\Illuminate\Database\QueryException $e){            
                $errorCode = $e->errorInfo[1];
                if($errorCode == 1062){
                    return Response::json(array(
                        'success' => false,
                        'errors' => "Category already exists."
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
            $validator = Validator::make(Input::all(), $this->updateValidationRules);

            if ($validator->fails())
            {
                return Response::json(array(
                    'success' => false,
                    'errors' => $validator->getMessageBag()->toArray()
                ), 400); 
            } 

            $attributes = array();
            $id  = Request::input('category_id');
            $attributes['name'] = Request::input('name');
            $attributes['user_id'] = Auth::user()->id;
            $attributes['company_id'] = Auth::user()->company->id;
            $attributes['is_active'] = true;
                        
            try{
                return $this->category->update($id, $attributes); 

            }catch (\Illuminate\Database\QueryException $e){  
                $errorCode = $e->errorInfo[1];
                if($errorCode == 1062){
                    return Response::json(array(
                        'success' => false,
                        'errors' => "Provided category already exists."
                    ), 400);
                }

                return Response::json(array(
                        'success' => false,
                        'errors' => "Database error, please contact admin."
                    ), 400);            
            }catch(\Exception $e){
                return Response::json(array(
                        'success' => false,
                        'errors' => "Error while updating category"
                    ), 400);
            }            
        }
    }


    public function getCategoriesDropdown()
    {                  
        if (Request::ajax()) {                       
            return $this->category->getCategoriesDropdownForCompany(Auth::user()->company->id);
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy()
    {
        if (Request::ajax()) {                                         
            $id  = Request::input('category_id');            
            
            return $this->category->delete($id);            
        }
    }
}
