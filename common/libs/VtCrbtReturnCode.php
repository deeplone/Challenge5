<?php

namespace common\libs;

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of VtCrbtReturnCode
 *
 * @author Ico
 */
class VtCrbtReturnCode {

    private $code;

    public function __construct($code) {
        $this->code = trim($code);
    }

    public function setCode($code) {
        return $this->code = $code;
    }

    public function getCode() {
        return $this->code;
    }

    public function getDescription() {
        return $this->getErrVN();
    }

    public function getCrbtDescription($type = '') {
        return $this->getCrbtCode($type);
    }

    public function isSuccess() {
        if (self::strBeginWith('0', $this->code))
            return true;
        return false;
    }

    private static function strBeginWith($needle, $haystack) {
        return (substr($haystack, 0, strlen($needle)) == $needle);
    }

    public function getErrVN() {
        switch ($this->code) {
            case "000000":
                return "Thực hiện thành công";
            case "000001":
                return "Yêu cầu đã được chấp nhận và đang trong quá trình xử lý.";
            case "000002":
                return "Không có thông tin về gói đang thêm mới hoặc sửa thành công.";
            case "000003":
                return "Yêu cầu tải RBT được chấp nhận và RBTs sẽ được tải về sau khi thuê bao đăng kí dịch vụ RBT.";
            case "100001":
                return "Lỗi không xác đinh.";
            case "100002":
                return "Hệ thống đang bận xử lý.";
            case "100003":
                return "Thời gian chờ đợi xử lý đã hết.";
            case "100004":
                return "Lỗi đường truyền.";
            case "100005":
            case "100006":
                return "Lỗi xử lý database.";
            case "100007":
                return "Dịch vụ tạm dừng hoạt động.";
            case "100008":
                return "Lỗi thực thi cơ sở dữ liệu.";
            case "200001":
                return "Không vào giá trị các tham số bắt buộc.";
            case "200002":
                return "Dữ liệu nhập vào không hợp lệ.";
            case "200003":
                return "Độ dài tham số vượt quá độ dài cho phép.";
            case "200004":
                return "Tất cả các tham số vào đều rỗng(null).";
            case "200005":
                return "Sai định dạng thời gian của RBT hoặc thời gian bắt đầu phải bé hơn thời gian kết thúc.";
            case "200006":
                return "Vào giá trị của những tham số không yêu cầu.";
            case "201001":
                return "Sai định dạng số điện thoại.";
            case "201002":
                return "Sai mật khẩu.";
            case "201003":
                return "Không vào mật khẩu.";
            case "202001":
                return "Sai định dạng của hộp âm nhạc.";
            case "202002":
                return "Sai định dạng của mã RBT.";
            case "300001":
                return "Vượt quá số lượng thành viên cho phép.";
            case "300002":
                return "Không lấy được thông tin.";
            case "301001":
                return "Thuê bao không tồn tại.";
            case "301002":
                return "Thuê bao đã đăng ký dịch vụ trước đó.";
            case "301003":
                return "Sai mật khẩu.";
            case "301004":
                return "Không gửi được tin nhắn đến thuê bao.";
            case "301005":
                return "Vào sai mã kiểm tra.";
            case "301006":
                return "Thuê bao đang chờ đăng ký hoặc chờ được kích hoạt.";
            case "301008":
                return "Không lấy được mã kiểm tra do thuê bao có lỗi.";
            case "301009":
                return "Không được phép định nghĩa thuê bao do thuê bao đang có lỗi.";
            case "301010":
                return "Không xóa được thuê bao do thuê bao đang có lỗi.";
            case "301011":
                return "Thuê bao nợ tiền.";
            case "301012":
                return "Mã kiểm tra không tồn tại.";
            case "301013":
                return "Không thể tải về trang thái dịch vụ thuê bao.";
            case "301014":
                return "Không thể thiết lập trạng thái dịch vụ thuê bao";
            case "301015":
                return "Dịch vụ không đáp ứng cho thuê bao do lỗi trạng thái dịch vụ của thuê bao.";
            case "301016":
                return "Thuê bao không cho phép các thuê bao khác sao chép RBTs.";
            case "301017":
                return "Không thể sao chép cấu hình hệ thống.";
            case "301018":
                return "Số điện thoại của thuê bao bị sao chép không tồn tại.";
            case "301019":
                return "Danh sách các RBT có chứa RBT không hợp lệ (trạng thái không xác định).";
            case "301020":
                return "RBT không thuộc một công ty nào.";
            case "301021":
                return "Đối tượng bị hạn chế lần tiêu thụ.";
            case "301022":
                return "Mã giới hạn tiêu dùng không tồn tại.";
            case "301023":
                return "Vượt quá giới hạn sử dụng.";
            case "301024":
                return "Loại RBT không tồn tại.";
            case "301025":
                return "Hệ thống tính tiền mới không thay đổi so với hệ thống cũ nên không cần thay đổi gì.";
            case "309123":
                return "Số lần thuê bao đăng ký dịch vụ trong ngày đã vượt quá giới hạn.";
            case "301026":
                return "Một nhánh dịch vụ mới không thay đổi gì so với dịch vụ cũ.";
            case "301027":
                return "Mã ngôn ngữ không được Hệ thống hỗ trợ.";
            case "301029":
                return "Số thuê bao không thuộc phạm vi vùng.";
            case "302001":
                return "Nhạc chờ đã tồn tại trong BST!";
            case "302002":
                return "Lỗi truyền file RBT.";
            case "302003":
                return "Nhạc chờ không tồn tại.";
            case "302004":
                return "RBT đã bị yêu cầu xóa.";
            case "302005":
                return "RBT của CP yêu cầu xử lý không thuộc về CP đó.";
            case "302006":
                return "RBT đã được yêu cầu sửa chữa.";
            case "302007":
                return "Số lượng kết quả truy vấn bằng 0.";
            case "302008":
                return "RBT đang trong trạng thái được thay đổi.";
            case "302009":
                return "RBT trong thư để tải lên có lỗi.";
            case "302010":
                return "Lỗi tính cước thuê bao.";
            case "302011":
                return "Nhạc chờ đã có trong bộ sưu tập";
            case "302015":
                return "RBT đã ở trạng thái ẩn (chưa kích hoạt).";
            case "302016":
                return "RBT đã ở trạng thái được phép hiển thị.";
            case "302017":
                return "Hộp âm nhạc không tồn tại.";
            case "302018":
                return "RBT chưa được tải về.";
            case "302019":
                return "RBT hết hạn sử dụng.";
            case "302020":
                return "Số lượng RBT trong hộp âm nhạc vượt quá giới hạn.";
            case "302021":
                return "Kiểu thư mục không tồn tại.";
            case "302022":
                return "Mã xác định trong của thư mục không tồn tại.";
            case "302023":
                return "Không tạo được thư mục.";
            case "302026":
                return "Không ẩn được trạng thái của RBT.";
            case "302027":
                return "Không hiện được trạng thái của RBT.";
            case "302028":
                return "RBT đang đợi được chấp nhận.";
            case "302029":
                return "Lỗi sai thời hạn sử dụng RBT: Thời gian sử dụng lại đặt trước thời gian hiện thời hoặc Thời hạn sử dụng sai (bắt đầu và kết thúc)";
            case "302030":
                return "Thời gian chơi RBT bị đè lên nhau.";
            case "302031":
                return "Mã kiểu thư mục không tồn tại hoặc sai định dạng.";
            case "302032":
                return "Cấu trúc thư mục sai và không chứa được RBT.";
            case "302033":
                return "Thư mục gốc không được chứa RBT (hệ thống chỉ cho phép thư mục con chứa RBT)";
            case "302034":
                return "Không được xóa thư mục chứa RBT.";
            case "302035":
                return "Không xóa được thư mục chứa thư mục con.";
            case "302037":
                return "Không sao chép được tất cả RBTs trong thư mục.";
            case "302038":
                return "Không sao chép được một vài RBTs trong thư mục.";
            case "302039":
                return "Các trường đợi được chấp nhận không thể sửa chữa. Các trường đang ở trong trạng thái bị xóa.";
            case "302040":
                return "Ngôn ngữ không tồn tại.";
            case "302041":
                return "Công ty không tồn tại.";
            case "302042":
                return "Mã vùng không tồn tại.";
            case "302043":
                return "Sai định dạng file.";
            case "302044":
                return "Không ẩn được bài hát trong hộp âm nhạc.";
            case "302045":
                return "Không thể thay đổi thuộc tính tài nguyên của thư mục.";
            case "302046":
                return "Thư mục mẹ không tồn tại.";
            case "302047":
                return "Thư mục RBT không tồn tại.";
            case "302048":
                return "Hộp âm nhạc đã tồn tại.";
            case "302052":
                return "Hộp âm nhạc quá hạn.";
            case "302053":
                return "Hộp âm nhạc đang trọng trạng thái chờ được chấp nhận.";
            case "302054":
                return "Không ẩn được trạng thái hiện thời của hộp âm nhạc.";
            case "302055":
                return "Không hiển thị được trạng thái hiện thời của hộp âm nhạc.";
            case "302056":
                return "Thư mục chứa RBT không tồn tại.";
            case "302057":
                return "Thư mục chứa RBT đang đợi được chấp nhận.";
            case "302058":
                return "Không ẩn được trạng thái hiện thời của thư mục chứa RBT.";
            case "302059":
                return "Không hiển thị được trạng thái hiện thời của thư mục RBT.";
            case "302060":
                return "Không thực hiện thay đổi một chuỗi RBT.";
            case "302061":
                return "Không thực hiện được thay đổi chuỗi";
            case "302065":
                return "Ngày hết hạn sử dụng của hôm âm nhạc sớm hơn ngày hiện thời.";
            case "302066":
                return "Hộp âm nhạc đang đợi được chấp nhận đã bị xóa nên không thể thay đổi được.";
            case "302067":
                return "Hộp âm nhạc không thể thay đổi.";
            case "302068":
                return "RBT không thuộc một danh sách RBTs nào cả.";
            case "302069":
                return "Tất cả RBTs đã bao gồm trong danh sách RBT.";
            case "302070":
                return "Không lấy được thư mục hoạt động của file announcement trong hộp âm nhạc.";
            case "302071":
                return "Đã tồn tại cả hai trường ghi người gọi và nhận.";
            case "302072":
                return "Không tồn tại cả hai trường ghi người gọi và nhận.";
            case "302073":
                return "Thuê bao hoặc tài nguyên RBT không tồn tại.";
            case "302074":
                return "RBT không thể được sửa chữa.";
            case "302075":
                return "Số nhạc nền không tồn tại trong mục ghi cấu hình.";
            case "302076":
                return "Âm nhạc nền không tồn tại.";
            case "302078":
                return "Không soạn được RBT.";
            case "302079":
                return "Số người gọi đã đặt trước đó.";
            case "302080":
                return "Thời gian hiệu lực bị sai.";
            case "302082":
                return "Vượt quá hạn sử dụng của hộp âm nhạc.";
            case "302088":
                return "Thuê bao chưa tải RBT.";
            case "302091":
                return "RBT và hộp âm nhạc  hết hạn sử dụng và không gia hạn được.";
            case "302093":
                return "Hạn sử dụng của một gói sớm hơn thời gian hiện thời.";
            case "302100":
                return "RBT đã tồn tại trước đó.";
            case "302101":
                return "Announcement file không tồn tại.";
            case "302102":
                return "Không sao chép được file announcement.";
            case "302103":
                return "Mã trường ghi RBTs ngầm định không tồn tại.";
            case "302104":
                return "Trạng thái hiện thời của gói RBT không ẩn được.";
            case "302105":
                return "Trạng thái hiện thời của gói RBT không hiển thị được.";
            case "302110":
                return "Ngày bắt đầu sớm hơn ngày kết thúc thời hạn sử dụng.";
            case "302112":
                return "Sai lệch hạn sử dụng.";
            case "302119":
                return "Trạng thái RBT bị lỗi.";
            case "302123":
                return "RBT tồn tại trong thư viện cá nhân.";
            case "302124":
                return "Kiểu RBT khác nhau.";
            case "302125":
                return "Kiểu RBT đặt không trùng với kiểu trong danh sách. Ví dụ kiểu RBT được đặt là PLUS RBT nhưng trong danh sách RBT lại là RBT thường.";
            case "302133":
                return "Số lượng RBTs tải vượt quá tối đa cho phép";
            case "303001":
                return "Thuê bao đã định nghĩa nhóm gọi đến (gồm cả tên và số thuê bao).";
            case "303002":
                return "Khi sửa chữa hoặc xóa một nhóm người gọi, trường ghi nhận báo nhóm đó không tồn tại.";
            case "303003":
                return "Nhóm người gọi không thể bổ xung bởi số người trong nhóm vượt quá giới hạn cho phép.";
            case "303004":
                return "Nhóm người gọi bao gồm những thành viên không thể xóa được.";
            case "303011":
                return "Thuê bao đã tồn tại trong nhóm.";
            case "303012":
                return "Thuê bao không tồn tại trong nhóm.";
            case "303013":
                return "Số thuê bao trong nhóm vượt quá giới hạn.";
            case "303014":
                return "Không thể sửa được số của thuê bao bởi thuê bao này nằm trong nhóm khác.";
            case "303015":
                return "Số lượng thuê bao gọi tới vượt quá giới hạn cho phép.";
            case "303021":
                return "RBT đã tồn tại trong hộp âm nhạc.";
            case "303023":
                return "Số lượng RBT được tải về vượt quá giới hạn cho phép.";
            case "303024":
                return "Số lượng RBT vượt quá giới hạn cho phép.";
            case "303025":
                return "Gói tải về không tồn tại.";
            case "303028":
                return "Gói chuẩn bị tải về đã được tải trước đó.";
            case "303029":
                return "Thuê bao không tải gói về.";
            case "303030":
                return "Thuê bao không được phép tải nhiều gói của một CP.";
            case "303031":
                return "Hộp âm nhạc đã tồn tại.";
            case "303032":
                return "Hộp âm nhạc không tồn tại.";
            case "303033":
                return "Chủ sở hữu của hộp âm nhạc không tồn tại.";
            case "303041":
                return "RBT đã tồn tại trong hộp âm nhạc.";
            case "303042":
                return "RBT không tồn tại trong hộp âm nhạc.";
            case "303043":
                return "Nội dung của nhóm RBT không sửa chữa được.";
            case "303051":
                return "Cài đặt RBT đã tồn tại.";
            case "303052":
                return "Cài đặt cho RBT không tồn tại.";
            case "303053":
                return "Nhóm hoặc bộ phận không tồn tại.";
            case "303054":
                return "Tình trạng dịch vụ của nhóm hoặc bộ phận không bình thường";
            case "303056":
                return "Nguồn RBT không nằm trong thư viện nhạc cá nhân của người sử dụng, mà sẽ được copied.";
            case "303057":
                return "Thông tin cấu hình hệ thống thiết yếu không tồn tại";
            case "304001":
                return "Không tìm thấy giá trị thống kê.";
            case "306001":
                return "RBT ngầm định không tồn tại.";
            case "306002":
                return "Hệ thống báo lỗi khi hiển thị mã RBT.";
            case "306003":
                return "Hệ thống báo lỗi khi mã nhận dạng trong của RBT chuyển thành mã RBT.";
            case "306004":
                return "Tham số vào sai.";
            case "306012":
                return "Mã vùng không tồn tại.";
            case "307016":
                return "Nhóm đã cài đặt rồi.";
            case "307017":
                return "Dải số không tồn tại";
            case "308001":
                return "Người nhận quà tặng RBT không đăng ký dịch vụ RBT";
            case "308002":
                return "Số lượng RBT của người nhận quà tặng RBT đã vượt quá giới hạn cho phép.";
            case "308003":
                return "Người nhận quà tặng không phải thuộc vùng thuê bao cho phép.";
            case "308004":
                return "Người nhận quà tặng đã có quà tặng này trong nhóm rồi.";
            case "308005":
                return "Số tháng tặng quà vượt quá giá trị cho phép.";
            case "308006":
                return "Người nhận quà tặng dịch vụ RBT cũng đã đăng kí dịch vụ RBT.";
            case "308007":
                return "Người được tặng không được là người tặng RBT";
            case "308008":
                return "Dịch vụ hết hạn sử dụng.";
            case "308009":
                return "Một phần của gói đang download bị lỗi!";
            case "308010":
                return "Thuê bao đã có RBTs ngầm định, cài đặt không thực hiện được.";
            case "308011":
                return "Một RBT không thể đặt được vào hộp âm nhạc.";
            case "308012":
                return "RBT tồn tại trong danh sách RBT rồi.";
            case "308013":
                return "Tải không thành công. Bạn đã có bài hát này hoặc bộ sưu tập của bạn đã đầy.";
            case "308014":
                return "Lệnh gửi tặng bị lỗi.";
            case "308015":
                return "Lệnh gửi tặng bị lỗi.";
            case "308016":
                return "Thực hiện lệnh gửi tặng bị lỗi.";
            case "308017":
                return "Thực hiện lệnh gửi tặng bị lỗi.";
            case "308023":
                return "Bài hát (RBT) đã tồn tại hoặc đang được gửi tặng.";
            case "309001":
                return "Vượt quá khả năng cung cấp của hệ thống.";
            case "309002":
                return "Yêu cầu mã kiểm tra";
            case "309003":
                return "Chính sách đăng ký không tìm thấy.";
            case "309004":
                return "Không xóa và tạo được thuê bao tại website.";
            case "309005":
                return "Chưa đặt kiểu truy cập";
            case "309006":
                return "Số lượng thue bao định nghĩa trong ngày vượt quá giới hạn.";
            case "309007":
                return "Không xóa hoặc tạo được thuê bao.";
            case "309008":
                return "Thuê bao đang được tạo hoặc xóa.";
            case "309113":
                return "Người dùng không dùng được dịch vụ RBT .";
            case "309114":
                return "Thuê bao không thể xóa được.";
            case "309115":
                return "Chưa đặt kiểu thuê bao.";
            case "309116":
                return "Sai kiểu thuê bao hoặc kiểu truy cập.";
            case "309117":
                return "Số lượng thuê bao hằng ngày dùng dịch vụ vượt quá giới hạn cho phép.";
            case "309118":
                return "Thuê bao không được phép sử dụng dịch vụ dịch vụ RBT.";
            case "309119":
                return "Vùng của thuê bao không được phép dùng dịch vụ.";
            case "309120":
                return "Thời gian để tạo hoặc xóa một thuê bao nằm trong khoảng thời gian không cho phép.";
            case "309121":
                return "Thuê bao thuộc nhóm khác.";
            case "309122":
                return "Tạo được dịch vụ cho thuê bao nhưng không gửi được tin nhắn SMS. Nhắc thuê bao để lấy mật khẩu qua Webiste.";
            case "310001":
                return "Thuê bao không đủ tiền trong tài khoản.";
            case "310010":
                return "Thuê bao không đủ tiền trong tài khoản.";
            case "312003":
                return "Mã vùng không tồn tại.";
            case "312004":
                return "Tài khoản của thuê bao không được phép thực hiện yêu cầu.";
            case "312005":
                return "Mã không tồn tại.";
            case "312008":
                return "Administrator không tồn tại.";
            case "312009":
                return "Mã đăng nhập của tài khoản hệ thống đã tồn tại.";
            case "312010":
                return "Mã đăng nhập của tài khoản hệ thống không tồn tại.";
            case "312011":
                return "Mật khẩu cũ vào không đúng.";
            case "312017":
                return "Quản trị không có quyền hoạt động trên thuê bao.";
            case "313001":
                return "Mã trả về không tồn tại.";
            case "313002":
                return "Dừng lại một vài tác vụ có lỗi.";
            case "313003":
                return "Nhận lại một vài tác vụ có lỗi.";
            case "313004":
                return "Sửa chưa các tác vụ tại thời điểm hoạt động bị lỗi.";
            case "314001":
                return "Tên tham số không tồn tại.";
            case "314002":
                return "Tên mới của biến không tuân theo yêu cầu đăng nhập.";
            case "314003":
                return "Tham số cập nhật không tồn tại.";
            case "314004":
                return "Kiểu tham số hàm gọi không tồn tại.";
            case "314005":
                return "Lỗi xử lý database";
            case "314006":
                return "Mục cấu hình đã tồn tại";
            case "314007":
                return "Tham số vào không đúng hoặc không đúng với qui tắc cấu hình.";
            case "314008":
                return "Hệ thống lỗi để cập nhật cấu hình";
            case "315001":
                return "Danh sách xếp hạng không tồn tại";
            case "315002":
                return "Vào vị trí của bảng xếp hạng sai.";
            case "315003":
                return "Nội dung của một bảng xếp hạng bị sai.";
            case "315004":
                return "Bảng xếp hạng bị trùng đè.";
            case "315005":
                return "Bảng xếp hàng không thể bị xóa";
            case "315006":
                return "Một vài RBTs có chung một vị trí trong bảng xếp hạng.";
            case "315007":
                return "Một bảng xếp hạng có hiệu lực sớm hơn thời gian hiện tại.";
            case "316001":
                return "Một phiên yêu cầu tồn tại.";
            case "316002":
                return "Không có RBT tương ứng trong bảng xếp hạng.";
            case "316003":
                return "Mã RBT không tồn tại.";
            case "316004":
                return "RBT được kích hoạt không tồn tại hoặc ở trạng thái lỗi.";
            case "317001":
                return "Thuê bao không yêu cầu dịch vụ.";
            case "317002":
                return "Thuê bao bị lỗi không thể khởi tạo dịch vụ.";
            case "317003":
                return "Thuê bao chưa kích hoạt dịch vụ thêm.";
            case "317004":
                return "Thuê bao đang ở trạng thái lỗi và không thể hủy dịch vụ.";
            case "317006":
                return "RBT không phải là RBT plus.";
            case "317007":
                return "Bộ sưu tập cá nhân đã vượt quá mức cho phép";
            case "317008":
                return "Thuê bao không được phép tải RBT – plus lên hệ thống.";
            case "317010":
                return "Sau khi RBT plus được chấp thuận, RBT tải về lỗi.";
            case "318004":
                return "Bạn không thể xóa hoặc sửa các trường đang đợi chấp thuận.";
            case "319003":
                return "Luật không thể áp dùng cho dịch vụ thông tin.";
            case "319004":
                return "Luật này không thể áp dụng cho hàm dịch vụ này.";
            case "319005":
                return "Dịch vụ được yêu cầu nên không xóa được.";
            case "319006":
                return "Dịch vụ chưa hoàn tất nên không thể tải về được.";
            case "319008":
                return "Luật phí dịch vụ đã tồn tại.";
            case "319009":
                return "Dịch vụ đã tồn tại";
            case "319010":
                return "Luật cho dịch vụ đã tồn tại.";
            case "319011":
                return "Dịch vụ không tồn tại hoặc đang bị ẩn.";
            case "319012":
                return "Luật cho dịch vụ không tồn tại.";
            case "319013":
                return "Chính sách thu tiền không tồn tại.";
            case "319014":
                return "Mô tả của chính sách thu tiền không tồn tại.";
            case "319015":
                return "Thuê bao không dùng dịch vụ không tồn tại.";
            case "319016":
                return "Thuê bao dùng dịch vụ không tồn tại.";
            case "319017":
                return "Thuê bao vừa yêu cầu dùng dịch vụ.";
            case "319018":
                return "Chức năng này đưuợc yêu cầu lại.";
            case "319019":
                return "Cờ thời gian khác nhau.";
            case "319020":
                return "Chính sách thu tiền đã tồn tại.";
            case "319021":
                return "Số lượng thuê bao yêu cầu dịch vụ vượt quá giới hạn.";
            case "319022":
                return "Thuê bao không thể gọi dịch vụ do sô thuê bao không nằm trong dải số cho phép.";
            case "320001":
                return "Thuê bao yêu cầu dịch vụ gọi đến.";
            case "320002":
                return "Thuê bao không yêu cầu dịch vụ gọi đến.";
            case "321001":
                return "Các cài đặt liên quan đến số thuê bao đã tồn tại.";
            case "321002":
                return "Cài đặt RBT của thuê bao không tồn tại.";
            default:
                return "Hệ thống đang bận! Vui lòng thử lại sau!";
        }
    }

    public function getCrbtCode($type) {
        $msg = [
            'addSubscribeReverse' => [
                '301006' => 'Đăng ký dịch vụ Reverse không thành công do đang sử dụng dịch vụ Reverse',
                '200002' => 'Đăng ký dịch vụ Reverse không thành công do gói cước thuê bao đang sử dụng không hợp lệ (Không phải gói tuần, ngày, plus)',
                '301001' => 'Đăng ký dịch vụ Reverse không thành công do thuê bao chưa đăng ký CRBT',
                '301015' => 'Đăng ký dịch vụ Reverse không thành công do thuê bao đang ở trạng thái hủy dịch vụ CRBT',
            ],
            'unSubscribeReverse' => [
                '301001' => 'Hủy dịch vụ Reverse không thành công do thuê bao chưa đăng ký dịch vụ CRBT hoặc Reverse',
                '301015' => 'Hủy dịch vụ Reverse không thành công do thuê bao đang ở trạng thái hủy dịch vụ CBRT',
            ]
        ];
        if ($msg[$type][$this->code]) {
            return $msg[$type][$this->code];
        } else {
            switch ($this->code) {
                case "000000":
                    return "Thực hiện thành công!";
                case "301009":
                    return "Đăng ký không thành công do đã đăng ký IMUZIK Plus";
                case "310010":
                    return "Đăng ký không thành công do tài khoản không đủ tiền";
                case "301505":
                    return "Đăng ký không thành công do thuê bao thuộc Blacklist hoặc Homephone";
                case "100006":
                    return "Đăng ký không thành công do lỗi kết nối hệ thống";
                case '301006':
                    return 'Đăng ký dịch vụ Nhạc chờ cá nhân không thành công do đang sử dụng dịch vụ Nhạc chờ cá nhân';
                case '200002':
                    return 'Đăng ký dịch vụ Nhạc chờ cá nhân không thành công do gói cước thuê bao đang sử dụng không hợp lệ (Không phải gói tuần, ngày, plus)';
                case '301001':
                    return 'Thực hiện không thành công do thuê bao chưa đăng ký dịch vụ nhạc chờ';
                case '301015':
                    return 'Thực hiện không thành công do thuê bao đang ở trạng thái hủy dịch vụ nhạc chờ';
                default:
                    return $this->getErrVN();
            }
        }
    }

}

?>
