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

        dd('stpoed');
            $user           = User::listing('single',"email='$request->email' AND (user_type='admin' OR user_type='subadmin')",'*');
            $name           = $user['name'];
            $blade_name     = 'passwordreset';
            $subject        = 'Reset Password Notification.';
            $data['email']      = $request->email;
            $data['token']      = bcrypt(__random_string());
            $data['created_at'] = date('Y-m-d H:i:s');
            $isadded            = PasswordReset::manage('email',$request->email,$data);
             if($isadded){
               ___sendTemplate($request->email,$name,$data,$blade_name,$subject);
             
        }

    }
  }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $id                           = ___decrypt($id);
        $data['country']              =  Country::get();
        $data['details']              = _arefy(User::list('single',"id=$id",'*'));
        /*dd($data['details']);*/
        $data['view']                 ='admin.subadmin.edit';
        return view('admin.index',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $id          = ___decrypt($id);
        $request->id = $id;
        $validation  = new Validations($request);
        $validator   = $validation->edit();
        if($validator->fails()){
            $this->message = $validator->errors();
        }else{
           if ($file = $request->file('image')){
                    $photo_name = time() . '.' . $file->getClientOriginalExtension();
                    $file->move('assets/images/users',$photo_name);
                    $data['image'] = $photo_name;
            }
            $data['first_name']    = $request->first_name;
            $data['last_name']     = $request->last_name;
            $data['mobile']        = $request->phone_number;
            $data['email']         = $request->email;
            $data['gender']        = $request->gender;
            if($request->has('date_of_birth')){
                $data['date_of_birth'] =  $request->date_of_birth;

            }
            $data['country']               = $request->country;
            $data['city']                  = $request->city;
            $data['state']                 = $request->state;
            $data['address']               = $request->address;
            $data['country']               = $request->country;
            $data['permanent_country']     = $request->permanent_country;
            $data['permanent_city']        = $request->permanent_city;
            $data['permanent_state']       = $request->permanent_state;
            $data['permanent_address']     = $request->permanent_address;
            $data['updated_at']            = date('Y-m-d H:i:s');
            $isUpdated                     = User::change($id,$data);
            if($isUpdated){
                $this->status   = true;
                $this->modal    = true;
                $this->alert    = true;
                $this->message  = "Sub Admin Updated successfully.";
                $this->redirect = route('subadmin.index');
            }
        }
        return $this->populateresponse();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function updatestatus(Request $request){
        $data                   = ['status'=>$request->status,'updated_at'=>date('Y-m-d H:i:s')];
        $isUpdated              = User::updateStatus($request->id,$data);
        if($isUpdated){
            $this->status       = true;
            $this->redirect     = true;
            $this->jsondata     = [];
        }
        return $this->populateresponse();
    }


}
