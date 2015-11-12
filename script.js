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
    var slider = $('#slider');
    return tab.position().left + pxToInt(tab.css('marginLeft')) + (getWidth(tab) - slider.width()) / 2;
}
function getTabY(tab)
{
    var slider = $('#slider');
    return tab.position().top + pxToInt(tab.css('paddingTop')) + pxToInt(tab.css('paddingBottom')) +
        pxToInt(tab.css('height')) - pxToInt(slider.css('height'));
}
function getWidth(tab)
{
    return tab.width() + pxToInt(tab.css('paddingLeft')) + pxToInt(tab.css('paddingRight'));
}

function pxToInt(px)
{
    return parseInt(px.replace('px', ''));
}
