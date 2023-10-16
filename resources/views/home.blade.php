@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 p-3">

                <div id="saveform_errlist">
                </div>

                <div id="success_message">
                </div>

                @can('admin')
                    <a href="{{ route('competition') }}" class="btn btn-primary" type="button">New Competition</a>
                    <a href="{{ route('competitor') }}" class="btn btn-primary" type="button">New Competitor</a>
                @endcan
            </div>
            @if(isset($competitions))
                @foreach($competitions as $competition)
                    <div class="col-md-8 p-3" id="competition{{ $competition->id }}">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h4>
                                    <a href="{{ URL('competition/update/'. $competition->id) }}">{{ $competition->name }}</a>
                                </h4>
                                <div class="col-md-2 float-right">
                                    @can('admin')
                                        <a href="{{ URL('round/'. $competition->id)  }}"
                                           class="btn btn-primary float-right"
                                           type="button">New Round</a>
                                        <input class=" id" type="hidden" value="{{ $competition->id }}">
                                        <input class="btn btn-danger delete_competition" type="submit" value="Delete">
                                    @endcan
                                </div>
                            </div>
                            <div class="card-body">
                                <h5>Date: {{ $competition->date }}</h5>
                                @foreach($competition->competitionRound as $round)
                                    <table class="table round{{$round->id}}">
                                        <thead>
                                        <tr>
                                            <th scope="col">Name</th>
                                            <th scope="col">Birthday</th>
                                            <th scope="col">Nationality</th>
                                        </tr>
                                        </thead>
                                        <div class="round{{$round->id}}">
                                            <h5><a href="{{ URL('round/update/'. $round->id) }}">{{ $round->name }}</a>
                                            </h5>
                                            <input class="roundId" type="hidden"
                                                   value="{{ $round->id }}">
                                            <input class="btn btn-danger delete_round" type="submit" value="Delete">
                                            <p>Competitors:</p>
                                        </div>
                                        @foreach($round->competitors as $competitor)
                                            <tbody class="competitor{{ $competitor->id }}">
                                            <tr>
                                                <td>{{ $competitor->name }}</td>
                                                <td>{{ $competitor->birthday }}</td>
                                                <td>{{ $competitor->nationality }}</td>
                                                <td>
                                                    <input class="competitionId" type="hidden"
                                                           value="{{ $competition->id }}">
                                                    <input class="competitorId" type="hidden"
                                                           value="{{ $competitor->id }}">
                                                    <input class="btn btn-danger delete_competitor" type="submit"
                                                           value="Delete">
                                                </td>
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
    <script>
        $(document).ready(function () {
            $(document).on('click', '.delete_competition', function (e) {
                e.preventDefault();

                let id = $(this).siblings(".id").val();

                let data = {
                    'id': id,
                }

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "DELETE",
                    url: "competition/delete/" + id,
                    data: data,
                    success: function (result) {
                        $('#success_message').html("");
                        $('#success_message').addClass('alert alert-success');
                        $('#success_message').text('Competition deleted');
                        $('#competition' + id).remove();
                    }
                });
            });

            $(document).on('click', '.delete_competitor', function (e) {
                e.preventDefault();

                let competitorId = $(this).siblings(".competitorId").val();
                let competitionId = $(this).siblings(".competitionId").val();

                let data = {
                    'competitorId': competitorId,
                    'competitionId': competitionId,
                }

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "DELETE",
                    url: "competitor/delete/" + competitorId + "/" + competitionId,
                    data: data,
                    success: function (result) {
                        $('#success_message').html("");
                        $('#success_message').addClass('alert alert-success');
                        $('#success_message').text('Competitor deleted');
                        $('.competitor' + competitorId).remove();
                    }
                });
            });

            $(document).on('click', '.delete_round', function (e) {
                e.preventDefault();

                let roundId = $(this).siblings(".roundId").val();

                let data = {
                    'roundId': roundId,
                }

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "DELETE",
                    url: "round/delete/" + roundId,
                    data: data,
                    success: function (result) {
                        $('#success_message').html("");
                        $('#success_message').addClass('alert alert-success');
                        $('#success_message').text('Round deleted');
                        $('.round' + roundId).remove();
                    }
                });
            });

        });
    </script>
@endsection
