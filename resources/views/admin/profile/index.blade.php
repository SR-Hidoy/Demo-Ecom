@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">

          <div class="col-md-6 m-auto">
            <div class="card">
              <div class="card-header">
                <h3>Profile Edit</h3>
              </div>
              <div class="card-body">

                @if (session('success_message'))
                  <div class="alert alert-success">
                    {{session('success_message')}}
                  </div>
                @endif
                {{-- {{ print_r($errors->all()) }} --}}

                <form action="{{url('profile/post')}}" method="post">
                  @csrf
                          <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control"   placeholder="Enter your Name" name="name" value="{{ Str::title(Auth::user()->name) }}">
                          </div>
                          <div>
                            @error ('name')
                              <span class="text-danger">
                                {{$message}}
                              </span>
                            @enderror
                          </div>


                          <button type="submit" class="btn btn-info">Change Name</button>
                        </form>
              </div>
            </div>
          </div>

    </div>

    <div class="row mt-5">

          <div class="col-md-6 m-auto">
            <div class="card">
              <div class="card-header bg-warning">
                <h5>Change Password</h5>
              </div>
              <div class="card-body">

                @if (session('password_Change_status'))
                  <div class="alert alert-success">
                  {{ session('password_Change_status') }}
                  </div>
                @endif
                @if (session('database_status'))
                  <div class="alert alert-danger">
                  {{ session('database_status') }}
                  </div>
                @endif

                {{-- @if ($errors->all())
                  <div class="alert alert-danger">
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
                  </div>
                @endif --}}
                {{-- {{ print_r($errors->all()) }} --}}

                <form action="{{url('password/post')}}" method="post">
                  @csrf
                          <div class="form-group">
                            <label>Old/Current Password</label>
                            <input type="password" class="form-control"   placeholder="Enter your Old/Current Password" name="old_password" value="{{ old('old_password')}}">
                          </div>
                          <div>
                            <div>
                          @error ('old_password')
                            <span class="text-danger">
                              {{$message}}
                            </span>
                          @enderror
                        </div>

                            <div class="form-group">
                              <label>New Password</label>
                              <input type="password" class="form-control"   placeholder="Enter your New Password" name="password" >
                            </div>
                            <div>
                              <div>
                            @error ('password')
                              <span class="text-danger">
                                {{$message}}
                              </span>
                            @enderror
                          </div>

                              <div class="form-group">
                                <label>Confirm Password</label>
                                <input type="password" class="form-control"   placeholder="Enter your Confirm Password" name="password_confirmation">
                              </div>
                              <div>
                            @error ('password_confirmation')
                              <span class="text-danger">
                                {{$message}}
                              </span>
                            @enderror
                          </div>


                          <button type="submit" class="btn btn-secondary">Change Password</button>
                        </form>
              </div>
            </div>
          </div>

    </div>

  </div>

@endsection
