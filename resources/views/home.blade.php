@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-success">{{ __('Dashboard') }}</div>

                <div class="card-body bg-info">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <h1>Welcome, {{ Auth::user()->name }}</h1>
                    <h2>Email: {{ Auth::user()->email }}</h2>
                    <h3>Created: {{ Auth::user()->created_at }}</h3>
                    {{ __('You are logged in!') }}

                </div>
            </div>
        </div>
    </div>

    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header bg-warning">
             <h2>User List</h2>
             <h1>Total Users: {{ $total_users }}</h1>

          </div>

          <div class="card-body">
            {{-- {{$users}} --}}

            <table class="table table-bordered">
              <thead>
                <tr>
                  <th scope="col">Serial No.</th>
                  <th scope="col">ID No.</th>
                  <th scope="col">Name</th>
                  <th scope="col">Email</th>
                  <th scope="col">Created At</th>

                </tr>
              </thead>
              <tbody>
                {{-- @php
                  $flag = 1;
                @endphp --}}
                @foreach ($users as $user)
                <tr>
                  <td class="text-center">{{ $users->firstItem() + $loop->index }}</td>
                  <td>{{$user->id}}</td>
                  <td>{{$user->name}}</td>
                  <td>{{$user->email}}</td>
                  <td>
                    <li>{{$user->created_at->format('d/m/Y h:i:s A') }}</li>
                    <li>{{$user->created_at->diffForHumans() }}</li>
                  </td>


                </tr>
              @endforeach




              </tbody>
            </table>
            {{ $users->links()}}
          </div>
        </div>
      </div>
    </div>

</div>
@endsection
