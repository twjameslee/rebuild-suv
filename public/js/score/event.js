/**
 * Created by James on 2014/5/15.
 */

var Event = function(Result) {

    //--------------------------------------------------------------------------

    var __construct = function() {
        console.log('Event created');

        query_score();
        //delete_todo();

    };

    //--------------------------------------------------------------------------
    var query_score = function() {

        $('#score_form').submit(function(evt) {

            evt.preventDefault();

            var data = [{
                stu_name    : '',
                jsch        : '',
                exam_class  : '',
                exam_no     : '',
                score       : '',
                rank        : '',
                remark      : ''
            }];
            Result.success(data);  // clear field

            $.ajax({
                type: "POST",
                url: $(this).attr('action'),
                data: $(this).serialize(),
                dataType: 'json',
                success: function(o) {

                    if (o.result == 1)
                        Result.success(o.data);
                    else
                        Result.error(o.error);
                }
            });

            /*
            $.post(
                $(this).attr('action'),
                $(this).serialize(),
                function(o)
                {
                    if (o.result == 1)
                    {
                        Result.success(o.data);
                    }
                    else
                    {
                        Result.error(o.error);
                    }
                },
            'json');
            */
        });

    };

    //--------------------------------------------------------------------------

    __construct();

}