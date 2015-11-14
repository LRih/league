var currentTab = null;


$(function()
{
    currentTab = $('.active.tab');
    updateSlider();
    
    $('.tab').mouseenter(tabHover);
    $(window).resize(windowResize);

    $(".dropdown-menu li a").click(function()
    {
        var btn = $(this).parents(".dropdown").find('.btn');
        btn.html($(this).text() + ' <span class="caret"></span>');
        btn.val($(this).data('value'));
        
        $(".dropdown-menu li").removeClass('active');
        $(this).parent().addClass('active');
    });
});


function tabHover(e)
{
    var slider = $('#slider');
    currentTab = $(e.target);

    if (slider.css('display') == 'none')
    {
        slider.css('display', 'block');
        slider.css('left', getTabX(currentTab));
        slider.css('top', getTabY(currentTab));
    }
    else
    {
        slider.stop();
        slider.animate({ 'left': getTabX(currentTab), 'top': getTabY(currentTab) }, 200);
    }
}

function windowResize(e)
{
    if (currentTab != null)
        updateSlider();
}

function updateSlider()
{
    var slider = $('#slider');
    slider.css('left', getTabX(currentTab));
    slider.css('top', getTabY(currentTab));
}

function getTabX(tab)
{
    var slider = $('#slider');
    return tab.position().left + pxToInt(tab.css('marginLeft')) + (getWidth(tab) - slider.width()) / 2;
}
function getTabY(tab)
{
    var slider = $('#slider');
    return tab.position().top + pxToInt(tab.css('height')) - pxToInt(slider.css('height'));
}
function getWidth(tab)
{
    return tab.width() + pxToInt(tab.css('paddingLeft')) + pxToInt(tab.css('paddingRight'));
}

function pxToInt(px)
{
    return parseInt(px.replace('px', ''));
}
