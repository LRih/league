
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

    $("#password").blur(function()
    {
        validatePassword();

        // only validate retype if it has already been previously validated
        if (isPreviouslyValidated($("#retype-password")))
            validateRetypedPassword();
    });

    $("#retype-password").blur(validateRetypedPassword);
});


function isPreviouslyValidated(field)
{
    var group = field.parents('.form-group');
    return group.hasClass('has-success') || group.hasClass('has-error');
}

function validateForm()
{
    return validatePassword() && validateRetypedPassword();
}

function validatePassword()
{
    var password = $("#password");
    var group = getGroup(password);
    var icon = getIcon(group);
    var help = group.find('.help-block');

    if (password.val().match(/^[A-Za-z0-9]{8,16}$/g))
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
        help.html('Password must be between 8 to 16 characters and consist of A-Z a-z 0-9.');
        return false;
    }
}

function validateRetypedPassword()
{
    var retypePassword = $("#retype-password");
    var group = getGroup(retypePassword);
    var icon = getIcon(group);
    var help = group.find('.help-block');

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
