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

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sort_search = null;
        $customers = Customer::orderBy('created_at', 'desc');
        if ($request->has('search')){
            $sort_search = $request->search;
            $user_ids = User::where('user_type', 'customer')->where(function($user) use ($sort_search){
                $user->where('name', 'like', '%'.$sort_search.'%')->orWhere('email', 'like', '%'.$sort_search.'%');
            })->pluck('id')->toArray();
            $customers = $customers->where(function($customer) use ($user_ids){
                $customer->whereIn('user_id', $user_ids);
            });
            if($customers == null){
                $customers = $customers->paginate(15);
                return view('backend.customer.customers.index', compact('customers', 'sort_search'));
            }
        }
        $customers = $customers->paginate(15);
        return view('backend.customer.customers.index', compact('customers', 'sort_search'));
    }
    public function create()
    {
        return view('backend.customer.customers.create');
    }

    public function store(Request $request)
    {
        $mytime = Carbon::now();
        $today =  Carbon::parse($mytime->toDateTimeString())->format('Y-m-d H:i');
        if(User::where('email', $request->email)->first() != null){
            flash(translate('Email already exists!'))->error();
            return back();
        }
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->verification_code = rand(100000, 999999);
        $user->user_type = "customer";
        $user->email_verified_at = $today;
        $user->password = Hash::make($request->password);
        if($user->save()){
            $customer = new Customer;
            $customer->user_id = $user->id;
            $customer->save();
            // $otpController = new OTPVerificationController;
            // $otpController->send_code($user);
            flash(translate('customer has been inserted successfully'))->success();
            return redirect()->route('customers.index');
        }
        flash(translate('Something went wrong'))->error();
        return back();
    }
    public function edit($id)
    {

        
        $user_data = User::where('id', $id )->first();
        return view('backend.customer.customers.edit',compact('user_data'));
    }
  

   public function update(Request $request, $id){


        $data = $this->validate(\request(),
            [
                'name' => 'required|unique:users,name,' . $id,
                'email' => 'required|unique:users,email,' . $id,
                'password' => 'sometimes|nullable|min:6',
            ]
        );
        if($request['password'] != null){
            $pass= Hash::make(request('password'));
            $data['password'] = $pass;
        }else{
            unset($data['password']);
        }
        User::where('id', $id)->update($data);
        flash(translate('customer has been updated successfully'))->success();
        return redirect()->route('customers.index');
    }
    public function destroy($id)
    {
        Order::where('user_id', Customer::findOrFail($id)->user->id)->delete();
        User::destroy(Customer::findOrFail($id)->user->id);
        if(Customer::destroy($id)){
            flash(translate('Customer has been deleted successfully'))->success();
            return redirect()->route('customers.index');
        }

        flash(translate('Something went wrong'))->error();
        return back();
    }

    public function login($id)
    {
        $customer = Customer::findOrFail(decrypt($id));

        $user  = $customer->user;

        auth()->login($user, true);

        return redirect()->route('dashboard');
    }

    public function ban($id) {
        $customer = Customer::findOrFail($id);

        if($customer->user->banned == 1) {
            $customer->user->banned = 0;
            flash(translate('Customer UnBanned Successfully'))->success();
        } else {
            $customer->user->banned = 1;
            flash(translate('Customer Banned Successfully'))->success();
        }

        $customer->user->save();

        return back();
    }
}
