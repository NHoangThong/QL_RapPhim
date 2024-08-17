<?php

namespace App\Http\Controllers;
use App\Models\Food;
use Illuminate\Http\Request;

class FoodController extends Controller
{
    //
    public function food(){
        $food= Food::orderBy('id_food','DESC')->Paginate(10);
        return view('admin.food.list',['food'=>$food]);
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
            $fileName =  $file->getClientOriginalName();
            // Di chuyển tệp hình ảnh vào thư mục cục bộ
            $file->move(public_path('images/food'), $fileName);
            // Lưu đường dẫn của hình ảnh vào biến $imageUrl để lưu vào cơ sở dữ liệu
            //$imageUrl = 'uploads/directors/' . $fileName;
            $food = new Food(
                [
                    'ten_food' => $request->name,
                    'hinh_food' => $fileName,
                    'gia_food'=>$request->price,
                ]
            );
        }else{
            return redirect('admin/food')->with('error','Vui lòng nhập hình ảnh');
        }
        $food->save();
        return redirect('admin/food')->with('success','Thêm thức ăn thành công');

    }

    public function postEdit(Request $request, $id)
    {
        

        $request->validate([
            'name' => 'required'
        ], [
            'name.required' => "Please enter Food's name"
        ]);

        $food = Food::find($id);
        if (!$food) {
            return redirect('admin/food')->with('error', 'Director not found');
        }
    
        $food->ten_food = $request->name;
        $food->gia_food = $request->price;
        
        
        if ($request->hasFile('Image')) {
            $file = $request->file('Image');
            // Tạo tên mới cho tệp hình ảnh để tránh trùng lặp
            $fileName =  $file->getClientOriginalName();
            // Di chuyển tệp hình ảnh vào thư mục cục bộ
            $file->move(public_path('images/food'), $fileName);
           
            $food->hinh_food = $fileName;
        }
        $food->save();
        return redirect('admin/food')->with('success', 'Updated Successfully!');
    }

    public function delete($id)
    {
        $food = Food::find($id);
        if (!$food) {
            return redirect('admin/food')->with('error', 'Director not found');
        }

        // Delete associated image file
        if (file_exists(public_path('images/food/'.$food->hinh_food))) {
            unlink(public_path('images/food/'.$food->hinh_food));
        }
      
        $food->delete();
        return redirect('admin/food')->with('success', 'Food deleted successfully');
    }
    public function status(Request $request){
        $food = Food::find($request->food_id);
        if($food) {
            $food->trang_thai = $request->active;
            $food->save();
            return redirect()->back();
        } else {
            return redirect()->back();
        }
    }
}
