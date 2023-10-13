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
                                <h4><a href="{{ URL('competition/update/'. $competition->id) }}"> {{ $competition->name }}</a></h4>
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
                    url: "competition/delete/"+id,
                    data: data,
                    success: function(result) {
                        $('#success_message').html("");
                        $('#success_message').addClass('alert alert-success');
                        $('#success_message').text('Competition deleted');
                        // location.reload();

                        $('#competition'+id).remove();
                    }
                });
            });
        });

    </script>
@endsection
