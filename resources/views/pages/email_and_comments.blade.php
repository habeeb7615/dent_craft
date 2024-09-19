<x-app-layout>
    <div class="page-content window-height">
        <div class="header-title-search fix-height common-padding-lr">
            <div class="header-title-content">
                <h2>Email and Comments</h2>
                {{-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore.</p> --}}
            </div>
        </div>
        <div class="profile-setting-wrapper common-padding-lr after-header-section">
            
            
             {{-- new --}}
            <div class="my-profile-section p-0 common-padding-lr after-header-section">
                    <div class="my-profile-wrapper mb-3">
                        <h5>Email Subject</h5>
                        <div class="personal-info-wrapper row">
                            <div class="col-md-12 personal-info-formgroups">
                                <div>

                                    <div class="form-group">
                                        <!--<label>Email Subject</label>-->
                                        <input id="email_sub" name="email_sub" type="text" value="{{$email_subject}}" required/>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>


            </div>
            {{-- end --}}


            
            <div class="email-template-wrapper">
                <h5>Email Template</h5>
                <div class="email-template-editor">
                    <textarea class="form-control border-primary" id="editor1" name="editor1">{{ $emailTemplate }}</textarea>
                </div>
                <div class="update-btn">
                    <button onclick="submitTemplate()" class="btn-primary">
                        {{-- <img src="{{ asset('new-theme/images/update.svg') }}" alt=""> --}}
                        <span>Update</span>
                    </button>
                </div>
            </div>
            <div class="canned-comments-wrapper">
                <div class="canned-comments-heading">
                    <h5 class="pr-4">Canned Comments</h5>
                    <a data-toggle="modal" data-target="#userdetails_email" href="#" class="btn btn-primary new-quatation">
                        <span><i class="bi bi-plus-circle-fill"></i></span>
                        <p>Add Comment</p>
                    </a>
                </div>
                <div id="canned-comments" class="canned-comments-listing">
                    @include('pages.partials.canned_comments')
                </div>
            </div>
        </div>
        @include('layouts.footer')
    </div>

    <!-- Modal -->
    <div class="modal fade" id="userdetails_email" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Comment</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="bi bi-x-lg"></i>
                </button>
            </div>
            <div class="modal-body">
                <form class="form" id="last_form_email">
                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                    <div class="form-group">
                        <label for="userinput1" class="fw-600">
                            Title
                            <span><sup><i class="fa fa-star text-danger fz"></i></sup></span>
                        </label>
                        <input type="text"  id="title" class="form-control" placeholder=""
                        name="title" maxlength="50" required />
                        <span class="text-danger"></span>
                    </div>
                    <div class="form-group">
                        <label for="userinput1" class="fw-600">
                            Comment
                            <span><sup><i class="fa fa-star text-danger fz"></i></sup></span>
                        </label>
                        <textarea  id="comment" class="form-control" placeholder=""
                        name="comment" maxlength="250" required></textarea>
                        <span class="text-danger"></span>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary my-quotations-btn next-btn" data-dismiss="modal">Cancel</button>
                <button onclick="add_comment()" id="last-form-email-submit" type="button" class="btn btn-success btn-primary my-quotations-btn next-btn"  >Submit</button>
            </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
        <script>
            $(function() {
                CKEDITOR.replace('editor1')
            })

            validateForm('#last_form_email', '#last-form-email-submit')

            function showErrors(errors) {
                for(var error in errors) {
                    $('#'+error).siblings('span').html(errors[error])
                }
            }

            function clearErrors(el) {
                $(el+' input').siblings('span').html('')
            }

            function clearFields(el) {
                $(el+' input').val('')
            }

            function submitTemplate() {
                var inputString = $("#email_sub").val();
               
                $.ajax({
                    url: "{{ route('admin.update_email_template') }}",
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        subject : inputString, 
                        editor: CKEDITOR.instances.editor1.getData()
                    },
                    success: function (response) {
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Template updated successfully.',
                            showConfirmButton: false,
                            timer: 1500
                        })
                    }
                })
            }

            function add_comment(){
                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.canned-comments.store') }}",
                    data: {
                        _token: '{{ csrf_token() }}',
                        user_id: '{{ auth()->user()->id }}',
                        title: $('#title').val(),
                        comment: $('#comment').val()
                    }, // serializes the form's elements.
                    success: function(data)
                    {
                        $('#userdetails_email').modal('hide');
                        $('.modal-backdrop').hide();

                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Comment Added Successfully.',
                            showConfirmButton: false,
                            timer: 1500
                        })
                        $('#canned-comments').html(data.view)
                        // setTimeout(function() { location.reload(); }, 1000);
                    },
                    error: function (data) {
                        clearErrors('#last_form_email')
                        showErrors(data.responseJSON.errors)
                    }
                });
                // if($("#last_form_email").valid()){
                // }
            }

            function delete_comment(id){
                Swal.fire({
                    title: 'Warning',
                    text: 'Do you really want to delete the comment',
                    icon: 'question',
                    confirmButtonText: 'YES',
                    cancelButtonText: 'NO',
                    showCancelButton: true
                }).then(function (isConfirmed) {
                    if (isConfirmed.value) {
                        var url = "{{ route('admin.canned-comments.destroy', ':id') }}"
                        url = url.replace(':id', id)
                        $.ajax({
                            type: "POST",
                            url: url,
                            data: {
                                _token: '{{ csrf_token() }}',
                                _method: 'DELETE'
                            },
                            success: function(data)
                            {
                                // table.draw()
                                Swal.fire({
                                    position: 'center',
                                    icon: 'success',
                                    title: 'Comment Deleted Successfully.',
                                    showConfirmButton: false,
                                    timer: 1500
                                })
                                $('#canned-comments').html(data.view)
                                // setTimeout(function() { location.reload(); }, 1000);
                            }
                        });
                    }
                })
                // if(confirm("Are you sure you want to delete?")){
                // }
            }

            $('#userdetails_email').on('hide.bs.modal', function(e) {
                $('#last_form_email').find('input').val('')
                $('#last_form_email').find('textarea').val('')
                $('#last_form_email .text-custom').html('')
                $('#last_form_email label.error').html('')
            })
        </script>
    @endpush
</x-app-layout>
