<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Bill;
use App\BillDetail;
use App\Product;
use App\Customer;
use App\PaymentStatus;
use DB;

class BillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Bill Page
        $bills = Bill::all()->sortBy('status');
        return view('admin.bill.index')->with(['bills'=> $bills]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Create Bill Page
        $customers = Customer::all()->sortDesc();
        $products = Product::all()->sortDesc();
        $payment_status = PaymentStatus::all();
        return view('admin.bill.create')->with(['payment_status'=> $payment_status, 'customers' => $customers, 'products' => $products]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Create Bill
        if ($request->id) {
            $customer = Customer::find($request->id);
            $customer->phone = $request->phone;
            $customer->address = $request->address;
        } else {
            $customer = new Customer();
            if($request->customer != null) {
                $customer->name = $request->customer;
            } else {
                $customer->name = $request->name;
                $customer->phone = $request->phone;
                $customer->address = $request->address;
            }
        }
        $customer->save();

        $bill = new Bill();
        $bill->customer_id = $customer->id;
        $bill->created = Date('Y-m-d H:i:s');
        $bill->payment_id = $request->payment_id;
        $bill->status = $request->status;
        $bill->note = $request->note;
        $bill->name = $request->name;
        $bill->phone = $request->phone;
        $bill->address = $request->address;
        $bill->save();

        foreach ($request->product_id as $key => $value) {
            $BillDetail = new BillDetail;
            $BillDetail->bill_id = $bill->id;
            $BillDetail->product_id = $value;
            $product = Product::find($value);
            if($bill->status == 4)
            {
                if ($product->quantity >= $request->quantity[$key]){
                    $BillDetail->quantity = $request->quantity[$key];
                    $product->quantity -= $request->quantity[$key];
                    $product->save();
                } else {
                    Bill::find($bill->id)->delete();
                    return redirect()->back()->with('error', 'Số lượng tồn kho không đủ.');
                }
            } else {
                $BillDetail->quantity = $request->quantity[$key];
            }
            $BillDetail->price = $request->price[$key];
            $BillDetail->save();
        }
        return redirect()->route('admin.bill.show', $bill->id)->with('success', 'Create success.');
    }


    /**
     * Display the specified resource.
     *®
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //Show Bill
        $bill = Bill::find($id);
        $total = 0;
        foreach ($bill->bill_billdetail as $item) {
            $total += $item->quantity * $item->price;
        }
        return view('admin.bill.show')->with(['bill'=> $bill, 'total' => $total]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //Edit Bill
        $product = Product::where('status', '!=', 0)->get();
        $payment_status = PaymentStatus::all();
        $bill = Bill::find($id);
        $total = 0;
        foreach ($bill->bill_billdetail as $item){
            $total += $item->quantity * $item->price;
        }
        return view('admin.bill.edit')->with(['bill'=> $bill, 'total' => $total, 'payment_status' => $payment_status, 'product' => $product]);
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
        //Update Bill
        $result = [];
        $bill = Bill::find($id);
        if ($request->pk['db'] == 'bills' || $request->pk['db'] == 'bill_detail')
        {
            // if ($request->name == 'quantity') {
            //     $product = BillDetail::find($request->pk['id'])->billdetail_product;
            //     if($request->value > $product->quantity){
            //         $result['error'] = 'Tồn kho không đủ sản phẩm.';
            //     }
            // }
            if($request->name == 'status') {
                if($request->value < $bill->status) {
                    $result['error'] = "Không thể trở về trạng thái cũ.";
                }
            }

            if ($request->name == 'status' && $request->value == '4')
            {
                foreach ($bill->bill_billdetail as $item){
                    if ($item->billdetail_product->quantity < $item->quantity){
                        $result['error'] = "Tồn kho không đủ sản phẩm.";
                        return response()->json($result);
                    }
                }

                foreach ($bill->bill_billdetail as $item){
                    if ($item->billdetail_product->quantity >= $item->quantity){
                        $item->billdetail_product->quantity -= $item->quantity;
                        $item->billdetail_product->save();
                    } else {
                        $result['error'] = "Tồn kho không đủ sản phẩm.";
                    }
                }
            }
            if(!isset($result['error'])) DB::table($request->pk['db'])->where('id', $request->pk['id'])->update([$request->name => $request->value]);

            $total = 0;
            foreach ($bill->bill_billdetail as $item)
            {
                $total += $item->quantity * $item->price;
            }
            $result['total'] = $total;

            return response()->json($result);
        }
    }

    public function delete(Request $request)
    {
        BillDetail::find($request->id)->delete();
    }

    public function searchProduct(Request $request)
    {
        $find = $request->find;
        $list = Product::where('id', 'like', "%$find%")
            ->orWhere('name', 'like', "%$find%")
            ->orWhere('description', 'like', "%$find%")
            ->where('status', '!=', 0)->get();
        return response()->json($list);
    }

    public function selectProduct(Request $request)
    {
        $product = Product::find($request->id);
        return response()->json($product);
    }

    public function addProduct(Request $request)
    {
        foreach ($request->product_id as $key =>$value) {
            $BillDetail = new BillDetail;
            $BillDetail->bill_id = $request->bill_id;
            $BillDetail->product_id = $value;
            $BillDetail->quantity = $request->quantity[$key];
            $BillDetail->price = $request->price[$key];
            $BillDetail->save();
        }
        return redirect()->back()->with('success', 'Thêm sản phẩm vào đơn hàng thành công.');
    }

    public function searchCustomer(Request $request)
    {
        $find = $request->find;
        $list = Customer::where('id', 'like', "%$find%")
            ->orWhere('name', 'like', "%$find%")
            ->orWhere('phone', 'like', "%$find%")
            ->orWhere('email', 'like', "%$find%")
            ->orWhere('address', 'like', "%$find%")->get();
        return response()->json($list);
    }

    public function selectCustomer(Request $request)
    {
        $customer = Customer::find($request->id);
        return response()->json($customer);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Delete Bill
        Bill::find($id)->Delete();
        return redirect()->back()->with('success', 'Xoá đơn hàng thành công.');
    }

    public function getPayment()
    {
        $payments = PaymentStatus::all()->sortDesc();
        return view('admin.bill.payment')->with('payments', $payments);
    }

    public function addPayment(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:payment_status'
        ]);

        $payment = new PaymentStatus();
        $payment->name = $request->name;
        $payment->note = $request->note;
        $payment->save();
        return redirect()->back()->with('success', 'Thêm trạng thái thành công.');
    }

    public function editPayment($id)
    {
        $payment = PaymentStatus::find($id);
        return response()->json($payment);
    }

    public function updatePayment(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $payment = PaymentStatus::find($request->id);
        $payment->name = $request->name;
        $payment->note = $request->note;
        $payment->save();
        return redirect()->back()->with('success', 'Cập nhật trạng thái thành công.');
    }

    public function deletePayment($id)
    {
        PaymentStatus::find($id)->delete();
    }
}
