$(function()
{
    $('.tab').mouseenter(tabHover);
});

function tabHover(e)
{
    var slider = $('#slider');
    var tab = $(e.target);

    var x = tab.position().left + parseInt(tab.css('marginLeft').replace('px', ''));
    if (slider.css('display') == 'none')
    {
        slider.css('display', 'block');
        slider.css('left', x);
    }
    else
    {
        slider.stop();
        slider.animate({ 'left': x }, 200);
    }
}
