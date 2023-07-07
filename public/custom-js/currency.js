$(document).ready(function(e){
    

    $('#target_currency').on('change', function(e) {
        e.preventDefault();
        //get the action-url of the form
        data = {
          'source_currency' : this.value,
        };
        console.log(data);
        //do your own request an handle the results
        $.ajax({
                url: currency_ajax,
                type: 'get',
                data: data,
                success: function(data) {
                    console.log(data);
                    if(data.data != ''){
                        $('#closing_rate').val(data.data);
                    }
                },

        });
      });
});