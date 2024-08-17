<?php

namespace App\Http\Controllers;

use App\Models\Combo;
use App\Models\Food;
// use App\Models\Movie;
// use App\Models\Price;
// use App\Models\RoomType;
use App\Models\Lichtrinh;
// use App\Models\SeatType;
use App\Models\Ve;
use App\Models\Ve_ComBo;
use App\Models\Ve_Food;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Stripe\Stripe;
use Illuminate\Support\Facades\Session;


class DichVuController extends Controller
{
    public function buyCombo(Request $request) 
    {
        $combos = Combo::where('status', 1)->get();
        $foods = Food::where('trang_thai', 1)->get();
        return view('admin.buyCombo.buycombo', [
            'combos' => $combos,
            'foods' => $foods,
        ]);
    }

    public function createTicketCombo(Request $request) {
        Log::info($request->all());
        $ticket = new Ve([
            'id_lich_trinh' => null,
            'id_user' => null,
            'trang_thai_giu_ve' => false,
            'trang_thai_dat_ve' => false,
            'trang_thai_thanh_toan' => false,
            'ma_code' => rand(10000000, 9999999999)
        ]);
        $ticket->save();
        if ($request->ticketCombos) {
            foreach ($request->ticketCombos as $ticketCombo) {
                $combo = Combo::find($ticketCombo[0]);
                $details = '';
                foreach ($combo->foods as $food) {
                    $details .= $food->pivot->so_luong . ' ' . $food->ten_food . ' + ';
                }
                $details = substr($details, 0, -3);
                $newTkCb = new ve_combo([
                    'ten_combo' => $combo->ten_combo,
                    'comboPrice' => $combo->gia_food,
                    'mieu_ta' => $details,
                    'so_luong' => $ticketCombo[1],
                    'id_ve' => $ticket->id_ve
                ]);

                $newTkCb->save();
                unset($newTkCb);
            }
        }
        if ($request->ticketFoods) {
            foreach ($request->ticketFoods as $ticketFood) {
                $food = Food::find($ticketFood[0]);
                $newTkF = new ve_food([
                    'ten_food' => $food->ten_food,
                    'gia_food' => $food->gia_food,
                    'so_luong' => $ticketFood[1],
                    'id_ve' => $ticket->id_ve,
                ]);

                $newTkF->save();
                unset($newTkF);
            }
        }

        return response()->json(['id_ve' => $ticket->id_ve]);
    }
    public function ticketPayment(Request $request) {
        Log::info($request->all());

        $ticket = Ve::find($request->ticket_id);
        $ticket->trang_thai_giu_ve = false;
        $ticket->tong_tien_ve = $request->totalPrice;
        // $user = User::where('code', $request->userCode)->get()->first();
        // if ($user) {
        //     $ticket->user_id = $user->id;
        // } else {
        //     $ticket->user_id = Auth::user()->id;
        // }
        $ticket->save();

        return response('', 200);
    }
    public function deleteVe(Request $request)
    {
        Log::info($request->all());

        $ticket_id = $request->input('ticket_id');
        $ticket = Ve::find($ticket_id);

        if ($ticket) {
            $ticket->delete();
            return response()->json(['message' => 'Ticket deleted successfully.']);
        } else {
            return response()->json(['message' => 'Ticket not found.'], 404);
        }
    }

    public function handleResult(Request $request)
    {


        // if ($request->vnp_BankCode === 'MONEY') {
        //     $request->vnp_Amount = $request->total;
        //     $request->vnp_ResponseCode = '00';
        //     $tickeById = Ticket::find($request->ticket_id);
        //     $request->vnp_TxnRef = $tickeById->code;
        // }


        // $ticket = Ticket::where('code', $request->vnp_TxnRef)->get()->first();
        // switch ($request->vnp_ResponseCode) {
        //     case '00':
        //         if ($request->userCode) {
        //             $user = User::where('code', $request->userCode)->first();
        //             $money_payment = 0 ;
        //             foreach($user['ticket'] as $ticket)
        //             {
        //                 $money_payment += $ticket['totalPrice'];
        //             }
        //             if($money_payment < 4000000){
        //                 $point = ($ticket['totalPrice'])*5/100;
        //             } else {
        //                 $point = ($ticket['totalPrice'])*10/100;
        //             }
        //             if ($request->point == null) {
        //                 $user->point += $point;
        //             } else {
        //                 $user->point -= $request->point;
        //             }
        //             $user->save();
        //         }
        //         $ticket->hasPaid = true;
        //         $ticket->save();

                if ($request->type == 'ticket') {
                    return redirect('admin/buyTicket')->with('success', 'thanh toán thành công!');
                } else {
                    return redirect('admin/buyCombo')->with('success', 'thanh toán thành công!');
                }
            // default:
            //     Ticket::where('code', $request->vnp_TxnRef)->delete();
            //     return redirect('admin/buyTicket')->with('fail', 'thanh toán thất bại!');
        }

        public function createPayment(Request $request)
        {
            \Stripe\Stripe::setApiKey(config('stripe.sk'));
        
            // Lấy giá trị từ request và loại bỏ các ký tự không phải số
            $vnd_price = intval(str_replace('.', '', $request->input('ticketSeat_totalPrice')));
        
            // Kiểm tra giá trị VND
            if ($vnd_price < 18000) { // 18000 VND là xấp xỉ 0.5 USD
                return redirect()->back()->with('error', 'Tổng số tiền thanh toán phải ít nhất là 18,000 VND để đủ $0.50 USD.');
            }
        
            // Chuyển đổi từ VND sang USD và sau đó sang cent
            $usd_price = $vnd_price / 23000; // Giả sử tỷ giá hối đoái là 1 USD = 23,000 VND
            $unit_amount = intval($usd_price * 100); // Chuyển đổi sang cent
        
            // Kiểm tra lại giá trị đã chuyển đổi
            if ($unit_amount < 50) { // 50 cent là $0.50 USD
                return redirect()->back()->with('error', 'Tổng số tiền thanh toán phải ít nhất là $0.50 USD.');
            }
        
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
        
            // Trả về URL của phiên thanh toán mới
            return redirect()->away($session->url);
        }
        
        
    


}