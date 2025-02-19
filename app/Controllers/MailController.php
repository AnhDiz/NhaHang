<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;

class MailController extends BaseController
{
    public function sendeotp($emailtosend,$otp){
        $to = $emailtosend;
        $sub = 'Đăng ký tài khoản';
        $message = 'Mã xác nhận của bạn: '. $otp;

        $email = \Config\Services::email();
        $email->setFrom('htalol1106@gmail.com');
        $email->setTo($to);
        $email->setSubject($sub);
        $email->setMessage($message);
        $email->send();
    }
    function generateOTP($length = 6)
    {
        $characters = '0123456789'; // Use numeric characters for OTP
        $otp = '';

        for ($i = 0; $i < $length; $i++) {
            $otp .= $characters[random_int(0, strlen($characters) - 1)];
        }
        return $otp;
    }
    public function sendemail($emailtosend){
        $to = $emailtosend;
        $sub = 'Đặt bàn';
        $message = 'Bàn bạn đặt đã được xác nhận';

        $email = \Config\Services::email();
        $email->setFrom('htalol1106@gmail.com');
        $email->setTo($to);
        $email->setSubject($sub);
        $email->setMessage($message);
        $email->send();
    }
}
