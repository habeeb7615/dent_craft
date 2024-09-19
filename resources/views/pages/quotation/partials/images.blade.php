<div class="app-content content" id="page3" style="display:none">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-center  col-12 mb-2 text-center">
                <h3 class="content-header-title mb-0 d-inline-block">Upload Photos</h3>
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
                                    <form id="page_three_image_upload" class="form-body" enctype="multipart/form-data">
                                        @csrf
                                        <div class="col-md-12 row mt-3">

                                            <div class="col-lg-3"></div>
                                            <div class="col-lg-3 col-md-6">
                                                <div class="form-group">
                                                    <div class="col-sm-6 col-md-12 imgUp">
                                                        <div class="imagePreview"></div>
                                                        <label class="btn btn-primary upload-btn">
                                                            Upload<input accept="image/x-png,image/gif,image/jpeg"
                                                                type="file" id='page_three_image' class="uploadFile img"
                                                                style="width: 0px;height: 0px;overflow: hidden;"
                                                                name="page_three_image" capture="camera">
                                                        </label>
                                                        <span class="text-danger">Maximum file size must be {{ $upload_mb }} MB</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-6 image-cat text-center">
                                                <div class="form-group">
                                                    <select class="form-control" name="access_type">

                                                        <option value="1">Assessed Damage</option>
                                                        <option value="2">Pre Existing Condition</option>
                                                    </select>
                                                </div>
                                                <input type="hidden" name="main_id"
                                                    value="{{ !empty($quote) ? $quote->id : '' }}">
                                                <input type="hidden" id="empty_img" value="@if (!empty($quote) && count($quote->images) > 0) 1 @else 0 @endif">
                                                <button type="submit"
                                                    class="btn  my-quotations-btn next-btn">Submit</button>
                                            </div>

                                            <div class="col-lg-3"></div>
                                        </div>
                                    </form>

                                    <div class="col-md-12 row mt-3" id="access_div">
                                        <div class="col-md-12">
                                            <h3>Assessed Damage</h3>
                                        </div>
                                        @foreach (!empty($quote) ? $quote->images : [] as $img)
                                            @if ($img->image_type === 'assessed_damage')
                                                <div class="col-lg-3 col-md-4 col-sm-6"
                                                    id="img_ac_<?php echo $img->id; ?>">
                                                    <div class="col-sm-12 col-md-12 imgUp">
                                                        <button
                                                            onclick="delete_img('<?php echo $img->id; ?>')"
                                                            type="button" class="close" data-dismiss="modal"><i
                                                                class="la la-trash"></i></button>

                                                        <a data-magnify="gallery" data-src="" data-caption="Assessed Damage"
                                                            data-group="a"
                                                            href="{{ asset($img->image_url) }}">
                                                            <img src="{{ asset($img->image_url) }}"
                                                                alt="" class="pe-img" id="access_1">
                                                        </a>


                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                    <div class="col-md-12 row mt-3" id="pre_div">
                                        <div class="col-md-12">
                                            <h3>Pre Existing Condition</h3>
                                        </div>
                                        @foreach (!empty($quote) ? $quote->images : [] as $img)
                                            @if ($img->image_type === 'pre_existing_condition')
                                                <div class="col-lg-3 col-md-4 col-sm-6"
                                                    id="img_ac_<?php echo $img->id; ?>">
                                                    <div class="col-sm-12 col-md-12 imgUp">
                                                        <button
                                                            onclick="delete_img('<?php echo $img->id; ?>')"
                                                            type="button" class="close" data-dismiss="modal"><i
                                                                class="la la-trash"></i></button>

                                                        <a data-magnify="gallery" data-src="" data-caption="Assessed Damage"
                                                            data-group="a"
                                                            href="{{ asset($img->image_url) }}">
                                                            <img src="{{ asset($img->image_url) }}"
                                                                alt="" class="pe-img" id="access_1">
                                                        </a>


                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                    <div class="col-md-12 mt-2">
                                        <p class="card-title">
                                            <input type="checkbox" name="qoute_email_check"
                                                id="qoute_email_check"
                                                {{ !empty($quote) && ($quote->attach_images_in_email == 1) ? 'checked' : '' }}
                                                onclick="page_three_check_box()" class="checkbox-custom"
                                                value="{{ !empty($quote) && $quote->attach_images_in_email ? 1 : 0 }}">
                                            <strong>Do you
                                                want to attach the photos in the Quotation Email?</strong></p>
                                    </div>
                                    <div class="col-md-12 text-center mt-3">
                                        <h5>Pre existing condition advises of anything that will not be covered in the
                                            quotation</h5>
                                    </div>
                                    <form class="form" id="page_three_form_submit" class="form-body">
                                        @csrf
                                        <input type="hidden" name="main_id" value="{{ !empty($quote) ? $quote->id : '' }}">
                                        <div class="col-md-12 row mt-3">
                                            <div class="col-md-2"></div>
                                            <div class="col-md-3 col-sm-6">

                                                <div class="form-body">
                                                    <div class="row">
                                                        <?php foreach ($preCon as $pre) { ?>
                                                        <div class="col-md-12">
                                                            <h4 class="card-title"><input
                                                                    {{ !empty($quote) && in_array($pre->id, $quote->pre_existing_conditions->pluck('id')->toArray()) ? 'checked' : '' }}
                                                                    type="checkbox"
                                                                    name="precon_{{ $pre->id }}"
                                                                    class="checkbox-custom"
                                                                    value="{{ $pre->is_checked ? '1' : '0' }}"> <span
                                                                    class="checkbox-text"> {{ $pre->name }}</span>
                                                            </h4>
                                                        </div>

                                                        <?php } ?>
                                                    </div>


                                                </div>

                                            </div>
                                            <div class="col-md-5 col-sm-6">
                                                <div class="form-group">
                                                    <select onchange="select_comment(this)" class="form-control" name="canned_comment">
                                                        <option value="">--Select Canned Comments--</option>
                                                        @foreach ($cannedComments as $com)
                                                            <option value="{{ $com->comment }}">
                                                                {{ $com->title }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <textarea type="text" class="form-control"
                                                        placeholder="Add Notes or Comments" rows="14" id="note_page3"
                                                        name="note_page3">{{ !empty($quote) ? $quote->image_notes : '' }}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-2"></div>
                                            <div class="col-md-12 text-center mt-2">
                                                <input type="hidden" name="main_id"
                                                    value="{{ !empty($quote) ? $quote->id : '' }}">
                                                <button onclick="back_fun('2', '3')" type="button"
                                                    class="btn  my-quotations-btn next-btn pull-left">Back</button>
                                                <button onclick="next_page_demaage(4)" type="button"
                                                    class="btn  my-quotations-btn next-btn pull-right">Next</button>

                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
<div class="modal fade" id="alert_page3" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Image Size Alert</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body text-center modal-inner">
                <p class="card-title">Your compressed photos exceed 10mb.<strong> </strong></p>
                <p class="card-title">Please remove some photos or <span id="no_of_emaiils"></span> emails will be
                    sent.<strong> </strong></p>
            </div>
            <div class="modal-footer ">
                <div class="col-md-12 text-center">
                    <button type="button" onclick="sumbit_page_three_data()" class="btn  my-quotations-btn next-btn"
                        data-dismiss="modal">Send multiple emails</button>
                    <button type="button" class="btn  my-quotations-btn next-btn" data-dismiss="modal">Delete
                        Photos</button>
                </div>
            </div>
        </div>

    </div>
</div>
