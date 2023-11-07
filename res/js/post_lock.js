jQuery(document).ready(function ($) {
    jQuery('input#publish').click(function () {
        var title = '';
        var empty = false;
        title = jQuery('#title').val();
        if (title == '') {
            alert('Judul artikel masih kosong.');
            empty = true;
        }
        if (empty) {
            jQuery('#submitpost .spinner').hide();
            jQuery('input#publish').removeClass('button-primary-disabled');
        }
        return !empty;
    });

    function postTypeSupportsFeaturedImage() {
        return $.find('#postimagediv').length !== 0;
    }

    function lacksFeaturedImage() {
        return $('#postimagediv').find('img').length === 0;
    }

    function publishButtonIsPublishText() {
        return $('#publish').attr('name') === 'publish';
    }

    function disablePublishAndWarn() {
        createMessageAreaIfNeeded();
        $('#nofeature-message').addClass('error')
            .html('<p>' + objectL10n.jsWarningHtml + '</p>');
        $('#publish').attr('disabled', 'disabled');
    }

    function clearWarningAndEnablePublish() {
        $('#nofeature-message').remove();
        $('#publish').removeAttr('disabled');
    }

    function createMessageAreaIfNeeded() {
        if ($('body').find('#nofeature-message').length === 0) {
            $('h1, h2').after('<div id="nofeature-message"></div>');
        }
    }

    function detectWarnFeaturedImage() {
        if (postTypeSupportsFeaturedImage()) {
            if (lacksFeaturedImage() && publishButtonIsPublishText()) {
                disablePublishAndWarn();
            } else {
                clearWarningAndEnablePublish();
            }
        }
    }

    detectWarnFeaturedImage();
    setInterval(detectWarnFeaturedImage, 3000);
});
