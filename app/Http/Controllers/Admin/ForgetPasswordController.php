<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Models\PasswordReset;
use Validations\PasswordResetValidation as PasswordResetValidation;
class ForgetPasswordController extends Controller
{

    public function __construct(Request $request)
    {   
        parent::__construct($request);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return view('admin.forgetpassword.forgetview');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
      $validation  = new PasswordResetValidation($request);
      $validate    = $validation->passwordreset();
      $validate->after(function($validate) use ($request){
        $userDetails= User::list('single',"email='$request->email' AND (user_type='admin' OR user_type='subadmin')",['status','user_type']);
        if($userDetails){
        $status     = $userDetails['status'];
        $user_type  = $userDetails['user_type'];
        if($status!='active'){
          $validate->errors()->add('email','Your Account Has Been Disabled Contact Your System Administrator');
        }
        }else{
          $validate->errors()->add('email','Account Not Registred With Us.');
        }
      });
      if($validate->fails()){
       return back()->withErrors($validate)->withInput();
      }else{

   /*     dd('stpoed');*/
            $user           = User::list('single',"email='$request->email' AND (user_type='admin' OR user_type='subadmin')",'*');
            $name           = $user['name'];
            $blade_name     = 'passwordreset';
            $subject        = 'Reset Password Notification.';
            $data['email']      = $request->email;
            $data['token']      = bcrypt(__random_string());
            $data['created_at'] = date('Y-m-d H:i:s');
            $isadded            = PasswordReset::manage('email',$request->email,$data);
             if($isadded){
               ___sendTemplate($request->email,$name,$data,$blade_name,$subject);
               return redirect::back()->with('message', ' A email will be sent to that address containing a link to reset your password');
        }else{
              $validate->errors()->add('email','Something Went Wrong,Please Try again later');
             return back()->withErrors($validate)->withInput();
        }

    }
  }

  public function setpassword(Request $request){
    $data['page_title']  = 'Reset Password';
    $data['site_title']  = 'Set Password';
    $data['view']        = 'admin.forgetpassword.resetpassword';
    $passwordDetails      = PasswordReset::listing('single','*',"token='$request->token'");
    if(empty($request->token)){
      $data['message']   = "Invalid Url";
    }elseif(empty($passwordDetails)||$passwordDetails==NULL){
      $data['message']  = "Invalid Token";
    }elseif(___datetimediffernce($passwordDetails['created_at'])>TOKEN_TIME||___datetimediffernce($passwordDetails['created_at'])<0){
      $data['message']  = "Token Expired";
    }else{
      $data['message'] ='';
      $email      = $passwordDetails['email'];
      $userDetails = User::list('single',"email='$email'",['id']);
      $data['id']  = $userDetails['id'];
    }
    return view('admin.forgetpassword.resetpassword')->with($data);
  }

  public function updatepassword(Request $request, $id){
    $id                 = ___decrypt($id);
    $validator          = new PasswordResetValidation($request);
    $validate           = $validator->updatepassword();
    if($validate->fails()){
      return back()->withErrors($validate)->withInput();
    }else{
      $data['password']   = bcrypt($request->password);
      $data['updated_at'] = date('Y-m-d H:i:s');
      $isUpdated          = User::where('id',$id)->update($data);
      if($isUpdated){
        $userDetails        = User::list('single',"id='$id'",['email']);
        $email              = $userDetails['email'];
        $delete             = PasswordReset::where('email',$email)->delete();
        return redirect('admin/login')->with('message', 'Password Reset Successfully.');

      }
    }
  }


}
