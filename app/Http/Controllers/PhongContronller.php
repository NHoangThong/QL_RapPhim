<?php

namespace App\Http\Controllers;

use App\Models\Ghe;
use App\Models\Loaiphong;
use App\Models\Phong;
use App\Models\Rap;
use Illuminate\Http\Request;

class PhongContronller extends Controller
{
    //
    // public function room($id){
    //     $theater = Rap::all(); // Lấy tất cả các rạp
    //     $roomType = Loaiphong::all(); // Lấy tất cả các loại phòng
    //     $room= Phong::where('id_rap', $id)->Paginate(5);
    //     return view('admin.phong.list',['rooms'=>$room,'theaters'=>$theater,'roomTypes'=>$roomType]);

        
        
        
    // }
    // public function postCreate(Request $request)
    // {
    //     $roomType = Loaiphong::find($request->roomType);
    //     $theater = Rap::find($request->theaterId);
    //     //        dd($roomType->id);
    //     $room = new Phong([
    //         'ten_phong' => $request->name,
    //         'id_rap' => $theater->id,
            
    //     ]);
    //     $room->id_loai_phong = $request->roomType;
    //     $room->save();


    //     // for ($i = 65; $i <= (65 + $request->row); $i++) {
    //     //     for ($j = 1; $j <= $request->col; $j++) {
    //     //         $seat = new Seat([
    //     //             'row' => chr($i),
    //     //             'col' => $j,
    //     //             'room_id' => $room->id,
    //     //         ]);
    //     //         if ($i <= 68 && $roomType->name == '2D') {
    //     //             $seat->seatType_id = 1;
    //     //         } else {
    //     //             $seat->seatType_id = 2;
    //     //         }
    //     //         $seat->save();
    //     //     }
    //     // }

    //     return redirect('admin/rap')->with('success', 'Thêm mới phòng tại ' . $theater->name . ' thành công!');
    // }

    public function room($id) {
        $theaters = Rap::where('id_rap', $id)->get(); // Lấy tất cả các rạp
        $roomTypes = Loaiphong::all(); // Lấy tất cả các loại phòng
        $rooms = Phong::where('id_rap', $id)->paginate(5);
       

        foreach ($rooms as $room) {
            $room->row = Ghe::where('id_phong', $room->id_phong)->max('row');
            $room->col = Ghe::where('id_phong', $room->id_phong)->max('col');
        }
        
        return view('admin.phong.list', [
            'rooms' => $rooms,
            'theaters' => $theaters,
            'roomTypes' => $roomTypes,
           
        ]);
    }

    public function postCreate(Request $request)
    {
        $roomType = Loaiphong::find($request->roomType);
        $theater = Rap::find($request->theaterId);

        $room = new Phong([
            'ten_phong' => $request->name,
            'id_rap' => $request->theaterId,
        ]);
        $room->id_loai_phong = $request->roomType;
        $room->save();


        for ($i = 65; $i <= (65 + $request->row); $i++) {
            for ($j = 1; $j <= $request->col; $j++) {
                $seat = new Ghe([
                    'row' => chr($i),
                    'col' => $j,
                    'id_phong' => $room->id_phong,
                ]);
                // if ($i <= 68 && $roomType->name == '2D') {
                //     $seat->seatType_id = 1;
                // } else {
                //     $seat->seatType_id = 2;
                // }
                $seat->id_loai_ghe = 1;
                $seat->save();
            }
        }
       

        return redirect('admin/phong/list/'. $room->id_rap)->with('success', 'Thêm mới phòng thành công!');
    }

    public function status(Request $request)
    {
        $phong = Phong::find($request->phong_id);
        if($phong) {
            $phong->trang_thai = $request->active;
            $phong->save();
            return redirect()->back();
        } else {
            return redirect()->back();
        }
    }

    public function delete($id) {
        $room = Phong::find($id);
        if ($room) {
            if ($room->schedules->count() == 0) {
                $room->delete();
            } else {
                return redirect()->back()->with('error', 'có suất chiếu tại phòng, không thể xóa!');
            }
        }
        return redirect()->back()->with('success', 'Xóa thành công!');
    }
    public function postEdit($id, Request $request) {
        // Lấy thông tin phòng từ ID
        $room = Phong::find($id);
    
        // Kiểm tra xem phòng có tồn tại không
        if($room) {
            // Cập nhật thông tin phòng từ request
            $room->ten_phong = $request->name;
            $room->id_loai_phong = $request->roomType;
            $room->id_rap= $request->theaterId;
            // Tiến hành lưu thông tin phòng
            $room->save();
            
            
            // Xóa các ghế hiện tại của phòng nếu cần
            Ghe::where('id_phong', $room->id_phong)->delete();

            for ($i = 65; $i <= (65 + $request->row); $i++) {
                for ($j = 1; $j <= $request->col; $j++) {
                    $seat = new Ghe([
                        'row' => chr($i),
                        'col' => $j,
                        'id_phong' => $room->id_phong,
                    ]);
                    // if ($i <= 68 && $roomType->name == '2D') {
                    //     $seat->seatType_id = 1;
                    // } else {
                    //     $seat->seatType_id = 2;
                    // }
                    $seat->id_loai_ghe = 1;
                    $seat->save();
                }
            }
            // Chuyển hướng về trang danh sách phòng
            return redirect()->back()->with('success', 'Cập nhật thông tin phòng thành công!');
        } else {
            // Nếu không tìm thấy phòng, chuyển hướng về trang trước
            return redirect()->back()->with('error', 'Không tìm thấy phòng cần cập nhật!');
        }
    }
}
