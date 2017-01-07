<?php namespace App\Http\Controllers\Admin\Configuration;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\Question\QuestionRepository;

use Request;
use Response;
use Auth;
use Validator;
use Input;

class QuestionBankController extends Controller {

	private $question;

	private $createValidationRules = array('title' => 'required',
		'optionA' => 'required','optionB' => 'required','answer' => 'required','answer_type' => 'required',
		'chapter_id' => 'required','category_id' => 'required'
		);
	private $updatevalidationRules = array('id'=>'required', 'title' => 'required',
		'optionA' => 'required','optionB' => 'required','answer' => 'required','answer_type' => 'required',
		'chapter_id' => 'required','category_id' => 'required');

	public function __construct(QuestionRepository $question)
    {
        $this->question = $question;
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return view('admin.partials.configuration.questionbank');
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
			$attributes['title'] = Request::input('title');
            $attributes['body'] = Request::input('body');
			$attributes['footer'] = Request::input('footer','');
			$attributes['optionA'] = Request::input('optionA');
			$attributes['optionB'] = Request::input('optionB');
			$attributes['optionC'] = Request::input('optionC','');
			$attributes['optionD'] = Request::input('optionD','');
			$attributes['optionE'] = Request::input('optionE','');
			$attributes['optionF'] = Request::input('optionF','');
			$attributes['marks'] = Request::input('marks',1);
			$attributes['answer'] = Request::input('answer');
			$attributes['answer_description'] = Request::input('answer_description','');
			$attributes['answer_type'] = Request::input('answer_type');
			$attributes['negative_weightage'] = Request::input('negative_weightage',0);
			$attributes['chapter_id'] = Request::input('chapter_id');
			$attributes['category_id'] = Request::input('category_id');
			$attributes['answer_selection'] = Request::input('answer_selection','');
            $attributes['user_id'] = Auth::user()->id;
            $attributes['company_id'] = Auth::user()->company->id;
            $attributes['is_active'] = true;
            
            try{
                return $this->question->create($attributes);

            }catch (\Illuminate\Database\QueryException $e){            
                $errorCode = $e->errorInfo[1];

                return Response::json(array(
                        'success' => false,
                        'errors' => "Database error, please contact admin."
                    ), 400);            
            }catch(\Exception $e){
                return Response::json(array(
                        'success' => false,
                        'errors' => "Error while creating question"
                    ), 400);
            }                        
        }
	}
	 

	public function getAllQuestions()
	{	
		if (Request::ajax()) {                       
			$answerType =$_REQUEST['answerType'];
			$category = $_REQUEST['category'];

            return $this->question->getAllForCompany(Auth::user()->company->id,$answerType,$category);
        }
	}

	public function getQuestionById()
	{	
		if (Request::ajax()) {                       
			$questionId =$_REQUEST['questionId'];
			
            return $this->question->getById($questionId);
        }
	}

	public function mcq()
	{
		$action = $_REQUEST['action'];
		
		if($action == 'create')
			return view('admin.partials.configuration.questionType.mcq')->with('action','Add');
		else if (($action=='edit' && array_key_exists ('questionid' ,$_REQUEST)))
			return view('admin.partials.configuration.questionType.mcq')->with('action','Edit');
		else
			return redirect('a/configuration/questionbank');
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
			$id = Request::input('id');
			
			$attributes['title'] = Request::input('title');
            $attributes['body'] = Request::input('body');
			$attributes['footer'] = Request::input('footer','');
			$attributes['optionA'] = Request::input('optionA');
			$attributes['optionB'] = Request::input('optionB');
			$attributes['optionC'] = Request::input('optionC','');
			$attributes['optionD'] = Request::input('optionD','');
			$attributes['optionE'] = Request::input('optionE','');
			$attributes['optionF'] = Request::input('optionF','');
			$attributes['marks'] = Request::input('marks',1);
			$attributes['answer'] = Request::input('answer');
			$attributes['answer_description'] = Request::input('answer_description','');
			$attributes['answer_type'] = Request::input('answer_type');
			$attributes['negative_weightage'] = Request::input('negative_weightage',0);
			$attributes['chapter_id'] = Request::input('chapter_id');
			$attributes['category_id'] = Request::input('category_id');
			$attributes['answer_selection'] = Request::input('answer_selection','');
            $attributes['user_id'] = Auth::user()->id;
            $attributes['company_id'] = Auth::user()->company->id;
            $attributes['is_active'] = true;
                        
            try{
                return $this->question->update($id, $attributes); 

            }catch (\Illuminate\Database\QueryException $e){ 
				$errorCode = $e->errorInfo[1];               

                return Response::json(array(
                        'success' => false,
                        'errors' => "Database error, please contact admin."
                    ), 400);            
            }catch(\Exception $e){
                return Response::json(array(
                        'success' => false,
                        'errors' => "Error while updating question"
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
	public function destroy()
	{
		if (Request::ajax()) {                                         
            $id  = Request::input('id');            
            
            return $this->question->delete($id);            
        }
	}

}
