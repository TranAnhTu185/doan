<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Customer;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Customer Page
        $customers = Customer::All()->sortDesc();
        return view('admin.customer.index')->with('customers', $customers);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Create Customer Page
        return view('admin.customer.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Create Customer
        $request->validate([
            'name' => 'required|min:2|max:100',
            'phone' => 'required|min:10',
            'email' => 'required|min:10|email|unique:customers',
            'password' => 'min:5|max:50',
            'address' => 'required|max:200'
        ]);

        $customer = new Customer();
        $customer->name = $request->name;
        $customer->phone = $request->phone;
        $customer->email = $request->email;
        $customer->password = bcrypt($request->password);
        $customer->address = $request->address;
        $customer->save();
        return redirect()->route('admin.customer')->with('success', 'Create success!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //Show Customer
        $customer = Customer::find($id);
        return view('admin.customer.show')->with('customer', $customer);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //Edit Customer Page
        $customer = Customer::find($id);
        return view('admin.customer.edit')->with('customer', $customer);
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
        //Update Customer
        $request->validate([
            'name' => 'required|min:2|max:100',
            'phone' => 'required|min:10',
            'email' => 'required|min:10|email',
            'password' => 'max:50',
            'address' => 'required|max:200'
        ]);

        $customer = Customer::find($id);
        $customer->name = $request->name;
        $customer->phone = $request->phone;
        $customer->email = $request->email;
        if ($request->password != '') {
            $user->password = bcrypt($request->password);
        }
        $customer->address = $request->address;
        $customer->save();
        return redirect()->route('admin.customer')->with('success', 'Update success!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Delete Customer
        Customer::find($id)->delete();
        return redirect()->route('admin.customer')->with('success', 'Delete success!');
    }
}
