@extends('dashbord.layouts.master')
@section('css')

@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span>Train AI</span>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('admin.train.ai') }}" method="POST">
                        @csrf
                        <!-- Input fields for training data -->
                            <div class="form-group mb-3">
                                <label for="keyphrase">Keyphrase</label>
                                <input type="text" name="keyphrase" id="keyphrase" class="form-control" placeholder="Enter keyphrase" required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="response">Response</label>
                                <textarea name="response" id="response" class="form-control" placeholder="Enter response" rows="4" required></textarea>
                            </div>

                            <button type="submit" class="btn btn-primary w-100">Train AI</button>
                        </form>

                        @if(session('status'))
                            <div class="alert alert-success mt-4">
                                {{ session('status') }}
                            </div>
                        @elseif(session('error'))
                            <div class="alert alert-danger mt-4">
                                {{ session('error') }}
                            </div>
                    @endif

                    <!-- Display the Last Trained Data -->
                        <div class="mt-4">
                            <h5>Last Trained Data</h5>
                            @if($lastTrainingData)
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>Keyphrase</th>
                                        <th>Response</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($lastTrainingData as $data)
                                        <tr>
                                            <td>{{ $data->keyphrase }}</td>
                                            <td>{{ $data->response }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            @else
                                <p>No training data available yet.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
