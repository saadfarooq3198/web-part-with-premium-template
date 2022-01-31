 <!-- @@ Profile Edit Modal @e -->
 <div class="modal fade" tabindex="-1" role="dialog" id="profile-edit">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <a href="#" class="close" data-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
            <div class="modal-body modal-body-lg">
                <h5 class="title">Update Profile</h5>
                <ul class="nk-nav nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#personal">Personal</a>
                    </li>
                </ul><!-- .nav-tabs -->
                <div class="tab-content">
                    <div class="tab-pane active" id="personal">
                        <form method="post" action="{{url('update_loggedin_user')}}"   enctype="multipart/form-data">
                        <div class="row gy-4">
                                @csrf
                                @method('put')
                                <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="full-name">First Name</label>
                                    <input type="text" class="form-control form-control-lg" name="first_name"  value="{{Auth::user()->first_name}}" placeholder="Enter Full name">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="display-name">Last Name</label>
                                    <input type="text" class="form-control form-control-lg" name="last_name"  value="{{Auth::user()->last_name}}" placeholder="Enter display name">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="phone-no">Email</label>
                                    <input type="email" class="form-control form-control-lg" name="email"  value="{{Auth::user()->email}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="birth-day">Image</label>
                                    <input type="file" name="img" class="form-control form-control-lg">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Password</label>
                                    <input type="password" autocomplete="current-password" name="password" class="form-control form-control-lg">
                                </div>
                            </div>
                            <div class="col-12">
                                <ul class="align-center flex-wrap flex-sm-nowrap gx-4 gy-2">
                                    <li>
                                        <button type="submit"  class="btn btn-lg btn-primary">Update Profile</button>
                                    </li>
                                    <li>
                                        <a href="#" data-dismiss="modal" class="link link-light">Cancel</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </form>
                    </div><!-- .tab-pane -->
                    
                </div><!-- .tab-content -->
            </div><!-- .modal-body -->
        </div><!-- .modal-content -->
    </div><!-- .modal-dialog -->
</div><!-- .modal -->     
     <!-- main header @s -->
      <div class="nk-header nk-header-fixed is-light">
        <div class="container-fluid">
            <div class="nk-header-wrap">
                <div class="nk-menu-trigger d-xl-none ml-n1">
                    <a href="#" class="nk-nav-toggle nk-quick-nav-icon" data-target="sidebarMenu"><em
                            class="icon ni ni-menu"></em></a>
                </div>
                <div class="nk-header-brand d-xl-none">
                    <a href="html/index.html" class="logo-link">
                        <img class="logo-light logo-img" src="./images/logo.png"
                            srcset="./images/logo2x.png 2x" alt="logo">
                        <img class="logo-dark logo-img" src="./images/logo-dark.png"
                            srcset="./images/logo-dark2x.png 2x" alt="logo-dark">
                    </a>
                </div><!-- .nk-header-brand -->
                <div class="nk-header-tools">
                    <ul class="nk-quick-nav">
                       
                        
                        <li class="dropdown user-dropdown">
                            <a href="#" class="dropdown-toggle mr-n1" data-toggle="dropdown">
                                <div class="user-toggle">
                                    <div class="user-avatar sm">
                                        <img src="images/{{Auth::user()->image}} " alt="no image" width="50px" />
                                        {{-- <em class="icon ni ni-user-alt"></em> --}}
                                    </div>
                                    <div class="user-info d-none d-xl-block">
                                       <span style="display: none">{{$first_name = Auth::user()->first_name}}</span>
                                       <span style="display: none"> {{$last_name = Auth::user()->last_name}}</span>
                                        <div class="user-name dropdown-indicator">{{$first_name." ".$last_name}}</div>
                                    </div>
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-md dropdown-menu-right">
                                <div class="dropdown-inner user-card-wrap bg-lighter d-none d-md-block">
                                    <div class="user-card">
                                        <div class="user-avatar">
                                            <span>
                                                <img src="images/{{Auth::user()->image}} " alt="no image" width="50px"/>
                                            </span>
                                        </div>
                                        <div class="user-info">
                                            <span class="lead-text">{{$first_name." ".$last_name}}</span>
                                            <span class="sub-text">{{Auth::user()->email}}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="dropdown-inner">
                                    <ul class="link-list">
                                        <li><a href="#" data-target="#profile-edit" data-toggle="modal"><em
                                                    class="icon ni ni-user-alt"></em><span>Edit
                                                    Profile</span></a></li>
                                                    {{-- data-target="#profile-edit" data-toggle="modal" --}}
                                        {{-- <li><a href="html/user-profile-setting.html"><em
                                                    class="icon ni ni-setting-alt"></em><span>Account
                                                    Setting</span></a></li>
                                        <li><a href="html/user-profile-activity.html"><em
                                                    class="icon ni ni-activity-alt"></em><span>Login
                                                    Activity</span></a></li> --}}
                                        <li><a class="dark-switch" href="#"><em
                                                    class="icon ni ni-moon"></em><span>Dark Mode</span></a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="dropdown-inner">
                                    <ul class="link-list">
                                        <li>
                                            <form method="POST" action="{{ route('logout') }}">
                                                @csrf
                    
                                                <x-dropdown-link :href="route('logout')"
                                                        onclick="event.preventDefault();
                                                                    this.closest('form').submit();">
                                                    {{ __('Log Out') }}
                                                </x-dropdown-link>
                                            </form>
                                        </li>
                                        {{-- <li><a href="#"><em class="icon ni ni-signout"></em><span>Sign
                                                    out</span></a></li> --}}
                                    </ul>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div><!-- .nk-header-wrap -->
        </div><!-- .container-fliud -->
    </div>
    <!-- main header @e -->
    