<div class="row">
    <div class="col-md-6">
        <?php foreach ($leftParts as $pa) {
        // if ($pa->position == 0) {
        $part_res = !empty($quote)
        ? $quote
        ->parts()
        ->whereId($pa->id)
        ->first()
        : 0;
        if ($part_res) {
        if ($part_res->pivot->part_price > 0) {
        $if_checkd_part = 'checked';
        $if_show_prt = 'block';
        } else {
        $if_checkd_part = '';
        $if_show_prt = 'none';
        } ?>

        <div class="col-md-12">
            <h4 class="card-title">
                <input <?php echo $if_checkd_part;
                    ?> type="checkbox"
                    name="parts_<?php echo $pa->id; ?>"
                    id="parts_<?php echo $pa->id; ?>"
                    value="1" class="checkbox-custom"
                    oninput="abc('<?php echo $pa->id; ?>')">
                <span
                    class="checkbox-text">{{ $pa->part_name }}</span>
            </h4>
        </div>


        <div class="col-md-12"
            id="hidden_fields<?php echo $pa->id; ?>"
            style="display: <?php echo $if_show_prt; ?>;">
            <div class="col-md-5 "> <label for="userinput1"
                    class="fw-600">Select the quantity of
                    Parts</label></div>
            <div class="col-md-7">
                <div class="form-group">
                    <select class="form-control"
                        name="quantity_parts_<?php echo $pa->id; ?>">

                        <?php for ($u = 0; $u <= 15;
                            $u++) { ?> <option <?php if ($part_res->
                            pivot->part_quantity == $u) {
                            echo 'selected';
                            } ?> value="<?php echo $u; ?>"><?php echo $u; ?></option>


                            <?php } ?>



                    </select>
                </div>
            </div>
            <div class="col-md-5 "> <label for="userinput1"
                    class="fw-600">Enter Price</label></div>
            <div class="col-md-7">
                <div class="form-group">
                    <input type="number"
                        value="<?php echo $part_res->pivot->part_price; ?>"
                        class="form-control calc_part_quant"
                        name="price_parts_<?php echo $pa->id; ?>">

                </div>
            </div>
        </div>

        <?php
        } else {
        ?>

        <div class="col-md-12">
            <h4 class="card-title">
                <input type="checkbox"
                    name="parts_<?php echo $pa->id; ?>"
                    id="parts_<?php echo $pa->id; ?>"
                    value="0" class="checkbox-custom"
                    oninput="abc('<?php echo $pa->id; ?>')">
                <span class="checkbox-text"><?php
                    echo $pa->part_name; ?></span>
            </h4>
        </div>


        <div class="col-md-12"
            id="hidden_fields<?php echo $pa->id; ?>"
            style="display: none;">
            <div class="col-md-5 "> <label for="userinput1"
                    class="fw-600">Select the quantity of
                    Parts</label></div>
            <div class="col-md-7">
                <div class="form-group">
                    <select class="form-control"
                        name="quantity_parts_<?php echo $pa->id; ?>">
                        <option value="0">Select Quantity</option>
                        <?php for ($u = 0; $u <= 15;
                            $u++) { ?> <option
                            value="<?php echo $u; ?>">
                            <?php echo $u; ?></option>


                            <?php } ?>

                    </select>
                </div>
            </div>
            <div class="col-md-5 "> <label for="userinput1"
                    class="fw-600">Enter Price</label></div>
            <div class="col-md-7">
                <div class="form-group">
                    <input type="number"
                        class="form-control calc_part_quant"
                        name="price_parts_<?php echo $pa->id; ?>">

                </div>
            </div>
        </div>

        <?php
        }
        // }
        } ?>
    </div>
    <div class="col-md-6">
        <?php foreach ($rightParts as $pa) {
            // if ($pa->position == 0) {
            $part_res = !empty($quote)
            ? $quote
            ->parts()
            ->whereId($pa->id)
            ->first()
            : 0;
            if ($part_res) {
            if ($part_res->pivot->part_price > 0) {
            $if_checkd_part = 'checked';
            $if_show_prt = 'block';
            } else {
            $if_checkd_part = '';
            $if_show_prt = 'none';
            } ?>

            <div class="col-md-12">
                <h4 class="card-title">
                    <input <?php echo $if_checkd_part;
                        ?> type="checkbox"
                        name="parts_<?php echo $pa->id; ?>"
                        id="parts_<?php echo $pa->id; ?>"
                        value="1" class="checkbox-custom"
                        oninput="abc('<?php echo $pa->id; ?>')">
                    <span
                        class="checkbox-text">{{ $pa->part_name }}</span>
                </h4>
            </div>


            <div class="col-md-12"
                id="hidden_fields<?php echo $pa->id; ?>"
                style="display: <?php echo $if_show_prt; ?>;">
                <div class="col-md-5 "> <label for="userinput1"
                        class="fw-600">Select the quantity of
                        Parts</label></div>
                <div class="col-md-7">
                    <div class="form-group">
                        <select class="form-control"
                            name="quantity_parts_<?php echo $pa->id; ?>">

                            <?php for ($u = 0; $u <= 15;
                                $u++) { ?> <option <?php if ($part_res->
                                pivot->part_quantity == $u) {
                                echo 'selected';
                                } ?> value="<?php echo $u; ?>"><?php echo $u; ?></option>


                                <?php } ?>



                        </select>
                    </div>
                </div>
                <div class="col-md-5 "> <label for="userinput1"
                        class="fw-600">Enter Price</label></div>
                <div class="col-md-7">
                    <div class="form-group">
                        <input type="number"
                            value="<?php echo $part_res->pivot->part_price; ?>"
                            class="form-control calc_part_quant"
                            name="price_parts_<?php echo $pa->id; ?>">

                    </div>
                </div>
            </div>

            <?php
            } else {
            ?>

            <div class="col-md-12">
                <h4 class="card-title">
                    <input type="checkbox"
                        name="parts_<?php echo $pa->id; ?>"
                        id="parts_<?php echo $pa->id; ?>"
                        value="0" class="checkbox-custom"
                        oninput="abc('<?php echo $pa->id; ?>')">
                    <span class="checkbox-text"><?php
                        echo $pa->part_name; ?></span>
                </h4>
            </div>


            <div class="col-md-12"
                id="hidden_fields<?php echo $pa->id; ?>"
                style="display: none;">
                <div class="col-md-5 "> <label for="userinput1"
                        class="fw-600">Select the quantity of
                        Parts</label></div>
                <div class="col-md-7">
                    <div class="form-group">
                        <select class="form-control"
                            name="quantity_parts_<?php echo $pa->id; ?>">
                            <option value="0">Select Quantity</option>
                            <?php for ($u = 0; $u <= 15;
                                $u++) { ?> <option
                                value="<?php echo $u; ?>">
                                <?php echo $u; ?></option>


                                <?php } ?>

                        </select>
                    </div>
                </div>
                <div class="col-md-5 "> <label for="userinput1"
                        class="fw-600">Enter Price</label></div>
                <div class="col-md-7">
                    <div class="form-group">
                        <input type="number"
                            class="form-control calc_part_quant"
                            name="price_parts_<?php echo $pa->id; ?>">

                    </div>
                </div>
            </div>

            <?php
            }
            // }
            } ?>
    </div>

    <div class="col-md-12" style="margin-bottom: 15px;">
        <button type="button" class="btn btn-success btn-number"
            data-toggle="modal" data-target="#enter_part">
            <span class="glyphicon glyphicon-plus"
                style="font-weight:bold;">+</span>
        </button>
    </div>

    <div class="col-md-12 text-center">
        <button onclick="back_fun('4', '5')" type="button"
            class="btn  my-quotations-btn next-btn pull-left">Back</button>
        <button type="button" onclick="submit_parts_next_function()"
            class="btn  my-quotations-btn next-btn pull-right">Next</button>

    </div>
</div>
