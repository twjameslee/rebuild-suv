/**
 * Created by James on 2016/5/7.
 */
"use strict"; 

(function($) {

    // $("element").toggleDisabled();
    $.fn.toggleDisabled = function() {
        return this.each(function() {
            this.disabled = !this.disabled;
        });
    };

    $.extend({

        getUrlVars: function () {
            var vars = [], hash;
            var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
            for (var i = 0; i < hashes.length; i++) {
                hash = hashes[i].split('=');
                vars.push(hash[0]);
                vars[hash[0]] = decodeURI(hash[1]);
            }
            return vars;
        },
        getUrlVar: function (name) {
            return $.getUrlVars()[name];
        }

    });

})(jQuery);