<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Models\ProviderUser;
use Validator;
use App\Models\UserChild;
use Validations\Validate as Validations;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['view']='admin.users';
        $data['users']=_arrayfy(User::where('user_type','user')->get());
        
       // dd($data['user']);
        return view('admin.index',$data);
    }

    public function viewChildren($user_id)
    {
        $data['view']='admin.viewchildren';
        $user_id = base64_decode($user_id);
        $data['children']=_arrayfy(UserChild::where('user_id',$user_id)->get());

        
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
        $data['view']='admin.user.add';
        $data['user']=_arrayfy(User::where('user_type','user')->get());
       // dd($data['user']);
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
        //
        print_r('dcfghbjkm,');
        dd('wqdefrt');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['view']='admin.user.view';
        $user_id = base64_decode($id);
        $data['user']=_arrayfy(User::list('single','id = '.$user_id));
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
        //
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
        //
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

    /*public function updatebank($id){
        $id          = base64_decode($id);
        $data['view']='admin.provider.editbank';
        $data['bank']=_arrayfy(ProviderUser::where('user_id',$id)->firstOrFail());
        return view('admin.index',$data);

    }*/
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
            $user_id = base64_decode($request->user_id);
            
            $isUpdated = ProviderUser::changeUserDetails($user_id,$provider);

            if($isUpdated){
                $this->status       = true;
                $this->modal        =true;
                $this->alert        =true;
                $this->message      ="Bank details updated Successful.";
                $this->redirect     = url('admin/provider');;
            }
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
            $user_id = base64_decode($request->user_id);
            
            $isUpdated = ProviderUser::changeUserDetails($user_id,$provider);

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
                $user_id = $request->user_id;
                if(!empty($provider)){

                    $user = ProviderUser::changeUserDetails($user_id,$provider);
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
