
$(function()
{
    $(".dropdown-menu li a").click(function()
    {
        // set selected text in button
        var btn = $(this).parents(".dropdown").find('.btn');
        btn.html($(this).text() + ' <span class="caret"></span>');
        btn.val($(this).text().toLowerCase());

        // make selection active
        $(".dropdown-menu li").removeClass('active');
        $(this).parent().addClass('active');
    });

    // set division image
    $(".division-select li a").click(function()
    {
        $(this).parents(".rank-select").find('.division-img').attr('src', 'images/div_' + $(this).text().toLowerCase() + '.png');
    });

    // set default division to bronze
    $(".dropdown-menu").each(function()
    {
        $(this).find('li a').first().trigger('click');
    });
});

function getRankValue()
{
    return 0;
}
