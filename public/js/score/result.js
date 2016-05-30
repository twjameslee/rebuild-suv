/**
 * Created by James on 2014/5/15.
 */

var Result = function() {

    //--------------------------------------------------------------------------

    var __construct = function() {
        console.log('Result created');
    };

    //--------------------------------------------------------------------------

    this.success = function(data) {
        data = data[0];
        $('#stu_name').html(data.stu_name);
        $('#jsch').html(data.jsch);
        $('#exam_class').html(data.exam_class);
        $('#exam_no').html(data.exam_no);
        $('#score').html(data.score);
        $('#rank').html(data.rank);
        $('#remark').html(data.remark);
    };

    //--------------------------------------------------------------------------

    this.error = function(msg) {
        msg = msg || '錯誤！' ;
        var output = msg;
        if (typeof msg == 'object') {   // [key1:value1, key2:value2 ... ]
            output = '<ul>';
            for (var key in msg) {
                output += '<li>' + msg[key] + '</li>';
            }
            output += '</ul>';
        }

        var elm = $('#score_form_error');
        elm.html(output).fadeIn();
        setTimeout(function(){ elm.hide(); }, 5000);
    };

    //--------------------------------------------------------------------------

    __construct();

}