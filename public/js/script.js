 $(document).ready(function () {
        $('#event-submit').click(function () {
            let eventId = $(this).data('id');
            let form = $('#event-form');
            
            $.ajax({
                url: form.attr('action'), // Obtém a URL do formulário
                type: 'POST',
                data: form.serialize(), // Serializa os dados do formulário
                success: function (response) {
                    $('#msgContainer').html('<div class="alert alert-success">' + response.msg + '</div>');
                },
                error: function (xhr) {
                    $('#msgContainer').html('<div class="alert alert-danger">Erro ao confirmar presença.</div>');
                }
            });
        });
});


