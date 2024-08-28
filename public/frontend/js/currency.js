
    function currency_change(currency_code) {
        $.ajax({
            type:'POST',
            url:route('currency.load'),
            data:{
                currency_code:currency_code,
                _token: '{{csrf_token()}}',
            },
            success:function (response) {
                if(response['status']){
                    location.reload();
                }
                else{
                    alert('server error');
                }
            }
        })
    }
