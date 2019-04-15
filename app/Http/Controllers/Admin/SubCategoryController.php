<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Models\ServiceCategory;
use App\Models\ServiceSubCategory;
use Yajra\DataTables\DataTables;
use Yajra\DataTables\Html\Builder;
use Validations\SubCategoryValidation as Validations;
class SubCategoryController extends Controller
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
        $data['site_title'] = $data['page_title'] = 'Sub Category';
        $data['breadcrumb'] = '<ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="'.url('admin/dashboard').'">Home</a></li>
              <li class="breadcrumb-item active">Sub Category</li></ol>';
        $data['view']       = 'admin.subcategory.list';
        $subcategory        = _arefy(ServiceSubCategory::listing('array','*'));
        /*_dd($category);*/
        if ($request->ajax()) {
            return DataTables::of($subcategory)
                ->editColumn('action',function($item){
                    $html    = '<div class="edit_details_box">';
                    $html   .= '<a href="'.url(sprintf('admin/subcategory/%s/edit',___encrypt($item['service_sub_category_id']))).'" title="Edit Category"><i class="fa  fa-edit"></i></a>|';
                     $html   .= '<a href="javascript:void(0);" 
                  data-url="'.url(sprintf('admin/subcategory/deleterecord/?id=%s&status=trashed',$item['service_sub_category_id'])).'"
                  data-ask="'.sprintf('Are You Sure to delete %s subcategory?',$item['service_sub_category_name']).'" data-ask_image="'.url('assets/images/delete-user.png').'"data-request="ajax-confirm" title="Delete Category"><i class="fa fa-trash fa-lg" aria-hidden="true" style="color:red;"></i></a> | ';
                    $html   .= '</div>';
                    return $html;
                })

                ->editColumn('status',function($item){
                $spanhtml   = _showSpan($item['status']);
                 if($item['status']=='active'){
                  $html   = '<a href="javascript:void(0);" 
                  data-url="'.url(sprintf('admin/subcategory/status/?id=%s&status=inactive',$item['service_sub_category_id'])).'"
                  data-ask="'.sprintf(INACTIVE_MSG,$item['service_sub_category_name'] ).'" data-ask_image="'.url('images/inactive-user.png').'"data-request="ajax-confirm" title="Update Status">'.$spanhtml.'</a>';  
                }elseif($item['status']=='inactive'){
                  $html   = '<a href="javascript:void(0);" 
                  data-url="'.url(sprintf('admin/subcategory/status/?id=%s&status=active',$item['service_sub_category_id'])).'"
                  data-ask="'.sprintf(ACTIVE_MSG,$item['service_sub_category_name']).'" data-ask_image="'.url('images/active-user.png').'"data-request="ajax-confirm" title="Update Status">'.$spanhtml.'</a>';  

                }
            return $html;
                })
                ->editColumn('subcategory',function($item){
                  return _case($item['service_sub_category_name'],'u');

                })
                ->editColumn('category',function($item){
                  return _case($item['category']['service_category_name'],'u');

                })
                ->rawColumns(['action','image','status'])
                ->make(true);
        }
        $data['html'] = $builder
            ->parameters([
                "dom" => "<'row' <'col-md-6 col-sm-12 col-xs-4'l><'col-md-6 col-sm-12 col-xs-4'f>><'row filter'><'row white_box_wrapper database_table table-responsive'rt><'row' <'col-md-6'i><'col-md-6'p>>",
            ])
            ->addColumn(['data' => 'subcategory', 'name' => 'subcategory','title' => 'Sub Category Name','orderable' => true, 'width' => 120])
            ->addColumn(['data'=>'category','name'=>'category','title'=>'Category','orderable'=> true,'width'=> 120])
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
        $data['view']     ='admin.subcategory.add';
        $data['category'] = ServiceCategory::listing('array','*',"status='active'");
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
        $validator   = $validation->createSubCategory();
        if($validator->fails()){
            $this->message = $validator->errors();
        }else{
            $data['service_category_id']       = $request->service_category_name;
            $data['service_sub_category_name'] = $request->service_sub_category_name;
            $isadded                           = ServiceSubCategory::add($data);
            if($isadded){
                $this->status   = true;
                $this->modal    = true;
                $this->alert    = true;
                $this->message  = "Sub Category added successfully.";
                $this->redirect = url('admin/subcategory');
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
        $service_sub_category_id      = ___decrypt($id);
        $data['details']              = _arefy(ServiceSubCategory::listing('single','*',"service_sub_category_id=$service_sub_category_id"));
        $data['category']             = ServiceCategory::all();
        $data['view']                 ='admin.subcategory.edit';
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
        $validator   = $validation->updateSubCategory();
        if($validator->fails()){
            $this->message = $validator->errors();
        }else{
            $data['service_category_id']       = $request->service_category_name;
            $data['service_sub_category_name'] = $request->service_sub_category_name;
            $data['updated_at']                = date('Y-m-d H:i:s');
            $isadded                           = ServiceSubCategory::change($id,$data);
            if($isadded){
                $this->status   = true;
                $this->modal    = true;
                $this->alert    = true;
                $this->message  = "Sub Category updated successfully.";
                $this->redirect = url('admin/subcategory');
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
        $isUpdated              = ServiceSubCategory::updateStatus($request->id,$data);
        if($isUpdated){
            $this->status       = true;
            $this->redirect     = true;
            $this->jsondata     = [];
        }
        return $this->populateresponse();
    }

    public function deleterecord(Request $request){
        $isDeleted = ServiceSubCategory::find($request->id)->delete();
        if($isDeleted){
            $this->status       = true;
            $this->redirect     = true;
            $this->jsondata     = [];
        }
        return $this->populateresponse();
    
    }

}
