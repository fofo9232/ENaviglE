<!DOCTYPE html>
<html lang="zxx">
<head>
	@include('frontend.layouts.head')
</head>
<body class="js">
	
	<!-- Preloader -->
	<div class="preloader">
		<div class="preloader-inner">
			<div class="preloader-icon">
				<span></span>
				<span></span>
			</div>
		</div>
	</div>
	<!-- End Preloader -->
	
	
	<!-- Header -->
	@include('frontend.layouts.header')
	<!--/ End Header -->
	@include('frontend.layouts.notification')
	@yield('main-content')
	
	
	@include('frontend.layouts.footer')
	
	<script>
    function currency_change(currency_code) {
        $.ajax({
            type:'POST',
            url:"{{route('currency.load')}}",
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
</script>

</body>

</html>