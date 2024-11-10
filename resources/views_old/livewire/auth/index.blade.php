@section('title')

ورود به پروفیل سازه
@endsection
@section('script')
<script>
           $('.mobile-menu-toggle').click(function(){
        $('.loaded').addClass('mmenu-active');
    })
    $('.mobile-menu-close').click(function(){
        $('.loaded').removeClass('mmenu-active');
    })
       $('div#categories > ul.mobile-menu > li > a').append('<span class="toggle-btn"> </span>');
          $('div#categories > ul.mobile-menu > li > a').append('<span class="toggle-btn"> </span>');
   $('div#categories > ul.mobile-menu > li > a > span.toggle-btn').click(function(e){
     
        e.preventDefault();
       $(this).parent().next().slideToggle(300).parent().toggleClass("show");
       })
       
               function isNumberKey(evt) {
  var charCode = (evt.which) ? evt.which : evt.keyCode
  if (charCode > 31 && (charCode < 48 || charCode > 57))
    return false;
  return true;
}
</script>
@endsection
@section('style')
    <style>
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Firefox */
        input[type=number] {
            -moz-appearance: textfield;
        }
        input[type= checkbox]:checked{
            background-color: #3474d4;
            border: none;
        }
    </style>
@endsection
<div class="col-md-4 mt-5 mb-5 mr-auto ml-auto">
    <div class="card shadow rounded bg-white">
        <div class="card-body">
            <div class="logo">
                <a href="{{ route('home.index') }}">
                    <img
                        src="{{ asset('home/images/main/log-in-main.jpg') }}"
                        alt="">
                </a>
            </div>
            <livewire:auth.notification/>
            @if ($showRegisterForm)
                <livewire:auth.register/>
            @else
                <livewire:auth.login/>
            @endif
        </div>
    </div>
</div>
