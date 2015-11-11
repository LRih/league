var currentTab = null;


$(function()
{
    $('.tab').mouseenter(tabHover);
    $(window).resize(windowResize);
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
    {
        var slider = $('#slider');
        slider.css('left', getTabX(currentTab));
        slider.css('top', getTabY(currentTab));
    }
}

function getTabX(tab)
{
    return currentTab.position().left + pxToInt(currentTab.css('marginLeft'));
}
function getTabY(tab)
{
    var slider = $('#slider');
    return currentTab.position().top + pxToInt(currentTab.css('paddingTop')) + pxToInt(currentTab.css('paddingBottom')) +
        pxToInt(currentTab.css('height')) - pxToInt(slider.css('height'));
}

function pxToInt(px)
{
    return parseInt(px.replace('px', ''));
}
