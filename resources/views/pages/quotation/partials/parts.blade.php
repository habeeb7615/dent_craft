<div class="app-content content" id="page5" style="display:none;">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-center  col-12 mb-2 text-center">
                <h3 class="content-header-title mb-0 d-inline-block">Choose Parts</h3>
            </div>
        </div>
        <div class="content-body">
            <section id="basic-form-layouts">
                <!--<div class="row">
            <div class="col-12">
              <div class="alert alert-success" role="alert">
                <strong>Success!</strong> Your profile has been updated.
              </div>
            </div>
          </div>-->
                <div class="row match-height">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-content collapse show">
                                <div class="card-body">
                                    <div class="col-md-12 row mt-3 m-0">
                                        <div class="col-md-3"></div>
                                        <div class="col-md-12">
                                            <p class="card-title f-14 fw-600">Choose parts for your car, such as:</p>
                                            <form class="form" id="parts_form">
                                                @csrf
                                                <input type="hidden" name="main_id"
                                                    value="{{ !empty($quote) ? $quote->id : '' }}">
                                                <div id="part-form" class="form-body">
                                                    @include('pages.quotation.partials.parts_form')
                                                </div>
                                            </form>
                                        </div>
                                        <div class="col-md-3"></div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
<!--Part details Modal-->
<div class="modal fade" id="partdetails" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Part Details</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body text-center modal-inner">

                <div class="alert alert-warning" id="parts_msg" role="alert">
                    No part selected yet !!
                </div>
                <p class="modal-text-2">Add to the quote?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn  my-quotations-btn next-btn" data-dismiss="modal">Yes, Select</button>
                <button type="button" onclick="submit_parts(6)" class="btn  my-quotations-btn next-btn">No,
                    Proceed</button>
            </div>
        </div>

    </div>
</div>


<div class="modal fade" id="enter_part" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Custom Part</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body text-center modal-inner">
                <form method="POST" id="add-new-part">
                    @csrf
                    <input type="hidden" name="quote_id" value="{{ !empty($quote) ? $quote->id : '' }}">
                    <div class="row">
                        <div class="col-md-3 "> <label for="userinput1" class="fw-600">Enter Part</label></div>
                        <div class="col-md-7">
                            <div class="form-group">
                                <input type="text" class="form-control" name="part_name" id="part_name">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 "> <label for="position" class="fw-600">Enter Part</label></div>
                        <div class="col-md-7">
                            <div class="form-group">
                                <select name="position" id="position" class="form-control">
                                    <option value="left">Left</option>
                                    <option value="right">Right</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn  my-quotations-btn next-btn" data-dismiss="modal">Back</button>
                <button type="button" onclick="add_new_part()" class="btn  my-quotations-btn next-btn">Add
                    Parts</button>
            </div>
        </div>

    </div>
</div>

@push('scripts')
    <script>
        function submit_parts_next_function() {
            var tot_quantity = 0;
            $(":input.calc_part_quant").each(function(i, val) {
                thisnmae = $(this).attr('name');
                num = thisnmae.replace(/[^0-9]/g, '');
                vald = $('select[name="quantity_parts_' + num + '"]').val();

                if ($(this).val() != '' && vald > 0) {
                    tot_quantity = tot_quantity + parseInt($(this).val());
                }
            });
            if (tot_quantity > 0) {
                submit_parts(6);
            } else {
                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        cancelButton: 'btn btn-danger',
                        confirmButton: 'btn '

                    },
                    buttonsStyling: false
                })

                swalWithBootstrapButtons.fire({
                    title: ' You didn’t select any part, Do you want to select?',
                    html: '',
                    icon: 'question',
                    showCancelButton: true,
                    cancelButtonText: 'No, Proceed!',
                    confirmButtonText: 'Yes, Select it!',

                    reverseButtons: false
                }).then((result) => {
                    if (result.value) {
                        // not proceed
                        $("html, body").animate({
                            scrollTop: 0
                        }, "slow");

                    } else if (
                        /* Read more about handling dismissals below */
                        result.dismiss === Swal.DismissReason.cancel
                    ) {
                        submit_parts(6);
                    }
                })
            }
        }

        function abc(id) {
            $('#hidden_fields' + id).toggle();
            if ($('#parts_' + id).prop('checked')) {
                $('#parts_' + id).val(1);

            } else {
                $('#parts_' + id).val(0);
                $('select[name=quantity_parts_' + id + ']').val(0);
                $('input[name=price_parts_' + id + ']').val(0);
            }

        }

        $('.checkbox-custom').click(function(e) {
            if ($(this).prop('checked')) {
                $(this).val(1);
            } else {
                $(this).val(0);
            }
        })


        function submit_parts(tab) {
            next_page('#parts_form', 6)
        }


        function add_new_part() {
            $.ajax({
                type: "POST",
                url: "{{ route('admin.quotation.parts.store') }}",
                data: $('#add-new-part').serialize(), // serializes the form's elements.
                success: function(data) {
                    $('#part-form').html(data.view);
                }
            });
        }
    </script>
@endpush
