
$(function()
{
    $('.help-block').each(function()
    {
        if ($(this).html().length > 0)
        {
            var group = getGroup($(this));
            var icon = getIcon(group);
            group.addClass('has-error');
            icon.addClass('glyphicon-remove');
        }
    });
});


function validateForm()
{
    return validateRetypedPassword();
}

function validateRetypedPassword()
{
    var retypePassword = $("#retype-password");
    var group = getGroup(retypePassword);
    var icon = getIcon(group);
    var help = getHelp(group);

    if (retypePassword.val() === $("#password").val())
    {
        group.removeClass('has-error');
        icon.removeClass('glyphicon-remove');
        help.empty();
        return true;
    }
    else
    {
        group.addClass('has-error');
        icon.addClass('glyphicon-remove');
        help.html('Passwords do not match.');
        return false;
    }
}


function getGroup(child)
{
    return child.parents('.form-group');
}

function getIcon(group)
{
    return group.find('.glyphicon');
}

function getHelp(group)
{
    return group.find('.help-block');
}
