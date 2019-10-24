<div class="modal-header">
    <h5 class="modal-title" id="NavbarModalLabel"><i class="fas fa-user-edit"></i> สมัครสมาชิก</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <form id="register">
        <div class="form-group">
            <label for="email"><b>อีเมล</b></label>
            <input type="email" class="form-control" name="email" id="email" aria-describedby="helpId" placeholder="example@example.com" required>
            <div class="text-danger" id="used_email" style="display:none;">
                <small>อีเมลนี้มีคนใช้แล้ว</small>
            </div>
            <div class="text-danger" id="email_invalid" style="display:none;">
                <small>รูปแบบ อีเมล ไม่ถูกต้อง</small>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-6 col-md-6 col-12">
                <div class="form-group">
                    <label for="firstname"><b>ชื่อ</b></label>
                    <input type="text" class="form-control" name="firstname" id="firstname" aria-describedby="helpId" placeholder="ชื่อ" required>
                </div>
            </div>
            <div class="col-xl-6 col-md-6 col-12">
                <div class="form-group">
                    <label for="lastname"><b>นามสกุล</b></label>
                    <input type="text" class="form-control" name="lastname" id="lastname" aria-describedby="helpId" placeholder="นามสกุล" required>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="password"><b>รหัสผ่าน</b></label>
            <input type="password" class="form-control" name="password" id="password" aria-describedby="helpId" placeholder="รหัสผ่าน" required>
        </div>
        <div class="form-group">
            <label for="re_password"><b>รหัสผ่านอีกครั้ง</b></label>
            <input type="password" class="form-control" name="re_password" id="re_password" aria-describedby="helpId" placeholder="รหัสผ่านอีกครั้ง" required>
            <div class="text-danger" id="same_pass" style="display:none;">
                <small>รหัสผ่านไม่ตรงกัน</small>
            </div>
        </div>
        <div class="form-group text-center">
            <a class="btn btn-primary w-100 text-light" onclick="regis_btn()" style="cursor:pointer;"><i class="fas fa-user-edit"></i> สมัครสมาชิก</a>
        </div>
    </form>
    <div class="form-group text-center">
        <a href="javascript:func_call_nav_login()"><i class="fas fa-sign-in-alt"></i> มีบัญชีผู้ใช้แล้ว</a>
    </div>
</div>
<script>
$(document).ready(function() {
    $('#email').keyup(function() {
        var email = $(this).val();
        if (emailIsValid(email)) {
            $(this).removeClass("is-invalid");
            $('#email_invalid').hide();
        } else {
            $(this).addClass("is-invalid");
            $('#email_invalid').show();
        }
        $('#used_email').hide();
    });
    $('input').keyup(function() { // Check Auto this val != "" removeclass invalid
        if ($(this).val() == "") {
            $(this).addClass("is-invalid");
        } else {
            $(this).removeClass("is-invalid");
        }
    });
    $('#re_password').keyup(function() { // Check Same password Auto
        var pass = $('#password').val();
        var re_pass = $(this).val();
        if (pass == re_pass) {
            $(this).removeClass("is-invalid");
        } else {
            $(this).addClass("is-invalid");
        }
    });
});
</script>
