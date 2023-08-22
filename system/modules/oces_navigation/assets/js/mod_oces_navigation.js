// When the page is loaded
$(document).ready(function(){

    // set our default option to id=0 when page loads to reset after return/reload
    $('#select_parent option[id="0"]').attr("selected",true);
    
    // When our select changes
    $("#select_parent").on( "change", function(){

        // Get the selected options target page and target anchor
        var target_page = $('option:selected', this).attr('data-target-page');
        var target_anchor = $('option:selected', this).attr('data-target-anchor');

        // Build our link and redirect to it
        window.location.href = "/" + target_page + "#" + target_anchor;
    });
    
});
