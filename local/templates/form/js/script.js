$(function(){
    $('#geo-ip-form').on('submit', (e) => {
        e.preventDefault();
        let responseMessage = $('#response-message');
        responseMessage.attr('class', 'alert').empty();

        fetch('/local/templates/form/ajax/get_ip.php', {
            method: 'post',
            body: new FormData(e.target)
        }).then(response => response.json()).then(response => {
            if (response.status === 'error'){
                responseMessage.addClass('alert-danger');
                responseMessage.html(response.error_message);
            }
            else{
                responseMessage.addClass('alert-success');
                responseMessage.html(response.result);
            }
        })
    })
})