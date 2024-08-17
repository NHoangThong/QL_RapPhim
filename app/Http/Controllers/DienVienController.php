<?php

namespace App\Http\Controllers;

use App\Models\Dienvien;
use Illuminate\Http\Request;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;


class DienVienController extends Controller
{
    //
    public function dienVien()
    {
        $dienVien = Dienvien::orderBy('id_dien_vien', 'DESC')->Paginate(5);
        return view('admin.dienvien.listDienVien', ['dienVien' => $dienVien]);
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
            // $file->move(public_path('images/dienvien'), $fileName);
            // Lưu đường dẫn của hình ảnh vào biến $imageUrl để lưu vào cơ sở dữ liệu
            //$imageUrl = 'uploads/directors/' . $fileName;

            $result = Cloudinary::upload($file->getRealPath(), [
                'folder' => 'PHP_Laravel/DienVien'
            ]);
            $fileName = $result->getSecurePath();
            

            $dienVien = new Dienvien(
                [
                    'ten_dien_vien' => $request->name,
                    'hinh_dien_vien' => $fileName,
                    'ngaysinh' => $request->birthday,
                    'quoc_gia' => $request->national,
                    'content' => $request->contents
                ]
            );
        }else{
            return redirect('admin/dienvien')->with('error','Vui lòng nhập hình ảnh');
        }
        $dienVien->save();
        return redirect('admin/dienvien')->with('success','Thêm diễn viên thành công');
    }

    public function postEdit(Request $request, $id)
    {
        $request->validate([
            'name' => 'required'
        ], [
            'name.required' => 'Name is required',
        ]);
    
        $dienVien = Dienvien::find($id);
        if (!$dienVien) {
            return redirect('admin/dienvien')->with('error', 'Director not found');
        }
    
        $dienVien->ten_dien_vien = $request->name;
        $dienVien->ngaysinh = $request->birthday;
        $dienVien->quoc_gia = $request->national;
        $dienVien->content = $request->contents;
    
        if ($request->hasFile('Image')) {

            $currentImagePublicId = $this->getPublicIdFromUrl($dienVien->hinh_dien_vien);

            // Xóa hình ảnh hiện tại khỏi Cloudinary
            if ($currentImagePublicId) {
                Cloudinary::destroy($currentImagePublicId);
            }

            $file = $request->file('Image');
            // Tạo tên mới cho tệp hình ảnh để tránh trùng lặp
            // $fileName =  $file->getClientOriginalName();
            // // Di chuyển tệp hình ảnh vào thư mục cục bộ
            // $file->move(public_path('images/dienvien'), $fileName);
            $result = Cloudinary::upload($file->getRealPath(), [
                'folder' => 'PHP_Laravel/DienVien'
            ]);
            $fileName = $result->getSecurePath();
            $dienVien->hinh_dien_vien = $fileName;
        }
    
        $dienVien->save();
    
        return redirect('admin/dienvien')->with('success', 'Director updated successfully');
    }

    public function delete($id)
    {
        $dienVien = Dienvien::find($id);
        
        if (!$dienVien) {
            return redirect('admin/dienvien')->with('error', 'Director not found');
        }

        // Delete associated image file
        // if (file_exists(public_path('images/dienvien/'.$dienVien->hinh_dien_vien))) {
        //     unlink(public_path('images/dienvien/'.$dienVien->hinh_dien_vien));
        // }

        
         // Lấy public_id từ URL của hình ảnh
        $publicId = $this->getPublicIdFromUrl($dienVien->hinh_dien_vien);

        // Xóa tệp hình ảnh liên quan từ Cloudinary
        if ($publicId) {
            Cloudinary::destroy($publicId);
        }

    

        $dienVien->delete();

        return redirect('admin/dienvien')->with('success', 'Director deleted successfully');
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
