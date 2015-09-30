;
(function($) {
    $.fn.extend({
        /**
         * Resets the form data.  Causes all form elements to be reset to their original value.
         */
        resetForm: function() {
            return this.each(function() {
                // guard against an input with the name of 'reset'
                // note that IE reports the reset function as an 'object'
                if(typeof this.reset === 'function' || (typeof this.reset === 'object' && !this.reset.nodeType)) {
                    this.reset();
                }
            });
        }
    });
})(jQuery);