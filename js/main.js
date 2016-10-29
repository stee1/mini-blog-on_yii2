/**
 * Created by dmitry on 28.10.2016.
 */

$('form[validate-with-icons=1]').on('afterValidateAttribute', function (event, attribute, messages) {
    var hasError = messages.length !== 0;

    if (hasError)
        $(attribute.input).parent().find('.form-control-feedback').removeClass('glyphicon glyphicon-ok').addClass('glyphicon glyphicon-remove');
    else
        $(attribute.input).parent().find('.form-control-feedback').removeClass('glyphicon glyphicon-remove').addClass('glyphicon glyphicon-ok');
});