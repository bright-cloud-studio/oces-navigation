// When the page is loaded
$(document).ready(function(){

    // set our default option to id=0 when page loads to reset after return/reload
    $('#select_parent option[id="0"]').attr("selected",true);
    
    // When our select changes
    $("select").on( "change", function(){

        // Get the selected options target page and target anchor
        var target_page = $('option:selected', this).attr('data-target-page');
        var target_anchor = $('option:selected', this).attr('data-target-anchor');
        
        var buffer = '/';
        
        if(target_page !== '')
            buffer += target_page;
            
        if(target_anchor !== '')
            buffer += "#" + target_anchor;

        // Build our link and redirect to it
        window.location.href = buffer;
    });
    
});
