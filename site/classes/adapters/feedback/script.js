$('.feedback-form').on('submit', function (event)
{
    event.preventDefault();
    var form = $(this);
    $.ajax({
        type: "POST",
        url: 'index.php?adapter=feedback&task=send_mail',
        dataType: 'json',
        data: form.serialize(),
        success: function(data)
        {
            var messageContayner = form.find('.feedback-message');
            if(data.error == 1){
                messageContayner.addClass('error');
            }
            else{
                messageContayner.removeClass('error');
                form.find('input[type="text"], input[type="tel"]').val('');
                form.find('textarea').val('').text('');
            }
            messageContayner.text(data.message)
        }
    });
});