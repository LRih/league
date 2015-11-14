var TIERS = [ 'V', 'IV', 'III', 'II', 'I' ];

$(function()
{
    $(".dropdown-menu li a").click(function()
    {
        var btn = getBtn($(this));

        // set selected text in button
        btn.html($(this).text() + ' <span class="caret"></span>');

        // set button value
        btn.val($(this).parent().index());
    });

    $(".division-select .dropdown-menu li a").click(function()
    {
        // rename tiers according to division
        var rankContainer = getRankContainer($(this));
        var dropdown = rankContainer.find('.tier-select');
        var tierList = dropdown.find('.dropdown-menu').children();

        var division = getDivisionName(rankContainer);

        for (var i = 0; i < tierList.length; i++)
            tierList.eq(i).find('a').html(division + ' ' + TIERS[i]);

        if (isMastersChallenger(division))
            dropdown.css('visibility', 'hidden');
        else
        {
            dropdown.css('visibility', 'visible');
            updateDropdownText(dropdown);
        }
    });

    // set rank image
    $(".division-select .dropdown-menu li a, .tier-select .dropdown-menu li a").click(function()
    {
        var rankContainer = getRankContainer($(this));
        var division = getDivisionName(rankContainer);
        var img = rankContainer.find('.division-img');

        if (isMastersChallenger(division))
            img.attr('src', 'images/div_' + division + '.png');
        else
        {
            var tier = 5 - getTierIndex(rankContainer);
            img.attr('src', 'images/div_' + division + '_' + tier + '.png');
        }
    });

    // update desired rank on current rank change
    $("#current-rank .dropdown-menu li a").click(function()
    {
        var currentRank = getRankValue(getRankContainer($(this)));
        var desiredRank = getRankValue($('#desired-rank'));

        if (currentRank >= desiredRank)
            setNextRankUp($('#desired-rank'), currentRank);
    });

    // set default list values
    $('.dropdown-menu').each(function()
    {
        $(this).find('li a').first().trigger('click');
    });
    $('#current-rank li').eq(0).find('a').trigger('click');
});


function isMastersChallenger(division)
{
    return division == 'Masters' || division == 'Challenger';
}


function updateDropdownText(dropdown)
{
    var btn = dropdown.find('.btn');
    var list = dropdown.find('.dropdown-menu').children();

    btn.html(list.eq(btn.val()).find('a').html() + ' <span class="caret"></span>');
}


function getRankContainer(child)
{
    return child.parents(".rank-select-container");
}

function getBtn(child)
{
    return child.parents('.dropdown').find('.btn');
}


function getDivisionName(rankContainer)
{
    var list = rankContainer.find('.division-select .dropdown-menu').children();
    return list.eq(getDivisionIndex(rankContainer)).find('a').html();
}
function getDivisionIndex(rankContainer)
{
    return rankContainer.find('.division-select > .btn').val();
}
function getTierIndex(rankContainer)
{
    return rankContainer.find('.tier-select > .btn').val();
}


function setNextRankUp(rankContainer, rank)
{
    var divIndex, tierIndex;

    if (rank == 500) // masters to challenger
    {
        divIndex = 6;
        tierIndex = 0;
    }
    else if ((rank - 4) % 100 == 0) // from tier I
    {
        divIndex = Math.floor(rank / 100) + 1;
        tierIndex = 0;
    }
    else
    {
        divIndex = Math.floor(rank / 100);
        tierIndex = rank % 100 + 1;
    }

    rankContainer.find('.division-select .dropdown-menu').children().eq(divIndex).find('a').trigger('click');
    rankContainer.find('.tier-select .dropdown-menu').children().eq(tierIndex).find('a').trigger('click');
}
function getRankValue(rankContainer)
{
    return parseInt(getDivisionIndex(rankContainer)) * 100 + parseInt(getTierIndex(rankContainer));
}
