<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Combo;
use App\Models\Food;
use App\Models\Phim;
use App\Models\Giave;
use App\Models\Loaiphong;
use App\Models\Lichtrinh;
use App\Models\Loaighe;
use App\Models\Ve;
use App\Models\Ve_Combo;
use App\Models\Ve_Food;
use App\Models\Ve_Ghe;
use App\Models\User;
use App\Models\Ghe;
use App\Models\Rap;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log; // Thêm dòng này

use Illuminate\Support\Facades\Auth;

class StaffController extends Controller
{
    public function banve(Request $request) {
     
        // dd(Auth::user());
        $theater = Auth::user()->raps;
        // dd($theater);
        if (isset($request->date)) {
            $date_cur = $request->date;
        } else {
            $date_cur = date('Y-m-d');
        }
        $roomTypes = Loaiphong::all();
        $movies = Phim::whereDate('ngay_phat_hanh', '<=', Carbon::today()->format('Y-m-d'))
            ->where('ngay_ket_thuc', '>', Carbon::today()->format('Y-m-d'))
            ->get();

        // dd($movies->toArray());
        // dd($theater->lichtheongayvarapvaphims(1,1));
        $moviesEarly = Phim::all()->filter(function ($movie) {
            foreach ($movie->lichtrinhs as $schedule) {
                if ($schedule->early && $movie->ngay_ket_thuc > date('Y-m-d')) {
                    return $movie;
                }
            }
            return null;
        });
        return view('admin.banve.banve', [
            'movies' => $movies,
            'moviesEarly' => $moviesEarly,
            'theater' => $theater,
            'date_cur' => $date_cur,
            'roomTypes' => $roomTypes,
        ]);
    }
    //
    public function ve($schedule_id)
    {
       
        
        Ve::where('trang_thai_giu_ve', 0)
        ->where('trang_thai_dat_ve', 0)
        ->where('trang_thai_thanh_toan', 0) // Thêm điều kiện trạng thái thanh toán = 0
        ->where('id_lich_trinh', $schedule_id)
        ->delete();


        // Lấy danh sách các vé đang được giữ cho lịch trình này
        $danhSachVeGiu = Ve::where('trang_thai_giu_ve', true)
            ->where('id_lich_trinh', $schedule_id)
            ->get();

     
        // Lấy thông tin lịch trình
        $schedule = Lichtrinh::find($schedule_id);

        // Lấy danh sách các loại ghế
        $seatTypes = Loaighe::all();
        // dd($schedule->thoi_gian_bat_dau);
        // Xác định giá vé dựa trên thời gian bắt đầu của lịch trình
        $timeStart = strtotime($schedule->thoi_gian_bat_dau);
        
        $timeBefore5PM = strtotime(date('H:i:s', strtotime('17:00')));
        $generation = $timeStart < $timeBefore5PM ? '08:00' : '17:00';
        $price = Giave::where('generation', 'vtt')
            ->where('ngay', 'like', '%' . date('l', strtotime($schedule->ngay)) . '%')
            ->where('thoi_gian_sau', $generation)
            ->value('gia_ve');

        // Lấy phụ thu phòng chiếu
        $roomSurcharge = $schedule->phongs->loaiphongs->phu_phi;
        $room = $schedule->phongs;
    
        $combos=Combo::where('status',1)->get();
        $movie = $schedule->phims;
        $tickets = Ve::where('id_lich_trinh', $schedule_id)->get();
        
        return view('admin.banve.ve', [
            'schedule' => $schedule,
            'room' => $room,
            'seatTypes' => $seatTypes,
            'roomSurcharge' => $roomSurcharge,
            'price' => $price,
            'movie' => $movie,
            'tickets' => $tickets,
            'combos'=>$combos,
        ]);
    }

  

    public function tao_ve(Request $request)
    {
        // $ticketSeats = $request->input('ticket_seats');

        // // Lấy giá trị của schedule_id từ request
        // $scheduleId = $request->input('schedule_id');
        // $scheduleId = intval($scheduleId); // Chuyển sang kiểu số nguyên

        try {
            foreach ($request->ticketSeats as $seat) {
                // Kiểm tra xem ghế đã được đặt chưa
                $seatExists = Ve_Ghe::where('row', $seat[0])
                                    ->where('col', $seat[1])
                                    ->whereHas('ve', function ($query) use ($request) {
                                        $query->where('id_lich_trinh', $request->schedule);
                                    })
                                    ->exists();

                if ($seatExists) {
                    return response()->json(['error' => 'Ghế đã được đặt!!!'], 401);
                }
            }

            // Tạo vé mới
            $ticket = new Ve([
                'id_lich_trinh' => $request->schedule,
                'id_user' => Auth::user()->id_user,
                'trang_thai_giu_ve' => 1,
                'trang_thai_dat_ve' => 1,
                'ma_code' => rand(1000000000, 9999999999)
            ]);
            $ticket->save();
            
            // Lưu thông tin ghế vào chi tiết vé
            foreach ($request->ticketSeats as $seat) {
                $ticketSeat = new Ve_Ghe([
                    'row' => $seat[0],
                    'col' => $seat[1],
                    'gia_ve' => $seat[2],
                    'id_ve' => $ticket->id_ve,
                    
                ]);
                $seat = Ghe::where('row', $seat[0])->where('col', $seat[1])->where('id_phong', $ticket->lichtrinhs->id_phong)->get()->first();
                $ticketSeat->ten_loai_ghe = $seat->loaighes->ten_loai_ghe;
                $ticketSeat->save();
            }
          

            

            return response()->json(['id_ve' => $ticket->id_ve]);
        } catch (\Exception $e) {
            // Xử lý lỗi
            return response()->json(['error' => 'Có lỗi xảy ra trong quá trình tạo vé'], 500);
        }


    }

    public function xoave(Request $request)
    {
        Ve::destroy($request->ticket_id);
        return response('delete success', 200);
    }

    public function taovecombo(Request $request)
    {
        // Ghi nhật ký dữ liệu đầu vào
    

        $ticket = Ve::find($request->ticket_id);
    
        
        // Kiểm tra ticket có tồn tại không
        if (!$ticket) {
            return response()->json(['error' => 'Ticket not found'], 404);
        }
        
        foreach ($request->ticketCombos as $ticketCombo) {
            $combo = Combo::find($ticketCombo[0]);
            $details = '';
            foreach ($combo->foods as $food) {
                $details .= $food->pivot->so_luong . ' ' . $food->ten_food . ' + ';
            }
            $details = substr($details, 0, -3);

            $newTkCb = new Ve_Combo([
                'ten_combo' => $combo->ten_combo,
                'gia_combo' => $combo->gia,
                'mieu_ta' => $details,
                'so_luong' => $ticketCombo[1],
                'id_ve' => $ticket->id_ve
            ]);

            $newTkCb->save();
        }

        return response()->json(['id_ve' => $ticket->id_ve, 'message' => 'add combo success'], 200);
    }


    public function ticketPayment(Request $request)
    {
        log::info($request->all());
        $ticket = Ve::find($request->ticket_id);
        $ticket->trang_thai_giu_ve = 0;
        $ticket->trang_thai_thanh_toan = 1;
        $ticket->tong_tien_ve = $request->totalPrice;
        $ticket->save();

        return response('', 200);
    }
    public function createPayment(Request $request)
    {
        log::info($request->all());
        \Stripe\Stripe::setApiKey(config('stripe.sk'));
            $unit_amount = intval($request->input('totalPrice'));


        // Tạo một phiên thanh toán mới thông qua Stripe API
        $session = \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [
                [
                    'price_data' => [
                        'currency' => 'usd',
                        'unit_amount' => $unit_amount,
                        'product_data' => [
                            'name' => 'Product Name',
                        ],
                    ],
                    'quantity' => 1,
                ],
            ],
            'mode' => 'payment',
            'success_url' => route('combo'),
            'cancel_url' => route('payment.cancel'),
        ]);
    
        // Lưu thông tin về phiên thanh toán vào session hoặc cơ sở dữ liệu nếu cần thiết
    
        // Trả về ID của phiên thanh toán mới
        return redirect()->away($session->url);
    }


}
