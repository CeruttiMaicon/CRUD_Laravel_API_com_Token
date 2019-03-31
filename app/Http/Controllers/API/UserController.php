<?php
namespace App\Http\Controllers\API;
use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 
use App\User; 
use Illuminate\Support\Facades\Auth; 
use Validator;

class UserController extends Controller 
{

    public $successStatus = 200;
    public $errorPerissionStatus = 401;
/** 
     * Login API 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    
    public function login(){ 
        if(Auth::attempt(['email' => request('email'),  'password' => request('password')])){ 

            $user = Auth::user(); 
            $success['token'] =  $user->createToken('MyApp')->accessToken; 

            return response()->json(['success' => $success], $this->successStatus); 
        } 
        else{ 

            return response()->json(['error'=>'Error 401 - Acesso não autorizado'], $this->$errorPerissionStatus); 
        } 
    }
/** 
     * Registro API 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function register(Request $request) 
    { 
        $validator = Validator::make($request->all(), [ 
            'name' => 'required', 
            'email' => 'required|email', 
            'password' => 'required', 
            'c_password' => 'required|same:password', 
        ]);
        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], $this->$errorPerissionStatus);            
        }
        $input = $request->all(); 
        $input['password'] = bcrypt($input['password']); 
        $user = User::create($input); 
        $success['token'] =  $user->createToken('MyApp')->accessToken; 
        $success['name'] =  $user->name;
        return response()->json(['success'=>$success], $this->successStatus); 
    }
     /** 
     * Detalhes API 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function details() 
    { 
        $user = Auth::user(); 
        return response()->json(['success' => $user], $this->successStatus); 
    } 
}