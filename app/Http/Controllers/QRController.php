<?php

namespace App\Http\Controllers;

use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Writer\PngWriter;
use Symfony\Component\HttpFoundation\Response;

class QRController extends Controller
{
    public function generate()
    {
        // Chuỗi cần mã hóa thành QR code
        $text = "12411414141";

        // Tạo đối tượng QrCode
        $result = Builder::create()
            ->writer(new PngWriter())
            ->data($text)
            ->build();

        // Trả về hình ảnh dưới dạng response của Laravel
        return response($result->getString())->header('Content-type', 'image/png');
    }
}
