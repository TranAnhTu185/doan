<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Product;
use App\Category;
use App\Customer;
use App\BillDetail;
use App\Bill;
use App\Cart;
use App\SlideShow;
use App\News;
use App\Contact;
use App\BillStatus;
use App\PaymentStatus;
use Illuminate\Support\Facades\Auth;
use Session;
use Mail;
use App\Mail\SendMail;

class HomeController extends Controller
{


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $product_sale = Product::all()->where('status', '==', 1)->sortByDesc('sale')->take(8);
        $product_limited = Product::all()->where('status', '==', 1)->sortByDesc('quantity')->take(8);
        $product_featured = Product::all()->where('status', '==', 1)->sortByDesc('prince')->take(8);
        $product_new = Product::all()->where('status', '==', 1)->sortDesc()->take(8);
        $slideshow = Slideshow::all();
        $news = News::all()->where('image', '!=', Null)->where('status', '==', 1)->sortBy('sort_order')->sortDesc()->take(3);
        $banner1 = Category::all()->where('avatar', '!=', null)->sortBy('sort_order')->take(2);
        $banner2 = Category::all()->where('avatar', '!=', null)->sortByDesc('sort_order')->take(2);
        return view('index')->with(['banner1' => $banner1, 'banner2' => $banner2, 'product_sale' => $product_sale, 'product_limited' => $product_limited, 'product_featured' => $product_featured, 'product_new' => $product_new, 'slideShow' => $slideshow, 'news' => $news]);
    }

    public function getList($id, $name){
        $list = Product::where('category_id' , $id)->paginate(12);
        return view('list_product')->with('list', $list);
    }

    public function list($id, $name) {
        $list = Product::where('category_id' , $id)->paginate(12);
        return view('list_product')->with('list', $list);
    }

    public function getDetail($id, $name){
        $product = Product::find($id);
        $category = Category::where('parent_id', '!=', 0)->get();
        $product_other = Product::where('id', '!=', $id)->where('category_id', "=", $product->category_id)->take(8)->get();
        return view('detail_product')->with(['product'=> $product, 'category' => $category, 'product_other' => $product_other]);
    }

    public function quickView(Request $request)
    {
        $product = Product::find($request->id);
        $product->newPrice = $product->newPrice();
        $product->image = $product->product_image[0]->name;
        return response()->json($product);
    }

    public function checkout()
    {
        if (!Session::has('cart')){
            return redirect()->route('home.index');
        }
        $payment_status = PaymentStatus::all();
        return view('checkout')->with('payment_status', $payment_status);
    }

    public function storeBill(Request $request){
        $request->validate([
            'name' => 'required|min:2|max:100',
            'phone' => 'required|min:10|max:10',
            'address' => 'required|min:2|max:255',
            'password' => 'max:50',
        ]);

        if(Auth::guard('customer')->check()){
            $customer = Customer::find(Auth::guard('customer')->user()->id);
        } else {
            $customer = new Customer();
            $customer->name = $request->name;
            $customer->phone = $request->phone;
            $customer->address = $request->address;
            $customer->email = $request->email;
            if($request->password != ''){
                $customer->password = bcrypt($request->password);
            }
            $customer->save();
        }

        $bill = new Bill();
        $bill->customer_id = $customer->id;
        $bill->created = date('Y-m-d H:i:s');
        $bill->payment_id = $request->payment_id;
        $bill->note = $request->note;
        $bill->status = 0;
        $bill->name = $request->name;
        $bill->phone = $request->phone;
        $bill->address = $request->address;
        $bill->save();

        $cart = Session::get('cart');
        foreach ($cart as $id => $item){
            $billDetail = new BillDetail();
            $billDetail->bill_id = $bill->id;
            $billDetail->product_id = $id;
            $billDetail->quantity = $item->quantity;
            $billDetail->price = $item->price;
            $billDetail->save();
        }

//         if($customer->email != null){
//             Mail::to($customer->email)->send(new SendMail($bill->id));
//         }
        return redirect()->route('home.checkout.success');
    }

    public function confirmOder()
    {
        if (!Session::has('cart')){
            return redirect()->route('home.index');
        }
        Session::forget('cart');
        return view('confirm_order');
    }

    public function historyOder()
    {
    }

    //Login & Register
    public function loginpage(){
        return view('login');
    }

    public function login(Request $request){
        $email = $request->email;
        $password = $request->password;
        if(Auth::guard('customer')->attempt(['email' => $email, 'password' => $password])){
            return redirect()->route('home.index')->with('success', 'Đăng nhập thành công.');
        } else {
            return redirect()->back()->with('error', 'Email hoặc mật khẩu không khớp.');
        }
    }

    public function logout()
    {
        Auth::guard('customer')->logout();
        return redirect()->route('home.index')->with('success', 'Đăng xuất thành công.');
    }
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|min:2|max:100',
            'phone' => 'required|min:10|max:10',
            'address' => 'required|min:2|max:255',
            'email' => 'required|email|unique:customers',
            'password' => 'required|min:8|max:50',
            'password_confirmation' => 'required|min:8|max:50|same:password',
        ]);

        $customer = new Customer();
        $customer->name = $request->name;
        $customer->phone = $request->phone;
        $customer->address = $request->address;
        $customer->email = $request->email;
        $customer->password = bcrypt($request->password);
        $customer->save();
        return redirect()->route('home.login')->with('success', 'Tạo tài khoản thành công.');
    }

    //search
    public function search(Request $request)
    {
        $key = $request->key;
        $list = Product::where('name', 'like', "%$key%")
            ->orWhere('price', 'like', "%$key%")
            ->orWhere('description', 'like', "%$key%")->take(30)->paginate(5);
        return view('search')->with(['key' => $key, 'list' => $list]);
    }

    public function contact()
    {
        $contact = Contact::first();
        return view('contact')->with('contact', $contact);
    }
}
