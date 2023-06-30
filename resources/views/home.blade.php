@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    <form method = "POST" action = "/user/two-factor-authentication">
                        @csrf 

                        @if(auth()->user()->two_factor_secret)
                            @method('DElETE')

                            <div class = "pb-5">
                                {!!auth()->user()->twoFactorQrCodeSvg() !!}
                            </div>
                           
                            <div>
                                <h3>Recovery codes:</h3>
                                <ul>
                                    @foreach (json_decode(decrypt(auth()->user()->two_factor_recovery_codes)) as $code)
                                        <li>{{ $code }}</li>
                                    @endforeach
                                </ul>
                            </div>
                               <button class = "btn btn-danger">Disable</button>
                        @else
                              <button class = "btn btn-primary">Enable</button>
                        @endif
                    </form>
                    

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
