<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\ProviderUser;
use Validations\Validate as Validations;

class UserProfileController extends Controller
{
    public function profile(Request $request)
    {
    	$data['view']='front.profile';
    	$user = _arefy(User::provider_list('single','id = '.\Auth::user()->id));
    	$data['user'] = $user;
    	return view('front.index',$data);
    }

     public function updateProfile(Request $request)
    {
        $validation = new Validations($request);
        $validator = $validation->updateProfile();
        if ($validator->fails()){
            $this->message = $validator->errors();
        }else{
            
                $data['first_name'] = $request->first_name;
                $data['last_name'] = $request->last_name;
                $data['address'] = $request->address;
                $data['date_of_birth'] = $request->date_of_birth;
				$data['gender'] = $request->gender;
                if ($file = $request->file('image')){
                    $photo_name = time().$request->file('image')->getClientOriginalName();
                    $file->move('assets/images/users',$photo_name);
                    $data['image'] = $photo_name;
                   
                }
               
                $update = User::change(\Auth::user()->id,$data);
            
            $this->status   = true;
            $this->alert    = true;
            $this->message = "Profile Updated Successful";
            $this->modal = true;
            $this->redirect = url('provider/dashboard');
        }
        return $this->populateresponse();
    }

     public function changePassword(Request $request)
    {	
    	$request->request->add(['id'=>\Auth::user()->id]);
        $validation = new Validations($request);
        $validator = $validation->changeProviderPassword();
        if ($validator->fails()){
            $this->message = $validator->errors();
        }else{
                $data['password']=\Hash::make($request->new_password);
                $user = User::where('id', '=', $request->id)->update($data);
                

	            $this->status   = true;
	            $this->alert    = true;
	            $this->modal = true;
	            $this->redirect = url('provider/dashboard');
                $this->message = "Password changed Successfully.";
                
        }
        return $this->populateresponse();
    }
}
