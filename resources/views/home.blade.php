@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card my-3">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>

            @can('admin', auth()->user())
                <div class="card my-3">
                    <div class="card-header">Users (Only Admins Can See)</div>
                    <div class="card-body">
                        <ul>
                            @foreach(App\Models\User::where('role', 'admin')->get() as $user)
                                <li><a href="{{ route('users.show', $user) }}">{{ $user->name }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endcan

            @can('admin', auth()->user())
                <div class="card my-3">
                    <div class="card-header">Users (Only Admins Can See)</div>
                    <div class="card-body">
                        <ul>
                            @foreach(App\Models\User::where('role', 'standard')->limit(5)->get() as $user)
                                <li><a href="{{ route('users.show', $user) }}">{{ $user->name }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endcan

            <div class="card my-3">
                <div class="card-header">Post Test</div>
                <div class="card-body">
                    <form action="{{ route('post_test') }}" method="post">
                        @csrf
                        <input type="hidden" name="" value="" />
                        <div class="from-group">
                            <label>Update Your Name</label>
                            <input name="name" class="form-control" value="{{ auth()->user()->name }}">
                        </div>
                        <input type="submit" class="btn btn-primary">
                    </form>

                    {{-- Double Curlys:
                    {{ App\Models\Setting::where('key', 'test')->first()->value }} --}}

                    {{-- Exclamation Curlys:
                    {!! App\Models\Setting::where('key', 'test')->first()->value !!} --}}

                    {{-- Triple Curlys:
                    {{{ App\Models\Setting::where('key', 'test')->first()->value }}} --}}
                </div>
            </div>

            <div class="card my-3">
                <div class="card-header">Encrypting Values</div>
                <div class="card-body">
                    <form action="{{ route('encrypt') }}" method="post">
                        @csrf
                        <input type="hidden" name="" value="" />
                        <div class="from-group">
                            <label>Save Your Secrets Here</label>
                            <input name="secret" class="form-control">
                        </div>
                        <input type="submit" class="btn btn-primary">
                    </form>

                    Current Secret:
                    {{ auth()->user()->secret ? decrypt(auth()->user()->secret) : '' }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
