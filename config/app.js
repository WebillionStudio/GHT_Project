/* ***** Global Function ***** */
function loading_func(ele) {
    if (ele == "") {
        ele = "กำลังโหลด";
    }
    $('body').loadingModal({
        position: 'auto',
        text: ele,
        color: '#fff',
        opacity: '0.7',
        backgroundColor: 'rgb(0,0,0)',
        animation: 'circle'
    });
    // $('body').loadingModal('destroy');
}
function emailIsValid(email) {
    return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)
}
/* ***** Global Function ***** */

/* ***** Menu ***** */
function create_menu_btn(){
    var menu_name           =   $('#Menu_Name').val();
    var menu_price          =   $('#Menu_Price').val();
    var res_id              =   $('#res_id').val();
    if(menu_name==""){
        $('#Menu_Name').focus();
        $('#Menu_Name').addClass("is-invalid");
    }else{
        if(menu_price==""){
            $('#Menu_Price').focus();
            $('#Menu_Price').addClass("is-invalid");
        }else{
            $('#modal_create_menu').modal('hide');
            loading_func('กำลังเพิ่มเมนู');
            $.post('./database/menu.php', {
                type: "add",
                menu_name: menu_name,
                menu_price: menu_price,
                res_id:res_id
            }, function (callback) {
                if(callback=="Success"){
                    Swal.fire({
                        position: 'center',
                        type: 'success',
                        title: 'เพิ่มเมนูสำเร็จ',
                        showConfirmButton: false,
                        timer: 1500
                    });
                    $('body').loadingModal('destroy');
                    setTimeout(function(){ func_menu_conf_restaurant('restaurant_menu') }, 1500);
                }else if(callback=="Error_Query"){
                    Swal.fire({
                        position: 'center',
                        type: 'error',
                        title: 'เพิ่มเมนูสำเร็จไม่สำเร็จ',
                        text: 'กรุณาตรวจสอบการเชื่อมต่อ',
                        showConfirmButton: false,
                        timer: 1500
                    });
                    $('body').loadingModal('destroy');
                }else{
                    console.log('create_res[Callback]::' + callback);
                    $('body').loadingModal('destroy');
                    return;
                }
            });
        }
    }
}
function func_conf_menu(e){
    var Menu_id =   $(e).attr('data-id');
    $('#load_conf_menu').load("./views/config_restaurant/modal_conf_menu.php",{Menu_id:Menu_id},function(){
        $('#modal_config_menu').modal('show');
    });
}
function save_menu_btn(e){
    var Menu_id     =   $(e).attr('data-id');
    var Menu_Name   =   $('#Menu_Name_conf').val();
    var Menu_Price  =   $('#Menu_Price_conf').val();
    if(Menu_Name==""){
        $('#Menu_Name_conf').focus();
        $('#Menu_Name_conf').addClass("is-invalid");
    }else{
        if(Menu_Price==""){
            $('#Menu_Price_conf').focus();
            $('#Menu_Price_conf').addClass("is-invalid");
        }else{
            $('#modal_config_menu').modal('hide');
            loading_func('กำลังแก้ไขเมนู');
            $.post('./database/menu.php', {
                type: "config",
                Menu_Name: Menu_Name,
                Menu_Price: Menu_Price,
                Menu_id:Menu_id
            }, function (callback) {
                if(callback=="Success"){
                    Swal.fire({
                        position: 'center',
                        type: 'success',
                        title: 'แก้ไขเมนูสำเร็จ',
                        showConfirmButton: false,
                        timer: 1500
                    });
                    $('body').loadingModal('destroy');
                    setTimeout(function(){ func_menu_conf_restaurant('restaurant_menu') }, 1500);
                }else if(callback=="Error_Query"){
                    Swal.fire({
                        position: 'center',
                        type: 'error',
                        title: 'แก้ไขเมนูสำเร็จไม่สำเร็จ',
                        text: 'กรุณาตรวจสอบการเชื่อมต่อ',
                        showConfirmButton: false,
                        timer: 1500
                    });
                    $('body').loadingModal('destroy');
                }else{
                    console.log('create_res[Callback]::' + callback);
                    $('body').loadingModal('destroy');
                    return;
                }
            });
        }
    }
}
function func_del_menu(e){
    var Menu_id = $(e).attr('data-id');
    Swal.fire({
        title: 'แนใจที่หรือไม่?',
        text: "คุณแน่ใจที่จะลบเมนูอาหารนี้",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'ตกลง',
        cancelButtonText: 'ยกเลิก'
      }).then((result) => {
        if (result.value) {
            loading_func('กำลังลบไขเมนู');
            $.post('./database/menu.php', {
                type: "del",
                Menu_id:Menu_id
            }, function (callback) {
                if(callback=="Success"){
                    Swal.fire({
                        position: 'center',
                        type: 'success',
                        title: 'ลบเมนูสำเร็จ',
                        showConfirmButton: false,
                        timer: 1500
                    });
                    $('body').loadingModal('destroy');
                    setTimeout(function(){ func_menu_conf_restaurant('restaurant_menu') }, 1500);
                }else if(callback=="Error_Query"){
                    Swal.fire({
                        position: 'center',
                        type: 'error',
                        title: 'ลบเมนูสำเร็จไม่สำเร็จ',
                        text: 'กรุณาตรวจสอบการเชื่อมต่อ',
                        showConfirmButton: false,
                        timer: 1500
                    });
                    $('body').loadingModal('destroy');
                }else{
                    console.log('create_res[Callback]::' + callback);
                    $('body').loadingModal('destroy');
                    return;
                }
            });
        }
      })
}
/* ***** Menu ***** */

/* ***** restaurant ***** */
function func_call_restaurant_create(){
    $('#show_modal_restaurant').load("./views/restaurant/create_restaurant.php",function(){
        $('#modal_restaurant').modal('show');
    });
}
function create_res_btn() {
    var name            =   $('#restaurant_name').val();
    var description     =   $('#restaurant_description').val();
    var sel_area        =   $('#sel_area').val();
    if (name == "") {
        $('#restaurant_name').focus();
        $('#restaurant_name').addClass("is-invalid");
    } else {
        loading_func('กำลังสร้างร้านอาหาร');
        $.post('./database/restaurant.php', {
            type: "add",
            name: name,
            description: description,
            area:sel_area
        }, function (callback) {
            if(callback=="Success"){
                Swal.fire({
                    position: 'center',
                    type: 'success',
                    title: 'สร้างร้านอาหารสำเร็จ',
                    showConfirmButton: false,
                    timer: 1500
                });
                $('#modal_restaurant').modal('hide');
                func_load_my_restaurant();
                $('body').loadingModal('destroy');
            }else if(callback=="Error_Query"){
                Swal.fire({
                    position: 'center',
                    type: 'error',
                    title: 'สร้างร้านอาหารไม่สำเร็จ',
                    text: 'กรุณาตรวจสอบการเชื่อมต่อ',
                    showConfirmButton: false,
                    timer: 1500
                });
                $('body').loadingModal('destroy');
            }else{
                console.log('create_res[Callback]::' + callback);
                $('body').loadingModal('destroy');
                return;
            }
        });
    }
}
function del_res_btn(){
    var res_id  =   $('#res_id').val();
    Swal.mixin({
        input: 'password',
        confirmButtonText: 'ตกลง',
        cancelButtonText: 'ยกเลิก',
        showCancelButton: true
    }).queue([
    'กรอกรหัสผ่านเพื่อยืนยันการลบ'
    ]).then((result) => {
        if (result.value[0]) {
            loading_func('กำลังโหลดตรวจสอบรหัสผ่าน');
            $.post('./database/check_confirm_pass.php',{pass:result.value[0]},function(callback){
                if (callback == "Success") { // Success
                    $('body').loadingModal('destroy');
                    Swal.fire({
                        position: 'center',
                        type: 'success',
                        title: 'รหัสผ่านตรงกัน',
                        text: 'รอสักครู่...',
                        showConfirmButton: false,
                        timer: 1500
                    });
                    setTimeout(function(){
                        loading_func('กำลังลบร้านอาหาร');
                        $.post('./database/restaurant.php', {
                            type: "del",
                            res_id: res_id
                        }, function (callback) {
                            if(callback=="Success"){
                                $('body').loadingModal('destroy');
                                Swal.fire({
                                    position: 'center',
                                    type: 'success',
                                    title: 'ลบร้านอาหารสำเร็จ',
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                                setTimeout(function(){ window.location.reload(true); }, 1500);
                            }else if(callback=="Error_Query"){
                                Swal.fire({
                                    position: 'center',
                                    type: 'error',
                                    title: 'ลบร้านอาหารไม่สำเร็จ',
                                    text: 'กรุณาตรวจสอบการเชื่อมต่อ',
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                                $('body').loadingModal('destroy');
                            }else{
                                console.log('del_res[Callback]::' + callback);
                                $('body').loadingModal('destroy');
                                return;
                            }
                        });
                    }, 1500);
                } else if (callback == "Error") { // Success
                    Swal.fire({
                        position: 'center',
                        type: 'error',
                        title: 'รหัสผ่านไม่ตรงกัน',
                        showConfirmButton: false,
                        timer: 1500
                    });
                    $('body').loadingModal('destroy');
                    return;
                } else { // Other
                    console.log('Check_pass[Callback]::' + callback);
                    $('body').loadingModal('destroy');
                    return;
                }
            });
        }
    })
}
function func_load_my_restaurant(){
    loading_func('กำลังโหลด ร้านอาหาร');
    $('#show_restaurant_list').load('./views/restaurant/myrestaurant_list.php',function(callback){
        $('body').loadingModal('destroy');
    });
}
function change_show_restaurant(e){
    var res_id  =   $(e).attr('data-id');
    if ($(e).is(':checked')) {
        // alert('check');
        var check = '1';
    }else{
        // alert('uncheck');
        var check = '0';
    }
    $.post("./database/restaurant.php",{type:"check",check:check,res_id:res_id},function(callback){
        if(callback=="Success"){
            $('body').loadingModal('destroy');
            func_menu_conf_restaurant('restaurant_config');
        }else if(callback=="Error_Query"){
            Swal.fire({
                position: 'center',
                type: 'error',
                title: 'เปลี่ยนสถานะไม่สำเร็จ',
                text: 'กรุณาตรวจสอบการเชื่อมต่อ',
                showConfirmButton: false,
                timer: 1500
            });
            $('body').loadingModal('destroy');
        }else{
            console.log('create_res[Callback]::' + callback);
            $('body').loadingModal('destroy');
            return;
        }
    });
}
/* ***** restaurant ***** */

// ***** restaurant *****
function func_accept_rating(e){
    var star    = $(e).attr('data-id');
    var res     = $('#res_id').val();
    $.post("./database/rating.php", {
        type: "add",
        star: star,
        res: res
    }, function(callback) {
        if (callback == "Success") {
            Swal.fire({
                position: 'center',
                type: 'success',
                title: 'ขอบคุณที่ให้เรตติ้งร้านอาหาร',
                showConfirmButton: false,
                timer: 1500
            });
            $('body').loadingModal('destroy');
            setTimeout(function(){ window.location.reload(true); }, 1500);
        } else if (callback == "Error_Query") {
            Swal.fire({
                position: 'center',
                type: 'error',
                title: 'ให้เรตติ้งไม่สำเร็จ',
                text: 'กรุณาตรวจสอบการเชื่อมต่อ',
                showConfirmButton: false,
                timer: 1500
            });
            $('body').loadingModal('destroy');
        } else {
            console.log('create_res[Callback]::' + callback);
            $('body').loadingModal('destroy');
            return;
        }
    });
}
function func_cancel_rating(e){
    var rating_id     = $(e).attr('data-id');
    $.post("./database/rating.php", {
        type: "del",
        rating_id: rating_id
    }, function(callback) {
        if (callback == "Success") {
            $('body').loadingModal('destroy');
            setTimeout(function(){ window.location.reload(true); }, 1500);
        } else if (callback == "Error_Query") {
            Swal.fire({
                position: 'center',
                type: 'error',
                title: 'ให้เรตติ้งไม่สำเร็จ',
                text: 'กรุณาตรวจสอบการเชื่อมต่อ',
                showConfirmButton: false,
                timer: 1500
            });
            $('body').loadingModal('destroy');
        } else {
            console.log('create_res[Callback]::' + callback);
            $('body').loadingModal('destroy');
            return;
        }
    });
}
function func_add_bookmark(){
    loading_func('กำลังเพิ่มบุ๊กมาร์ค');
    $.post("./database/bookmark.php",{type:"add",res_id:$('#res_id').val()},function(callback){
        if (callback == "Success") { // Success
            Swal.fire({
                position: 'center',
                type: 'success',
                title: 'เพิ่มร้านอาหารบุ๊กมาร์คแล้ว',
                showConfirmButton: false,
                timer: 1500
            });
            $('body').loadingModal('destroy');
            setTimeout(function(){ window.location.reload(true); }, 1500);
        } else if (callback == "Error") { // Success
            Swal.fire({
                position: 'center',
                type: 'error',
                title: 'เพิ่มร้านอาหารบุ๊กมาร์คไม่สำเร็ข',
                text: 'กรุณาตรวจสอบการเชื่อมต่อ',
                showConfirmButton: false,
                timer: 1500
            });
            $('body').loadingModal('destroy');
            return;
        } else { // Other
            console.log('Login[Callback]::' + callback);
            $('body').loadingModal('destroy');
            return;
        }
    });
}
function func_del_bookmark(e){
    loading_func('กำลังลบบุ๊กมาร์ค');
    $.post("./database/bookmark.php",{type:"del",book_id:$('#bookmark_id').val()},function(callback){
        if (callback == "Success") { // Success
            Swal.fire({
                position: 'center',
                type: 'success',
                title: 'ลบร้านอาหารบุ๊กมาร์คแล้ว',
                showConfirmButton: false,
                timer: 1500
            });
            $('body').loadingModal('destroy');
            setTimeout(function(){ window.location.reload(true); }, 1500);
        } else if (callback == "Error") { // Success
            Swal.fire({
                position: 'center',
                type: 'error',
                title: 'เพิ่มร้านอาหารบุ๊กมาร์คไม่สำเร็ข',
                text: 'กรุณาตรวจสอบการเชื่อมต่อ',
                showConfirmButton: false,
                timer: 1500
            });
            $('body').loadingModal('destroy');
            return;
        } else { // Other
            console.log('Login[Callback]::' + callback);
            $('body').loadingModal('destroy');
            return;
        }
    });
}

function func_menu_conf_restaurant(e){
    var res_id  =   $('#res_id').val();
    loading_func('กำลังโหลด');
    $('#show_config').load('./views/config_restaurant/'+e+'.php',{
        res_id  :   res_id
    },function(){
        $('body').loadingModal('destroy');
    });
}
function func_conf_restaurant(e){
    loading_func('กำลังโหลด');
    $('#show_restaurant_config').load('./views/config_restaurant/config_restaurant.php',{
        res_id  :   e
    },function(){
        $('body').loadingModal('destroy');
        func_menu_conf_restaurant('restaurant_data');
    });
}

function func_save_conf_res_data(e){
    var res_id  =   $(e).attr('data-id');
    $.post("./database/restaurant.php", {type:"update",type_update:"res_data",res_id:res_id,data:$("#form_res_data").serializeArray()}).done(function(callback){
        if (callback == "Success") { // Success
            Swal.fire({
                position: 'center',
                type: 'success',
                title: 'แก้ไขข้อมูลร้านอาหารสำเร็จ',
                showConfirmButton: false,
                timer: 1500
            });
            $('body').loadingModal('destroy');
            func_conf_restaurant(res_id);
        } else if (callback == "Error_Query") { // Success
            Swal.fire({
                position: 'center',
                type: 'error',
                title: 'แก้ไขไม่สำเร็จ',
                text: 'กรุณาตรวจสอบการเชื่อมต่อ',
                showConfirmButton: false,
                timer: 1500
            });
            $('body').loadingModal('destroy');
        } else { // Other
            console.log('Login[Callback]::' + callback);
            $('body').loadingModal('destroy');
            return;
        }
    });
}

// ***** searchengine *****
function search() {
    var area_id     = $('#sel_area').val();
    var search_text = $('#search_text').val();
    var price       = $('#price_range').val();
    var res_type    = $('#sel_res_type').val();
    loading_func('กำลังค้นหา');
    $('#search_result_area').load('./views/restaurant/search_result.php',
    {
        area_id : area_id,
        search_text : search_text,
        price : price,
        res_type : res_type
    },function(callback){
        $('body').loadingModal('destroy');
    });
}
// ***** searchengine *****

// ***** navbar *****
function func_call_nav_modal() {
    $('#show_nav_modal').load('./views/navbar/login.php', function () {
        $('#NavbarModal').modal('show');
    });
}
function func_call_nav_login() {
    $('#show_nav_modal').load('./views/navbar/login.php');
}
function func_call_nav_regis() {
    $('#show_nav_modal').load('./views/navbar/register.php');
}
function func_call_nav_fgpass() {
    $('#show_nav_modal').load('./views/navbar/forgetpass.php');
}
function regis_btn() { // Register Button
    var email = $('#email').val();
    var fname = $('#firstname').val();
    var lname = $('#lastname').val();
    var pass = $('#password').val();
    var re_pass = $('#re_password').val();
    var ck_field = 0;
    $('form#register').find('input').each(function () { // Check null field :: Add invalid
        if ($(this).val() == "") {
            $(this).focus();
            $(this).addClass("is-invalid");
            ck_field++;
        } else {
            $(this).focus();
            $(this).removeClass("is-invalid");
        }
    });
    if (ck_field > 0) { // Check null field
        Swal.fire({
            position: 'center',
            type: 'warning',
            title: 'สมัครไม่สำเร็จ',
            text: 'กรุณากรอกรายละเอียดให้ครบ',
            showConfirmButton: false,
            timer: 1500
        });
        return;
    } else {
        if (emailIsValid(email) == false) { // Format email false
            $('#email').focus();
            $('#email').addClass("is-invalid");
            $('#email_invalid').show();
            return;
        }
        if (pass == re_pass) { // Check Same Password
            loading_func('กำลังเข้าสู่ระบบ');
            $(this).removeClass("is-invalid");
            $.post('./database/register.php', {
                email: email,
                fname: fname,
                lname: lname,
                pass: pass
            },
                function (callback) {
                    if (callback == "Error_Email") { // Error Email
                        Swal.fire({
                            position: 'center',
                            type: 'error',
                            title: 'สมัครไม่สำเร็จ',
                            text: 'อีเมลมนี้ผู้ใช้แล้ว',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        $('#email').focus();
                        $('#email').addClass("is-invalid");
                        $('#used_email').show();
                        $('body').loadingModal('destroy');
                    } else if (callback == "Error_Query") { // Error Query
                        Swal.fire({
                            position: 'center',
                            type: 'error',
                            title: 'สมัครไม่สำเร็จ',
                            text: 'ไม่สามารถบันทึกได้',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        $('body').loadingModal('destroy');
                    } else if (callback == "Success") { // Success
                        Swal.fire({
                            position: 'center',
                            type: 'success',
                            title: 'สมัครสำเร็จ',
                            text: 'กรุณาเข้าสู่ระบบ',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        $('body').loadingModal('destroy');
                        func_call_nav_login();
                    } else { // Other
                        console.log('Register[Callback]::' + callback);
                        $('body').loadingModal('destroy');
                    }
                });
        } else {
            $('#re_password').addClass("is-invalid");
            return;
        }
    }
}
function login_btn() {
    var email = $('#email').val();
    var password = $('#password').val();
    if (email == "" || password == "") {
        Swal.fire({
            position: 'center',
            type: 'warning',
            title: 'เข้าสู่ระบบไม่สำเร็จ',
            text: 'กรุณากรอกข้อมูลให้ครบ',
            showConfirmButton: false,
            timer: 1500
        });
        if (email == "") {
            $("#email").focus();
        } else {
            $("#password").focus();
        }
        return;
    } else {
        loading_func('กำลังเข้าสู่ระบบ');
        $.post("./database/login.php", {
            email: email,
            password: password
        },
            function (callback) {
                if (callback == "Success") { // Success
                    Swal.fire({
                        position: 'center',
                        type: 'success',
                        title: 'เข้าสู่ระบบสำเร็จ',
                        // text: 'กรุณาเข้าสู่ระบบ',
                        showConfirmButton: false,
                        timer: 1500
                    });
                    $('#NavbarModal').modal('hide');
                    location.reload();
                } else if (callback == "Error") { // Success
                    Swal.fire({
                        position: 'center',
                        type: 'error',
                        title: 'เข้าสู่ระบบไม่สำเร็จ',
                        text: 'กรุณาตรวจสอบอีเมล และ รหัสผ่าน',
                        showConfirmButton: false,
                        timer: 1500
                    });
                    $('#email').focus();
                    $('body').loadingModal('destroy');
                    return;
                } else { // Other
                    console.log('Login[Callback]::' + callback);
                    $('body').loadingModal('destroy');
                    return;
                }
            });
    }
}
function logout_btn(){
    Swal.fire({
    title: 'แน่ใจหรือไม่?',
    text: "คุณต้องการจะออกจากระบบ ใช่ หรือ ไม่",
    type: 'warning',
    showCancelButton: true,
    cancelButtonColor: '#d33',
    cancelButtonText: 'ไม่',
    confirmButtonColor: '#3085d6',
    confirmButtonText: 'ใช่'
    }).then((result) => {
        if (result.value) {
            $.post('./database/logout.php',function(){
                location.reload();
            });
        }
    })
}
// ***** navbar *****
