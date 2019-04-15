<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Models\Country;
use App\Models\ServiceCategory;
use Yajra\DataTables\DataTables;
use Yajra\DataTables\Html\Builder;
use Validations\SubAdminValidation as Validations;
class SubAdminController extends Controller
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
    public function index(Request $request, Builder $builder)
    {
        $data['site_title'] = $data['page_title'] = 'Sub Admin List';
        $data['menu']       = 'category-list';
        $data['breadcrumb'] = '<ul class="page-breadcrumb breadcrumb"><li><a href="'.url('/').'"><i class="fa fa-home" style="font-size:12px;"></i> Home</a><i class="fa fa-circle"></i></li><li> &nbsp;<a href="">Category</a></li></ul>';
        $data['view']       = 'admin.subadmin.list';
        $user                = _arefy(User::list('array',"user_type='subadmin'"));
        if ($request->ajax()) {
            return DataTables::of($user)
                ->editColumn('action',function($item){
                    $html    = '<div class="edit_details_box">';
                if($item['status']=='pending'){
                     $html   .= '<a href="javascript:void(0);" 
                  data-url="'.url(sprintf('admin/subadmin/status/?id=%s&status=active',$item['id'])).'"
                  data-ask="'.sprintf('Are You Sure to approve %s ?',$item['first_name']).'" data-ask_image="'.url('assets/images/delete-user.png').'"data-request="ajax-confirm" title="Approve Sub Admin"><i class="fa fa-check" aria-hidden="true"></i></a> | ';

                }
                $html   .= '<a href="'.route('subadmin.edit',___encrypt($item['id'])).'" title="Edit"><i class="fa  fa-edit"></i></a>|';
                 $html   .= '<a href="javascript:void(0);" 
              data-url="'.url(sprintf('admin/subadmin/status/?id=%s&status=trashed',$item['id'])).'"
              data-ask="'.sprintf('Are You Sure to delete %s ?',$item['first_name']).'" data-ask_image="'.url('assets/images/delete-user.png').'"data-request="ajax-confirm" title="Delete Sub Admin"><i class="fa fa-trash fa-lg" aria-hidden="true" style="color:red;"></i></a> | ';
                $html   .= '</div> ';
                return $html;
                })
                ->editColumn('status',function($item){
                $spanhtml   = _showSpan($item['status']);
                 if($item['status']=='active'){
                  $html   = '<a href="javascript:void(0);" 
                  data-url="'.url(sprintf('admin/subadmin/status/?id=%s&status=inactive',$item['id'])).'"
                  data-ask="'.sprintf(INACTIVE_MSG,$item['first_name'] ).'" data-ask_image="'.url('images/inactive-user.png').'"data-request="ajax-confirm" title="Update Status">'.$spanhtml.'</a>';  
                }elseif($item['status']=='inactive'){
                  $html   = '<a href="javascript:void(0);" 
                  data-url="'.url(sprintf('admin/subadmin/status/?id=%s&status=active',$item['id'])).'"
                  data-ask="'.sprintf(ACTIVE_MSG,$item['first_name']).'" data-ask_image="'.url('images/active-user.png').'"data-request="ajax-confirm" title="Update Status">'.$spanhtml.'</a>';  

                }elseif($item['status']=='pending'){
                  $html   = '<a href="javascript:void(0);>'.$spanhtml. '</a>';
                 

                }
            return $html;
                })
                ->editColumn('image', function($item){
                    $html = '<a class="imagelight" href="'.___defaultimage($item['image'],'assets/images/users/').'" target="_blank"><img style="border-radius:50%;" src="'.___defaultimage($item['image'],'assets/images/users/').'" alt="'.$item['first_name'].'" width="80" height="80"></a>';
                    return $html;
                })
                 ->editColumn('name', function($item){

                    return _case($item['first_name']).' '._case($item['last_name']);
                }) 
                ->rawColumns(['action','image','status'])
                ->make(true);
        }
        $data['html'] = $builder
            ->parameters([
                "dom" => "<'row' <'col-md-6 col-sm-12 col-xs-4'l><'col-md-6 col-sm-12 col-xs-4'f>><'row filter'><'row white_box_wrapper database_table table-responsive'rt><'row' <'col-md-6'i><'col-md-6'p>>",
            ])
            ->addColumn(['data' => 'image', 'name' => 'image','title' => 'Image','orderable' => true, 'width' => 120])
            ->addColumn(['data' => 'name', 'name' => 'name','title' => 'Name','orderable' => true, 'width' => 120])
            ->addColumn(['data'=>'status','name'=>'status','title'=>'Status','orderable'=> true,'width'=> 120])
            ->addColumn(['data'=>'created_at','name'=>'created_at','title'=>'Created At','orderable'=> true,'width'=> 120])
            ->addColumn(['data'=>'updated_at','name'=>'updated_at','title'=>'Updated At','orderable'=> true,'width'=> 120])
            ->addAction(['title'=>'Action','orderable'=>false,'width'=>120]);
        return view('admin.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['view']    = 'admin.subadmin.add';
        $data['country'] =  Country::get();
        return view('admin.index',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $validation = new Validations($request);
        $validator   = $validation->add();
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
            $data['password']              = bcrypt($request->password);
            $data['otp']                   = 123456;
            $data['user_type']             = 'subadmin';
            $isadded                       = User::create($data);
            if($isadded){
                $this->status   = true;
                $this->modal    = true;
                $this->alert    = true;
                $this->message  = "Sub Admin  has been added successfully.";
                $this->redirect = route('subadmin.index');
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
