<?php

namespace App\Http\Controllers;

use App\Models\Loaighe;
use App\Models\Loaiphong;
use App\Models\Rap;
use Illuminate\Http\Request;

class RapPhimController extends Controller
{
    //
    public function theater()
    {
        $theaters = Rap::all();
        // $seatTypes = Loaighe::all();
        // $roomTypes = Loaiphong::all();
        return view('admin.rap.list', [
            'theaters' => $theaters,
            // 'seatTypes' => $seatTypes,
            // 'roomTypes' => $roomTypes
        ]);
    }

    public function postCreate(Request $request)
    {
        $theater = new Rap([
            'ten_rap' => $request->name,
            'dia_chi' => $request->address,
            'thanh_pho' => $request->city,
            
           
        ]);

        $theater->save();
        return redirect('admin/rap')->with('success', 'Thêm rạp phim thành công!');
    }

    public function status(Request $request)
    {
        

        $theaters = Rap::find($request->rap_id);
        if($theaters) {
            $theaters->trang_thai = $request->active;
            $theaters->save();
            return redirect()->back();
        } else {
            return redirect()->back();
        }
    }
    public function delete($id)
    {
       
        $theaters = Rap::find($id);

        if (!$theaters) {
            return redirect('admin/rap')->with('notification', [
                'type' => 'error',
                'message' => 'Rạp phim không tồn tại!'
            ]);
        }
    
        if ($theaters['trang_thai'] != 0) {
            return redirect('admin/rap')->with('notification', [
                'type' => 'error',
                'message' => 'Vui lòng chuyển trạng thái sang offline!'
            ]);
        }
    
        $check = count($theaters->rooms);
        if ($check != 0) {
            return redirect('admin/rap')->with('notification', [
                'type' => 'error',
                'message' => 'Không thể xóa rạp phim vì còn tồn tại phòng phim!'
            ]);
        }
    
        Rap::destroy($id);
        return redirect('admin/rap')->with('success','Xóa rạp phim thành công!');
    }

    public function postEdit($id, Request $request)
    {

        $theater = Rap::find($id);
        $theater->ten_rap = $request->name;
        $theater->dia_chi = $request->address;
        $theater->thanh_pho = $request->city;

        $theater->save();
        return redirect('admin/rap')->with('notification',[
            'type' => 'success',
            'message' => 'Cập nhật ' . $theater->ten_rap . ' thành công !'
        ]);
    }
}
