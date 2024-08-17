<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GiaVe;
use App\Models\Loaighe;
use App\Models\Loaiphong;


class GiaVeController extends Controller
{
    // public function price()
    // {
    //     $hssv2345t17 = GiaVe::where(['ngay' => 'Monday, Tuesday, Wednesday, Thursday', 'thoi_gian_sau' => '08:00:00', 'generation' => 'hssv'])->first()->gia_ve ?? 0;
    //     $nl2345t17 = GiaVe::where(['ngay' => 'Monday, Tuesday, Wednesday, Thursday', 'thoi_gian_sau' => '08:00:00', 'generation' => 'nl'])->first()->gia_ve ?? 0;
    //     $nctte2345t17 = GiaVe::where(['ngay' => 'Monday, Tuesday, Wednesday, Thursday', 'thoi_gian_sau' => '08:00:00', 'generation' => 'nctte'])->first()->gia_ve ?? 0;
    //     $vtt2345t17 = GiaVe::where(['ngay' => 'Monday, Tuesday, Wednesday, Thursday', 'thoi_gian_sau' => '08:00:00', 'generation' => 'vtt'])->first()->gia_ve ?? 0;

    //     $hssv2345s17 = GiaVe::where(['ngay' => 'Monday, Tuesday, Wednesday, Thursday', 'thoi_gian_sau' => '17:00:00', 'generation' => 'hssv'])->first()->gia_ve ?? 0;
    //     $nl2345s17 = GiaVe::where(['ngay' => 'Monday, Tuesday, Wednesday, Thursday', 'thoi_gian_sau' => '17:00:00', 'generation' => 'nl'])->first()->gia_ve ?? 0;
    //     $nctte2345s17 = GiaVe::where(['ngay' => 'Monday, Tuesday, Wednesday, Thursday', 'thoi_gian_sau' => '17:00:00', 'generation' => 'nctte'])->first()->gia_ve ?? 0;
    //     $vtt2345s17 = GiaVe::where(['ngay' => 'Monday, Tuesday, Wednesday, Thursday', 'thoi_gian_sau' => '17:00:00', 'generation' => 'vtt'])->first()->gia_ve ?? 0;

    //     $hssv67cnt17 = GiaVe::where(['ngay' => 'Friday, Saturday, Sunday', 'thoi_gian_sau' => '08:00:00', 'generation' => 'hssv'])->first()->gia_ve ?? 0;
    //     $nl67cnt17 = GiaVe::where(['ngay' => 'Friday, Saturday, Sunday', 'thoi_gian_sau' => '08:00:00', 'generation' => 'nl'])->first()->gia_ve ?? 0;
    //     $nctte67cnt17 = GiaVe::where(['ngay' => 'Friday, Saturday, Sunday', 'thoi_gian_sau' => '08:00:00', 'generation' => 'nctte'])->first()->gia_ve ?? 0;
    //     $vtt67cnt17 = GiaVe::where(['ngay' => 'Friday, Saturday, Sunday', 'thoi_gian_sau' => '08:00:00', 'generation' => 'vtt'])->first()->gia_ve ?? 0;

    //     $hssv67cns17 = GiaVe::where(['ngay' => 'Friday, Saturday, Sunday', 'thoi_gian_sau' => '17:00:00', 'generation' => 'hssv'])->first()->gia_ve ?? 0;
    //     $nl67cns17 = GiaVe::where(['ngay' => 'Friday, Saturday, Sunday', 'thoi_gian_sau' => '17:00:00', 'generation' => 'nl'])->first()->gia_ve ?? 0;
    //     $nctte67cns17 = GiaVe::where(['ngay' => 'Friday, Saturday, Sunday', 'thoi_gian_sau' => '17:00:00', 'generation' => 'nctte'])->first()->gia_ve ?? 0;
    //     $vtt67cns17 = GiaVe::where(['ngay' => 'Friday, Saturday, Sunday', 'thoi_gian_sau' => '17:00:00', 'generation' => 'vtt'])->first()->gia_ve ?? 0;

    //     $roomTypes = Loaiphong::all();
    //     $seatTypes = Loaighe::all();

    //     return view('admin.gia_ve.list', compact(
    //         'hssv2345t17', 'nl2345t17', 'nctte2345t17', 'vtt2345t17',
    //         'hssv2345s17', 'nl2345s17', 'nctte2345s17', 'vtt2345s17',
    //         'hssv67cnt17', 'nl67cnt17', 'nctte67cnt17', 'vtt67cnt17',
    //         'hssv67cns17', 'nl67cns17', 'nctte67cns17', 'vtt67cns17',
    //         'roomTypes', 'seatTypes'
    //     ));
    // }

    // public function edit(Request $request)
    // {
    //     $data = $request->all();

    //     $this->updatePrice('Monday, Tuesday, Wednesday, Thursday', '08:00:00', 'hssv', $data['hssv2345t17']);
    //     $this->updatePrice('Monday, Tuesday, Wednesday, Thursday', '08:00:00', 'nl', $data['nl2345t17']);
    //     $this->updatePrice('Monday, Tuesday, Wednesday, Thursday', '08:00:00', 'nctte', $data['nctte2345t17']);
    //     $this->updatePrice('Monday, Tuesday, Wednesday, Thursday', '08:00:00', 'vtt', $data['vtt2345t17']);

    //     $this->updatePrice('Monday, Tuesday, Wednesday, Thursday', '17:00:00', 'hssv', $data['hssv2345s17']);
    //     $this->updatePrice('Monday, Tuesday, Wednesday, Thursday', '17:00:00', 'nl', $data['nl2345s17']);
    //     $this->updatePrice('Monday, Tuesday, Wednesday, Thursday', '17:00:00', 'nctte', $data['nctte2345s17']);
    //     $this->updatePrice('Monday, Tuesday, Wednesday, Thursday', '17:00:00', 'vtt', $data['vtt2345s17']);

    //     $this->updatePrice('Friday, Saturday, Sunday', '08:00:00', 'hssv', $data['hssv67cnt17']);
    //     $this->updatePrice('Friday, Saturday, Sunday', '08:00:00', 'nl', $data['nl67cnt17']);
    //     $this->updatePrice('Friday, Saturday, Sunday', '08:00:00', 'nctte', $data['nctte67cnt17']);
    //     $this->updatePrice('Friday, Saturday, Sunday', '08:00:00', 'vtt', $data['vtt67cnt17']);

    //     $this->updatePrice('Friday, Saturday, Sunday', '17:00:00', 'hssv', $data['hssv67cns17']);
    //     $this->updatePrice('Friday, Saturday, Sunday', '17:00:00', 'nl', $data['nl67cns17']);
    //     $this->updatePrice('Friday, Saturday, Sunday', '17:00:00', 'nctte', $data['nctte67cns17']);
    //     $this->updatePrice('Friday, Saturday, Sunday', '17:00:00', 'vtt', $data['vtt67cns17']);

    //     // foreach ($data as $key => $value) {
    //     //     if (str_starts_with($key, 'phong_')) {
    //     //         $id = str_replace('phong_', '', $key);
    //     //         Loaiphong::where('id_loai_phong', $id)->update(['phu_phi' => $value]);
    //     //     } elseif (str_starts_with($key, 'ghe_')) {
    //     //         $id = str_replace('ghe_', '', $key);
    //     //         Loaighe::where('id_loai_ghe', $id)->update(['phu_phi' => $value]);
    //     //     }
    //     // }
    //             // Lấy tất cả các loại phòng
    //     $roomTypes = Loaiphong::all();

    //     // Duyệt qua từng loại phòng và cập nhật giá trị phụ phí
    //     foreach ($roomTypes as $roomType) {
    //         $rt = Loaiphong::find($roomType->id_loai_phong);
    //         $rt->phu_phi = $request[$roomType->ten_loai_phong];
    //         $rt->save();
    //         unset($rt);
    //     }

    //     // Lấy tất cả các loại ghế
    //     $seatTypes = Loaighe::all();

    //     // Duyệt qua từng loại ghế và cập nhật giá trị phụ phí
    //     foreach ($seatTypes as $seatType) {
    //         $st = Loaighe::find($seatType->id_loai_ghe);
    //         $st->phu_phi = $request[$seatType->ten_loai_ghe];
    //         $st->save();
    //         unset($st);
    //     }
    //     return redirect()->back()->with('success', 'Prices updated successfully!');
    // }

    // private function updatePrice($ngay, $thoi_gian_sau, $generation, $gia_ve)
    // {
    //     GiaVe::updateOrCreate(
    //         ['ngay' => $ngay, 'thoi_gian_sau' => $thoi_gian_sau, 'generation' => $generation],
    //         ['gia_ve' => $gia_ve]
    //     );
    // }

    private $hssv2345t17;
    private $hssv2345s17;
    private $nl2345t17;
    private $nl2345s17;
    private $nctte2345t17;
    private $nctte2345s17;
    private $vtt2345t17;
    private $vtt2345s17;
    private $hssv67cnt17;
    private $hssv67cns17;
    private $nl67cnt17;
    private $nl67cns17;
    private $nctte67cnt17;
    private $nctte67cns17;
    private $vtt67cnt17;
    private $vtt67cns17;

    public function __construct()
    {
        $this->hssv2345t17 =Giave::where('ngay', 'Monday, Tuesday, Wednesday, Thursday')
            ->where('generation', 'hssv')
            ->where('thoi_gian_sau', '08:00')->get()->first();
        $this->hssv2345s17 =Giave::where('ngay', 'Monday, Tuesday, Wednesday, Thursday')
            ->where('generation', 'hssv')
            ->where('thoi_gian_sau', '17:00')->get()->first();

        $this->nl2345t17 =Giave::where('ngay', 'Monday, Tuesday, Wednesday, Thursday')
            ->where('generation', 'nl')
            ->where('thoi_gian_sau', '08:00')->get()->first();
        $this->nl2345s17 =Giave::where('ngay', 'Monday, Tuesday, Wednesday, Thursday')
            ->where('generation', 'nl')
            ->where('thoi_gian_sau', '17:00')->get()->first();

        $this->nctte2345t17 =Giave::where('ngay', 'Monday, Tuesday, Wednesday, Thursday')
            ->where('generation', 'nctte')
            ->where('thoi_gian_sau', '08:00')->get()->first();
        $this->nctte2345s17 =Giave::where('ngay', 'Monday, Tuesday, Wednesday, Thursday')
            ->where('generation', 'nctte')
            ->where('thoi_gian_sau', '17:00')->get()->first();

        $this->vtt2345t17 =Giave::where('ngay', 'Monday, Tuesday, Wednesday, Thursday')
            ->where('generation', 'vtt')
            ->where('thoi_gian_sau', '08:00')->get()->first();
        $this->vtt2345s17 =Giave::where('ngay', 'Monday, Tuesday, Wednesday, Thursday')
            ->where('generation', 'vtt')
            ->where('thoi_gian_sau', '17:00')->get()->first();

        $this->hssv67cnt17 =Giave::where('ngay', 'Friday, Saturday, Sunday')
            ->where('generation', 'hssv')
            ->where('thoi_gian_sau', '08:00')->get()->first();
        $this->hssv67cns17 =Giave::where('ngay', 'Friday, Saturday, Sunday')
            ->where('generation', 'hssv')
            ->where('thoi_gian_sau', '17:00')->get()->first();

        $this->nl67cnt17 =Giave::where('ngay', 'Friday, Saturday, Sunday')
            ->where('generation', 'nl')
            ->where('thoi_gian_sau', '08:00')->get()->first();
        $this->nl67cns17 =Giave::where('ngay', 'Friday, Saturday, Sunday')
            ->where('generation', 'nl')
            ->where('thoi_gian_sau', '17:00')->get()->first();

        $this->nctte67cnt17 =Giave::where('ngay', 'Friday, Saturday, Sunday')
            ->where('generation', 'nctte')
            ->where('thoi_gian_sau', '08:00')->get()->first();
        $this->nctte67cns17 =Giave::where('ngay', 'Friday, Saturday, Sunday')
            ->where('generation', 'nctte')
            ->where('thoi_gian_sau', '17:00')->get()->first();

        $this->vtt67cnt17 =Giave::where('ngay', 'Friday, Saturday, Sunday')
            ->where('generation', 'vtt')
            ->where('thoi_gian_sau', '08:00')->get()->first();
        $this->vtt67cns17 =Giave::where('ngay', 'Friday, Saturday, Sunday')
            ->where('generation', 'vtt')
            ->where('thoi_gian_sau', '17:00')->get()->first();
    }

    public function price()
    {
        $roomTypes = Loaiphong::all();
        $seatType = Loaighe::all();

        return view('admin.gia_ve.list', [
            'roomTypes' => $roomTypes,
            'seatTypes' => $seatType,
            'hssv2345t17' => $this->hssv2345t17->gia_ve,
            'hssv2345s17' => $this->hssv2345s17->gia_ve,
            'nl2345t17' => $this->nl2345t17->gia_ve,
            'nl2345s17' => $this->nl2345s17->gia_ve,
            'nctte2345t17' => $this->nctte2345t17->gia_ve,
            'nctte2345s17' => $this->nctte2345s17->gia_ve,
            'vtt2345t17' => $this->vtt2345t17->gia_ve,
            'vtt2345s17' => $this->vtt2345s17->gia_ve,
            'hssv67cnt17' => $this->hssv67cnt17->gia_ve,
            'hssv67cns17' => $this->hssv67cns17->gia_ve,
            'nl67cnt17' => $this->nl67cnt17->gia_ve,
            'nl67cns17' => $this->nl67cns17->gia_ve,
            'nctte67cnt17' => $this->nctte67cnt17->gia_ve,
            'nctte67cns17' => $this->nctte67cns17->gia_ve,
            'vtt67cnt17' => $this->vtt67cnt17->gia_ve,
            'vtt67cns17' => $this->vtt67cns17->gia_ve,
        ]);
    }

    public function edit(Request $request)
    {
        $this->hssv2345t17->gia_ve = $request->hssv2345t17;
        $this->hssv2345t17->save();

        $this->hssv2345s17->gia_ve = $request->hssv2345s17;
        $this->hssv2345s17->save();

        $this->nl2345t17->gia_ve = $request->nl2345t17;
        $this->nl2345t17->save();

        $this->nl2345s17->gia_ve = $request->nl2345s17;
        $this->nl2345s17->save();

        $this->nctte2345t17->gia_ve = $request->nctte2345t17;
        $this->nctte2345t17->save();

        $this->nctte2345s17->gia_ve = $request->nctte2345s17;
        $this->nctte2345s17->save();

        $this->vtt2345t17->gia_ve = $request->vtt2345t17;
        $this->vtt2345t17->save();

        $this->vtt2345s17->gia_ve = $request->vtt2345s17;
        $this->vtt2345s17->save();

        $this->hssv67cnt17->gia_ve = $request->hssv67cnt17;
        $this->hssv67cnt17->save();

        $this->hssv67cns17->gia_ve = $request->hssv67cns17;
        $this->hssv67cns17->save();

        $this->nl67cnt17->gia_ve = $request->nl67cnt17;
        $this->nl67cnt17->save();

        $this->nl67cns17->gia_ve = $request->nl67cns17;
        $this->nl67cns17->save();

        $this->nctte67cnt17->gia_ve = $request->nctte67cnt17;
        $this->nctte67cnt17->save();

        $this->nctte67cns17->gia_ve = $request->nctte67cns17;
        $this->nctte67cns17->save();

        $this->vtt67cnt17->gia_ve = $request->vtt67cnt17;
        $this->vtt67cnt17->save();

        $this->vtt67cns17->gia_ve = $request->vtt67cns17;
        $this->vtt67cns17->save();


    
        $roomTypes = Loaiphong::all();

        foreach ($roomTypes as $roomType) {
            $rt = Loaiphong::find($roomType->id_loai_phong);
            $rt->phu_phi = $request[$roomType->id_loai_phong];
            $rt->save();
            unset($rt);
        }

        $seatTypes = Loaighe::all();

        foreach ($seatTypes as $seatType) {
            $st = Loaighe::find($seatType->id_loai_ghe);
            $st->phu_phi = $request[$seatType->id_loai_ghe];
            $st->save();
            unset($st);
        }
        
        return redirect('admin/gia_ve')->with('success', 'Thêm giá vé thành công!');
    }
}
