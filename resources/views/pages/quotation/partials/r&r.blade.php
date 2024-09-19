<div class="app-content content" id="page6" style="display:none;">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-center  col-12 mb-2 text-center">
                <h3 class="content-header-title mb-0 d-inline-block">Type in any additional dollar value</h3>
            </div>
        </div>
        <div class="content-body">
            <section id="basic-form-layouts">
                <div class="row match-height">
                    <div class="col-md-12">
                        <div class="card">

                            <div class="card-content collapse show">
                                <div class="card-body">
                                    <div class="col-md-12 row mt-3">
                                        <div class="col-md-3"></div>
                                        <div class="col-md-6">
                                            <form class="form" id="submit_randr">
                                                @csrf
                                                <div class="form-body">
                                                    <div class="row">

                                                        <div class="col-md-4 tr"> <label for="userinput1"
                                                                class="fw-600">Remove & Replace</label></div>
                                                        <div class="col-md-8">
                                                            <div class="form-group">
                                                                <input type="hidden" name="main_id"
                                                                    value="{{ !empty($quote) ? $quote->id : '' }}">
                                                                <input type="text" class="form-control" list="rrlist" />
                                                                <datalist id="rrlist">
                                                                    <option value="Bodyshop" />
                                                                </datalist>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4 tr"><label for="userinput1"
                                                                class="fw-600">Details</label></div>
                                                        <div class="col-md-8">
                                                            <div class="form-group">
                                                                <textarea type="text" name="details"
                                                                    class="form-control" placeholder="Enter Details"
                                                                    rows="7">{{ !empty($quote) && $quote->additional_value ? $quote->additional_value->details : '' }}</textarea>
                                                            </div>
                                                        </div>


                                                        <div class="col-md-12 text-center">
                                                            <button onclick="back_fun('5', '6')" type="button"
                                                                class="btn  my-quotations-btn next-btn pull-left">Back</button>
                                                            <button onclick="next_page('#submit_randr', 7)" type="button"
                                                                class="btn  my-quotations-btn next-btn pull-right">Next</button>

                                                        </div>
                                                    </div>

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
