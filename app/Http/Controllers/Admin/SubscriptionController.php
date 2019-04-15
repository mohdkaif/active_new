<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Models\Subscription;
use Yajra\DataTables\DataTables;
use Yajra\DataTables\Html\Builder;
use Validations\SubscriptionValidation as Validations;
class SubscriptionController extends Controller
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
        $data['site_title'] = $data['page_title'] = 'Subscription List';
        $data['menu']       = 'category-list';
        $data['breadcrumb'] = '<ul class="page-breadcrumb breadcrumb"><li><a href="'.url('/').'"><i class="fa fa-home" style="font-size:12px;"></i> Home</a><i class="fa fa-circle"></i></li><li> &nbsp;<a href="">Category</a></li></ul>';
        $data['view']       = 'admin.subscription.list';
        $subscription       = _arefy(Subscription::list('array'));
        if ($request->ajax()) {
            return DataTables::of($subscription)
                ->editColumn('action',function($item){
                $html    = '<div class="edit_details_box">';
                $html   .= '<a href="'.url(sprintf('admin/subscription/%s/edit',___encrypt($item['id']))).'" title="Edit Category"><i class="fa  fa-edit"></i></a>|';
                 $html   .= '<a href="javascript:void(0);" 
                data-url="'.url(sprintf('admin/subscription/status/?id=%s&status=trashed',$item['id'])).'"
                data-ask="'.sprintf('Are You Sure to delete %s ?',$item['name']).'" data-ask_image="'.url('assets/images/delete-user.png').'"data-request="ajax-confirm" title="Delete Sub Admin"><i class="fa fa-trash fa-lg" aria-hidden="true" style="color:red;"></i></a> | ';
                  $html   .= '</div> ';
                return $html;
                })
                ->editColumn('status',function($item){
                $spanhtml   = _showSpan($item['status']);
                 if($item['status']=='active'){
                  $html   = '<a href="javascript:void(0);" 
                  data-url="'.url(sprintf('admin/subscription/status/?id=%s&status=inactive',$item['id'])).'"
                  data-ask="'.sprintf(INACTIVE_MSG,$item['name'] ).'" data-ask_image="'.url('images/inactive-user.png').'"data-request="ajax-confirm" title="Update Status">'.$spanhtml.'</a>';  
                }elseif($item['status']=='inactive'){
                  $html   = '<a href="javascript:void(0);" 
                  data-url="'.url(sprintf('admin/subscription/status/?id=%s&status=active',$item['id'])).'"
                  data-ask="'.sprintf(ACTIVE_MSG,$item['name']).'" data-ask_image="'.url('images/active-user.png').'"data-request="ajax-confirm" title="Update Status">'.$spanhtml.'</a>';  
                }
            return $html;
                })

                 ->editColumn('name', function($item){
                    return _case($item['name']);
                }) 
                ->rawColumns(['action','status'])
                ->make(true);
        }
        $data['html'] = $builder
            ->parameters([
                "dom" => "<'row' <'col-md-6 col-sm-12 col-xs-4'l><'col-md-6 col-sm-12 col-xs-4'f>><'row filter'><'row white_box_wrapper database_table table-responsive'rt><'row' <'col-md-6'i><'col-md-6'p>>",
            ])
            ->addColumn(['data' => 'name', 'name' => 'name','title' => 'Name','orderable' => true, 'width' => 120])
            ->addColumn(['data' => 'description', 'name' => 'description','title' => 'Description','orderable' => true, 'width' => 120])
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
        $data['view']    = 'admin.subscription.add';
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

            $data['name']            = $request->name;
            $data['description']     = $request->description;
            $data['months']          = $request->months;
            $data['price']           = $request->price;
            $data['status']          = 'active';
             $isadded                = Subscription::create($data);
            if($isadded){
                $this->status   = true;
                $this->modal    = true;
                $this->alert    = true;
                $this->message  = "Subscription has been added successfully.";
                $this->redirect = url('admin/subscription');
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
        $data['details']              = _arefy(Subscription::list('single',"id=$id",'*'));
        /*dd($data['details']);*/
        $data['view']                 ='admin.subscription.edit';
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
            $data['name']            = $request->name;
            $data['description']     = $request->description;
            $data['months']          = $request->months;
            $data['price']           = $request->price;
            $data['updated_at']      = date('Y-m-d H:i:s');
            $isUpdated               = Subscription::where('id',$id)->update($data);
            if($isUpdated){
                $this->status   = true;
                $this->modal    = true;
                $this->alert    = true;
                $this->message  = "Subscription Updated successfully.";
                $this->redirect = url('admin/subscription');
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
        $isUpdated              = Subscription::updateStatus($request->id,$data);
        if($isUpdated){
            $this->status       = true;
            $this->redirect     = true;
            $this->jsondata     = [];
        }
        return $this->populateresponse();
    }


}
