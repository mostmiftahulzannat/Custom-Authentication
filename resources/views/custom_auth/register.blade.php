@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-8 mt-auto">
                <div class="card">
                    <div class="card-title p-2">
                        <h3>Registered Here</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{route('register.store') }}" method="POST">
                            @method('POST')
                            @csrf

                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" name="name" id=""
                                    class="form-control @error('name')
                                  is-invalid
                                @enderror">
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" id=""
                                    class="form-control @error('email')
                                 is-invalid
                              @enderror">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="tel" class="form-label">Phone</label>
                                <input type="tel" name="phone" id=""
                                    class="form-control @error('phone')
                                 is-invalid
                              @enderror">
                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="tel" class="form-label">Last Educational qualification</label>
                                <input type="tel" name="education" id=""
                                    class="form-control @error('education')
                                 is-invalid
                              @enderror">
                                @error('education')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" name="password" id=""
                                    class="form-control @error('password')
                                 is-invalid
                              @enderror">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">password Conform</label>
                                <input type="password" name="password_confirmation" id="" class="form-control">
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-info">Register</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
