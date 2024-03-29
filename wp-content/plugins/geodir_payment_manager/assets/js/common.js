jQuery(function($) {});

function geodir_pricing_select_post_package(el, package_id, redirect_to) {
    if (redirect_to && (post_id = parseInt(jQuery('#geodirectory-add-post [name="ID"]').val()))) {
        if (!jQuery('.geodir-page-add .has-auto-draft').length) {
            jQuery('form#geodirectory-add-post').append('<input type="hidden" name="geodir_switch_pkg" value="' + post_id + '">');
        }
    }
    geodir_auto_save_post(); // save post before redirect
    geodir_changes_made = false; // disable navigate away warning
    if (redirect_to) {
        geodir_params.autosave = 0; // prevent autosave
        setTimeout(function() {
            document.location.href = redirect_to;
        }, 1000);
    }
}