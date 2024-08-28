@extends('backend.layouts.master')
@section('content')

<div class="card">
@include('backend.layouts.notification')
    <h5 class="card-header">Edit Settings</h5>
    <div class="card-body">
      <form method="post" action="{{route('settings.update')}}" enctype="multipart/form-data">
        @csrf 
        
        <div class="form-group">
          <label for="inputTitle" class="col-form-label">Title <span class="text-danger">*</span></label>
        <input id="inputTitle" type="text" name="title" placeholder="Enter title"  value="{{$settings->title}}" class="form-control">
        @error('title')
        <span class="text-danger">{{$message}}</span>
        @enderror
        </div>

    

        <div class="form-group">
          <label for="inputDesc" class="col-form-label">Description</label>
          <textarea class="form-control" id="" name="description">{{$settings->description}}</textarea>
          @error('description')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="inputDesc" class="col-form-label">Short Description</label>
          <textarea class="form-control" id="" name="short_des">{{$settings->short_des}}</textarea>
          @error('short_des')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="inputDesc" class="col-form-label">Email</label>
          <textarea class="form-control" id="" name="email">{{$settings->email}}</textarea>
          @error('email')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="inputDesc" class="col-form-label">Phone Number</label>
          <textarea class="form-control" id="" name="phone">{{$settings->phone}}</textarea>
          @error('phone')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="inputDesc" class="col-form-label">Address</label>
          <textarea class="form-control" id="" name="address">{{$settings->address}}</textarea>
          @error('address')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="inputDesc" class="col-form-label">Facebook URL</label>
          <textarea class="form-control" id="" name="facebook_url">{{$settings->facebook_url}}</textarea>
          @error('facebook_url')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="inputDesc" class="col-form-label"> X URL</label>
          <textarea class="form-control" id="" name="x_url">{{$settings->x_url}}</textarea>
          @error('x_url')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="inputDesc" class="col-form-label">Instegram URL</label>
          <textarea class="form-control" id="" name="instegram_url">{{$settings->instegram_url}}</textarea>
          @error('instegram_url')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
        <label for="inputPhoto" class="col-form-label">Logo <span class="text-danger">*</span></label>
        <div class="input-group">
            <span class="input-group-btn">
                <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                <i class="fa fa-picture-o"></i> Choose
                </a>
            </span>
          <input id="" class="form-control" type="file" name="logo" value="{{$settings->logo}}">
        </div>
        <div id="holder" style="margin-top:15px;max-height:100px;"></div>
          @error('logo')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
        <label for="inputPhoto" class="col-form-label">Photo <span class="text-danger">*</span></label>
        <div class="input-group">
            <span class="input-group-btn">
                <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                <i class="fa fa-picture-o"></i> Choose
                </a>
            </span>
          <input id="" class="form-control" type="file" name="photo" value="{{$settings->photo}}">
        </div>
        <div id="holder" style="margin-top:15px;max-height:100px;"></div>
          @error('photo')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        
        <div class="form-group mb-3">
           <button class="btn btn-success" type="submit">Update</button>
        </div>
      </form>
    </div>
</div>

@endsection

