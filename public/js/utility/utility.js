/**
 * Created by Administrator on 2016/5/26.
 */

"use strict";

/**
 * @param value
 * @param userFormat
 * @returns {*}
 *
 * isValidDate('dd-mm-yyyy', '31/11/2012')
 *
 */
var isValidDate = function(value, userFormat) {
    // Set default format if format is not provided
    userFormat = userFormat || 'mm/dd/yyyy';
    // Find custom delimiter by excluding
    // month, day and year characters
    var delimiter = /[^mdy]/.exec(userFormat)[0];
    // Create an array with month, day and year
    // so we know the format order by index
    var theFormat = userFormat.split(delimiter);
    // Create array from user date
    var theDate = value.split(delimiter);

    function isDate(date, format) {
        var m, d, y, i = 0, len = format.length, f;
        for (i; i < len; i++) {
            f = format[i];
            if (/m/.test(f)) m = date[i];
            if (/d/.test(f)) d = date[i];
            if (/y/.test(f)) y = date[i];
        }
        return (
            m > 0 && m < 13 &&
            y && y.length === 4 &&
            d > 0 &&
            // Check if it's a valid day of the month
            d <= (new Date(y, m, 0)).getDate()
        );
    }

    return isDate(theDate, theFormat);
}

var round = function (val, precision) {
    return Math.round(Math.round(val * Math.pow(10, (precision || 0) + 1)) / 10) / Math.pow(10, (precision || 0));
}