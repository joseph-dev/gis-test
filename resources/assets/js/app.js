/**
 * Basic app object
 */
$.GIS = {};

/**
 * Form object
 */
$.GIS.form = {
    selector: $('#feed-form'),

    activate: function () {
        this.onLoad();
        this.initEventListeners();
    },

    onLoad: function () {
        var feedType = this.selector.find('#feed_id').val();
        this.showOptionalElements(feedType);
    },

    initEventListeners: function () {
        var _this = this;

        this.selector.on('change', '#feed_id', function (event) {
            _this.showOptionalElements($(this).val());
        });
    },

    showOptionalElements: function (feedType) {
        this.selector.find('.feed-optional').hide();
        this.selector.find('.feed-type-' + feedType).show();
    }
};

/**
 * Activate components on load
 */
$(function () {
    $.GIS.form.activate();
});