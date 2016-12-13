/**
 * Created by James on 2016/5/7.
 */
"use strict";

var app = window.app = window.app || {};

$(function() {
    var _user = app.user = app.user || {
            id:             '',
            name:           '',
            email:          '',
            thumbnailUrl:   ''
    };

    function renderButton() {
        gapi.signin2.render('signIn-btn', {
            scope: 'profile',
            width: 240,
            height: 50,
            longtitle: true,
            theme: 'dark',
            onsuccess: onSuccess,
            onfailure: showError
        });
    }

    function onSuccess(googleUser) {
        var profile = googleUser.getBasicProfile();

        _user.id = profile.getId();
        //_user.id_token = googleUser.getAuthResponse().id_token;
        _user.name = profile.getName();
        _user.email = profile.getEmail();
        _user.thumbnailUrl = profile.getImageUrl();
        console.log('getId: ' + _user.id);
        console.log('Logged in as: ' + _user.name);
        console.log('Email: ' + _user.email);
        console.log('photoUrl: ' + _user.thumbnailUrl);
        $('#signIn-div').hide();
        $('#form-div').removeClass('hide_me');

        next();
    }




    function next() {
        queryData();
        querySubjects();
    }

    function onSubmit() {
        var chk_val = $('#chkdiv input[name="subj"]:checkbox:checked').map(function () {
            return $(this).val();
        }).get().join(',');
        $('#UID').attr('name', 'entry.1103021244').val(UID);
        $('#class').attr('name', 'entry.1974649373');
        $('#seatNo').attr('name', 'entry.755675225');
        $('#stuName').attr('name', 'entry.111372776');
        $('#subjs').attr('name', 'entry.2026888020').val(chk_val);
    }

    function queryData() {
        var query = new google.visualization.Query('https://docs.google.com/spreadsheets/d/1ZiL2PY1tgI8Zj4i356cVQjKG4PMdEcsSxZnihGtlXRI/gviz/tq?headers=1&sheet=個資');
        query.setQuery("select B,C,D where A='" + UID + "'"); // '9036219166'

        query.send(function (response) {
            if (response.isError()) {
                showError('Error in query: ' + response.getMessage() + ' ' + response.getDetailedMessage() + ' ' + response.getReasons());
                return;
            }
            var data = response.getDataTable();
            var rows = data.getNumberOfRows();
            if (rows !== 1) {
                showError('Error in query: UID or Google Spreadsheet Data Error');
                return;
            }
            $('#class').val(data.getValue(0, 0)).attr("readonly", "readonly");
            $('#seatNo').val(data.getValue(0, 1)).attr("readonly", "readonly");
            $('#stuName').val(data.getValue(0, 2)).attr("readonly", "readonly");
        });
    }

    function querySubjects() {
        var query = new google.visualization.Query('https://docs.google.com/spreadsheets/d/1ZiL2PY1tgI8Zj4i356cVQjKG4PMdEcsSxZnihGtlXRI/gviz/tq?headers=1&sheet=多選1');
        query.setQuery("select B where A='" + UID + "'"); // '9036219166'

        query.send(function (response) {
            if (response.isError()) {
                showError('Error in query: ' + response.getMessage() + ' ' + response.getDetailedMessage() + ' ' + response.getReasons());
                return;
            }

            var $chk = $('<div class="chkbox-item"><input type="checkbox" name="subj" value="都不選">都不選</div>');
            var $chkdiv = $('#chkdiv');
            $chkdiv.append($chk);

            var data = response.getDataTable();
            var rows = data.getNumberOfRows();
            for (var row = 0; row < rows; row++) {
                var val = data.getValue(row, 0);
                var $chk = $('<div class="chkbox-item"><input type="checkbox" name="subj" value="' + val + '">' + val + '</div>');
                $chkdiv.append($chk);
            }
        });
    }

    function showError(error) {
        console.log(error);
        window.alert('哦哦…發生錯誤了，請再試一次看看！\n' + error);
    }


// -------------------------------------------------------------------------

    renderButton();

    app.UID = $.getUrlVar('UID');
    app.sub_title = $.getUrlVar('stitle');

    // if (!app.UID) {
    //     $('#submit').attr("disabled", "disabled");
    //     return;
    // }
    if (app.sub_title) $('.sub-title').html(app.sub_title);
    //
    // $('#Form1').submit(function () {
    //     onSubmit();
    //     return false;
    // });

});
