<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Models\ProviderUser;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use Validator;
use Validations\Validate as Validations;
use File;
use Intervention\Image\ImageManagerStatic as Image;

class ProviderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['view']='admin.service_providers';
        $data['user']=_arrayfy(User::where('user_type','provider')->get());
       // dd($data['user']);
        return view('admin.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['view']='admin.provider.add';
        $data['user']=_arrayfy(User::where('user_type','provider')->get());
       // dd($data['user']);
        $country = Country::get();
        $data['country'] = $country;
        return view('admin.index',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation = new Validations($request);
        $validator = $validation->signupByAdmin("add");
        if ($validator->fails()){
            $this->message = $validator->errors();
        }else{
               
                $data['first_name'] = (!empty($request->first_name))?$request->first_name:'';
                $data['last_name'] = (!empty($request->last_name))?$request->last_name:'';
                $data['mobile'] = (!empty($request->mobile))?$request->mobile:'';
                $data['email'] = (!empty($request->email))?$request->email:'';

                $data['address'] = (!empty($request->address))?$request->address:'';
                $data['country'] = (!empty($request->country))?$request->country:'';
                $data['state'] =  (!empty($request->state))?$request->state:'';
                $data['city'] = (!empty($request->city))?$request->city:'';

                $data['permanent_address'] = (!empty($request->permanent_address))?$request->permanent_address:'';
                $data['permanent_country'] = (!empty($request->permanent_country))?$request->permanent_country:'';
                $data['permanent_state'] =  (!empty($request->permanent_state))?$request->permanent_state:'';
                $data['permanent_city'] = (!empty($request->permanent_city))?$request->permanent_city:'';
                $data['user_type'] = 'provider';

                 $data['password'] = \Hash::make($request->password);
                                $data['status'] = 'pending';
                 $data['otp'] = 'SHDJS';
                $data['date_of_birth'] =(!empty($request->date_of_birth))?$request->date_of_birth:'';
                $provider['distance_to_travel']=(!empty($request->distance_travel))?$request->distance_travel:'';         
                $provider['long_distance_travel']=(!empty($request->long_distance_travel))?$request->long_distance_travel:''; 
                $provider['location_track_permission']=(!empty($request->location_track_permission) && $request->location_track_permission=='yes')?$request->location_track_permission:'no';
               
                if ($file = $request->file('image')){
                    $photo_name = time().$request->file('image')->getClientOriginalName();
                    $file->move('assets/images/users',$photo_name);
                    $data['image'] = $photo_name;
                   
                }
               
                $user = User::create($data);
                $provider['user_id'] = $user->id;
                $provider= ProviderUser::create($provider);
            if($user && $provider){
                
                $this->status   = true;
                $this->alert    = true;
                $this->message = "Provider Updated Successfully";
                $this->modal = true;
                $this->redirect = url('admin/provider');
            }
        }
          
        return $this->populateresponse();

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['view']='admin.provider.view';
        $user_id = base64_decode($id);
        $data['user']=_arrayfy(User::provider_list('single','id = '.$user_id));
        return view('admin.index',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['view']='admin.provider.edit';
        $user_id = base64_decode($id);
        $country = Country::get();
        $data['country'] = $country;

        $data['user']=_arrayfy(User::provider_list('single','id = '.$user_id));
        $data['selected_states'] = State::where('country_id',$data['user']['country'])->get();
        
        $data['selected_cities'] = City::where('state_id',$data['user']['state'])->get();
        $data['permanent_selected_states'] = State::where('country_id',$data['user']['permanent_country'])->get();
        
        $data['permanent_selected_cities'] = City::where('state_id',$data['user']['permanent_state'])->get();
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
        $request->request->add(['id'=>base64_decode($id)]);
        $validation = new Validations($request);
        $validator = $validation->signupByAdmin("edit");
        if ($validator->fails()){
            $this->message = $validator->errors();
        }else{
                $user_id = base64_decode($id);
                $data['first_name'] = (!empty($request->first_name))?$request->first_name:'';
                $data['last_name'] = (!empty($request->last_name))?$request->last_name:'';
                $data['mobile'] = (!empty($request->mobile))?$request->mobile:'';
                $data['email'] = (!empty($request->email))?$request->email:'';

                $data['address'] = (!empty($request->address))?$request->address:'';
                $data['country'] = (!empty($request->country))?$request->country:'';
                $data['state'] =  (!empty($request->state))?$request->state:'';
                $data['city'] = (!empty($request->city))?$request->city:'';

                $data['permanent_address'] = (!empty($request->permanent_address))?$request->permanent_address:'';
                $data['permanent_country'] = (!empty($request->permanent_country))?$request->permanent_country:'';
                $data['permanent_state'] =  (!empty($request->permanent_state))?$request->permanent_state:'';
                $data['permanent_city'] = (!empty($request->permanent_city))?$request->permanent_city:'';
               
                $data['date_of_birth'] =(!empty($request->date_of_birth))?$request->date_of_birth:'';
                $provider['distance_to_travel']=(!empty($request->distance_travel))?$request->distance_travel:'';         
                $provider['long_distance_travel']=(!empty($request->long_distance_travel))?$request->long_distance_travel:''; 
                $provider['location_track_permission']=(!empty($request->location_track_permission) && $request->location_track_permission=='yes')?$request->location_track_permission:'no';
               
                if ($file = $request->file('image')){
                    $photo_name = time().$request->file('image')->getClientOriginalName();
                    $file->move('assets/images/users',$photo_name);
                    $data['image'] = $photo_name;
                   
                }
               
                User::change($user_id,$data);
                ProviderUser::changeUserDetails($user_id,$provider);
            
            $this->status   = true;
            $this->alert    = true;
            $this->message = "Provider Updated Successfully";
            $this->modal = true;
            $this->redirect = url('admin/provider');
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


    public function editbank($id){
        $id          = base64_decode($id);
        $data['view']='admin.provider.editbank';
        $data['bank']=_arrayfy(ProviderUser::where('user_id',$id)->firstOrFail());
        return view('admin.index',$data);

    }

    public function updateBank(Request $request,$id)
    {
        $validation = new Validations($request);
        $validator = $validation->bankDetail();
        if ($validator->fails()){
            $this->message = $validator->errors();
        }else{
            $provider['bank_name']=$request->bank_name; 
            $provider['bank_branch_name']=$request->bank_branch_name;                
            $provider['bank_account_number']=$request->bank_account_number;              
            $provider['bank_holder_name']=$request->bank_holder_name;          
            $provider['bank_ifsc_code']=$request->bank_ifsc_code;            
            $provider_id = base64_decode($id);
            
            $isUpdated = ProviderUser::change($provider_id,$provider);

            
                $this->status       = true;
                $this->modal        =true;
                $this->alert        =true;
                $this->message      ="Bank details updated Successful.";
                $this->redirect     = url('admin/provider');;
            
        }
        return $this->populateresponse(); 
    }

    public function editqualification($id){
        $id          = base64_decode($id);
        $data['view']='admin.provider.editqualification';
        $data['qualification']=_arrayfy(ProviderUser::where('user_id',$id)->firstOrFail());
        /*_dd($data['qualification']);*/
        return view('admin.index',$data);

    }
    public function updatequalification(Request $request,$id)
    {
        $validation = new Validations($request);
        $validator = $validation->qualificationDetail();
        if ($validator->fails()){
            $this->message = $validator->errors();
        }else{
            $provider['highschool_year']=$request->highschool_year; 
            $provider['intermediate_year']=$request->intermediate_year;                
            $provider['graduation_year']=$request->graduation_year;              
            $provider['post_graduation_year']=$request->post_graduation_year;          
            $provider_id = base64_decode($request->user_id);
            
            $isUpdated = ProviderUser::change($provider_id,$provider);

                $this->status       = true;
                $this->modal        =true;
                $this->alert        =true;
                $this->message      ="Qualification details updated Successful.";
                $this->redirect     = url('admin/provider');
        }
        return $this->populateresponse(); 
    }

    public function editDocument($id){
        $id          = base64_decode($id);
        $data['view']='admin.provider.editupload_doc';
        $data['qualification']=_arrayfy(ProviderUser::where('user_id',$id)->firstOrFail());
        /*_dd($data['qualification']);*/
        return view('admin.index',$data);

    }
    public function updateDocument(Request $request,$id)
    {
        $validation = new Validations($request);
        $validator = $validation->addDocuments();
        if ($validator->fails()){
            $this->message = $validator->errors();
        }else{
            $user_id = base64_decode($request->user_id);
            if($request->file('document_high_school')){
                    $path = url('/assets/images/document/');
                    if(!File::exists($path)) {
                        File::makeDirectory($path, $mode = 0777, true);
                    }
                    $image       = $request->file('document_high_school');
                    $document_high_school    = time().$image->getClientOriginalName();
                    $image = Image::make($image->getRealPath());              
                    $image->save('assets/images/document/' .$document_high_school);
                    $provider['document_high_school'] = $document_high_school;
                }   

                if($request->file('document_graduation')){
                    $path = url('/assets/images/document/');
                    if(!File::exists($path)) {
                        File::makeDirectory($path, $mode = 0777, true);
                    }
                    $image       = $request->file('document_graduation');
                    $document_graduation    = time().$image->getClientOriginalName();
                    $image = Image::make($image->getRealPath());              
                    $image->save('assets/images/document/' .$document_graduation);
                    $provider['document_graduation'] = $document_graduation;
                }       
                if($request->file('document_post_graduation')){
                    $path = url('/assets/images/document/');
                    if(!File::exists($path)) {
                        File::makeDirectory($path, $mode = 0777, true);
                    }
                    $image       = $request->file('document_post_graduation');
                    $document_post_graduation    = time().$image->getClientOriginalName();
                    $image = Image::make($image->getRealPath());              
                    $image->save('assets/images/document/' .$document_post_graduation);
                    $provider['document_post_graduation'] = $document_post_graduation;
                } 
                if($request->file('document_adhar_card')){
                    $path = url('/assets/images/document/');
                    if(!File::exists($path)) {
                        File::makeDirectory($path, $mode = 0777, true);
                    }
                    $image       = $request->file('document_adhar_card');
                    $document_adhar_card    = time().$image->getClientOriginalName();
                    $image = Image::make($image->getRealPath());              
                    $image->save('assets/images/document/' .$document_adhar_card);
                    $provider['document_adhar_card'] = $document_adhar_card;
                }

                if($request->file('document_other')){
                    $path = url('/assets/images/document/');
                    if(!File::exists($path)) {
                        File::makeDirectory($path, $mode = 0777, true);
                    }
                    $image       = $request->file('document_other');
                    $document_other    = time().$image->getClientOriginalName();
                    $image = Image::make($image->getRealPath());              
                    $image->save('assets/images/document/' .$document_other);
                    $provider['document_other'] = $document_other;
                }    

                
                if(!empty($provider)){
                    
                    $user = ProviderUser::change($user_id,$provider);
                }

                $this->status       = true;
                $this->modal        =true;
                $this->alert        =true;
                $this->message      ="Document details updated Successful.";
                $this->redirect     = url('admin/provider');
        }
        return $this->populateresponse(); 
    }
}
