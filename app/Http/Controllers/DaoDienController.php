<?php

namespace App\Http\Controllers;

use App\Models\Daodien;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class DaoDienController extends Controller
{
    //
    public function DaoDien(){
        $daoDien= Daodien::orderBy('id_dao_dien','desc')->Paginate(5);
        return view('admin.daodien.listDaoDien',['daoDien'=> $daoDien]);
    }
    public function postCreate(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ], [
            'name.required' => 'Name is required',
        ]);
        if ($request->hasFile('Image')) {
            $file = $request->file('Image');

            // Tạo tên mới cho tệp hình ảnh để tránh trùng lặp
            // $fileName =  $file->getClientOriginalName();
            // // Di chuyển tệp hình ảnh vào thư mục cục bộ
            // $file->move(public_path('images/daodien'), $fileName);
            // Lưu đường dẫn của hình ảnh vào biến $imageUrl để lưu vào cơ sở dữ liệu
            //$imageUrl = 'uploads/directors/' . $fileName;

            $result = Cloudinary::upload($file->getRealPath(), [
                'folder' => 'PHP_Laravel/DaoDien'
            ]);
            $fileName = $result->getSecurePath();

            $director = new Daodien(
                [
                    'ten_dao_dien' => $request->name,
                    'hinh_dao_dien' => $fileName,
                    'ngaysinh' => $request->birthday,
                    'quoc_gia' => $request->national,
                    'content' => $request->contents
                ]
            );
        }else{
            return redirect('admin/daodien')->with('error','Vui lòng nhập hình ảnh');
        }
        $director->save();
        return redirect('admin/daodien')->with('success','Thêm đạo diễn thành công');
    }
    public function postEdit(Request $request, $id)
    {
        $request->validate([
            'name' => 'required'
        ], [
            'name.required' => 'Name is required',
        ]);
    
        $director = Daodien::find($id);
        if (!$director) {
            return redirect('admin/daodien')->with('error', 'Director not found');
        }
    
        $director->ten_dao_dien = $request->name;
        $director->ngaysinh = $request->birthday;
        $director->quoc_gia = $request->national;
        $director->content = $request->contents;
    
        if ($request->hasFile('Image')) {

            $currentImagePublicId = $this->getPublicIdFromUrl($director->hinh_dao_dien);

            // Xóa hình ảnh hiện tại khỏi Cloudinary
            if ($currentImagePublicId) {
                Cloudinary::destroy($currentImagePublicId);
            }
            $file = $request->file('Image');
            // // Tạo tên mới cho tệp hình ảnh để tránh trùng lặp
            // $fileName =  $file->getClientOriginalName();
            // // Di chuyển tệp hình ảnh vào thư mục cục bộ
            // $file->move(public_path('images/daodien'), $fileName);

            $result = Cloudinary::upload($file->getRealPath(), [
                'folder' => 'PHP_Laravel/DaoDien'
            ]);
            $fileName = $result->getSecurePath();
            $director->hinh_dao_dien = $fileName;
        }
    
        $director->save();
    
        return redirect('admin/daodien')->with('success', 'Director updated successfully');
    }

    public function delete($id)
    {
        $director = Daodien::find($id);
        
        if (!$director) {
            return redirect('admin/daodien')->with('error', 'Director not found');
        }

        // Delete associated image file
        // if (file_exists(public_path('images/daodien/'.$director->hinh_dao_dien))) {
        //     unlink(public_path('images/daodien/'.$director->hinh_dao_dien));
        // }

         // Lấy public_id từ URL của hình ảnh
         $publicId = $this->getPublicIdFromUrl($director->hinh_dao_dien);

         // Xóa tệp hình ảnh liên quan từ Cloudinary
         if ($publicId) {
             Cloudinary::destroy($publicId);
         }

        $director->delete();

        return redirect('admin/daodien')->with('success', 'Director deleted successfully');
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
