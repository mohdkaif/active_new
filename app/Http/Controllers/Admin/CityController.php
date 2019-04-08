<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\PermissionUsers;
use App\Models\State;
use App\Models\City;
use Illuminate\Http\Request;
use Validations\Validate as Validations;
use Yajra\Datatables\Datatables;

class CityController extends Controller
{
    private $state_menu_id = 7;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['countries'] = _arrayfy(Country::where('status', '!=', 'deleted')
                ->orderBy('created_at', 'DESC')
                ->get());
         $data['states'] = _arrayfy(State::where('status', '!=', 'deleted')
                ->orderBy('created_at', 'DESC')
                ->get());
        $data['view'] = 'admin.cities.list';
        return view('admin.index',$data);
        // return view('admin.states.state-list', compact('countries', $countries));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['countries'] = Country::where('status', '=', 'active')->get();
      /*   $data['states'] = State::where('status', '=', 'active')->get();*/
        $data['view'] = 'admin.cities.add';
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
        $validator = $validation->addCity();
        if ($validator->fails()){
            $this->message = $validator->errors();
        }else{
                $data['state_id'] = $request->state_id;
                $data['city_name'] = $request->city_name;
               
                $data['status'] ='active';
              
                $city = City::create($data);

             
            $this->status   = true;
            $this->alert    = true;
            $this->message = "City Successfully added";
            $this->modal = true;
            $this->redirect = url('admin/city');
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
        $countries = Country::where('status', '=', 'active')->get();
        $state = json_decode(json_encode(State::where(['id' => $id])->get()->first()));
        if (empty($state)) {
            return redirect()->route('states.index');
        } else {
            return view('Admin.states.edit-state', array('state' => $state, 'countries' => $countries));
        }
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
        $validator = Validator::make($request->all(), [
            'country_id' => 'required',
            'state_name' => 'required|max:250',
        ], [
            'country_id' => 'Please select country.',
            'state_name.required' => 'The State Name field is required.',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        } else {
            $input['country_id'] = $request->country_id;
            $input['state_name'] = $request->state_name;
            State::where('id', '=', $id)->update($input);
            return redirect()->route('states.index')->with('delete', 'State Updated Successfully.');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        State::where('id', '=', $id)->update(['status' => 'deleted']);
        return redirect()->route('states.index')->with('delete', 'State Deleted Successfully.');
    }

    public function changeStatus($id)
    {
        $state = State::where('id', $id)->get()->first();
        if ($state->status == 'active') {
            State::where('id', '=', $id)->update(['status' => 'inactive']);
            return redirect()->route('states.index')->with('delete', 'State Inactivated Successfully.');
        } else {
            State::where('id', '=', $id)->update(['status' => 'active']);
            return redirect()->route('states.index')->with('delete', 'State Activated Successfully.');
        }
    }

    public function datatableView(Request $request)
    {
        $cities = _arrayfy(City::list('array','state_id = '.$request->s_id));
        $res = Datatables::of($cities)

          /*  ->editColumn('country_name', function ($item) {
                return $item['country']['country_name'];
            })*/
            ->editColumn('state_name', function ($item) {
                return $item['state']['state_name'];
            })
            ->editColumn('status', function ($item) {
                return ucfirst($item['status']);
            });

        //if (!empty($pre) && $pre->is_modify == 'yes') {

            $res->editColumn('action', function ($item) {
                $action = "<td class='action'><div class='btn-group'><button type='button' class='btn btn-default'>Action</button><button type='button' class='btn btn-default dropdown-toggle' data-toggle='dropdown' aria-expanded='false'><span class='caret'></span><span class='sr-only'>Toggle Dropdown</span></button><ul class='dropdown-menu' role='menu'>";

                if ($item['status'] == 'active') {
                    $action .= "<li><a href='#'' onclick= \"myfunction('" . $item['id'] . "','" . $item['status'] . "')\" >Inactivate</a>
                       <form role='form' id='changeStatusForm_" . $item['id'] . "' method='POST' action ='" . route('states.changestatus', $item['id']) . "' style='display:none;'>
                        <input type='hidden' name='_method' value='PATCH'>" . csrf_field() . "</form></li>";
                } else {
                    $action .= "<li><a href='#'' onclick= \"myfunction('" . $item['id'] . "','" . $item['status'] . "')\" >Activate</a>
                       <form role='form' id='changeStatusForm_" . $item['id'] . "' method='POST' action ='" . route('states.changestatus', $item['id']) . "' style='display:none;'>
                        <input type='hidden' name='_method' value='PATCH'>" . csrf_field() . "</form></li>";
                }

                /*$action.= "<li><a href='#' onclick=\"myfunction('".$item['id']."')\">Delete</a><form role='form' id='deleteform_".$item['id']."' method='POST' action='".route('states.destroy',$item['id'])."' style='display:none;'><input type='hidden' name='_method' value='delete'>".csrf_field()."</form></li></ul></div></td>";*/
                return $action;
            });
        //} else {
            $res->editColumn('action', function ($item) {
                $action = "";
            });
       // }

        $res->escapeColumns([]);

        $result = $res->make(true);
        return $result;
    }

    public function getStateAsDropDownOptions(Request $request)
    {
        $states = State::where('status', '=', 'active')->where('country_id', '=', $request->id)->get();
        $string = '<option value="">Select State</option>';
        foreach ($states as $key => $state) {
            $string .= "<option value=" . $state->id . ">" . $state->state_name . "</option>";
        }
        return $string;
    }
}
