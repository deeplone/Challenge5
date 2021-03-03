<h4 class="txt-welcome">Mời quý khách hoàn thành hồ sơ đăng ký</h4>
<div class="frm-content">
    <div class="form-group row">
        <div class="col-sm-3">
            <div class="pretty p-icon  p-jelly">
                <input type="radio" name="cbx_step" value="_form1" onclick="toStep(3);" <?php echo ($step == 3) ? 'checked="checked"' : '' ?>/>
                <div class="state">
                    <i class="icon mdi mdi-checkbox-marked-outline"></i>
                    <label> Thu âm online trên web</label>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="pretty p-icon  p-jelly">
                <input type="radio" name="cbx_step" value="_form1" onclick="toStep(1);" <?php echo ($step == 1) ? 'checked="checked"' : '' ?>/>
                <div class="state">
                    <i class="icon mdi mdi-checkbox-marked-outline"></i>
                    <label> Thu âm qua phòng thu</label>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="pretty p-icon  p-jelly">
                <input type="radio" name="cbx_step" value="_form2" onclick="toStep(2);" <?php echo ($step == 2) ? 'checked="checked"' : '' ?>/>
                <div class="state">
                    <i class="icon mdi mdi-checkbox-marked-outline"></i>
                    <label> Sử dụng file thu âm nhạc chờ có sẵn</label>
                </div>
            </div>
        </div>        
    </div>
</div>