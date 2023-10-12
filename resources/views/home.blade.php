@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 p-3">
                <div class="card">
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
            </div>
            <div class="col-md-8 p-3">
                <a href="{{ route('competition') }}" class="btn btn-primary" type="button">New Competition</a>
                <a href="{{ route('competitor') }}" class="btn btn-primary" type="button">New Competitor</a>
            </div>
            @if(isset($competitions))
                @foreach($competitions as $competition)
                    <div class="col-md-8 p-3">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h3> {{ $competition->name }} </h3>
                                <div class="col-md-2 float-right">
                                    <a href="{{ URL('round/'. $competition->id)  }}"
                                       class="btn btn-primary float-right"
                                       type="button">New Round</a>
                                </div>
                            </div>
                            <div class="card-body">
                                <h5>Date: {{ $competition->date }}</h5>
                                @foreach($competition->competitionRound as $round)
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th scope="col">Name</th>
                                        <th scope="col">Birthday</th>
                                        <th scope="col">Nationality</th>
                                    </tr>
                                    </thead>
                                    <h5>{{ $round->name }}</h5>
                                    <p>Competitors:</p>
                                        @foreach($round->competitors as $competitor)
                                            <tbody>
                                            <tr>
                                                <td>{{ $competitor->name }}</td>
                                                <td>{{ $competitor->birthday }}</td>
                                                <td>{{ $competitor->nationality }}</td>
                                            </tr>
                                            </tbody>
                                        @endforeach
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
@endsection
