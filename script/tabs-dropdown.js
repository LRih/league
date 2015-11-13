
$(function()
{
    // toggles visibility of mobile navigation dropdown when menu icon is clicked
    $('#nav-menu').click(ToggleTabsDropdownDisplay);

    // hide dropdown when content clicked
    var dropdown = $('#tabs-dropdown');
    $('#content').click(function()
    {
        if (!IsDisplayNone(dropdown))
            CollapseHide(dropdown);
    });
});

function ToggleTabsDropdownDisplay()
{
    var dropdown = $('#tabs-dropdown');
    if (IsDisplayNone(dropdown))
        ExpandShow(dropdown);
    else
        CollapseHide(dropdown);
}

function IsDisplayNone(element)
{
    return element.css('display') == 'none';
}


function ExpandShow(element)
{
    // get max element height
    element.css('height', 'auto');
    var height = element.css('height');

    element.css('height', 0);
    element.css('display', 'block');

    // animate and scroll to element
    element.animate({ 'height': height }, 200, function(e)
    {
        $(this).css('height', 'auto');
    });
}

function CollapseHide(element)
{
    element.animate({ 'height': 0 }, 200, function(e)
    {
        $(this).css('display', 'none');
    });
}
