var TIERS = [ 'V', 'IV', 'III', 'II', 'I' ];

$(function()
{
    $(".dropdown-menu li a").click(function()
    {
        // set selected text in button
        var btn = $(this).parents(".dropdown").find('.btn');
        btn.html($(this).text() + ' <span class="caret"></span>');
    });

    // set button value
    $(".division-select .dropdown-menu li a").click(function()
    {
        $(this).parents(".dropdown").find('.btn').val($(this).text());

        // rename tiers
        var rankSelectContainer = getRankSelectContainer($(this));
        var division = getDivision(rankSelectContainer);

        var tierList = rankSelectContainer.find('.tier-select .dropdown-menu').children();
        for (var i = 0; i < tierList.length; i++)
            tierList.eq(i).find('a').html(division + ' ' + TIERS[i]);

        tierList.eq(5 - getTier(rankSelectContainer)).find('a').trigger('click');
    });
    $(".tier-select .dropdown-menu li a").click(function()
    {
        $(this).parents(".dropdown").find('.btn').val(5 - $(this).parent().index());
    });
    $(".region-select .dropdown-menu li a").click(function()
    {
        $(this).parents(".dropdown").find('.btn').val($(this).text());
    });

    // set rank image
    $(".division-select .dropdown-menu li a, .tier-select .dropdown-menu li a").click(function()
    {
        var rankSelectContainer = getRankSelectContainer($(this));
        var division = getDivision(rankSelectContainer);
        var img = rankSelectContainer.find('.division-img');

        if (division == 'Masters' || division == 'Challenger')
            img.attr('src', 'images/div_' + division + '.png');
        else
        {
            var tier = rankSelectContainer.find('.tier-select > .btn').val();
            img.attr('src', 'images/div_' + division + '_' + tier + '.png');
        }
    });

    // set default division to bronze
    $(".dropdown-menu").each(function()
    {
        $(this).find('li a').first().trigger('click');
    });
});

function getRankSelectContainer(child)
{
    return child.parents(".rank-select-container");
}

function getDivision(rankSelectContainer)
{
    return rankSelectContainer.find('.division-select > .btn').val();
}

function getTier(rankSelectContainer)
{
    return rankSelectContainer.find('.tier-select > .btn').val();
}

function getRankValue()
{
    return 0;
}
