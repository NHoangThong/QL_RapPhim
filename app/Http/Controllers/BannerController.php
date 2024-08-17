<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    //

    public function banners()
    {
        $banners = Banner::orderBy('id_banner', 'DESC')->Paginate(10);
        return view('admin.banner.list', ['banners' => $banners]);
    }

    public function postCreate(Request $request)
    {
        if ($request->hasFile('Image')) {
            $file = $request->file('Image');
            $img = $request['image'] = $file;
            $cloud = Cloudinary::upload($img->getRealPath(), [
                'folder' =>'PHP_Laravel/Banner',
               

            ]);
            $fileName = $cloud->getSecurePath();
            $banner = new Banner(
                [
                    'hinh' => $fileName,
                ]
            );
        }else{
            return redirect('admin/banner')->with('error','Vui lòng nhập hình ảnh');
        }
        $banner->save();
        return redirect('admin/banner');
    }

    public function postEdit(Request $request, $id)
    {
        $banners = Banner::find($id);

        if ($request->hasFile('Image')) {
            $file = $request->file('Image');
            $img = $request['image'] = $file;
            if ($banners['hinh'] != '') {
                $publicId = $this->getPublicIdFromUrl($banners['hinh']);
                Cloudinary::destroy($publicId);
            }
            $result = Cloudinary::upload($img->getRealPath(), [
                'folder' =>'PHP_Laravel/Banner',
                
            ]);
            $fileName = $result->getSecurePath();
            $banners->hinh = $fileName;
        }
        $banners->update($request->all());
        return redirect('admin/banner')->with('success', 'Updated Successfully!');
    }


    public function delete($id)
    {
        $banners = Banner::find($id);
        $publicId = $this->getPublicIdFromUrl($banners['hinh']);
        Cloudinary::destroy($publicId);
        $banners->delete();
        return redirect('admin/banner')->with('success' ,'Delete Successfully');
    }
    public function status(Request $request){
        $banners = Banner::find($request->banner_id);
        $banners['trang_thai'] = $request->active;
        $banners->save();
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
