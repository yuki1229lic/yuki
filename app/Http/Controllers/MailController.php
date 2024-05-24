<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use Illuminate\Support\Facades\Log;

class MailController extends Controller
{
    public  static function sendRegisterEmail($name, $email, $verification_code){
        $data = [
            'name' => $name,
            'verification_code' => $verification_code,
            'app_url' => env('APP_URL'),
            'email' => $email
        ];

        Mail::send('mail.sign_up_mail', $data, function($message)use($data) {
            $message->to($data['email'],$data['email'])
                ->from(env('MAIL_USERNAME'),'ハコボウズ事務局')
                ->subject("新規登録認証メール");
        });
        self::handleMailFailure($data);

    }

    public static function sendContactEmail($data){
        Mail::send('mail.contact_replay_mail', $data, function($message)use($data) {
            $message->to($data['email'],$data['email'])
                ->from(env('MAIL_USERNAME'),'ハコボウズ事務局')
                ->subject("お問い合わせの受付");
        });
        self::handleMailFailure($data);


        Mail::send('mail.contact_mail', $data, function($message)use($data) {
            $message->to('support@hakobozu.com','support@hakobozu.com')
                ->from(env('MAIL_USERNAME'),'ハコボウズ事務局')
                ->subject("お問い合わせの受付");
        });
        self::handleMailFailure($data);

    }

    public static function sendCompanyMail($name, $company_name,$zip_code,$address, $phone,$email,$message_content){
        $data = [
            'name' => $name,
            'company_name' => $company_name,
            'zip_code' => $zip_code,
            'address' => $address,
            'phone' => $phone,
            'email' => $email,
            'message_content' => $message_content,
        ];

        Mail::send('mail.company_reply_mail', $data, function($message)use($data) {
            $message->to($data['email'],$data['email'])
                ->from(env('MAIL_USERNAME'),'ハコボウズ事務局')
                ->subject("【ハコボウズ事務局】求人掲載に関するお問い合わせありがとうございます");
        });
        self::handleMailFailure($data);

        Mail::send('mail.company_mail', $data, function($message)use($data) {
            $message->to(env('ADMIN_EMAIL'),env('ADMIN_EMAIL'))
                ->from(env('MAIL_USERNAME'),'ハコボウズ事務局')
                ->subject("求人申し込み受付");
        });
        self::handleMailFailure($data);

    }

    public static function sendBidMail($data){
        Mail::send('mail.company_bid_mail', $data, function($message)use($data) {
            $message->to($data['jober_email'],$data['jober_email'])
                ->from(env('MAIL_USERNAME'),'ハコボウズ事務局')
                ->subject("案件応募通知");
        });
        self::handleMailFailure($data);

        Mail::send('mail.user_bid_mail', $data, function($message)use($data) {
            $message->to($data['user_email'],$data['user_email'])
                ->from(env('MAIL_USERNAME'),'ハコボウズ事務局')
                ->subject("応募完了のお知らせ 「" . $data['job_title'] . "」");
        });
        self::handleMailFailure($data);

        Mail::send('mail.admin_bid_mail', $data, function($message)use($data) {
            $message->to(env('ADMIN_EMAIL'),env('ADMIN_EMAIL'))
                ->from(env('MAIL_USERNAME'),'ハコボウズ事務局')
                ->subject("案件応募通知");
        });
        self::handleMailFailure($data);
    }

    public static function sendJobRegisterMail($data){
        Mail::send('mail.job_register_mail', $data, function($message)use($data) {
            $message->to(env('ADMIN_EMAIL'),env('ADMIN_EMAIL'))
                ->from(env('MAIL_USERNAME'),'ハコボウズ事務局')
                ->subject("求人掲載開始の通知");
        });
        self::handleMailFailure($data);
    }

    public static function sendJobOpenMail($data){
        Mail::send('mail.job_open_mail', $data, function($message)use($data) {
            $message->to($data['jober_email'],$data['jober_email'])
                ->from(env('MAIL_USERNAME'),'ハコボウズ事務局')
                ->subject("掲載開始のお知らせ「" . $data['job_title'] . "」");
        });
        self::handleMailFailure($data);
    }

    public static function sendHireMail($data){
        Mail::send('mail.user_hire_mail', $data, function($message)use($data) {
            $message->to($data['user_email'],$data['user_email'])
                ->from(env('MAIL_USERNAME'),'ハコボウズ事務局')
                ->subject("【ハコボウズ事務局】採用おめでとうございます！");
        });
        self::handleMailFailure($data);

        Mail::send('mail.admin_hire_mail', $data, function($message)use($data) {
            $message->to(env('ADMIN_EMAIL'),env('ADMIN_EMAIL'))
                ->from(env('MAIL_USERNAME'),'ハコボウズ事務局')
                ->subject("案件採用通知");
        });
        self::handleMailFailure($data);
    }

    public static function sendHireStopMail($data){
        Mail::send('mail.company_hire_stop_mail', $data, function($message)use($data) {
            $message->to($data['jober_email'],$data['jober_email'])
                ->from(env('MAIL_USERNAME'),'ハコボウズ事務局')
                ->subject("【ハコボウズ事務局】退職通知完了のお知らせ");
        });
        Mail::send('mail.admin_hire_stop_mail', $data, function($message)use($data) {
            $message->to(env('ADMIN_EMAIL'),env('ADMIN_EMAIL'))
                ->from(env('MAIL_USERNAME'),'ハコボウズ事務局')
                ->subject("ドライバー退職に関する通知");
        });
    }

    public static function sendPasswordUpdateMail($data){
        Mail::send('mail.company_password_update_mail', $data, function($message)use($data) {
            $message->to($data['jober_email'],$data['jober_email'])
                ->from(env('MAIL_USERNAME'),'ハコボウズ事務局')
                ->subject("【【ハコボウズ事務局】パスワード設定完了のお知らせ");
        });
        self::handleMailFailure($data);
    }

    public static function chatSendMail($data){
        Mail::send('mail.chat_send_mail', $data, function($message)use($data) {
            $message->to($data['toEmail'],$data['toEmail'])
                ->from(env('MAIL_USERNAME'),'ハコボウズ事務局')
                ->subject("【ハコボウズ事務局】メッセージ受信のお知らせ");
        });
        self::handleMailFailure($data);
    }

    public static function handleMailFailure($data){
        if (count(Mail::failures()) > 0) {
            Log::error("Failed to send mail from function", [
                'function' => __FUNCTION__,
                'failed_addresses' => implode(", ", Mail::failures()),
                'data' => $data
            ]);
        }
    }
}
