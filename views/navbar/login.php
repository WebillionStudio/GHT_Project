<div class="modal-header">
    <h5 class="modal-title" id="NavbarModalLabel"><i class="fas fa-sign-in-alt"></i> เข้าสู่ระบบ</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <div class="form-group">
        <label for="email"><b>อีเมล</b></label>
        <input type="email" class="form-control" name="email" id="email" aria-describedby="helpId" placeholder="example@example.com">
    </div>
    <div class="form-group">
        <label for="password"><b>รหัสผ่าน</b></label>
        <input type="password" class="form-control" name="password" id="password" aria-describedby="helpId" placeholder="รหัสผ่าน">
    </div>
    <div class="form-group">
        <button class="btn btn-success w-100" onclick="login_btn()">
            <i class="fas fa-sign-in-alt"></i> เข้าสู่ระบบ
        </button>
    </div>
    <div class="form-group text-center">
        <a href="javascript:func_call_nav_regis()">
            <i class="fas fa-user-edit"></i> สมัครสมาชิก
        </a>
    </div>
    <p class="text-center">
        <a href="javascript:func_call_nav_fgpass()">
            <i class="fas fa-exclamation-triangle"></i> ลืมรหัสผ่าน
        </a>
    </p>
</div>
<script>
$(function(){
    $('#password').keypress(function(e) {
        var key = e.which;
        if (key == 13){
            login_btn();
            return false;
        }
  });
});
</script>
