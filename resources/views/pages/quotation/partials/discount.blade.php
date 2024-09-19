<div class="app-content content" id="page7" style="display:none;">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-center  col-12 mb-2 text-center">
                <h3 class="content-header-title mb-0 d-inline-block">Add Discount</h3>
            </div>
        </div>
        <div class="content-body">
            <section id="basic-form-layouts">
                <div class="row match-height">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-content collapse show">
                                <div class="card-body">
                                    <form class="form" id="discount_form">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-3"></div>
                                            <div class="col-md-6">
                                                <div class="form-body">
                                                    <div class="row show-cat">
                                                        <div class="col-md-5">
                                                            <label>Select the percentage of discount</label>
                                                        </div>
                                                        <div class="col-md-7">
                                                            <input type="hidden" name="main_id"
                                                                value="{{ !empty($quote) ? $quote->id : '' }}">
                                                            <select class="form-control" name="discount">
                                                                <option value="">No Discount</option>
                                                                <?php for ($i = 1; $i <= 100; $i++) { ?> <option <?php if
                                                                    (!empty($quote) && $quote->discount && $quote->discount->percent_discount == $i) {
                                                                    echo 'selected';
                                                                    } ?> value="<?php
                                                                    echo $i; ?>"><?php
                                                                    echo $i; ?>%</option>
                                                                    <?php } ?>


                                                            </select>
                                                        </div>
                                                        <div class="col-md-12 text-center mt-2">
                                                            <button onclick="back_fun('6', '7')" type="button"
                                                                class="btn  my-quotations-btn next-btn pull-left">Back</button>
                                                            <button onclick="submit_discount('#discount_form', 8)" type="button"
                                                                class="btn  my-quotations-btn next-btn pull-right">Next</button>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3"></div>
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
