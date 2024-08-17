<?php

namespace App\Http\Controllers;

use App\Models\Combo;
use App\Models\Food;
use Illuminate\Http\Request;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class ComboController extends Controller
{
    //
    public function combo()
    {
        $foods = Food::all();
        $combos = Combo::orderBy('id_combo', 'DESC')->paginate(10);
        return view('admin.combo.list', [
            'combos' => $combos,
            'foods' => $foods
        ]);
    }

    public function postCreate(Request $request)
    {
//        dd($request->food[0]);
        $request->validate([
            'name' => 'required'
        ], [
            'name.required' => 'Name is required',
        ]);
        if ($request->hasFile('Image')) {
            $file = $request->file('Image');

            $result = Cloudinary::upload($file->getRealPath(), [
                'folder' => 'PHP_Laravel/combo'
            ]);
            $fileName = $result->getSecurePath();

            $combo = new Combo(
                [
                    'ten_combo' => $request->name,
                    'hinh' => $fileName,
                    'gia' => $request->price,
                  
                ]
            );
        }else{
            return redirect('admin/combo')->with('error','Vui lòng nhập hình ảnh');
        }
        $combo->save();

        for ($i = 0; $i < count($request->food); $i++) {
            $food = Food::find($request->food[$i]);
            $combo->foods()->attach($food, ['so_luong' => $request->quantity[$i]]);
        }

        return redirect('admin/combo')->with('success', 'Add Combo Successfully!');
    }

    public function postEdit(Request $request, $id)
    {
        $combo = Combo::find($id);
        $request->validate([
            'name' => 'required'
        ], [
            'name.required' => "Please enter Combo's name"
        ]);

        if ($request->hasFile('Image')) {
            $img = $request->file('Image');
            if ($combo->hinh != '') {
                $publicId = $this->getPublicIdFromUrl($combo->hinh);
                Cloudinary::destroy($publicId);
            }
            $result = Cloudinary::upload($img->getRealPath(), [
                'folder' => 'PHP_Laravel/combo'
            ]);
            $fileName = $result->getSecurePath();
            $combo->hinh = $fileName;
        }
        $combo->ten_combo = $request->name;
        $combo->gia = $request->price;

        $combo->foods()->detach();
        for ($i = 0; $i < count($request->food); $i++) {
            $food = Food::find($request->food[$i]);
            $combo->foods()->attach($food, ['so_luong' => $request->quantity[$i]]);
        }

        $combo->save();
        return redirect('admin/combo')->with('success', 'Updated Successfully!');
    }


    public function delete($id)
    {
        $combo = Combo::find($id);

        $publicId = $this->getPublicIdFromUrl($combo->hinh);
        Cloudinary::destroy($publicId);
        $combo->delete();
        return redirect('admin/combo')->with('success', 'Deleted successfully');
    }

    public function status(Request $request)
    {
        $combo = Combo::find($request->combo_id);
        $combo['status'] = $request->active;
        $combo->save();
        return redirect()->back();
    }

    private function getPublicIdFromUrl($url)
    {
        // Giả sử URL có dạng https://res.cloudinary.com/your_cloud_name/image/upload/v12345678/folder_name/public_id.jpg
        $parts = explode('/', $url); // Chia URL thành các phần
        $publicIdWithExtension = end($parts); // Lấy phần cuối cùng của URL (public_id với phần mở rộng)
        $publicId = pathinfo($publicIdWithExtension, PATHINFO_FILENAME); // Lấy public_id mà không có phần mở rộng

        // Ghép các phần của public_id (thư mục + public_id)
        $folderParts = array_slice($parts, 7, -1); // Bỏ phần đầu URL đến thư mục và phần cuối cùng
        array_push($folderParts, $publicId); // Thêm public_id vào cuối mảng thư mục

        return implode('/', $folderParts); // Trả về public_id đầy đủ
    }
}
