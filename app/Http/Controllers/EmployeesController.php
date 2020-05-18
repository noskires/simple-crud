<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
// use Config;

use DB;
use Auth;
use App\Models\Employee;
// use App\User;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use DataTables;
// use Artisaninweb\SoapWrapper\SoapWrapper;

class EmployeesController extends Controller {

    // protected $soapWrapper;

 
    // public function __construct(SoapWrapper $soapWrapper)
    // {
    //   $this->soapWrapper = $soapWrapper;
    // }
    
	public function index(){
        return view('layout.index');
    }

    public function index2(){
        return view('layout.index2');
    }
    
    public function show(Request $request){
        $data = array(
            'id'=>$request->input('id')
        );
        
        $employees = Employee::select('id', 'lastname', 'suffix', 'firstname', 'middlename');

        if ($data['id']){
            $employees = $employees->where('id', $data['id']);
        }

        $employees = $employees->get();

        return response()->json([
            'status'=>200,
            'data'=>$employees,
            'count'=>$employees->count(),
            'message'=>''
        ],200,[], JSON_NUMERIC_CHECK);
    }
    
    public function show2(Request $request){

        $data = array(
            'id'=>$request->input('id')
        );

        $ricd = Employee::select('id', 'lastname', 'suffix', 'firstname', 'middlename');
        return DataTables::of($ricd)->make(true);

    }

    public function store(Request $request){

        $fields = Input::post();

        $transaction = DB::transaction(function($field) use($fields){
            try{

                $employee = new Employee;
                $employee->lastname    = $fields['lastname'];
                $employee->suffix      = $fields['suffix'];
                $employee->firstname   = $fields['firstname'];
                $employee->middlename  = $fields['middlename'];
                $employee->save();

                return response()->json([
                    'status' => 200,
                    'data' => null,
                    'message' => 'Successfully saved.'
                ]);

            }
            catch (\Exception $e) 
            {
                return response()->json([
                    'status' => 500,
                    'data' => null,
                    'message' => 'Error, please try again!'
                ]);
            }
        });

        return $transaction;
    }

    public function update(Request $request){

        $fields = Input::post();

        $transaction = DB::transaction(function($field) use($fields){
        try{

            $employee = Employee::where('id', $fields['id'])->first();
            $employee->lastname    = $fields['lastname'];
            $employee->suffix      = $fields['suffix'];
            $employee->firstname   = $fields['firstname'];
            $employee->middlename  = $fields['middlename'];
            $employee->save();

            return response()->json([
                'status' => 200,
                'data' => null,
                'message' => 'Successfully updated.'
            ]);

          }
          catch (\Exception $e) 
          {
            return response()->json([
              'status' => 500,
              'data' => null,
              'message' => 'Error, please try again!'
            ]);
          }
        });

        return $transaction;
    }

    public function remove(Request $request){

	    $data = Input::post();

	    $transaction = DB::transaction(function($data) use($data){
	    try{

			Employee::where('id', $data['id'])->firstOrFail()->delete();

	        return response()->json([
	            'status' => 200,
	            'data' => 'null',
	            'message' => 'Successfully deleted.'
	        ]);

	      }
	      catch (\Exception $e) 
	      {
	          return response()->json([
	            'status' => 500,
	            'data' => 'null',
	            'message' => 'Error, please try again!'
	        ]);
	      }
	    });

   	 	return $transaction;
  	}
  	
}