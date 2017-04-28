var sidebarCooldown = 0;
$(document).ready(function() {
    $('.sidebar-itemgroup').find('.sidebar-subgroup').each(function()
        {
            if($(this).attr("class")=="sidebar-subgroup")
            {
                if($(this).attr("menu-parent")==$('.sidebar-menuactive').attr("id")){return;}
                $(this).slideUp(1);
            }
    });
    $('.sidebar-menuitem').click(function()
    {
        if(sidebarCooldown+200>Date.now()) {return;}
        sidebarCooldown = Date.now();
        var currentMenu = $('.sidebar-menuactive');
        var newMenu = this;
        if(currentMenu.attr("id") == this.id) {return;}
        var slideup;
        $('.sidebar-itemgroup').find("[menu-parent='"+currentMenu.attr("id")+"']").each(function(){slideup = $(this).slideUp(200);});
        $.when(slideup).done(function()
        {
            currentMenu.removeClass('sidebar-menuactive');
            $(newMenu).addClass('sidebar-menuactive');
            $('.sidebar-itemgroup').find("[menu-parent='"+newMenu.id+"']").each(function(){$(this).slideDown(200);});
            var activeCounter = 0;
            $('.sidebar-menuactive').each(function(){activeCounter += 1;if(activeCounter>1){
                $(this).removeClass("sidebar-menuactive");
                $('.sidebar-itemgroup').find("[menu-parent='"+$(this).attr("id")+"']").each(function(){$(this).slideUp(200);});
            }});
        });
    });
    $('.sidebar-subitem').click(function()
    {
        alert(this.innerHTML); 
    });
});