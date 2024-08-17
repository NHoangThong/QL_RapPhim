<?php

namespace App\Http\Controllers;

use App\Models\Tintuc;
use Illuminate\Http\Request;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class TinTucController extends Controller
{
    //
    public function news()
    {
        $news = Tintuc::orderBy('id_tin_tuc', 'DESC')->Paginate(5);
        return view('admin.tintuc.list', ['news' => $news]);
    }
    public function postCreate(Request $request)
    {
        $request->validate([
            'title' => 'required'
        ], [
            'title.required' => 'Please enter Title',
        ]);
        if ($request->hasFile('Image')) {
            $file = $request->file('Image');


            $result = Cloudinary::upload($file->getRealPath(), [
                'folder' => 'PHP_Laravel/TinTuc'
            ]);
            $fileName = $result->getSecurePath();
            //$request['user_id'] = Auth::user()['id'];
            $news = new Tintuc(
                [
                    'tieu_de' => $request->title,
                    'hinh_tin_tuc' => $fileName,
                    'content' => $request->contents,
                    'trang_thai' => 1,
                    //'user_id' => $request['user_id']
                ]
            );
        }else{
            return redirect('admin/tintuc')->with('error','Vui lòng nhập hình ảnh');
        }
        $news->save();
        return redirect('admin/tintuc')->with('success', 'Added Successfully!');
    }

    public function postEdit(Request $request, $id)
    {
        $news = Tintuc::find($id);

        $request->validate([
            'title' => 'required'
        ], [
            'title.required' => "Please enter Title"
        ]);
        //$request['user_id'] = Auth::user()['id'];
        $news->content = $request->contents;
        $news->tieu_de=$request->title;
        if ($request->hasFile('Image')) {
            $file = $request->file('Image');
            $currentImagePublicId = $this->getPublicIdFromUrl($news->hinh_tin_tuc);

            // Xóa hình ảnh hiện tại khỏi Cloudinary
            if ($currentImagePublicId) {
                Cloudinary::destroy($currentImagePublicId);
            }
            $file = $request->file('Image');
           
            $result = Cloudinary::upload($file->getRealPath(), [
                'folder' => 'PHP_Laravel/TinTuc'
            ]);
            $fileName = $result->getSecurePath();
            $news->hinh_tin_tuc = $fileName;
        }
        $news->update($request->all());
        return redirect('admin/tintuc')->with('success', 'Updated Successfully!');
    }


    public function delete($id)
    {
        $news = Tintuc::find($id);
        $publicId = $this->getPublicIdFromUrl($news->hinh_tin_tuc);
        Cloudinary::destroy($publicId);
        $news->delete();
        return redirect('admin/tintuc')->with('success', 'Delete Successfully!');
    }
    public function status(Request $request){
        $news = Tintuc::find($request->news_id);
        $news['trang_thai'] = $request->active;
        $news->save();
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
