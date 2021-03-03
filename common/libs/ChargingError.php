<?php

namespace common\libs;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class ChargingError {

    public static $error = [
        0 => 'Thanh toán thành công',
        //10 => 'Thuê bao là trả trước',
        //11 => 'Thuê bao là trả sau',
        //201 => 'Yêu cầu không hợp lệ. (Kiển tra tài khoản và fomat request)',
        //202 => 'VCGW timeout',
        //203 => 'Check IP không thuộc IP của service',
        //204 => 'Check Msisdn không phải là số thuộc testlist',
        //205 => 'Msisdn + Service + Cmd thuộc danh sách chặn trừ tiền',
        //206 => 'Chặn trừ cước gia hạn do thuê bao mới nạp thẻ',
        //207 => 'Chặn trừ cước gia hạn do tổng tài khoản chính nhỏ hơn N đồng',
        //300 => 'Cộng tiền cho thuê bao trả sau không thành công',
        401 => 'Tai khoan cua Quy khach khong du <#fee#> de thuc hien thanh toan nhac cho doanh nghiep. Vui long nap them tien va thuc hien lai. Chi tiet LH 198 (mien phi). Xin cam on.',
        402 => 'Homephone: Thuê bao chưa đăng ký trong billing server',
        403 => 'Homephone: Thuê bao không tồn tại',
        404 => 'Số thuê bao không hợp lệ',
        409 => 'Thuê bao bị khóa 2 chiều',
        //440 => 'Lỗi chung của VCGW',
        405 => 'Số thuê bao đã đổi chủ',
        //406 => 'Số thuê bao không thể trừ tiền do OCS không hoạt động hoặc OCS đang nâng cấp..',
        501 => 'Thuê bao chưa đăng ký dịch vụ',
        //502 => 'Lỗi không cho Register lại khi chưa cancel',
        //503 => 'Lỗi không cho Register khi chưa đăng kí trừ tiền theo chu kỳ trong DB',
        //600 => 'Kiển tra những giao dịch trừ tiền thành công trong 24h vừa qua không có giao dịch nào trùng lăp serviceId + req_id',
        //601 => 'Giao dịch có serviceId  + req_Id  đang xử lý',
        //602 => 'Giao dịch có serviceId + req_Id đã trừ tiền thành công trong 24h vừa qua',
        //603 => 'Giao dịch có serviceId + req_Id không biết kết quả trừ tiền trên OCS',
        //604 => 'Không biết kết quả trừ tiền trên VCGW CDR',
        //605 => 'Không thấy kết quả trừ tiền thành công trong log OCS',
        //606 => 'Sai format check timeout hoặc không tìm được PartyCodeId',
        //607 => 'Thời gian gửi lệch check timeout quá sớm, phải nhở hơn 5 phút',
        //608 => 'Thời gian gửi lệnh chẹc timeout quá lâu, phải trong 24h kể từ khi bị timeout',
        //612 => 'Service đã trừ tiền thuê bao gia hạn trong chu kỳ (ngày, tuần, tháng) này rồi',
        //800 => 'Hệ thống đang chuẩn bị khởi động lại',
        808 => 'Hệ thống đang bận, Quý khách vui lòng thử lại sau ít phút!',
            //910 => 'Lỗi partycode không tồn tại',
            //920 => 'Lỗi partycode không hợp lệ',
    ];

    public static function getMessage($errorCode) {
        if (self::$error[$errorCode]) {
            return self::$error[$errorCode];
        }
        return 'Hệ thống đang bận, Quý khách vui lòng thử lại sau ít phút!';
    }

}
