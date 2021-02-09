<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Controllers\OTPVerificationController;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Customer;
use App\User;
use App\Order;
use App\Models\sellerstype;
 
class sellerstypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sort_search =null;
        $sellerstypes = sellerstype::orderBy('created_at', 'desc');
        if ($request->has('search'))
        {
            $sort_search = $request->search;
            $sellerstypes = $sellerstypes->where('name', 'like', '%'.$sort_search.'%');
        }
        $sellerstypes = $sellerstypes->paginate(15);
        return view('backend.sellerstypes.index', compact('sellerstypes', 'sort_search'));
    }


    public function create()
    {
        return view('backend.sellerstypes.create');
    }

    public function store(Request $request)
    {
         
        $user = new sellerstype;
        $user->name = $request->name;
         
        if($user->save())
        {
            
            flash(translate('sellerstype has been inserted successfully'))->success();
            return redirect()->route('sellerstype.index');
        }
        flash(translate('Something went wrong'))->error();
        return back();
    }
    public function edit($id)
    {

        
         $sellerstype = sellerstype::where('id', $id )->first();
        return view('backend.sellerstypes.edit',compact('sellerstype'));
    }
  

   public function update(Request $request, $id){

   
        $data = $this->validate(\request(),
            [
                'name' => 'required',
                
            ]
        );
        
        sellerstype::where('id', $id)->update($data);
        flash(translate('sellerstype has been updated successfully'))->success();
        return redirect()->route('sellerstype.index');
    }
    public function destroy($id)
    {
         
        sellerstype::destroy($id);

        flash(translate('sellerstype has been deleted successfully'))->success();
        return redirect()->route('sellerstype.index');

    }

   

   
}
