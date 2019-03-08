<?php
namespace App\Http\Controllers\API;
use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 
use App\User; 
use Illuminate\Support\Facades\Auth; 
use Validator;
use Validations\Validate as Validations;
use Perks\Response;
class UserController extends Controller 
{
   /* public function __construct(Request $request){
        parent::__construct($request);
    }*/
   public function __construct(Request $request){
        $this->language         = \App::getLocale();
        $this->prefix           = \DB::getTablePrefix();        
        $this->jsondata         = (object)[];
        $this->message          = "";
        $this->error_code       = "no_error_found";
        $this->status           = false;
        $this->status_code      = 200;
        $this->redirect         = false;
        $this->modal            = false;
        $this->alert            = false;
        $this->next_tab         = false;
        $this->ajax             = 'api';
        $this->successimage     = asset('images/success.png');
        
        if($request->ajax()){
            $this->ajax = 'web';
        }

        $json = json_decode(file_get_contents('php://input'),true);
        if(!empty($json)){
            $this->post = $json;
        }else{
            $this->post = $request->all();
        }

  
        $request->replace($this->post);
    }
    public $successStatus = 200;
/** 
     * login api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    /*public function login(){ 
        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){ 
            $user = Auth::user(); 
            $success['user_details']=$user;
            $success['token'] =  $user->createToken('MyApp')->accessToken; 
            return response()->json([
                    'success' => $success
            ], $this-> successStatus); 
        } 
        else{ 
            return response()->json(['error'=>'Unauthorised'], 401); 
        } 
    }*/

    public function login(Request $request)
    {
        $validation = new Validations($request);
        $validator = $validation->login();
        if ($validator->fails()){
            $this->message = $validator->errors();
        }else{
            if(is_numeric($request->username)){
                $login = Auth::attempt(['mobile' => $request->username,'password' => $request->password]);
            }else{

                $login = Auth::attempt(['email' => $request->username,'password' => $request->password]);
            }
            if ($login){
                $user = Auth::user(); 
                $success['user_details']=$user;
                $success['token'] =  $user->createToken('MyApp')->accessToken;
                $this->status   = true;
                $response = new Response($success);
                $this->jsondata = $response->api_common_response();
                $this->message = "Login Successful";
               
            }else{
                $this->message = $validator->errors()->add('not_exist', 'Username or Password is invalid');
            }
        }
        return $this->populateresponse();
    }

    public function forgotPassword(Request $request)
    {
        $validation = new Validations($request);
        $validator = $validation->forgotpass();
        if ($validator->fails()){
            $this->message = $validator->errors();
        }else{
            
                $user = Auth::user(); 
                $success['user_details']=$user;
                $user = User::where('email', '=', $request->email)->firstOrFail();
                $autopass = strtoupper(str_random(4));
                $input['otp'] = $autopass;
                $upd = $user->update($input);
                $subject = "Reset Password Request";
                $msg = "Your OTP is : ".$autopass;
                $emailData               = ___email_settings();
                $emailData['name']       = $user->name; //!empty($request->name)?$request->name:'';
                $emailData['email']      = !empty($request->email)?$request->email:'';
                $emailData['subject']    = 'Reset Password Request';
                $emailData['password']    = !empty($autopass)?$autopass:'';
                $emailData['date']       = date('Y-m-d H:i:s');

                $emailData['custom_text'] = 'Your Enquiry has been submitted successfully';
                $mailSuccess = ___mail_sender($emailData['email'],$request->name,"forgot_password",$emailData);
               
       
                $success['otp'] =  $autopass;
                $this->status   = true;
                $response = new Response($success);
                $this->jsondata = $response->api_common_response();
                $this->message = "OTP send Successfully. Please Check your email.";
               
            
        }
        return $this->populateresponse();
    }

    public function otp(Request $request)
    {
        $validation = new Validations($request);
        $validator = $validation->otp();
        if ($validator->fails()){
            $this->message = $validator->errors();
        }else{
                $user = User::where('otp', '=', $request->otp)->firstOrFail();
                if($user){
                    $success['user_details']=$user;
                    $autopass = strtoupper(str_random(4));
                    $input['otp'] = $autopass;
                    $upd = $user->update($input);

                    $this->status   = true;
                    $response = new Response($success);
                    $this->jsondata = $response->api_common_response();
                    $this->message = "Success.";
                }
                
        }
        return $this->populateresponse();
    }

    public function ChangePassword(Request $request)
    {
        $validation = new Validations($request);
        $validator = $validation->changePassword();
        if ($validator->fails()){
            $this->message = $validator->errors();
        }else{
                $data['password']=\Hash::make($request->password);
                $user = User::where('id', '=', $request->id)->update($data);
                $success['user'] =  $user;
                $this->status   = true;
                $response = new Response($success);
                $this->jsondata = $response->api_common_response();
                $this->message = "Password changed Successfully.";
                
        }
        return $this->populateresponse();
    }
/** 
     * Register api 
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
            return response()->json(['error'=>$validator->errors()], 401);            
        }
$input = $request->all(); 
        $input['password'] = bcrypt($input['password']); 
        $user = User::create($input); 
        $success['token'] =  $user->createToken('MyApp')-> accessToken; 
        $success['name'] =  $user->name;
return response()->json(['success'=>$success], $this-> successStatus); 
    }
/** 
     * details api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function details() 
    { 
        $user = Auth::user(); 
        return response()->json(['success' => $user], $this-> successStatus); 
    } 
}