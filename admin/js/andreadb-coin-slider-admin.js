(function ($) {
    'use strict';

    $(function () {

        // Uploading files
        var dbaCoinSliderFrame;

        $('#andreadb-add-coin-slider').on('click', function (event) {
            event.preventDefault();
            // If the media frame already exists, reopen it.
            if (dbaCoinSliderFrame) {
                dbaCoinSliderFrame.open();
                return;
            }
            // Create the media frame.
            dbaCoinSliderFrame = wp.media.frames.dbaCoinSliderFrame = wp.media({
                state: 'insert',
                frame: 'post',
                multiple: true
            });
            // When an image is selected, run a callback.
            dbaCoinSliderFrame.on('insert', function () {
                var selection = dbaCoinSliderFrame.state().get('selection');
                var slideIds = [];
                selection.map(function (attachment) {
                    attachment = attachment.toJSON();
                    slideIds.push(attachment.id);
                });
                var data = {
                    action: 'create_dba_coin_slider',
                    selection: slideIds,
                    _wpnonce: andreadb_coin_slider.addslide_nonce,
                    andreadb_coin_slider_id: $('#andreadb-coin-slider-id').val()
                };
                // We can also pass the url value separately from ajaxurl for front end AJAX implementations
                $.post(andreadb_coin_slider.ajaxurl, data, function (response) {
                    $('.andreadb-coin-slider-slides #slides').append(response);
                });
            });
            // Finally, open the modal.
            dbaCoinSliderFrame.open();
        });

        // Sortable slides	
        $('.andreadb-coin-slider-slides #slides').sortable({
            update: function () {
                dbaCoinSliderNumbers();
            },
            opacity: 0.8
        });

        // Remove a slide
        $('.andreadb-coin-slider-slides').on('click', '.delete-slide', function () {
            if (confirm(andreadb_coin_slider.confirm)) {
                $(this).closest('.slide').remove();
                dbaCoinSliderNumbers();
                return false;
            }
        });

        // Update the number slide
        function dbaCoinSliderNumbers() {
            $('.andreadb-coin-slider-slides .slide').each(function () {
                var index = $(this).index();
                $(this).find('.slide-title-index').html('Slide ' + parseInt(index + 1));
            });
        }

        // Set value checkbox
        $('.andreadb-coin-slider-field, .andreadb-coin-slider-slides').on('change', '.checkbox', function () {
            if ($(this).is(':checked')) {
                $(this).val('1');
            } else {
                $(this).val('0');
            }
        });

        // Open preview slide
        $('#andreadb-preview-coin-slider').on('click', function () {
            var url = andreadb_coin_slider.iframeurl + '&andreadb_coin_slider_id=' + $('#andreadb-coin-slider-id').val();
            window.open(url, '_blank');
        });

        // Tab
        $('.andreadb-coin-slider-slides').on('click', '.tabs li', function () {
            var tab = $(this);
            tab.parent().parent().children('.tabs-content').children('div.tab').hide();
            tab.parent().parent().children('.tabs-content').children('div.' + tab.attr('data-tab')).show();
            tab.siblings().removeClass('selected');
            tab.addClass('selected');
        });

    });

})(jQuery);
