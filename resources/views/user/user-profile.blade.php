@extends('layouts.app')

@section('content')
<section class="bg-dark">
    <div class="container">
        <div class="row p-t-xxl">
            <div class="col-sm-8 col-sm-offset-2 p-v-xxl text-center">
                <h1 class="h1 m-t-l p-v-l">Profile</h1>
            </div>
        </div>
    </div>
</section>

    
<section class="p-v-xxl bg-light">
    <div class="container">
        <div class="row p-t-xxl bg-info content">
            <div class="col-md-12"> 
              @if (session('message'))
                  <div class="alert alert-success">
                      {{ session('message') }}
                  </div>
              @endif
            </div>
            <div class="col-md-12">
              <div class="col-md-4">
                  <!-- User image goes here -->
                  <div class="col-md-12"><a href="" class="btn btn-lg" data-toggle="modal" data-target="#loginModal"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></div>

                  <div class="col-md-12 user-image-frame">
                      <?php  ?>
                      <img src="{{ url($user->profile_photo) }}">
                  </div>

                  <!-- User Image upload modal goes here -->

                  <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                          <h4 class="modal-title" id="myModalLabel">Upload/Edit your profile photo</h4>
                        </div>
                        <div class="modal-body">
                           <form class="form-horizontal" method="post" enctype="multipart/form-data" action="{{ url('user/profile/upload-photo') }}">
                              {{ csrf_field() }}
                              <div class="form-group">
                                  <div class="col-md-12">
                                      <input type="file" name="profile-photo" class="form-control">
                                  </div>
                              </div>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                              <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                        </form>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-12"><!-- Profile image goes here --></div>
                  
              </div>
              <div class="col-md-8">
                  <!-- User bio goes here -->
                  <h3 class="user-name">{{ $user->name }}</h3>    
              </div>
            </div>

        </div>
    </div>
</section>

@endsection