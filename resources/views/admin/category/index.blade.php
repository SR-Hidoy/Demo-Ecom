@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row">
    <div class="col-md-12">
      @if (session('update_status'))
        <div class="alert alert-success">
          {{session('update_status')}}
        </div>
      @endif

      @if (session('delete_status'))
        <div class="alert alert-warning">
          {{session('delete_status')}}
        </div>
      @endif

      @if (session('restore_status'))
        <div class="alert alert-warning">
          {{session('restore_status')}}
        </div>
      @endif

      @if (session('force_delete_status'))
        <div class="alert alert-danger">
          {{session('force_delete_status')}}
        </div>
      @endif


    </div>

    <div class="col-md-8">
      <div class="card">
        <div class="card-header">
          <h3>List Category (Active)</h3>
        </div>
        <div class="card-body">

      <table class="table table-bordered">
  <thead>
    <tr>
      <th>SL No.</th>
      <th>Category Name</th>
      <th>Added By</th>
      <th>Created At</th>
      <th>Last Updated At</th>
      <th>Category Photo</th>
      <th>Action</th>

    </tr>
  </thead>
  <tbody>
    @forelse ($categories as $category)
      <tr>
        <td>{{ $loop->index + 1 }}</td>

        <td>{{ $category->category_name }}</td>
        <td>{{ App\User::find($category->user_id)->name }}</td>
        <td>
        @if ($category->created_at)
          {{ $category->created_at->diffForHumans() }}
        @else
          <span class="bg-danger text-white">No time to show</span>
        @endif
      </td>
        <td>
          @if ($category->updated_at)
            {{ $category->updated_at->diffForHumans() }}
          @else
            <span class="">-</span>
          @endif
          </td>
          <td>
            <img src="{{ asset('uploads/category_photos')}}/{{$category->category_photo}}" width="100" alt="Not Found">
          </td>
        <td>
          <div class="btn-group text-white" role"group" aria-label="Basic exampl" >
            <a href="{{url('update/category')}}/{{$category->id}}" type="button" class="btn btn-info">Update</a>
            <a href="{{url('delete/category')}}/{{$category->id}}" type="button" class="btn btn-danger">Delete</a>
          </div>

        </td>
      </tr>
    @empty
      <tr>
        <td colspan="50" class="text-center text-danger">No Data To Show</td>
      </tr>

    @endforelse


  </tbody>
</table>



        </div>
      </div>
    </div>



    <div class="col-md-4">
      <div class="card">
        <div class="card-header">
          <h3>Add Category</h3>
        </div>
        <div class="card-body">

          @if (session('success_message'))
            <div class="alert alert-success">
              {{session('success_message')}}
            </div>
          @endif
          {{-- {{ print_r($errors->all()) }} --}}

          <form action="{{url('add/category/post')}}" method="post" enctype="multipart/form-data">
            @csrf
                    <div class="form-group">
                      <label>Category Name</label>
                      <input type="text" class="form-control"   placeholder="Enter Category Name" name="category_name">
                    </div>
                    <div>
                      @error ('category_name')
                        <span class="text-danger">
                          {{$message}}
                        </span>
                      @enderror
                    </div>

                    <div class="form-group">
                      <label>Category Photo</label>
                      <input type="file" class="form-control"  name="category_photo">
                    </div>
                    <div>
                      @error ('category_photo')
                        <span class="text-danger">
                          {{$message}}
                        </span>
                      @enderror
                    </div>


                    <button type="submit" class="btn btn-success">Add Category</button>
                  </form>
        </div>
      </div>
    </div>





    <div class="col-md-8 mt-5">
      <div class="card">
        <div class="card-header">
          <h3>List Category (Deleted)</h3>
        </div>
        <div class="card-body">

      <table class="table table-bordered">
  <thead>
    <tr>
      <th>SL No.</th>
      <th>Category Name</th>
      <th>Added By</th>
      <th>Created At</th>
      <th>Deleted At</th>
      <th>Action</th>

    </tr>
  </thead>
  <tbody>
    @forelse ($deleted_categories as $deleted_category)
      <tr>
        <td>{{ $loop->index + 1 }}</td>
        <td>{{ $deleted_category->category_name }}</td>
        <td>{{ App\User::find($deleted_category->user_id)->name }}</td>
        <td>
        @if ($deleted_category->created_at)
          {{ $deleted_category->created_at->diffForHumans() }}
        @else
          <span class="bg-danger text-white">No time to show</span>
        @endif
      </td>
        <td>
          @if ($deleted_category->deleted_at)
            {{ $deleted_category->deleted_at->diffForHumans() }}
          @else
            <span class="">-</span>
          @endif
          </td>
        <td>
          <div class="btn-group text-white" role"group" aria-label="Basic exampl" >
            <a href="{{url('restore/category')}}/{{$deleted_category->id}}" type="button" class="btn btn-success">Restore</a>
            <a href="{{url('harddelete/category')}}/{{$deleted_category->id}}" type="button" class="btn btn-danger">Delete</a>
          </div>

        </td>
      </tr>
    @empty
      <tr>
        <td colspan="50" class="text-center text-danger">No Data To Show</td>
      </tr>

    @endforelse


  </tbody>
</table>



        </div>
      </div>
    </div>

  </div>
</div>




@endsection
