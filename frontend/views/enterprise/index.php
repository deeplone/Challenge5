<section class="mdl mdl-recording">
    <!-- Content 1 -->
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="row-top">
                    <h3 class="ttl">Mời quý khách lựa chọn</h3>
                </div>
                <div class="ctn ctn-1">
                    <div class="row justify-content-md-center">
                        <div class="col-md-6">
                            <?php if($type == 'new') {?>
                            <a href="/enterprise/voice?type=new">
                            <?php } else { ?>
                                <a href="/enterprise/voice?type=paid">
                            <?php } ?>
                                <div class="btn btn-blue-aqua rounded-pill btn-block">
                                    <div class="state">
                                        <span>Thu âm online tại web</span>
                                    </div>
                                </div>
                            </a>
                            <p class="txt1">Viettel cung cáp các mẫu quảng cáo có sẵn hoặc khách hàng có thể nhập nội dung nhạc chờ quảng cáo muốn thu âm, hệ thống sẽ tự động chuyển thành nội dung voice để làm nhạc chờ. Phí dịch vụ: 0 đồng</p>
                        </div>
                    </div>
                    <div class="row justify-content-md-center">
                        <div class="col-md-6">
                            <?php if($type == 'new') {?>
                            <a href="/enterprise/register1?type=new">
                            <?php } else { ?>
                                <a href="/enterprise/register1?type=paid">
                            <?php } ?>
                                <div class="btn btn-blue-aqua rounded-pill btn-block">
                                    <!-- <div class="pretty p-icon p-round p-pulse">
                                    <input type="radio" name="record"> -->
                                    <div class="state">
                                        <!-- <i class="icon mdi mdi-check"></i> -->
                                        <span>Thu âm tại phòng thu</span>
                                    </div>
                                    <!-- </div> -->
                                </div>
                            </a>
                            <p class="txt1">Viettel cung cấp dịch vụ thu âm chất lượng cao tại phòng thu với cước phí 500.000 đ/nội dung. Khách hàng sẽ được nghe và
                                duyệt nội dung quảng cáo trước khi tạo mã nhạc chờ trên hệ thống. Phí dịch vụ: 500.000 đồng</p>
                        </div>
                    </div>
                    <div class="row justify-content-md-center">
                        <div class="col-md-6">
                        <?php if($type == 'new') {?>
                            <a href="/enterprise/register2?type=new">
                            <?php } else { ?>
                                <a href="/enterprise/register2?type=paid">
                            <?php } ?>
                                <div class="btn btn-blue-aqua rounded-pill btn-block">
                                    <!-- <div class="pretty p-icon p-round p-pulse">
                                    <input type="radio" name="record"> -->
                                    <div class="state">
                                        <!-- <i class="icon mdi mdi-check"></i> -->
                                        <span>Đã có file thu âm</span>
                                    </div>
                                    <!-- </div> -->
                                </div>
                            </a>
                            <p class="txt1">Viettel tạo nhạc chờ dựa trên file thu âm nội dung quảng cáo doanh nghiệp cung cấp. Định dạng file yêu cầu là .mp3. Thời
                                lượng đảm bảo của file nhạc trên hệ thống là từ 30 đến 43 giây. Phí dịch vụ: 0 đồng</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>