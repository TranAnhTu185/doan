<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\SlideShow;
use App\Contact;
use Storage;

class SettingController extends Controller
{
    //SlideShow Page
    public function slideshow()
    {
        $slide = Slideshow::all();
        return view('admin.setting.slideshow')->with('slide', $slide);
    }

    public function storeSlide(Request $request)
    {
        $request->validate([
            'name.*' => 'required|image'
        ]);

        $names = $request->name;
        if ($request->hasFile('name')) {
            foreach ($names as $name) {
                $slide = new Slideshow();
                $slideName = $name->getClientOriginalName();
                $newName = time() . '-' . $slideName;
                Storage::disk('storage')->putFileAs('carousel', $name, $newName);
                $slide->name = $newName;
                $slide->save();
            }
        }
        return redirect()->route('admin.slide')->with('success', 'Thêm mới slideshow thành công.');
    }

    public function destroySlide($id)
    {
        $slide = Slideshow::find($id);
        Storage::disk('storage')->delete("carousel/$slide->name");
        $slide->delete();
        return redirect()->route('admin.slide')->with('success', 'Xoá slideshow thành công');
    }

    public function contact()
    {
        $contact = Contact::all()->first();
        return view('admin.setting.contact')->with('contact', $contact);
    }

    public function storeContact(Request $request)
    {
        $contact = Contact::find($request->id);
        $contact->note = $request->note;
        $file = $request->file('logo');
        if ($request->hasFile('logo')) {
            Storage::disk('storage')->delete("logo/$contact->logo");
            $img_name = $file->getClientOriginalName();
            $logo = time() . '-' . $img_name;
            Storage::disk('storage')->putFileAs("logo", $file, $logo);
            $contact->logo = $logo;
        }
        $contact->save();
        return redirect()->back()->with('success', 'Lưu thông tin thành công.');
    }

    public function updateContact(Request $request, $id)
    {
        if ($request->pk = 'contacts') {
            $contact = Contact::find($id)->update([
                $request->name => $request->value
            ]);
        }
    }

    public function createContact(Request $request)
    {
        $request->validate([
            'name' => 'required|max:50',
            'phone' => 'required|max:10',
            'logo.*' => 'image'
        ]);

        $contact = new Contact();
        $contact->name = $request->name;
        $contact->phone = $request->phone;
        $contact->phone_other = $request->phone_other;
        $contact->work_time = $request->work_time;
        $contact->address = $request->address;
        $contact->email = $request->email;
        $contact->description = $request->description;
        $contact->facebook = $request->facebook;
        $contact->note = $request->note;
        $file = $request->file('logo');
        if ($request->hasFile('logo')) {
            $img_name = $file->getClientOriginalName();
            $logo = time() . '-' . $img_name;
            Storage::disk('storage')->putFileAs("logo", $file, $logo);
            $contact->logo = $logo;
        }
        $contact->save();
        return redirect()->back()->with('success', 'Lưu thông tin thành công.');
    }
}
