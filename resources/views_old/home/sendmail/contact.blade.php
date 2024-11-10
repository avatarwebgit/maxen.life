@component('mail::layout')
    {{-- Header --}}
    @slot ('header')
        @component('mail::header', ['url' => config('app.url')])
            {{$subject}}
        @endcomponent
    @endslot

    {{-- Content here --}}
    <div style="direction: rtl;float: right;margin-bottom: 20px">
        <h1>نام درخواست کننده :</h1>
        <p style="margin-left: 123px">{{$name}}</p>
        <h1>ایمیل درخواست کننده :</h1>
        <p style="float: right" >{{$email}}</p>
    
    </div>

    {{-- Subcopy --}}
    @slot('subcopy')
        @component('mail::subcopy')
            <p style="direction: rtl;margin-right: 10px;float: right">
                {{$message}}
            </p>
        @endcomponent
    @endslot

    {{-- Footer --}}
    @slot ('footer')
        @component('mail::footer')
            <img src="{{asset('home/img/Logo.png')}}" style="width:30%;display: block " alt="ProfileSaze">
           Profilesaze
        @endcomponent
    @endslot
@endcomponent
