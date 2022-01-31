<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.ckeditor.com/4.17.1/standard/ckeditor.js"></script>
 @foreach ($fonts as $font)
    <link href='https://fonts.googleapis.com/css?family={{$font->google_fonts}}' rel='stylesheet'>
    @endforeach
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
                                <div class="nk-block-head nk-block-head-sm">
                                    <div class="nk-block-between">
                                        <div class="nk-block-head-content">
                                            <h3 class="nk-block-title page-title">Pages</h3>
                                            <div class="nk-block-des text-soft">
                                                <span style="display: none"> {{ $count = 0 }}</span>
                                                @foreach ($pages as $page)
                                                    <span style="display: none"> {{ $count++ }}</span>
                                                @endforeach
                                                <p>You have total {{ $count }} Pages.</p>
                                            </div>
                                        </div><!-- .nk-block-head-content -->
                                        <div class="nk-block-head-content">
                                            <div class="toggle-wrap nk-block-tools-toggle">
                                                <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1"
                                                    data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                                                <div class="toggle-expand-content" data-content="pageMenu">
                                                    <ul class="nk-block-tools g-3">
                                                        <li class="nk-block-tools-opt"><button class="btn btn-primary"
                                                                data-toggle="modal" data-target="#add-page-modal"><em
                                                                    class="icon ni ni-plus"></em><span>Add
                                                                    Page</span></button></li>
                                                    </ul>
                                                </div>
                                            </div><!-- .toggle-wrap -->
                                        </div><!-- .nk-block-head-content -->
                                    </div><!-- .nk-block-between -->
                                </div>
                            </div>
                        </div>
                        <div class="card card-preview">
                            <div class="card-inner" style="overflow-x: auto;">
                                <table class="table table-bordered data-table">
                                    <thead>
                                        <tr>
                                            <th>Title</th>
                                            <th>Description</th>
                                            <th>Button Text</th>
                                            <th>Button Background</th>
                                            <th>Button Text Color</th>
                                            <th>Page Slug</th>
                                            <th>Page Text Font</th>
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
  <!--Add Page Modal -->
  <div class="modal fade" id="add-page-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle">Add New Page</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
                  <form method="POST" id="add-page-form" enctype="multipart/form-data">
                  @method('post')
                  @csrf
                  <div class="form-group">
                      <label for="name">Page Title</label>
                      <input type="text" class="form-control" name="page_title" id="page_title"
                          placeholder="Page Title" required>
                  </div>

                  <div class="form-group">
                      <label for="name">Page Description</label>
                      <textarea class="ckeditor form-control"  name="page_description" id="page_description"></textarea>
                  </div>
                  <div class="form-group">
                    <label for="name">Button Text</label>
                    <input type="text" class="form-control" name="button_text" id="button_text"
                        placeholder="Button Text" required>
                </div>
                <div class="form-group">
                    <label for="name">Button Background Color</label>
                    <input type="color" class="form-control" name="button_background_color" id="button_background_color"
                         >
                </div>
                <div class="form-group">
                    <label for="name">Button Text Color</label>
                    <input type="color" class="form-control" name="button_text_color" id="button_text_color">
                </div>
                <div class="form-group">
                    <label for="name">Page Slug</label>
                    <input type="text" class="form-control" name="page_slug" id="page_slug"
                    placeholder="Page Slug">
                </div>
                  <div class="form-group">
                    <label class="form-label" for="fw-nationality">Page Text Font</label>
                    <div class="form-control-wrap ">
                        <div class="form-control-select">
                            <select class="form-control"  name="page_text_font">
                                <option value="">Fonts</option>
                                @foreach ($fonts as $font)
                                <option value="{{$font->google_fonts}}" style="font-family: {{$font->google_fonts}}">{{$font->google_fonts}}</option>
                                @endforeach
                                {{-- <option value="Aguafina Script">Aguafina Script</option>
                                <option value="Aclonica">Aclonica</option>
                                <option value="Akronim">Akronim</option>	
                                <option value="Aldrich">Aldrich</option>	
                                <option value="Alfa Slab One">Alfa Slab One</option>	 --}}
                            </select>
                        </div>
                    </div>
                </div>
                  <button class="btn btn-primary save-user-btn">Save changes</button>
              </form>
          </div>
      </div>
  </div>
</div>
{{-- Add Page modal end --}}
 <!--Edit Page Modal -->
 <div class="modal fade" id="edit-page-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
 aria-hidden="true">
 <div class="modal-dialog modal-dialog-centered" role="document">
     <div class="modal-content">
         <div class="modal-header">
             <h5 class="modal-title" id="exampleModalLongTitle">Add New Page</h5>
             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                 <span aria-hidden="true">&times;</span>
             </button>
         </div>
         <div class="modal-body">
                 <form method="POST" class="edit_page_form" enctype="multipart/form-data">
                    @method('put')
                 @csrf
                 <input type="hidden" class="set_page_edit_id">
                 <div class="form-group">
                     <label for="name">Page Title</label>
                     <input type="text" class="form-control page_title" name="page_title"
                         placeholder="Page Title">
                 </div>

                 <div class="form-group">
                     <label for="name">Page Description</label>
                     <textarea class="ckeditor form-control page_description" name="page_description"></textarea>
                 </div>
                 <div class="form-group">
                   <label for="name">Button Text</label>
                   <input type="text" class="form-control button_text" name="button_text" 
                       placeholder="Button Text">
               </div>
               <div class="form-group">
                   <label for="name">Button Background Color</label>
                   <input type="color" class="form-control button_background_color" name="button_background_color"
                        >
               </div>
               <div class="form-group">
                   <label for="name">Button Text Color</label>
                   <input type="color" class="form-control button_text_color" name="button_text_color">
               </div>
               <div class="form-group">
                   <label for="name">Page Slug</label>
                   <input type="text" class="form-control page_slug" name="page_slug"
                   placeholder="Page Slug">
               </div>
                 <div class="form-group">
                   <label class="form-label">Page Text Font</label>
                   <div class="form-control-wrap ">
                       <div class="form-control-select">
                           <select class="form-control page_text_font"  name="page_text_font">
                                <option value="">Fonts</option>
                                @foreach ($fonts as $font)
                                <option value="{{$font->google_fonts}}" style="font-family: {{$font->google_fonts}}">{{$font->google_fonts}}</option>
                                @endforeach
                                {{-- <option value="Aguafina Script">Aguafina Script</option>
                                <option value="Aclonica">Aclonica</option>
                                <option value="Akronim">Akronim</option>	
                                <option value="Aldrich">Aldrich</option>	
                                <option value="Alfa Slab One">Alfa Slab One</option> --}}
                           </select>
                       </div>
                   </div>
               </div>
                 <button class="btn btn-primary save-user-btn">Save changes</button>
             </form>
         </div>
     </div>
 </div>
</div>
{{-- Edit Page Modal End --}}
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
                <input type="hidden" name="set_page_id" class="set_page_id">
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
<script>
$(document).ready(function(){
 
    // Fetch data using datatable start
    $(function () {
    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax:{
           url: "{{ url('get_pages') }}",
           data: function (d) {
                d.status = $('#status').val()
            }
        },

        columns: [
            {data: 'page_title', name: 'page_title'},
            {data: 'page_description', name: 'page_description'},
            {data: 'button_text', name: 'button_text'},
            {data: 'button_background_color', name: 'button_background_color'},
            {data: 'button_text_color', name: 'button_text_color'},
            {data: 'page_slug', name: 'page_slug'},
            {data: 'page_text_font', name: 'page_text_font'},
            {data: 'edit', name: 'edit',orderable: false,searchable: false},
            {data: 'delete', name: 'delete',orderable: false,searchable: false},
        ]
    });
  });

    // datatable fetch end

    // adding new users using ajax
    $('#add-page-form').on('submit', function(e) {
            e.preventDefault();
            // $('.ckeditor').ckeditor();
            // CKEDITOR.replace('#page_description');
            let data = new FormData(this);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '{{ route('pages.store') }}',
                type: 'POST',
                data: data,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function(response) {
                        $('#add-page-modal').modal('hide');
                        toastr.success(response.message);
                        $('#add-page-form').find('input').val('');
                        $('.data-table').DataTable().ajax.reload();
                },
                error:function(request,status,error){
                    toastr.error(request.responseJSON.errors);
                }
            });
        });
        //  Add Records End
         // Deleting Record From Database
         $('body').on('click', '.delete-page', function(e) {
            e.preventDefault();
            var page_id = $(this).val();
            $('.set_page_id').val(page_id);
            $('#delete-modal').modal('show');
        });
        $('.confirm-delete').on('click', function(e) {
            e.preventDefault();
            var page_delete_id = $('.set_page_id').val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'DELETE',
                url: 'pages/'+page_delete_id,
                success: function(response) {
                    $('#delete-modal').modal('hide');
                    toastr.success(response.message);
                    $('.data-table').DataTable().ajax.reload();
                }
            });
        });

        // Updating Record
        $('body').on('click', '.edit-page', function(e) {
            e.preventDefault();
            var edit_id = $(this).val();
            $('#edit-page-modal').modal('show');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'get',
                url: 'pages/'+edit_id+'/edit',
                dataType: 'json',
                success: function(response) {
                    $('.page_title').val(response.page.page_title);
                    CKEDITOR.instances['page_description'].setData(response.page.page_description);
                    // $('.page_description').val(response.page.page_description);
                    $('.button_text').val(response.page.button_text);
                    $('.button_background_color').val(response.page.button_background_color);
                    $('.button_text_color').val(response.page.button_text_color);
                    $('.page_slug').val(response.page.page_slug);
                    $('.page_text_font').val(response.page.page_text_font);
                    $('.set_page_edit_id').val(edit_id);
                }
            });
        });

        $('.edit_page_form').on('submit', function(e) {
            e.preventDefault();
            var user_id_to_edit = $('.set_page_edit_id').val();
            var edit_form = $('.edit_page_form');
            let data = new FormData(this);
            console.log(data);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'post',
                url: 'pages/' + user_id_to_edit,
                data: data,
                contentType: false,
                processData: false,
                success: function(response) {
                    $('#edit-page-modal').modal('hide');
                    toastr.success(response.message);
                    $('.edit_page_form').find('input').val('');
                    $('.data-table').DataTable().ajax.reload();
                }

                
            });
        });
        // $('.ckeditor').ckeditor();
        CKEDITOR.replace('#page_description');
});
</script>
