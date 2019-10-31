@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Movie</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}" id="movie-frm">
                            @csrf

                            <div class="form-group row">
                                <label for="genre" class="col-md-4 col-form-label text-md-right">Genre</label>

                                <div class="col-md-6">
                                    <input id="genre" type="text" class="form-control @error('genre') is-invalid @enderror" name="genre" value="{{ old('genre') }}" required autofocus>

                                    @error('genre')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="time" class="col-md-4 col-form-label text-md-right">Time</label>

                                <div class="col-md-6">
                                    <select id="time" class="form-control @error('time') is-invalid @enderror" name="time" required>
                                        @php
                                            for($i=0;$i<24;$i++){
                                                echo '<option value="'.$i.':00">'.$i.':00</option>';
                                                echo '<option value="'.$i.':30">'.$i.':30</option>';
                                            }
                                        @endphp

                                    </select>

                                    @error('time')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Search
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container" style="padding-top: 20px;" id="movie-list">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Movie List</div>

                    <div class="card-body">
                        <ul id="movies">

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('after-scripts')
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script type="text/javascript">
        $( document ).ready(function() {
            $('#movie-list').hide();

            $("input").on("keypress", function (e) {
                if (e.which === 32 && !this.value.length) {
                    e.preventDefault();
                }

                if (this.value.length == 0 && e.which == 48) {
                    e.preventDefault();
                }
            });

            $("#movie-frm").submit(function(event) {

                /* stop form from submitting normally */
                event.preventDefault();
                var genre = $('#genre').val();
                var time = $('#time').val();
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: '{{ route("movie.search") }}',
                    type: 'POST',
                    data: "genre=" + genre + "&time=" + time,
                    cache: false,
                    success: function(data) {
                        $('#movie-list').show();
                        if (data != '') {
                            $("#movies").html(data);
                        }
                    }
                });

            });
        });
    </script>
@endpush

