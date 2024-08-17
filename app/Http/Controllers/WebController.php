<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log; // Thêm dòng này
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

use App\Models\Phim;
use App\Models\Loaiphong;
use App\Models\Rap;
use App\Models\Lichtrinh;
use App\Models\Gioihandotuoi;
use App\Models\Dienvien; 
use App\Models\Daodien;
use App\Models\Loaiphim;
use App\Models\Banner;
use App\Models\Ve;
use App\Models\Ve_Ghe;
use App\Models\Ghe;
use App\Models\Loaighe;
use App\Models\Giave;
use App\Models\Combo;
use App\Models\Tintuc;
use App\Models\Ve_Combo;
use App\Models\User;
use App\Models\Khuyenmai;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Endroid\QrCode\Builder\Builder;

use Endroid\QrCode\Writer\PngWriter;
use Illuminate\Support\Facades\Mail;
use DNS2D;
use Pelago\Emogrifier\CssInliner;
use Illuminate\Support\Facades\Hash;



use Illuminate\Pagination\LengthAwarePaginator;



use Illuminate\Support\Str;



class WebController extends Controller
{
    //
    public function home()
    {
//         DB::select("UPDATE schedules SET status = 0 WHERE date < CURDATE()");

   
//     DB::select("UPDATE schedules SET status = 0 WHERE date = CURDATE() AND endTime <= CURTIME()");

  
//     DB::select("UPDATE movies SET status = 0 WHERE endDate < CURDATE()");

   
//     DB::select("UPDATE tickets 
//                 JOIN schedules ON tickets.schedule_id = schedules.id
//                 SET tickets.status = 0, tickets.receivedCombo = 1 
//                 WHERE schedules.date < CURDATE()");

    
//     $news = DB::select("SELECT * FROM news WHERE status = 1 ORDER BY id DESC LIMIT 3");

    
//     $banners = DB::select("SELECT * FROM banners WHERE status = 1");

    
//     $movies = DB::select("SELECT * FROM movies 
//                           WHERE status = 1 AND endDate > CURDATE() AND releaseDate <= CURDATE() 
//                           ORDER BY releaseDate DESC LIMIT 6");

    
//     $moviesEarly = DB::select("SELECT DISTINCT movies.* FROM movies 
//                                JOIN schedules ON movies.id = schedules.movie_id 
//                                WHERE schedules.early = 1 AND schedules.date > CURDATE() 
//                                ORDER BY movies.releaseDate ASC");

// $mv=DB::select('select*from movies');
//     // dd($banners);
    
  
    // return view('web.pages.home', [
    //     'movies' => $movies,
    //     'moviesEarly' => $moviesEarly,
    //     'banners' => $banners,
    //     'news' => $news,
    // ]);
        // $user=User::where('xacminh_email',0)->delete();
        Ve::where('trang_thai_thanh_toan',null)->delete();
        Ve::where('trang_thai_thanh_toan',0)->delete();
        // $user_dl=User::where('xacminh_email',0)->delete();
       
        $currentDate = Carbon::now();

        $movies = Phim::where('trang_thai', 1)
                    ->where('ngay_ket_thuc', '>', $currentDate)
                    ->with('daodiens')
                    ->orderBy('ngay_phat_hanh', 'desc')
                    ->take(6)
                    ->get();
             
        

                    $moviesEarly = Phim::whereHas('lichtrinhs', function ($query) use ($currentDate) {
                        $query->where('early', 1)
                        ->where('ngay', '>', $currentDate);
                    })
                    ->where('trang_thai', 1)
                    ->where('ngay_ket_thuc', '>', $currentDate)
                    ->with('daodiens')
                    ->orderBy('ngay_phat_hanh', 'desc')
                    ->get();
    
    

     

        $banners =Banner::where('trang_thai', 1)->get();
 
                    

        $news = Tintuc::where('trang_thai', 1)
        ->orderBy('created_at', 'desc')
        ->take(3)
        ->get();
    
        

    return view('web.pages.home', [
            'movies' => $movies,
            'moviesEarly' => $moviesEarly,
            'banners' => $banners,
            'news' => $news,
        ]);
    }

    public function chitiet_phim($id, Request $request)
    {
        $currentDate = Carbon::now();

        $movie = Phim::find($id);
                   

       $schedulesEarly=new Collection();


       $roomTypes=Loaiphong::all();

       $cities=[];


       $theaters=Rap::where('trang_thai', 1)->get();
     
       foreach ($theaters as $theater) {
        if (array_search($theater->city, $cities)) {
            continue;
        } else {
            array_push($cities, $theater->city);
        }
    }

    $schedulesEarly = $movie->lichtrinhs->filter(function ($schedule) {
            return  $schedule->early == true;
        });
        if (isset($request->city)) {
            $city_cur = $request->city;
        } else {
            $city_cur = !empty($cities) ? $cities[0] : null;
        }
        
        if (isset($request->date)) {
            $date_cur = $request->date;
        } else {
            $date_cur = date('Y-m-d');
    }

    $theaters_city = Rap::where('trang_thai', 1)->where('thanh_pho', $city_cur)->get();
    return view('web.pages.chitiet_phim', [
            'movie' => $movie,
            'schedulesEarly' => $schedulesEarly,
            'theater_city' => $theaters_city,
            'date_cur' => $date_cur,
            'cities' => $cities,
            'city_cur' => $city_cur,
            'roomTypes' => $roomTypes,
            'theaters' => $theaters,
            'theaters_city' => $theaters_city,
        ]);
    }

    public function phims()
    {
        // Lấy danh sách diễn viên và đạo diễn
        $casts = Dienvien::all();
        $directors = Daodien::all();
        
        // Lấy danh sách phim đã ra mắt và đang chiếu
        $movies = Phim::orderBy('ngay_phat_hanh', 'desc')
                    ->where('trang_thai', 1)
                    ->where('ngay_phat_hanh', '<=', date('Y-m-d'))
                    ->where('ngay_ket_thuc', '>', date('Y-m-d'))
                    ->get();
        
        // Lấy danh sách phim sắp ra mắt
        $moviesSoon = Phim::where('trang_thai', 1)
                    ->where('ngay_phat_hanh', '>', date('Y-m-d'))
                    ->get();
        
                    $moviesEarly = Phim::join('lich_trinh', 'phim.id_phim', '=', 'lich_trinh.id_phim')
                    ->select('phim.*')
                    ->where('phim.trang_thai', 1)
                    ->where('phim.ngay_phat_hanh', '>', date('Y-m-d'))
                    ->where('lich_trinh.early', true)
                    ->groupBy('phim.id_phim', 'phim.ten_phim', 'phim.image', 'phim.thoi_luong_phim', 'phim.ngay_phat_hanh', 'phim.ngay_ket_thuc', 'phim.quoc_giasx','phim.id_gioi_han_do_tuoi','phim.trailer','phim.trang_thai','phim.mieu_ta') // Thêm cột phim.quoc_giasx vào GROUP BY
                    ->get();
                


        
        // Lấy danh sách thể loại phim
        $movieGenres = Loaiphim::all();
        
        // Lấy danh sách đánh giá phim
        $rating = Gioihandotuoi::all();
        
        return view('web.pages.phims', [
            'movies' => $movies,
            'movieGenres' => $movieGenres,
            'rating' => $rating,
            'casts' => $casts,
            'directors' => $directors,
            'moviesEarly' => $moviesEarly,
            'moviesSoon' => $moviesSoon
        ]);
    }

//loc theo phim
    public function locphim(Request $request)
    {
        // Lấy các dữ liệu cần thiết trước khi thực hiện truy vấn
        $casts = Dienvien::all();
        $directors = Daodien::all();
        $movieGenres = Loaiphim::all();
        $rating = Gioihandotuoi::all();

        if (!$request->casts && !$request->directors && !$request->movieGenres && !$request->rating) {
            return redirect('/phims');
        }

        // Khởi tạo query builder
        $query = Phim::query();

        // Thêm điều kiện lọc theo thể loại phim
        if ($request->movieGenres) {
            $query->whereHas('loaiphims', function ($q) use ($request) {
                $q->whereIn('loai_phim.id_loai_phim', $request->movieGenres);
            });
        }

        // Thêm điều kiện lọc theo diễn viên
        if ($request->casts) {
            $query->whereHas('dienviens', function ($q) use ($request) {
                $q->whereIn('dien_vien.id_dien_vien', $request->casts);
            });
        }

        // Thêm điều kiện lọc theo đạo diễn
        if ($request->directors) {
            $query->whereHas('daodiens', function ($q) use ($request) {
                $q->whereIn('dao_dien.id_dao_dien', $request->directors);
            });
        }

        // Thêm điều kiện lọc theo giới hạn độ tuổi
        if ($request->rating) {
            $query->where('phim.id_gioi_han_do_tuoi', $request->rating);
        }

        // Lọc các phim có trạng thái là true
        $query->where('trang_thai', 1);

        // Lấy kết quả truy vấn
        $movies = $query->get();

        // Phân loại các phim
        $moviesShowing = $movies->filter(function ($movie) {
            return ($movie->ngay_phat_hanh <= date('Y-m-d') && $movie->ngay_ket_thuc >= date('Y-m-d'));
        });

        $moviesSoon = $movies->filter(function ($movie) {
            return $movie->ngay_phat_hanh > date('Y-m-d');
        });

        $moviesEarly = $movies->filter(function ($movie) {
            return $movie->lichtrinhs->contains('early', 1);
        });

        return view('web.pages.phims', [
            'movies' => $moviesShowing,
            'moviesSoon' => $moviesSoon,
            'moviesEarly' => $moviesEarly,
            'movieGenres' => $movieGenres,
            'rating' => $rating,
            'casts' => $casts,
            'directors' => $directors
        ]);
    }






//dao dien
    public function chitiet_daodien($id)
    {
        $director = Daodien::find($id);
        return view('web.pages.chitiet_daodien', [
            'director' => $director,
        ]);
    }

//diễn viên
    public function chitiet_dienvien($id)
    {
        $cast = Dienvien::find($id);
        return view('web.pages.chitiet_dienvien', [
            'cast' => $cast,
        ]);
    }
//tin tức
    public function tintuc(Request $request)
    {
        $news=Tintuc::all();
        return view('web.pages.tintucs',['news'=>$news]);
    }
//chi tiết tin tức
    public function chitiet_tintuc($id)
    {
        $news=Tintuc::find($id);
        $news_all = Tintuc::where('trang_thai', 1)
        ->where('id_tin_tuc', '!=', $id)
        ->orderBy('created_at', 'desc') // Sắp xếp theo thời gian tạo
        ->take(4)
        ->get();

        return view('web.pages.chitiet_tintuc',[
            'news'=>$news,
            'news_all'=>$news_all,
        ]);
    }
//lịch theo phim
    public function lichtheophim(Request $request)
    {
        $theaters = Rap::where('trang_thai', 1)->get();
        $roomTypes = Loaiphong::all();
        $movies = Phim::whereDate('ngay_phat_hanh', '<=', Carbon::today()->format('Y-m-d'))
            ->where('ngay_ket_thuc', '>=', Carbon::today()->format('Y-m-d'))
            ->where('trang_thai', 1)->get();


        return view('web.pages.lichtheophim', [
            'movies' => $movies,
            'theaters' => $theaters,
            'roomTypes' => $roomTypes,
        ]);
    }

    public function lichtheorap(Request $request)
    {
        $cities = [];
        $theaters = Rap::where('trang_thai', 1)->get();
        foreach ($theaters as $theater) {
            if (array_search($theater->thanh_pho, $cities)) {
                continue;
            } else {
                array_push($cities, $theater->thanh_pho);
            }
        }
        if (isset($request->date)) {
            $date_cur = $request->date;
        } else {
            $date_cur = date('Y-m-d');
        }
        $roomTypes = Loaiphong::all();
        $movies = Phim::whereDate('ngay_phat_hanh', '<=', Carbon::today()->format('Y-m-d'))
            ->where('ngay_ket_thuc', '>=', Carbon::today()->format('Y-m-d'))
            ->where('trang_thai', 1)->get();

        return view('web.pages.lichtheorap', [
            'movies' => $movies,
            'theaters' => $theaters,
            'cities' => $cities,
            'date_cur' => $date_cur,
            'roomTypes' => $roomTypes,
        ]);
    }

//Vé 
    public function ve($schedule_id)
    {
       
        Ve::where('trang_thai_thanh_toan',null)->delete();
        Ve::where('trang_thai_thanh_toan',0)->delete();
     
        // Xóa các vé chưa thanh toán và không được giữ cho lịch trình này
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
        
        return view('web.pages.ve', [
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
    public function xoavecombo(Request $request)
    {
        Ve_Combo::where('id_ve',$request->ticket_id)->delete();
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


    public function profile()
    {
        if (Auth::check()) {
            $user = Auth::user();
        } else {
            return redirect('/');
        }
        $sum = 0;
        foreach ($user->ves as $ticket) {
            $sum += $ticket['tong_tien_ve'];
        }
        $sort_ticket = $user->ves->sortDesc();
        // dd($sort_ticket->toArray());
        $sum_percent = ($sum * 100) / 4000000;

        // <img alt="QR code" src="data:image/png;base64,{{ $qrCodeBase64 }}"/>
        $result = Builder::create()
        ->writer(new PngWriter())
        ->data($user->email)
        ->build();
        $qrCodeBase64 = base64_encode($result->getString());
        return view('web.pages.profile', ['sort_ticket' => $sort_ticket, 'user' => $user, 'sum' => $sum, 'sum_percent' => $sum_percent,'qrCodeBase64'=>$qrCodeBase64]);
    }

    
    public function editProfile(Request $request)
    {
        // Validate the phone number format
        $request->validate([
            'phone' => 'regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:12',
        ], [
            'phone.regex' => 'Số điện thoại từ 0-9 và không bao gồm kí tự',
            'phone.min' => 'Nhập tối thiểu 10 số',
            'phone.max' => 'Nhập tối đa 12 số',
        ]);

        // Get the authenticated user
        $user = Auth::user();

        // Check for existing email and phone in the system
        $email = User::where('email', $request->email)->first();
        $phone = User::where('phone', $request->phone)->first();

        if ($phone && $user->phone != $phone->phone) {
            return redirect('/profile')->with('warning', 'Số điện thoại này đã tồn tại trong hệ thống');
        }

        if ($email && $user->email != $email->email) {
            return redirect('/profile')->with('warning', 'Email này đã tồn tại trong hệ thống');
        }

        // Update user's email and phone if they are different
        $user->fullName=$request->fullName;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->save();

        return redirect('/profile')->with('success', 'Cập nhật hồ sơ thành công!');
    }

    public function changePassword(Request $request){
        $user = User::find(Auth::user()->id_user);
        if(Hash::check($request['oldpassword'], $user->password)){
            $request->validate([
                'password' => 'required|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9]).{6,}$/',
                'repassword' => 'required|same:password'
            ],[
                'password.regex'=>'Mật khẩu phải có ít nhất 1 chữ hoa,1 chữ thường,1 số và độ dài tối thiểu 6 kí tự',
                'password.required' => 'Vui lòng nhập mật khẩu mới',
                'repassword.required' => 'Vui lòng nhập lại mật khẩu',
                'repassword.same' => "Mật khẩu nhập lại không trùng khớp !"
            ]);
            if($request['password'] == $request['oldpassword']){
                return redirect('/profile')->with('danger',"Mật khẩu mới trùng với mật khẩu cũ !");
            }
            $user['password'] = bcrypt($request['password']);
            $user->save();
        }else{
            return redirect('/profile')->with('warning',"Mật khẩu cũ không đúng !");
        }
        return redirect('/dangxuat')->with('success','Cập nhật mật khẫu thành công');
    }

    // sudunggiamgia
    public function sudunggiamgia(Request $request)
    {
        $discount = Khuyenmai::where('ma_code', $request->discount)->where('trang_thai', 1)->get()->first();
       
        if ($discount) {
            if ($discount->so_luong == 0) {
                return response()->json(['error' => 'Mã giảm giá đã hết !']);
            }
           
            return response()->json([
                'success' => 'Áp dụng mã thành công',
                'discount_id' => $discount->id_khuyen_mai,
                'percent' => $discount->phan_tram,
            ]);
        }
        return response()->json(['error' => 'Mã giảm giá không tồn tại !']);
    }

    public function ticketCompleted($id)
    {
        $ticket = Ve::find($id);
        if (!$ticket) {
            return redirect('/');
        }
    
        
        // Kiểm tra quyền truy cập
        if (Auth::user()->id_user !== $ticket->id_user) {
            return redirect('/');
        }
        $text = "Mã vé: " . $ticket->ma_code . "\n";
    
        // Thêm thông tin về các ghế đã đặt
        $text .= "Các ghế đã đặt:\n";
    if ($ticket->veghes) {
        foreach ($ticket->veghes as $ghe) {
            $text .= "" . $ghe->row . "" . $ghe->col . " ";
        }
        $text .= "\n";
    } else {
        $text .= "Không có thông tin về ghế\n";
    }
    
    // Thêm thông tin về các combo được đặt
    $text .= "Các combo đã chọn:\n";
    if ($ticket->vecombos) {
        foreach ($ticket->vecombos as $combo) {
            $text .= "" . $combo->ten_combo . "\n";
           
            $text .= "\n";
            if ($combo->foods) {
                foreach ($combo->foods as $food) {
                    $text .= "" . $food->ten_food . "\n";
                }
            } else {
                $text .= "\n";
            }
        }
    } else {
        $text .= "\n";
    }
    
        // Hiển thị nội dung để kiểm tra
       
        // Tạo mã QR
        $result = Builder::create()
            ->writer(new PngWriter())
            ->data($text)
            ->build();
        $qrCodeBase64 = base64_encode($result->getString());
        
        // Tạo ảnh QR từ mã QRBase64
        $imageContent = base64_decode($qrCodeBase64);
        $tempFileName = 'temp_qr_code.png';
        file_put_contents($tempFileName, $imageContent);
        
        // Tải ảnh lên Cloudinary
        $result = Cloudinary::upload($tempFileName, [
            'folder' => 'PHP_Laravel/QR'
        ]);
        unlink($tempFileName); // Xóa file tạm sau khi tải lên thành công
        $imageUrl = $result->getSecurePath();
        
        // Gửi email cho khách hàng
        $user = Auth::user();
        $user = Auth::user();
        Mail::send([], [], function ($email) use ($user, $imageUrl) {
            $email->to($user->email)->subject('Ảnh QR Code Vé');
            $email->attach($imageUrl, [
                'as' => 'QR_Code.png',
                'mime' => 'image/png'
            ]);
        });
        
        // Trả về view với thông tin vé, mã QR và đường dẫn ảnh đã tải lên
        return view('web.pages.ticketPaid', [
            'ticket' => $ticket,
            'qrCodeBase64'=>$qrCodeBase64,
            'imageUrl' => $imageUrl,
        ]);
    }

    public function search(Request $request)
    {
        // Validate the request input to ensure the search word is provided and at least 3 characters long
        $request->validate(
            [
                'word' => 'required|min:3',
            ],
            [
                'word.required' => 'Vui Lòng Nhập Từ Khóa!',
                'word.min' => 'Vui Lòng Nhập Ít Nhất 3 Ký Tự!',
            ]
        );

        // Retrieve the search word from the request
        $searchTerm = $request->input('word');

        // Query the Movie model to find movies that match the search term
        $movies = Phim::where('ten_phim', 'like', '%' . $searchTerm . '%')->get();

        // Return the search results view with the found movies
        return view('web.pages.search', ['result' => $movies]);
    }
    

    

}
