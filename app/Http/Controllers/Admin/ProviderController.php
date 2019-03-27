<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Models\ProviderUser;
use Validator;
use Validations\Validate as Validations;
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
        //
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
        /*_dd($data['bank']);*/
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
            $user_id = base64_decode($request->user_id);
            
            $isUpdated = ProviderUser::changeUserDetails($user_id,$provider);

            if($isUpdated){
                $this->status       = true;
                $this->redirect     = true;
                $this->modal        =true;
                $this->alert        =true;
                $this->message      ="Bank details updated Successful.";
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
            $provider['bank_name']=$request->bank_name; 
            $provider['bank_branch_name']=$request->bank_branch_name;                
            $provider['bank_account_number']=$request->bank_account_number;              
            $provider['bank_holder_name']=$request->bank_holder_name;          
            $provider['bank_ifsc_code']=$request->bank_ifsc_code;            
            $user_id = base64_decode($request->user_id);
            
            $isUpdated = ProviderUser::changeUserDetails($user_id,$provider);

            if($isUpdated){
                $this->status       = true;
                $this->redirect     = true;
                $this->modal        =true;
                $this->alert        =true;
                $this->message      ="Bank details updated Successful.";
            }
        }
        return $this->populateresponse(); 
    }
}
