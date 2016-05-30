/**
 * Created by James on 2014/5/15.
 */
"use strict";

var Score = function() {

    // private variable
    var template = new Template();
    var event    = new Event( new Result() );

    //--------------------------------------------------------------------------

    var __construct = function() {
        console.log('Score created');
    };

    //--------------------------------------------------------------------------

    __construct();

};
