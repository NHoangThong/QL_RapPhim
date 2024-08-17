<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use App\Models\Rap;
use App\Models\Ve;
use App\Models\Ve_Ghe;
use App\Models\User;
use App\Models\Phim;
use App\Models\Info;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
// use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Str;
// use Spatie\Permission\Models\Permission;
// use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Log; // Thêm dòng này

class HomeAdminController extends Controller
{
    public function home(Request $request)
    {
        $now = Carbon::now('Asia/Ho_Chi_Minh')->endOfDay();
        $year = Carbon::now('Asia/Ho_Chi_Minh')->subDays(365)->startOfYear()->toDateString();
        $start_of_month = Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth();
        $total_year = Ve::whereBetween('created_at', [$year, $now])->where('trang_thai_thanh_toan', 1)->orderBy('created_at', 'ASC')->get();
        $theaters = Rap::orderBy('id_rap', 'ASC')->get();
        $ticket = Ve::whereDate('created_at', Carbon::today())->where('trang_thai_thanh_toan', 1)->get();
        $ticket_seat = Ve_Ghe::get()->whereBetween('created_at', [$year, $now])->count();
        // $user = User::role('user')->get();
        $movies = Phim::all();

        foreach ($theaters as $theater) {
            $total_seat = 0;
            $total_price = 0;
            foreach ($theater['phongs'] as $theater_room) {
                foreach ($theater_room['lichtrinhs'] as $theater_schedule) {
                    foreach ($theater_schedule['ves'] as $theater_ticket) {
                        $total_seat += $theater_ticket['veghes']->count();
                        $total_price += $theater_ticket['tong_tien_ve'];
                    }
                }
            }
            $theater->setAttribute('tong_tien_ve', $total_price);
            $theater->setAttribute('veghes', $total_seat);
        }

        foreach ($movies as $movie) {
            $total_seat = 0;
            $total_price = 0;
            foreach ($movie['lichtrinhs'] as $movie_schedule) {
                foreach ($movie_schedule['ves'] as $movie_ticket) {
                    $veghes = $theater_ticket->veghes;
                    
                    if ($veghes) {
                        $total_seat += $veghes->count();
                    }
                                        $total_price += $movie_ticket['tong_tien_ve'];
                }
            }
            $movie->setAttribute('tong_tien_ve', $total_price);
            $movie->setAttribute('veghes', $total_seat);
        }

        $movies = $movies->sortByDesc('tong_tien_ve');



        $sum = 0;
        $sum_today = 0;

        //total of month
        foreach ($total_year as $value) {
            $sum += $value['tong_tien_ve'];
        }
        //total today
        foreach ($ticket as $today) {
            $sum_today += $today['tong_tien_ve'];
        }

        return view('admin.home.list', [
            // 'user' => $user,
            'ticket' => $ticket,
            'sum' => $sum,
            'sum_today' => $sum_today,
            'now' => $now,
            'start_of_month' => $start_of_month,
            'ticket_seat' => $ticket_seat,
            'year' => $year,
            'theaters' => $theaters,
            'movies' => $movies
        ]);
        
    }


    public function filter_by_date(Request $request)
    {
        log::info($request->all());
        $start_time = Carbon::createFromFormat('Y-m-d', $request->from_date)->startOfDay();
        $end_time = Carbon::createFromFormat('Y-m-d', $request->to_date)->endOfDay(); // lấy ngày cuối cùng

        $get = Ve::whereBetween('created_at', [$start_time, $end_time])->where('trang_thai_giu_ve', 0)->orderBy('created_at', 'ASC')->get();
        $value_first = $get->first();
        $value_last = $get->last();

        $date_current = date("d-m-Y", strtotime($value_first['created_at']));

        $total = 0;
        $seat_count = 0;
        $chart_data = [];

        foreach ($get as $value) {
            if ($date_current == date("d-m-Y", strtotime($value['created_at']))) {
                $total += $value['tong_tien_ve'];
                $seat_count += $value['veghes']->count();
            } else {
                $data = array(
                    'date' =>  $date_current,
                    'total' => $total,
                    'seat_count' => $seat_count
                );
                $date_current = date("d-m-Y", strtotime($value['created_at']));
                $total = $value['tong_tien_ve'];
                $seat_count = $value['veghes']->count();
                array_push($chart_data, $data);
            }
            if ($value_last->id_ve == $value['id_ve']) {
                $data = array(
                    'date' => date("d-m-Y", strtotime($value['created_at'])),
                    'total' => $total,
                    'seat_count' => $seat_count
                );
                array_push($chart_data, $data);
            }
        }
        return response()->json([
            'success' => 'Thành công',
            'chart_data' => $chart_data
        ]);
    }
    public function statistical_filter(Request $request)
    {

        $now = Carbon::now('Asia/Ho_Chi_Minh')->endOfDay();
        $week = Carbon::now('Asia/Ho_Chi_Minh')->subDays(7)->startOfDay()->toDateString();
        $this_month = Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth()->toDateString();
        $start_last_month = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->startOfMonth()->toDateString();
        $end_last_month = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->endOfMonth()->toDateString();
        $year = Carbon::now('Asia/Ho_Chi_Minh')->subDays(365)->startOfYear()->toDateString();

        if ($request['statistical_value'] == 'week') {
            $get = Ve::whereBetween('created_at', [$week, $now])->where('trang_thai_giu_ve', 0)->orderBy('created_at', 'ASC')->get();
            $value_first = $get->first();
            $value_last = $get->last();
            $date_current = date("d-m-Y", strtotime($value_first['created_at']));
        }
        if ($request['statistical_value'] == 'year') {
            $get = Ve::whereBetween('created_at', [$year, $now])->where('trang_thai_giu_ve', 0)->orderBy('created_at', 'ASC')->get();
            $value_first = $get->first();
            $value_last = $get->last();
            $date_current = date("m-Y", strtotime($value_first['created_at']));
        }
        if ($request['statistical_value'] == 'this_month') {
            $get = Ve::whereBetween('created_at', [$this_month, $now])->where('trang_thai_giu_ve', 0)->orderBy('created_at', 'ASC')->get();
            $value_first = $get->first();
            $value_last = $get->last();
            $date_current = date("d-m-Y", strtotime($value_first['created_at']));
        }
        if ($request['statistical_value'] == 'last_month') {
            $get = Ve::whereBetween('created_at', [$start_last_month, $end_last_month])->where('trang_thai_giu_ve', 0)->orderBy('created_at', 'ASC')->get();
            $value_first = $get->first();
            $value_last = $get->last();
            $date_current = date("d-m-Y", strtotime($value_first['created_at']));
        }
        function date_statistical($option, $date)
        {
            if ($option == 'year') {
                return date("m-Y", strtotime($date));
            } else {
                return date("d-m-Y", strtotime($date));
            }
        }
        $total = 0;
        $seat_count = 0;
        $chart_data = [];

        foreach ($get as $value) {
            if ($date_current == date_statistical($request['statistical_value'], $value['created_at'])) {
                $total += $value['tong_tien_ve'];
                $seat_count += $value['veghes']->count();
            } else {
                $data = array(
                    'date' =>  $date_current,
                    'total' => $total,
                    'seat_count' => $seat_count
                );
                $date_current = date_statistical($request['statistical_value'], $value['created_at']);
                $total = $value['tong_tien_ve'];
                $seat_count = $value['veghes']->count();
                array_push($chart_data, $data);
            }
            if ($value_last->id == $value['id']) {
                $data = array(
                    'date' => date_statistical($request['statistical_value'], $value['created_at']),
                    'total' => $total,
                    'seat_count' => $seat_count
                );
                array_push($chart_data, $data);
            }
        }

        return response()->json([
            'success' => 'Thành công',
            'get' => $get,
            'chart_data' => $chart_data,
        ]);
    }

    public function statistical_sortby(Request $request)
    {
        log::info($request->all());
        $now = Carbon::now('Asia/Ho_Chi_Minh')->endOfDay();
        $year = Carbon::now('Asia/Ho_Chi_Minh')->subDays(365)->startOfYear()->toDateString();

        $get = Ve::whereBetween('created_at', [$year, $now])->where('trang_thai_giu_ve', 0)->orderBy('created_at', 'ASC')->get();
        $value_first = $get->first();
        $value_last = $get->last();
        $date_current = date("m-Y", strtotime($value_first['created_at']));

        $seat_count = 0;
        $theaters = Rap::all();
        foreach ($theaters as $theater) {
            $total[$theater->id_rap] = 0;
        }
        $chart_data = [];
        if ($request['statistical_value'] == 'ticket') {
            foreach ($get as $value) {
                if ($date_current == date("m-Y", strtotime($value['created_at']))) {
                    $seat_count += $value['veghes']->count();
                } else {
                    $data = array(
                        'date' =>  $date_current,
                        'seat_count' => $seat_count
                    );
                    $date_current = date("m-Y", strtotime($value['created_at']));
                    $seat_count = $value['veghes']->count();
                    array_push($chart_data, $data);
                }
                if ($value_last->id_ve == $value['id_ve']) {
                    $data = array(
                        'date' => date("m-Y", strtotime($value['created_at'])),
                        'seat_count' => $seat_count
                    );
                    array_push($chart_data, $data);
                }
            }
        }
        if ($request['statistical_value'] == 'theater') {
            foreach ($get as $value) {
                if ($date_current == date("m-Y", strtotime($value['created_at']))) {
                    if ($value->id_ve != null) {
                        $total[$value->lichtrinhs->phongs->id_rap] += $value['tong_tien_ve'];
                    }
                } else {
                    $data = array(
                        'date' =>  $date_current,
                    );
                    foreach ($theaters as $theater) {

                        $data[$theater->id_rap] = $total[$theater->id_rap];
                        //                        dd($data);
                    }
                    $date_current = date("m-Y", strtotime($value['created_at']));
                    foreach ($theaters as $theater) {
                        if ($value->id_ve != null && $value->lichtrinhs->phongs->id_rap == $theater->id_rap) {
                            $total[$theater->id_rap] = $value['tong_tien_ve'];
                        } else {
                            $total[$theater->id_rap] = 0;
                        }
                    }
                    array_push($chart_data, $data);
                }
                if ($value_last->id_ve == $value['id_ve']) {
                    $data = array(
                        'date' =>  $date_current,
                    );
                    foreach ($theaters as $theater) {
                        $data[$theater->id_rap] = $total[$theater->id_rap];
                        //                        dd($data);
                    }
                }
            }
        }
        //        if($request['statistical_value'] == 'genre'){
        //
        //        }
        return response()->json([
            'success' => 'Thành công',
            'chart_data' => $chart_data,
        ]);
    }



}