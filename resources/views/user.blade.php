@extends('layouts.app')
@section('table-content')
 <!-- content @s -->
 <div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="components-preview wide-md mx-auto">
                    <div class="nk-block nk-block-lg">
                        <div class="nk-block-head">
                            <div class="nk-block-head-content">
                                {{-- @can('add_user') --}}
                                <button class="btn btn-primary" data-toggle="modal" data-target="#add-user-modal">Add User</button>
                                {{-- @endcan --}}
                            </div>
                        </div>
                        <div class="card card-preview">
                            <div class="card-inner">
                                <table class="table table-bordered data-table">
                                    <thead>
                                        <tr>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Username</th>
                                            <th>Email</th>
                                            <th>Image</th>
                                            <th>Edit</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       
                                    </tbody>
                                </table>
                            </div>
                        </div><!-- .card-preview -->
                    </div> <!-- nk-block -->
                </div><!-- .components-preview -->
            </div>
        </div>
    </div>
</div>

{{-- modals section start --}}
  <!--Add user Modal -->
  <div class="modal fade" id="add-user-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle">Add New User</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
                  <form method="POST" id="add-user-form" enctype="multipart/form-data">
                  @method('post')
                  @csrf
                  <div class="form-group">
                      <label for="name">First Name</label>
                      <input type="text" class="form-control" name="first_name" id="first_name"
                          placeholder="First Name" required>
                  </div>

                  <div class="form-group">
                      <label for="name">Last Name</label>
                      <input type="text" class="form-control" name="last_name" id="last_name"
                          placeholder="Last Name" required>
                          
                  </div>

                  <div class="form-group">
                      <label for="email">Email</label>
                      <input type="email" class="form-control" name="email" id="email" placeholder="Email"
                          required>
                  </div>

                  <div class="form-group">
                      <label for="name">Image</label>
                      <input type="file" class="form-control" name="img" id="image">
                  </div>

                  <div class="form-group">
                      <label for="name">Password</label>
                      <input type="password" class="form-control" name="password" id="password1"
                          placeholder="Password" required>
                         
                  </div>
                  <button class="btn btn-primary save-user-btn">Save changes</button>
              </form>
          </div>
      </div>
  </div>
</div>
{{-- Add user modal end --}}
 <!--Edit user Modal -->
 <div class="modal fade" id="edit_user_modal" tabindex="-1" role="dialog"
 aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
 <div class="modal-dialog modal-dialog-centered" role="document">
     <div class="modal-content">
         <div class="modal-header">
             <h5 class="modal-title" id="exampleModalLongTitle">Edit User</h5>
             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                 <span aria-hidden="true">&times;</span>
             </button>
         </div>
         <div class="modal-body">
             <form  method = 'post' id="edit_user_form_submit" class="edit_user_form" enctype="multipart/form-data">
                  @csrf
                  @method('put')
                 <div class="form-group">
                     <label for="name">First Name</label>
                     <input type="text" class="form-control first-name" name="first_name"
                         placeholder="First Name" required>
                 </div>

                 <div class="form-group">
                     <label for="name">Last Name</label>
                     <input type="text" class="form-control last-name" name="last_name" placeholder="Last Name"
                         required>
                 </div>
                 <input type="hidden" class="set_user_edit_id" name="edit_user">
                 <div class="form-group">
                     <label for="email">Email</label>
                     <input type="email" class="form-control email" name="email" placeholder="Email" required>
                 </div>
                 <div class="form-group">
                     <label for="name">Image</label>
                     <input type="file" class="form-control image-update" name="img">
                 </div>
                 <div class="form-group">
                     <label for="name">Password</label>
                     <input type="password" class="form-control password2" name="password" placeholder="Password">
                 </div>
                 <button style="background: rgb(53, 53, 107)" type="submit"
                     class="btn btn-primary edit-save-btn">Save changes</button>
             </form>
         </div>
     </div>
 </div>
</div>
{{-- Edit User Modal End --}}
 {{-- Delete Modal Start--}}
 <div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                {{-- <h4 class="modal-title text-center" id="myModalLabel">Delete Confirmation</h4> --}}
            </div>
            <div class="modal-body text-center">
                <input type="hidden" name="set_user_id" class="set_user_id">
                Are you sure you want to delete this User?
            </div>
            <div class="modal-footer">
                <button type="submit" id="delete-btn" class="confirm-delete btn btn-default bg-danger">Yes</button>
                <button class="btn btn-primary" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
{{-- delete modal end --}}
{{-- modals section end --}}
<!-- content @e -->
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
    // Fetch data using datatable start
    $(function () {
    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ url('get_user') }}",
        columns: [
            {data: 'first_name', name: 'first_name'},
            {data: 'last_name', name: 'last_name'},
            {data: 'last_name', name: 'last_name'},
            {data: 'email', name: 'email'},
            {data: 'image', name: 'image'},
            {data: 'edit', name: 'edit',orderable: false,searchable: false},
            {data: 'delete', name: 'delete',orderable: false,searchable: false},
        ]
    });
    
  });
        // datatable fetch end
       // Fetch records using ajax
        fetch_users();
        function fetch_users() {
            $.ajax({
                url: 'get_users',
                type: "GET",
                success: function(response) {
                    $('tbody').html('');
                    $.each(response.users, function(key, item) {
                        $('tbody').append('<tr>\
                <td>' + item.first_name + '</td>\
                <td>' + item.last_name + '</td>\
                <td>'+ item.first_name +' '+ item.last_name + '</td>\
                <td>' + item.email + '</td>\
                <td><img src="images/' + item.image + ' " alt="no image" width="100px" height="100px"/></td>\
                <td>@can('update_user')<button value="' + item.id + '" class="btn-edit btn btn-primary btn-sm">Edit</button>@endcan</td>\
                <td>@can('delete_user')<button  value="' + item.id + '" class="delete-btn btn-delete btn btn-danger btn-sm">Delete</button>@endcan</td>\
              </tr>');
                });
                }
            });
        }
        // fetch End
    // adding new users using ajax
    $('#add-user-form').on('submit', function(e) {
            e.preventDefault();
            let data = new FormData(this);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '{{ route('users.store') }}',
                type: 'POST',
                data: data,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function(response) {
                        $('#add-user-modal').modal('hide');
                        toastr.success(response.message);
                        $('#add-user-form').find('input').val('');
                        fetch_users();
                },
                error:function(request,status,error){
                    toastr.error(request.responseJSON.errors);
                }
            });
        });
        //  Add Records End
         // Deleting Record From Database
         $('body').on('click', '.btn-delete', function(e) {
            e.preventDefault();
            var user_id = $(this).val();
            $('.set_user_id').val(user_id);
            $('#delete-modal').modal('show');
        });
        $('.confirm-delete').on('click', function(e) {
            e.preventDefault();
            var user_delete_id = $('.set_user_id').val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'DELETE',
                url: 'users/'+user_delete_id,
                success: function(response) {
                    $('#delete-modal').modal('hide');
                    toastr.success(response.message);
                    fetch_users();
                }
            });
        });

        // Updating Record
        $('body').on('click', '.btn-edit', function(e) {
            e.preventDefault();
            var edit_id = $(this).val();
            $('#edit_user_modal').modal('show');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'get',
                url: 'users/'+edit_id+'/edit',
                dataType: 'json',
                success: function(response) {
                    $('.first-name').val(response.user.first_name);
                    $('.last-name').val(response.user.last_name);
                    $('.email').val(response.user.email);
                    $('.password2').val(response.user.password);
                    $('.set_user_edit_id').val(edit_id);
                }
            });
        });

        $('.edit_user_form').on('submit', function(e) {
            e.preventDefault();
            var user_id_to_edit = $('.set_user_edit_id').val();
            var edit_form = $('.edit_user_form');
            let data = new FormData(this);
            console.log(data);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'post',
                url: 'users/' + user_id_to_edit,
                data: data,
                contentType: false,
                processData: false,
                success: function(response) {
                    $('#edit_user_modal').modal('hide');
                    toastr.success(response.message);
                    $('.edit_user_form').find('input').val('');
                    fetch_users();
                }
            });
        });
});
</script>