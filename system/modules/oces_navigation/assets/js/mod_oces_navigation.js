// When the page is loaded
$(document).ready(function(){

    // set our default option to id=0 when page loads to reset after return/reload
    $('#select_parent option[id="0"]').attr("selected",true);
    
    // When our select changes
    $("select").on( "change", function(){
        
        console.log(window.location.href);

        // Get the selected options target page and target anchor
        var target_page = $('option:selected', this).attr('data-target-page');
        var target_anchor = $('option:selected', this).attr('data-target-anchor');
        
        var buffer = '/';
        
        if(target_page !== '')
            buffer += target_page;
        
        // True or false if the current address includes the address we are trying to forward to
        var same_page = window.location.href.includes(buffer);
        
        if(target_anchor !== '')
            buffer += "#" + target_anchor;

        // OUTDATED - a simple way to redirect the user
        //window.location.href = buffer;
        
        // NEW - fire a window open even and pass with it a datalayer contained the event key 'homepage-navigation'
        window.open(buffer,'_self');
        window.dataLayer = window.dataLayer || [];
        dataLayer.push({'event':'homepage-navigation'});
        
        // if the target is on the same page, force a reload
        if(same_page)
            window.location.reload();
    });
    
    
});
