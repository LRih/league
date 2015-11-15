
$(function()
{
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
    var group = password.parents('.form-group');
    var icon = group.find('.glyphicon');

    if (password.val().match(/^[A-Za-z0-9]{8,16}$/g))
    {
        group.removeClass('has-error');
        icon.removeClass('glyphicon-remove');
        return true;
    }
    else
    {
        group.addClass('has-error');
        icon.addClass('glyphicon-remove');
        return false;
    }
}

function validateRetypedPassword()
{
    var retypePassword = $("#retype-password");
    var group = retypePassword.parents('.form-group');
    var icon = group.find('.glyphicon');
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
        help.html('Retyped password does not match password.');
        return false;
    }
}
