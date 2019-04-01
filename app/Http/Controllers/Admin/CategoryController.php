<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Models\ServiceCategory;
use Yajra\DataTables\DataTables;
use Yajra\DataTables\Html\Builder;
use Validations\CategoryValidation as Validations;
class CategoryController extends Controller
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
        $data['site_title'] = $data['page_title'] = 'Category List';
        $data['menu']       = 'category-list';
        $data['breadcrumb'] = '<ul class="page-breadcrumb breadcrumb"><li><a href="'.url('/').'"><i class="fa fa-home" style="font-size:12px;"></i> Home</a><i class="fa fa-circle"></i></li><li> &nbsp;<a href="">Category</a></li></ul>';
        $data['view']       = 'admin.category.list';
        $category           = _arefy(ServiceCategory::all());
        if ($request->ajax()) {
            return DataTables::of($category)
                ->editColumn('action',function($item){
                    $html    = '<div class="edit_details_box">';
                    $html   .= '<a href="'.url(sprintf('admin/category/%s/edit',___encrypt($item['service_category_id']))).'" title="Edit Category"><i class="fa  fa-edit"></i></a>|';
                     $html   .= '<a href="javascript:void(0);" 
                  data-url="'.url(sprintf('admin/category/deleterecord/?id=%s&status=trashed',$item['service_category_id'])).'"
                  data-ask="'.sprintf('Are You Sure to delete %s category?',$item['service_category_name']).'" data-ask_image="'.url('images/delete-user.png').'"data-request="ajax-confirm" title="Delete Category"><i class="fa fa-trash fa-lg" aria-hidden="true" style="color:red;"></i></a> | ';
                    $html   .= '</div>';
                    return $html;
                })

                ->editColumn('status',function($item){
                $spanhtml   = _showSpan($item['status']);
                 if($item['status']=='active'){
                  $html   = '<a href="javascript:void(0);" 
                  data-url="'.url(sprintf('admin/category/status/?id=%s&status=inactive',$item['service_category_id'])).'"
                  data-ask="'.sprintf(INACTIVE_MSG,$item['service_category_name'] ).'" data-ask_image="'.url('images/inactive-user.png').'"data-request="ajax-confirm" title="Update Status">'.$spanhtml.'</a>';  
                }elseif($item['status']=='inactive'){
                  $html   = '<a href="javascript:void(0);" 
                  data-url="'.url(sprintf('admin/category/status/?id=%s&status=active',$item['service_category_id'])).'"
                  data-ask="'.sprintf(ACTIVE_MSG,$item['service_category_name']).'" data-ask_image="'.url('images/active-user.png').'"data-request="ajax-confirm" title="Update Status">'.$spanhtml.'</a>';  

                }
            return $html;
                })
                ->rawColumns(['action','image','status'])
                ->make(true);
        }
        $data['html'] = $builder
            ->parameters([
                "dom" => "<'row' <'col-md-6 col-sm-12 col-xs-4'l><'col-md-6 col-sm-12 col-xs-4'f>><'row filter'><'row white_box_wrapper database_table table-responsive'rt><'row' <'col-md-6'i><'col-md-6'p>>",
            ])
            ->addColumn(['data' => 'service_category_name', 'name' => 'service_category_name','title' => 'Category Name','orderable' => true, 'width' => 120])
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
        $data['view']='admin.category.add';
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
        $validator   = $validation->createCategory();
        if($validator->fails()){
            $this->message = $validator->errors();
        }else{
            $data['service_category_name'] = $request->service_category_name;
            $isadded                       = ServiceCategory::add($data);
            if($isadded){
                $this->status   = true;
                $this->modal    = true;
                $this->alert    = true;
                $this->message  = "Category  has been added successfully.";
                $this->redirect = url('admin/category');
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
        $service_category_id          = ___decrypt($id);
        $data['details']              = _arefy(ServiceCategory::listing('single','*',"service_category_id=$service_category_id"));
        $data['view']                 ='admin.category.edit';
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
        $validator   = $validation->updateCategory();
        if($validator->fails()){
            $this->message = $validator->errors();
        }else{
            $data['service_category_name'] = $request->service_category_name;
            $isadded                       = ServiceCategory::change($id,$data);
            if($isadded){
                $this->status   = true;
                $this->modal    = true;
                $this->alert    = true;
                $this->message  = "Category updated successfully.";
                $this->redirect = url('admin/category');
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
        $isUpdated              = ServiceCategory::updateStatus($request->id,$data);
        if($isUpdated){
            $this->status       = true;
            $this->redirect     = true;
            $this->jsondata     = [];
        }
        return $this->populateresponse();
    }

    public function deleterecord(Request $request){
        $isDeleted = ServiceCategory::find($request->id)->delete();
        if($isDeleted){
            $this->status       = true;
            $this->redirect     = true;
            $this->jsondata     = [];
        }
        return $this->populateresponse();
    
    }

}
