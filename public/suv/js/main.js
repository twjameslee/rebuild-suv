/**
 * Created by James on 2016/5/7.
 */

$(function() {

    var data = {

        //使用者資料
        user: {
            uid:            '',     // retake system user id
            name:           '',
            class:          '',
            seatno:         '',
            email:          '尚未登入',
            attend:         0,      //參加
            gid:            '',     //google user id
            gid_token:      '',
            thumbnailUrl:   ''
        },

        //辦理梯次
        op_no: '????',

        //本梯次需重補修科目
        subjects: [],

        //勾選的科目
        selected_subj_id: [],

        //不參加
        chkOpt_out: false,
    };

    var vm = new Vue({
        el: '#vm',
        data: data,

        computed: {
            userInfo: function() {
              return this.user.class + ' ' + this.user.seatno + '號 ' + this.user.name;
            },
        },

        methods: {
            onSubmit: function (e) {

                var subjects_WBU = [];
                var IDs = this.selected_subj_id;

                this.subjects.map( function(subj){

                    if (IDs.indexOf(subj.id) > -1) {  //目前有勾選
                        if (subj.selected !== 1)   //可是原來沒選，所以要更新
                            subjects_WBU.push({ id: subj.id, selected: 1 });

                    } else {                            //目前沒勾選
                        if (subj.selected == 1)      //可是原來有選，也是要更新
                            subjects_WBU.push({ id: subj.id, selected: 0 });

                    }
                });

                //上傳選擇結果
                $.ajax({

                    type: "POST",
                    url: base_url + 'index.php/suv/updSubjects',
                    data: {
                        stu_id: this.user.uid,
                        attend: this.chkOpt_out ? 2 : 1,
                        subjects_WBU: subjects_WBU
                    },
                    dataType: 'json',
                    success: function (o) {

                        if (o.result == 1) {
                            showMessage('成功更新 ' + o.data + ' 筆選修科目');

                        } else {
                            showMessage(o.error);
                        }

                    }

                });

                //上傳成功後，進行「目前勾選的」與「從伺服器下載的」同步
                this.subjects.map( function(subj){

                    if (IDs.indexOf(subj.id) > -1)
                        subj.selected = 1;
                    else
                        subj.selected = 0;

                });

            },

            onAttendClick: function (e) {

                vm.chkOpt_out = !vm.chkOpt_out;
                if(vm.chkOpt_out) vm.selected_subj_id = [];

            },

            other_method: function() {

            },
        },

    });

    function renderButton() {
        gapi.signin2.render('signIn-btn', {
            scope: 'profile',
            width: 200,
            height: 40,
            longtitle: true,
            theme: 'dark',
            onsuccess: onLogin,     // pass googleUser Object
            onfailure: showError
        });
    }

    function onLogin(gUser) {

        getUserProfile(gUser);
        getUserInfo();
        getOpSubject();

    }

    function getUserProfile(googleUser) {

        var profile = googleUser.getBasicProfile();

        vm.user.gid_token = googleUser.getAuthResponse().id_token;
        vm.user.gid = profile.getId();
        vm.user.email = profile.getEmail();
        vm.user.uid = vm.user.email.split('@')[0];
        vm.user.thumbnailUrl = profile.getImageUrl();

    }

    function getUserInfo() {

        $.ajax({

            type: "POST",
            url: base_url + 'index.php/suv/getOpStudent',
            data: { stu_id: vm.user.uid },
            dataType: 'json',

            success: function(o) {

                if (o.result == 1) {
                    var u = o.data[0];
                    vm.user.name = u.sname;
                    vm.user.class = u.class;
                    vm.user.seatno = u.seatno;
                    vm.chkOpt_out = (u.attend==2);
                    vm.op_no = u.op_no;

                } else {
                    //Result.error(o.error);
                    showMessage("你不是本梯次需要重修的學生，有問題請洽實研組!!");

                }

            }

        });

    }

    function getOpSubject() {

        $.ajax({
            type: "POST",
            url: base_url + 'index.php/suv/getOpSubject',
            data: {stu_id: vm.user.uid},
            dataType: 'json',
            success: function(o) {
                if (o.result == 1) {
                    vm.subjects = o.data;
                    var IDs = [];
                    vm.subjects.map(function(subj) {
                        if (subj.selected == 1) IDs.push(subj.id);
                    });
                    vm.selected_subj_id = IDs;
                } else
                    showError("從伺服器讀取您的需重補修科目發生問題!!\n" + o.error);
            }
        });

    }

    function showError(error) {

        console.log(error);
        alert('哦哦…發生錯誤了：\n' + error);

    }

    function showMessage(msg) {

        alert(msg);

    }

    // ------------------------------------------------------------

    //user.uid = $.getUrlVar('UID');
    //data.opName = $.getUrlVar('opName');

    renderButton();

});
