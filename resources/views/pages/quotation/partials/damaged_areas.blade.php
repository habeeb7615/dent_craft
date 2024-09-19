@push('styles')
    <style>
        .select2 {
            margin-right: 2rem;
        }
    </style>
@endpush

<div class="app-content content" id="page4" style="display:none">
    <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-center  col-12 mb-2 text-center">
          <h3 class="content-header-title mb-0 d-inline-block">Damaged Area</h3>
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
                      <div class="col-md-12 p-0">
                          <p class="card-title f-14 fw-600">Check the Area that appears to be Damaged. You can check more than one option.</p>
                         <form class="form" id=page_three_form_submit_>
                        <div class="form-body">
                         <div class="row mt-1" id="damaged_area_appending">
                              <div class="col-md-10 mx-auto">
                               <input type="hidden" name="main_id" value="<?php echo !empty($quote) ? $quote->id: '';?>">
                                            <div id="new-orders" class="media-list position-relative ps-container ps-theme-default" data-ps-id="6b4eb629-7102-f486-684d-2669bf318b2d">
                                              <div class="table-responsive">
                                                  <table id="new-orders-table" class="table table-hover table-xl mb-0  qs-table mt-1">
                                                  <tbody>
                                                    <tr class="table-bg-clr">
                                                      <td class="text-truncate bt-0 text-center t-br"  width="25%">Panel Area</td>
                                                      <td class="text-truncate bt-0 text-center t-br"  width="25%" style="display:none">No. of Dents</td>
                                                      <td class="text-truncate bt-0 text-center t-br"  width="25%">Panel Cost</td>
                                                      <td class="text-truncate bt-0 text-center"  width="25%">Additional</td>
                                                    </tr>
                                                  </tbody>

                                                </table>
                                                  <div class="qs-table3">
                                                    <div class="col-md-12 p-0  max-width-mb">
                                                        <table id="new-orders-tables" class="table table-hover table-xl mb-0  qs-table mt-1">
                                                          <tbody>


                                                              <?php foreach($damagedAreas as $pre){
                                                              $res=$pre->guards->pluck('name')->toArray();
                                                                $response='';
		                                                        if($res!=0){



		                                                       $gaurd =  array_search("+" ,array_column($res, 'name') );
		                                                       $gaurd_exteam =  array_search("Extreme Size" ,array_column($res, 'name') );
		                                                       $gaurd_alum =  array_search("Aluminium" ,array_column($res, 'name') );
		                                                       $gaurd_penel =  array_search("Panel Crease" ,array_column($res, 'name') );
		                                                       $gaurd_P2P =  array_search("P2P" ,array_column($res, 'name') );

		                                                  //   if(in_array("Default",array_column($res, 'guards_name'))){

		                                                  //   }else{

		                                                  //   }

		                                                  if(is_bool($gaurd)){ ?>
		                                                            <tr class="table-td-clr"  id="damagedcon_<?php echo $pre->id;?>_1" >
                                                              <td class="text-truncate text-left t-br"  width="25%"><?php echo $pre->panel_area_name; ?></td>
                                                              <td class="text-truncate text-center t-br"  width="25%" style="display:none">
                                                                <div class="form-group m-0">
                                                                   <select class="select2-tokenizer form-control damaged_parts" data-id="<?php echo $pre->id;?>_1" style="width: 100%">
                                                                     <option  value="0">Select Dents</option>
                                                                     <option selected value="1">1</option>
                                                                      <option  value="2">2</option>
                                                                      <option  value="3">3</option>
                                                                      <option  value="4">4</option>
                                                                      <option  value="5">5</option>
                                                                      <option  value="6">6</option>
                                                                      <option  value="7">7</option>
                                                                      <option  value="8">8</option>
                                                                     <option  value="9">9</option>
                                                                   </select>
                                                                </div>
                                                              </td>
                                                              <td class="text-truncate bt-0 text-center t-br"  width="25%">
                                                                <div class="form-group m-0">
                                                                   <select class="select2-tokenizer form-control text-left" id="amount_<?php echo $pre->id;?>_1"  style="width: 100%">
                                                                     <option  value="0">$0</option>
                                                                      <option  value="100">$100</option>
                                                                      <option  value="150">$150</option>
                                                                      <option  value="250">$250</option>
                                                                      <option  value="350">$350</option>
                                                                      <option  value="550">$550</option>
                                                                      <option  value="750">$750</option>
                                                                      <option  value="950">$950</option>
                                                                      <option  value="1200">$1200</option>
                                                                     <option value="1650">$1650</option>
                                                                     <option  value="2000">$2000</option>
                                                                   </select>
                                                                </div>
                                                              </td>
                                                              <td class="text-truncate bt-0 text-center"  width="25%">
                                                                <div class="form-group m-0">
                                                                   <select class="js-select2 form-control" onchange="check_select_new_(this)" data-id="<?php echo $pre->id;?>"  id="damagedconselect_<?php echo $pre->id;?>" style="width: 100%" multiple="multiple" >
                                                                    <option value="1" selected locked="locked" >+</option>
                                                                    <option value="2" <?php if(!is_bool($gaurd_exteam)){ echo "selected"; }?> >Extreme Size</option>
                                                                    <option value="3" <?php if(!is_bool($gaurd_alum)){ echo "selected"; }?> >Aluminium</option>
                                                                    <option value="4" <?php if(!is_bool($gaurd_penel)){ echo "selected"; }?>>Panel Crease</option>
                                                                    <option value="5" <?php if(!is_bool($gaurd_P2P)){ echo "selected"; }?> >P2P</option>
                                                                   </select>
                                                                </div>
                                                              </td>
                                                            </tr>


		                                              <?php    }else{

		                                              $quantity=0;
		                                              $am=0;

		                                              ?>

		                                              <tr class="table-td-clr"  id="damagedcon_<?php echo $pre->id;?>_1" >
                                                              <td class="text-truncate text-left t-br"  width="25%"><?php echo $pre->panel_area_name; ?></td>
                                                              <td class="text-truncate text-center t-br"  width="25%" style="display:none">
                                                                <div class="form-group m-0">
                                                                   <select class="select2-tokenizer form-control damaged_parts" data-id="<?php echo $pre->id;?>_1" style="width: 100%">
                                                                     <option <?php if($res[$gaurd]['quantity']==0){echo "selected"; $quantity=1; } ?>  value="0">Select Dents</option>
                                                                     <option  <?php if($res[$gaurd]['quantity']==1){echo "selected"; $quantity=1;}  ?> value="1">1</option>
                                                                      <option  <?php if($res[$gaurd]['quantity']==2){echo "selected"; $quantity=1;} ?> value="2">2</option>
                                                                      <option <?php if($res[$gaurd]['quantity']==3){echo "selected"; $quantity=1;} ?> value="3">3</option>
                                                                      <option <?php if($res[$gaurd]['quantity']==4){echo "selected"; $quantity=1;} ?> value="4">4</option>
                                                                      <option  <?php if($res[$gaurd]['quantity']==5){echo "selected"; $quantity=1;} ?> value="5">5</option>
                                                                      <option  <?php if($res[$gaurd]['quantity']==6){echo "selected"; $quantity=1;} ?> value="6">6</option>
                                                                      <option  <?php if($res[$gaurd]['quantity']==7){echo "selected"; $quantity=1;} ?> value="7">7</option>
                                                                      <option <?php if($res[$gaurd]['quantity']==8){echo "selected"; $quantity=1;} ?>  value="8">8</option>
                                                                     <option <?php if($res[$gaurd]['quantity']==9){echo "selected"; $quantity=1; } ?> value="9">9</option>
                                                                     <?php
                                                                     if($quantity==0){ ?>
                                                                          <option selected   value="<?php echo $res[$gaurd]['quantity']; ?>"><?php echo $res[$gaurd]['quantity']; ?></option>
                                                                   <?php  }

                                                                     ?>
                                                                   </select>
                                                                </div>
                                                              </td>
                                                              <td class="text-truncate bt-0 text-center t-br"  width="25%">
                                                                <div class="form-group m-0">
                                                                   <select class="select2-tokenizer form-control text-left" id="amount_<?php echo $pre->id;?>_1"  style="width: 100%">
                                                                     <option  <?php if($res[$gaurd]['amount']==0){echo "selected"; $am=1;} ?> value="0">$0</option>
                                                                      <option  <?php if($res[$gaurd]['amount']==100){echo "selected"; $am=1;} ?>  value="100">$100</option>
                                                                      <option  <?php if($res[$gaurd]['amount']==150){echo "selected"; $am=1;} ?> value="150">$150</option>
                                                                      <option  <?php if($res[$gaurd]['amount']==250){echo "selected"; $am=1;} ?> value="250">$250</option>
                                                                      <option <?php if($res[$gaurd]['amount']==350){echo "selected"; $am=1;} ?> value="350">$350</option>
                                                                      <option <?php if($res[$gaurd]['amount']==550){echo "selected"; $am=1;} ?>  value="550">$550</option>
                                                                      <option  <?php if($res[$gaurd]['amount']==750){echo "selected"; $am=1;} ?> value="750">$750</option>
                                                                      <option  <?php if($res[$gaurd]['amount']==950){echo "selected"; $am=1;} ?> value="950">$950</option>
                                                                      <option <?php if($res[$gaurd]['amount']==1200){echo "selected"; $am=1;} ?>  value="1200">$1200</option>
                                                                     <option <?php if($res[$gaurd]['amount']==1650){echo "selected"; $am=1;} ?> value="1650">$1650</option>
                                                                     <option  <?php if($res[$gaurd]['amount']==2000){echo "selected"; $am=1;} ?> value="2000">$2000</option>

                                                                      <?php
                                                                     if($am==0){ ?>
                                                                          <option selected   value="<?php echo $res[$gaurd]['amount']; ?>"><?php echo $res[$gaurd]['amount']; ?></option>
                                                                   <?php  }

                                                                     ?>
                                                                   </select>
                                                                </div>
                                                              </td>
                                                              <td class="text-truncate bt-0 text-center"  width="25%">
                                                                <div class="form-group m-0">
                                                                   <select class="js-select2 form-control" onchange="check_select_new_(this)" data-id="<?php echo $pre->id;?>"  id="damagedconselect_<?php echo $pre->id;?>" style="width: 100%" multiple="multiple" >
                                                                    <option value="1" selected locked="locked" >+</option>
                                                                    <option value="2" <?php if(!is_bool($gaurd_exteam)){ echo "selected"; }?> >Extreme Size</option>
                                                                    <option value="3" <?php if(!is_bool($gaurd_alum)){ echo "selected"; }?> >Aluminium</option>
                                                                    <option value="4" <?php if(!is_bool($gaurd_penel)){ echo "selected"; }?>>Panel Crease</option>
                                                                    <option value="5" <?php if(!is_bool($gaurd_P2P)){ echo "selected"; }?> >P2P</option>
                                                                   </select>
                                                                </div>
                                                              </td>
                                                            </tr>

		                                              <?php    }



		                                                  //   if(in_array("Default",array_column($res, 'guards_name'))){

		                                                  //   }else{

		                                                  //   }

		                                                  if(is_bool($gaurd_exteam)){ ?>
		                                                            <tr class="table-td-clr"  id="damagedcon_<?php echo $pre->id;?>_2"  style="display:none">
                                                              <td class="text-truncate text-left t-br"  width="25%"><?php echo $pre->panel_area_name; ?></td>
                                                              <td class="text-truncate text-center t-br"  width="25%" style="display:none">
                                                                <div class="form-group m-0">
                                                                   <select class="select2-tokenizer form-control damaged_parts" data-id="<?php echo $pre->id;?>_2" style="width: 100%">
                                                                     <option  value="0">Select Dents</option>
                                                                     <option  selected value="1">1</option>
                                                                      <option  value="2">2</option>
                                                                      <option  value="3">3</option>
                                                                      <option  value="4">4</option>
                                                                      <option  value="5">5</option>
                                                                      <option  value="6">6</option>
                                                                      <option  value="7">7</option>
                                                                      <option  value="8">8</option>
                                                                     <option  value="9">9</option>
                                                                   </select>
                                                                </div>
                                                              </td>
                                                              <td class="text-truncate bt-0 text-center t-br"  width="25%">
                                                                <div class="form-group m-0">
                                                                   <select class="select2-tokenizer form-control text-left" id="amount_<?php echo $pre->id;?>_2"  style="width: 100%">
                                                                     <option  value="0">$0</option>
                                                                      <option  value="100">$100</option>
                                                                      <option  value="150">$150</option>
                                                                      <option  value="250">$250</option>
                                                                      <option  value="350">$350</option>
                                                                      <option  value="550">$550</option>
                                                                      <option  value="750">$750</option>
                                                                      <option  value="950">$950</option>
                                                                      <option  value="1200">$1200</option>
                                                                     <option value="1650">$1650</option>
                                                                     <option  value="2000">$2000</option>
                                                                   </select>
                                                                </div>
                                                              </td>
                                                              <td class="text-truncate bt-0 text-center"  width="25%">
                                                                Extreme Size
                                                                </div>
                                                              </td>
                                                            </tr>


		                                              <?php    }else{

		                                               $quantity=0;
		                                              $am=0;
		                                              ?>

		                                              <tr class="table-td-clr"  id="damagedcon_<?php echo $pre->id;?>_2" >
                                                              <td class="text-truncate text-left t-br"  width="25%"><?php echo $pre->panel_area_name; ?></td>
                                                              <td class="text-truncate text-center t-br"  width="25%" style="display:none">
                                                                <div class="form-group m-0">
                                                                   <select class="select2-tokenizer form-control damaged_parts" data-id="<?php echo $pre->id;?>_2" style="width: 100%">
                                                                     <option <?php if($res[$gaurd_exteam]['quantity']==0){echo "selected";$quantity=1;} ?>  value="0">Select Dents</option>
                                                                     <option  <?php if($res[$gaurd_exteam]['quantity']==1){echo "selected";$quantity=1;} ?> value="1">1</option>
                                                                      <option  <?php if($res[$gaurd_exteam]['quantity']==2){echo "selected";$quantity=1;} ?> value="2">2</option>
                                                                      <option <?php if($res[$gaurd_exteam]['quantity']==3){echo "selected";$quantity=1;} ?> value="3">3</option>
                                                                      <option <?php if($res[$gaurd_exteam]['quantity']==4){echo "selected";$quantity=1;} ?> value="4">4</option>
                                                                      <option  <?php if($res[$gaurd_exteam]['quantity']==5){echo "selected";$quantity=1;} ?> value="5">5</option>
                                                                      <option  <?php if($res[$gaurd_exteam]['quantity']==6){echo "selected";$quantity=1;} ?> value="6">6</option>
                                                                      <option  <?php if($res[$gaurd_exteam]['quantity']==7){echo "selected";$quantity=1;} ?> value="7">7</option>
                                                                      <option <?php if($res[$gaurd_exteam]['quantity']==8){echo "selected";$quantity=1;} ?>  value="8">8</option>
                                                                     <option <?php if($res[$gaurd_exteam]['quantity']==9){echo "selected";$quantity=1;} ?> value="9">9</option>
                                                                     <?php
                                                                     if($quantity==0){ ?>
                                                                          <option selected   value="<?php echo $res[$gaurd_exteam]['quantity']; ?>"><?php echo $res[$gaurd_exteam]['quantity']; ?></option>
                                                                   <?php  }

                                                                     ?>
                                                                   </select>
                                                                </div>
                                                              </td>
                                                              <td class="text-truncate bt-0 text-center t-br"  width="25%">
                                                                <div class="form-group m-0">
                                                                   <select class="select2-tokenizer form-control text-left" id="amount_<?php echo $pre->id;?>_2"  style="width: 100%">
                                                                     <option  <?php if($res[$gaurd_exteam]['amount']==0){echo "selected"; $am=1;} ?> value="0">$0</option>
                                                                      <option  <?php if($res[$gaurd_exteam]['amount']==100){echo "selected"; $am=1;} ?>  value="100">$100</option>
                                                                      <option  <?php if($res[$gaurd_exteam]['amount']==150){echo "selected"; $am=1;} ?> value="150">$150</option>
                                                                      <option  <?php if($res[$gaurd_exteam]['amount']==250){echo "selected"; $am=1;} ?> value="250">$250</option>
                                                                      <option <?php if($res[$gaurd_exteam]['amount']==350){echo "selected"; $am=1;} ?> value="350">$350</option>
                                                                      <option <?php if($res[$gaurd_exteam]['amount']==550){echo "selected"; $am=1;} ?>  value="550">$550</option>
                                                                      <option  <?php if($res[$gaurd_exteam]['amount']==750){echo "selected"; $am=1;} ?> value="750">$750</option>
                                                                      <option  <?php if($res[$gaurd_exteam]['amount']==950){echo "selected"; $am=1;} ?> value="950">$950</option>
                                                                      <option <?php if($res[$gaurd_exteam]['amount']==1200){echo "selected"; $am=1;} ?>  value="1200">$1200</option>
                                                                     <option <?php if($res[$gaurd_exteam]['amount']==1650){echo "selected"; $am=1;} ?> value="1650">$1650</option>
                                                                     <option  <?php if($res[$gaurd_exteam]['amount']==2000){echo "selected"; $am=1;} ?> value="2000">$2000</option>
                                                                      <?php
                                                                     if($am==0){ ?>
                                                                          <option selected   value="<?php echo $res[$gaurd_exteam]['amount']; ?>"><?php echo $res[$gaurd_exteam]['amount']; ?></option>
                                                                   <?php  }

                                                                     ?>
                                                                   </select>
                                                                </div>
                                                              </td>
                                                              <td class="text-truncate bt-0 text-center"  width="25%">
                                                                <div class="form-group m-0">
                                                                   Extreme Size
                                                                </div>
                                                              </td>
                                                            </tr>

		                                              <?php    }





		                                                  if(is_bool($gaurd_alum)){ ?>
		                                                            <tr class="table-td-clr"  id="damagedcon_<?php echo $pre->id;?>_3" style="display:none">
                                                              <td class="text-truncate text-left t-br"  width="25%"><?php echo $pre->panel_area_name; ?></td>
                                                              <td class="text-truncate text-center t-br"  width="25%" style="display:none">
                                                                <div class="form-group m-0">
                                                                   <select class="select2-tokenizer form-control damaged_parts" data-id="<?php echo $pre->id;?>_3" style="width: 100%">
                                                                     <option  value="0">Select Dents</option>
                                                                     <option selected value="1">1</option>
                                                                      <option  value="2">2</option>
                                                                      <option  value="3">3</option>
                                                                      <option  value="4">4</option>
                                                                      <option  value="5">5</option>
                                                                      <option  value="6">6</option>
                                                                      <option  value="7">7</option>
                                                                      <option  value="8">8</option>
                                                                     <option  value="9">9</option>
                                                                   </select>
                                                                </div>
                                                              </td>
                                                              <td class="text-truncate bt-0 text-center t-br"  width="25%">
                                                                <div class="form-group m-0">
                                                                   <select class="select2-tokenizer form-control text-left" id="amount_<?php echo $pre->id;?>_3"  style="width: 100%">
                                                                     <option  value="0">$0</option>
                                                                      <option  value="100">$100</option>
                                                                      <option  value="150">$150</option>
                                                                      <option  value="250">$250</option>
                                                                      <option  value="350">$350</option>
                                                                      <option  value="550">$550</option>
                                                                      <option  value="750">$750</option>
                                                                      <option  value="950">$950</option>
                                                                      <option  value="1200">$1200</option>
                                                                     <option value="1650">$1650</option>
                                                                     <option  value="2000">$2000</option>
                                                                   </select>
                                                                </div>
                                                              </td>
                                                              <td class="text-truncate bt-0 text-center"  width="25%">
                                                                Aluminium
                                                                </div>
                                                              </td>
                                                            </tr>


		                                              <?php    }else{
		                                               $quantity=0;
		                                              $am=0;?>

		                                              <tr class="table-td-clr"  id="damagedcon_<?php echo $pre->id;?>_3" >
                                                              <td class="text-truncate text-left t-br"  width="25%"><?php echo $pre->panel_area_name; ?></td>
                                                              <td class="text-truncate text-center t-br"  width="25%" style="display:none">
                                                                <div class="form-group m-0">
                                                                   <select class="select2-tokenizer form-control damaged_parts" data-id="<?php echo $pre->id;?>_3" style="width: 100%">
                                                                     <option <?php if($res[$gaurd_alum]['quantity']==0){echo "selected";$quantity=1;} ?>  value="0">Select Dents</option>
                                                                     <option  <?php if($res[$gaurd_alum]['quantity']==1){echo "selected";$quantity=1;} ?> value="1">1</option>
                                                                      <option  <?php if($res[$gaurd_alum]['quantity']==2){echo "selected";$quantity=1;} ?> value="2">2</option>
                                                                      <option <?php if($res[$gaurd_alum]['quantity']==3){echo "selected";$quantity=1;} ?> value="3">3</option>
                                                                      <option <?php if($res[$gaurd_alum]['quantity']==4){echo "selected";$quantity=1;} ?> value="4">4</option>
                                                                      <option  <?php if($res[$gaurd_alum]['quantity']==5){echo "selected";$quantity=1;} ?> value="5">5</option>
                                                                      <option  <?php if($res[$gaurd_alum]['quantity']==6){echo "selected";$quantity=1;} ?> value="6">6</option>
                                                                      <option  <?php if($res[$gaurd_alum]['quantity']==7){echo "selected";$quantity=1;} ?> value="7">7</option>
                                                                      <option <?php if($res[$gaurd_alum]['quantity']==8){echo "selected";$quantity=1;} ?>  value="8">8</option>
                                                                     <option <?php if($res[$gaurd_alum]['quantity']==9){echo "selected";$quantity=1;} ?> value="9">9</option>
                                                                      <?php
                                                                     if($quantity==0){ ?>
                                                                          <option selected   value="<?php echo $res[$gaurd_alum]['quantity']; ?>"><?php echo $res[$gaurd_alum]['quantity']; ?></option>
                                                                   <?php  }

                                                                     ?>
                                                                   </select>
                                                                </div>
                                                              </td>
                                                              <td class="text-truncate bt-0 text-center t-br"  width="25%">
                                                                <div class="form-group m-0">
                                                                   <select class="select2-tokenizer form-control text-left" id="amount_<?php echo $pre->id;?>_3"  style="width: 100%">
                                                                     <option  <?php if($res[$gaurd_alum]['amount']==0){echo "selected";$am=1;} ?> value="0">$0</option>
                                                                      <option  <?php if($res[$gaurd_alum]['amount']==100){echo "selected";$am=1;} ?>  value="100">$100</option>
                                                                      <option  <?php if($res[$gaurd_alum]['amount']==150){echo "selected";$am=1;} ?> value="150">$150</option>
                                                                      <option  <?php if($res[$gaurd_alum]['amount']==250){echo "selected";$am=1;} ?> value="250">$250</option>
                                                                      <option <?php if($res[$gaurd_alum]['amount']==350){echo "selected";$am=1;} ?> value="350">$350</option>
                                                                      <option <?php if($res[$gaurd_alum]['amount']==550){echo "selected";$am=1;} ?>  value="550">$550</option>
                                                                      <option  <?php if($res[$gaurd_alum]['amount']==750){echo "selected";$am=1;} ?> value="750">$750</option>
                                                                      <option  <?php if($res[$gaurd_alum]['amount']==950){echo "selected";$am=1;} ?> value="950">$950</option>
                                                                      <option <?php if($res[$gaurd_alum]['amount']==1200){echo "selected";$am=1;} ?>  value="1200">$1200</option>
                                                                     <option <?php if($res[$gaurd_alum]['amount']==1650){echo "selected";$am=1;} ?> value="1650">$1650</option>
                                                                     <option  <?php if($res[$gaurd_alum]['amount']==2000){echo "selected";$am=1;} ?> value="2000">$2000</option>
                                                                     <?php
                                                                     if($am==0){ ?>
                                                                          <option selected   value="<?php echo $res[$gaurd_alum]['amount']; ?>"><?php echo $res[$gaurd_alum]['amount']; ?></option>
                                                                   <?php  }

                                                                     ?>
                                                                   </select>
                                                                </div>
                                                              </td>
                                                              <td class="text-truncate bt-0 text-center"  width="25%">
                                                                <div class="form-group m-0">
                                                                   Aluminium
                                                                </div>
                                                              </td>
                                                            </tr>

		                                              <?php    }





		                                                  if(is_bool($gaurd_penel)){ ?>
		                                                            <tr class="table-td-clr"  id="damagedcon_<?php echo $pre->id;?>_4"  style="display:none">
                                                              <td class="text-truncate text-left t-br"  width="25%"><?php echo $pre->panel_area_name; ?></td>
                                                              <td class="text-truncate text-center t-br"  width="25%" style="display:none" >
                                                                <div class="form-group m-0">
                                                                   <select class="select2-tokenizer form-control damaged_parts" data-id="<?php echo $pre->id;?>_4" style="width: 100%">
                                                                     <option  value="0">Select Dents</option>
                                                                     <option  value="1">1</option>
                                                                      <option  value="2">2</option>
                                                                      <option  value="3">3</option>
                                                                      <option  value="4">4</option>
                                                                      <option  value="5">5</option>
                                                                      <option  value="6">6</option>
                                                                      <option  value="7">7</option>
                                                                      <option  value="8">8</option>
                                                                     <option  value="9">9</option>
                                                                   </select>
                                                                </div>
                                                              </td>
                                                              <td class="text-truncate bt-0 text-center t-br"  width="25%">
                                                                <div class="form-group m-0">
                                                                   <select class="select2-tokenizer form-control text-left" id="amount_<?php echo $pre->id;?>_4"  style="width: 100%">
                                                                     <option  value="0">$0</option>
                                                                      <option  value="100">$100</option>
                                                                      <option  value="150">$150</option>
                                                                      <option  value="250">$250</option>
                                                                      <option  value="350">$350</option>
                                                                      <option  value="550">$550</option>
                                                                      <option  value="750">$750</option>
                                                                      <option  value="950">$950</option>
                                                                      <option  value="1200">$1200</option>
                                                                     <option value="1650">$1650</option>
                                                                     <option  value="2000">$2000</option>
                                                                   </select>
                                                                </div>
                                                              </td>
                                                              <td class="text-truncate bt-0 text-center"  width="25%">
                                                                Panel Crease
                                                                </div>
                                                              </td>
                                                            </tr>


		                                              <?php    }else{
		                                               $quantity=0;
		                                              $am=0;?>

		                                              <tr class="table-td-clr"  id="damagedcon_<?php echo $pre->id;?>_4" >
                                                              <td class="text-truncate text-left t-br"  width="25%"><?php echo $pre->panel_area_name; ?></td>
                                                              <td class="text-truncate text-center t-br"  width="25%" style="display:none">
                                                                <div class="form-group m-0">
                                                                   <select class="select2-tokenizer form-control damaged_parts" data-id="<?php echo $pre->id;?>_4" style="width: 100%">
                                                                     <option <?php if($res[$gaurd_penel]['quantity']==0){echo "selected";$quantity=1;} ?>  value="0">Select Dents</option>
                                                                     <option  <?php if($res[$gaurd_penel]['quantity']==1){echo "selected";$quantity=1;} ?> value="1">1</option>
                                                                      <option  <?php if($res[$gaurd_penel]['quantity']==2){echo "selected";$quantity=1;} ?> value="2">2</option>
                                                                      <option <?php if($res[$gaurd_penel]['quantity']==3){echo "selected";$quantity=1;} ?> value="3">3</option>
                                                                      <option <?php if($res[$gaurd_penel]['quantity']==4){echo "selected";$quantity=1;} ?> value="4">4</option>
                                                                      <option  <?php if($res[$gaurd_penel]['quantity']==5){echo "selected";$quantity=1;} ?> value="5">5</option>
                                                                      <option  <?php if($res[$gaurd_penel]['quantity']==6){echo "selected";$quantity=1;} ?> value="6">6</option>
                                                                      <option  <?php if($res[$gaurd_penel]['quantity']==7){echo "selected";$quantity=1;} ?> value="7">7</option>
                                                                      <option <?php if($res[$gaurd_penel]['quantity']==8){echo "selected";$quantity=1;} ?>  value="8">8</option>
                                                                     <option <?php if($res[$gaurd_penel]['quantity']==9){echo "selected";$quantity=1;} ?> value="9">9</option>
                                                                      <?php
                                                                     if($quantity==0){ ?>
                                                                          <option selected   value="<?php echo $res[$gaurd_penel]['quantity']; ?>"><?php echo $res[$gaurd_penel]['quantity']; ?></option>
                                                                   <?php  }

                                                                     ?>

                                                                   </select>
                                                                </div>
                                                              </td>
                                                              <td class="text-truncate bt-0 text-center t-br"  width="25%">
                                                                <div class="form-group m-0">
                                                                   <select class="select2-tokenizer form-control text-left" id="amount_<?php echo $pre->id;?>_4"  style="width: 100%">
                                                                     <option  <?php if($res[$gaurd_penel]['amount']==0){echo "selected";$am=1;} ?> value="0">$0</option>
                                                                      <option  <?php if($res[$gaurd_penel]['amount']==100){echo "selected";$am=1;} ?>  value="100">$100</option>
                                                                      <option  <?php if($res[$gaurd_penel]['amount']==150){echo "selected";$am=1;} ?> value="150">$150</option>
                                                                      <option  <?php if($res[$gaurd_penel]['amount']==250){echo "selected";$am=1;} ?> value="250">$250</option>
                                                                      <option <?php if($res[$gaurd_penel]['amount']==350){echo "selected";$am=1;} ?> value="350">$350</option>
                                                                      <option <?php if($res[$gaurd_penel]['amount']==550){echo "selected";$am=1;} ?>  value="550">$550</option>
                                                                      <option  <?php if($res[$gaurd_penel]['amount']==750){echo "selected";$am=1;} ?> value="750">$750</option>
                                                                      <option  <?php if($res[$gaurd_penel]['amount']==950){echo "selected";$am=1;} ?> value="950">$950</option>
                                                                      <option <?php if($res[$gaurd_penel]['amount']==1200){echo "selected";$am=1;} ?>  value="1200">$1200</option>
                                                                     <option <?php if($res[$gaurd_penel]['amount']==1650){echo "selected";$am=1;} ?> value="1650">$1650</option>
                                                                     <option  <?php if($res[$gaurd_penel]['amount']==2000){echo "selected";$am=1;} ?> value="2000">$2000</option>
                                                                      <?php
                                                                     if($am==0){ ?>
                                                                          <option selected   value="<?php echo $res[$gaurd_penel]['amount']; ?>"><?php echo $res[$gaurd_penel]['amount']; ?></option>
                                                                   <?php  }

                                                                     ?>
                                                                   </select>
                                                                </div>
                                                              </td>
                                                              <td class="text-truncate bt-0 text-center"  width="25%">
                                                                <div class="form-group m-0">
                                                                   Panel Crease
                                                                </div>
                                                              </td>
                                                            </tr>

		                                              <?php    }



		                                                  if(is_bool($gaurd_P2P)){ ?>
		                                                            <tr class="table-td-clr"  id="damagedcon_<?php echo $pre->id;?>_5" style="display:none">
                                                              <td class="text-truncate text-left t-br"  width="25%"><?php echo $pre->panel_area_name; ?></td>
                                                              <td class="text-truncate text-center t-br"  width="25%" style="display:none">
                                                                <div class="form-group m-0">
                                                                   <select class="select2-tokenizer form-control damaged_parts" data-id="<?php echo $pre->id;?>_5" style="width: 100%">
                                                                     <option  value="0">Select Dents</option>
                                                                     <option  value="1">1</option>
                                                                      <option  value="2">2</option>
                                                                      <option  value="3">3</option>
                                                                      <option  value="4">4</option>
                                                                      <option  value="5">5</option>
                                                                      <option  value="6">6</option>
                                                                      <option  value="7">7</option>
                                                                      <option  value="8">8</option>
                                                                     <option  value="9">9</option>
                                                                   </select>
                                                                </div>
                                                              </td>
                                                              <td class="text-truncate bt-0 text-center t-br"  width="25%">
                                                                <div class="form-group m-0">
                                                                   <select class="select2-tokenizer form-control text-left" id="amount_<?php echo $pre->id;?>_5"  style="width: 100%">
                                                                     <option  value="0">$0</option>
                                                                      <option  value="100">$100</option>
                                                                      <option  value="150">$150</option>
                                                                      <option  value="250">$250</option>
                                                                      <option  value="350">$350</option>
                                                                      <option  value="550">$550</option>
                                                                      <option  value="750">$750</option>
                                                                      <option  value="950">$950</option>
                                                                      <option  value="1200">$1200</option>
                                                                     <option value="1650">$1650</option>
                                                                     <option  value="2000">$2000</option>
                                                                   </select>
                                                                </div>
                                                              </td>
                                                              <td class="text-truncate bt-0 text-center"  width="25%">
                                                                P2P
                                                                </div>
                                                              </td>
                                                            </tr>


		                                              <?php    }else{
		                                              $quantity=0;
		                                              $am=0;
		                                              ?>

		                                              <tr class="table-td-clr"  id="damagedcon_<?php echo $pre->id;?>_5" >
                                                              <td class="text-truncate text-left t-br"  width="25%"><?php echo $pre->panel_area_name; ?></td>
                                                              <td class="text-truncate text-center t-br"  width="25%" style="display:none">
                                                                <div class="form-group m-0">
                                                                   <select class="select2-tokenizer form-control damaged_parts" data-id="<?php echo $pre->id;?>_5" style="width: 100%">
                                                                     <option <?php if($res[$gaurd_P2P]['quantity']==0){echo "selected";$quantity=1;} ?>  value="0">Select Dents</option>
                                                                     <option  <?php if($res[$gaurd_P2P]['quantity']==1){echo "selected";$quantity=1;} ?> value="1">1</option>
                                                                      <option  <?php if($res[$gaurd_P2P]['quantity']==2){echo "selected";$quantity=1;} ?> value="2">2</option>
                                                                      <option <?php if($res[$gaurd_P2P]['quantity']==3){echo "selected";$quantity=1;} ?> value="3">3</option>
                                                                      <option <?php if($res[$gaurd_P2P]['quantity']==4){echo "selected";$quantity=1;} ?> value="4">4</option>
                                                                      <option  <?php if($res[$gaurd_P2P]['quantity']==5){echo "selected";$quantity=1;} ?> value="5">5</option>
                                                                      <option  <?php if($res[$gaurd_P2P]['quantity']==6){echo "selected";$quantity=1;} ?> value="6">6</option>
                                                                      <option  <?php if($res[$gaurd_P2P]['quantity']==7){echo "selected";$quantity=1;} ?> value="7">7</option>
                                                                      <option <?php if($res[$gaurd_P2P]['quantity']==8){echo "selected";$quantity=1;} ?>  value="8">8</option>
                                                                     <option <?php if($res[$gaurd_P2P]['quantity']==9){echo "selected";$quantity=1;} ?> value="9">9</option>
                                                                     <?php
                                                                     if($quantity==0){ ?>
                                                                          <option selected   value="<?php echo $res[$gaurd_P2P]['quantity']; ?>"><?php echo $res[$gaurd_P2P]['quantity']; ?></option>
                                                                   <?php  }

                                                                     ?>
                                                                   </select>
                                                                </div>
                                                              </td>
                                                              <td class="text-truncate bt-0 text-center t-br"  width="25%">
                                                                <div class="form-group m-0">
                                                                   <select class="select2-tokenizer form-control text-left" id="amount_<?php echo $pre->id;?>_5"  style="width: 100%">
                                                                     <option  <?php if($res[$gaurd_P2P]['amount']==0){echo "selected";$am=1;} ?> value="0">$0</option>
                                                                      <option  <?php if($res[$gaurd_P2P]['amount']==100){echo "selected";$am=1;} ?>  value="100">$100</option>
                                                                      <option  <?php if($res[$gaurd_P2P]['amount']==150){echo "selected";$am=1;} ?> value="150">$150</option>
                                                                      <option  <?php if($res[$gaurd_P2P]['amount']==250){echo "selected";$am=1;} ?> value="250">$250</option>
                                                                      <option <?php if($res[$gaurd_P2P]['amount']==350){echo "selected";$am=1;} ?> value="350">$350</option>
                                                                      <option <?php if($res[$gaurd_P2P]['amount']==550){echo "selected";$am=1;} ?>  value="550">$550</option>
                                                                      <option  <?php if($res[$gaurd_P2P]['amount']==750){echo "selected";$am=1;} ?> value="750">$750</option>
                                                                      <option  <?php if($res[$gaurd_P2P]['amount']==950){echo "selected";$am=1;} ?> value="950">$950</option>
                                                                      <option <?php if($res[$gaurd_P2P]['amount']==1200){echo "selected";$am=1;} ?>  value="1200">$1200</option>
                                                                     <option <?php if($res[$gaurd_P2P]['amount']==1650){echo "selected";$am=1;} ?> value="1650">$1650</option>
                                                                     <option  <?php if($res[$gaurd_P2P]['amount']==2000){echo "selected";$am=1;} ?> value="2000">$2000</option>
                                                                       <?php
                                                                     if($am==0){ ?>
                                                                          <option selected   value="<?php echo $res[$gaurd_P2P]['amount']; ?>"><?php echo $res[$gaurd_P2P]['amount']; ?></option>
                                                                   <?php  }

                                                                     ?>
                                                                   </select>
                                                                </div>
                                                              </td>
                                                              <td class="text-truncate bt-0 text-center"  width="25%">
                                                                <div class="form-group m-0">
                                                                   P2P
                                                                </div>
                                                              </td>
                                                            </tr>

		                                              <?php    }
		                                                        ?>


		                                                  <?php      }else{ ?>

		                                                      <tr class="table-td-clr"  id="damagedcon_<?php echo $pre->id;?>_1" >
                                                              <td class="text-truncate text-left t-br"  width="25%"><?php echo $pre->panel_area_name; ?></td>
                                                              <td class="text-truncate text-center t-br"  width="25%" style="display:none">
                                                                <div class="form-group m-0">
                                                                   <select class="select2-tokenizer form-control damaged_parts" data-id="<?php echo $pre->id;?>_1" style="width: 100%">
                                                                     <option  value="0">Select Dents</option>
                                                                     <option  value="1">1</option>
                                                                      <option  value="2">2</option>
                                                                      <option  value="3">3</option>
                                                                      <option  value="4">4</option>
                                                                      <option  value="5">5</option>
                                                                      <option  value="6">6</option>
                                                                      <option  value="7">7</option>
                                                                      <option  value="8">8</option>
                                                                     <option  value="9">9</option>
                                                                   </select>
                                                                </div>
                                                              </td>
                                                              <td class="text-truncate bt-0 text-center t-br"  width="25%">
                                                                <div class="form-group m-0">
                                                                   <select class="select2-tokenizer form-control text-left" id="amount_<?php echo $pre->id;?>_1"  style="width: 100%">
                                                                     <option  value="0">$0</option>
                                                                      <option  value="100">$100</option>
                                                                      <option  value="150">$150</option>
                                                                      <option  value="250">$250</option>
                                                                      <option  value="350">$350</option>
                                                                      <option  value="550">$550</option>
                                                                      <option  value="750">$750</option>
                                                                      <option  value="950">$950</option>
                                                                      <option  value="1200">$1200</option>
                                                                     <option value="1650">$1650</option>
                                                                     <option  value="2000">$2000</option>
                                                                   </select>
                                                                </div>
                                                              </td>
                                                              <td class="text-truncate bt-0 text-center"  width="25%">
                                                                <div class="form-group m-0">
                                                                   <select class="js-select2 form-control" onchange="check_select_new_(this)" data-id="<?php echo $pre->id;?>"  id="damagedconselect_<?php echo $pre->id;?>" style="width: 100%" multiple="multiple" >
                                                                    <option value="1" selected locked="locked" >+</option>
                                                                    <option value="2" >Extreme Size</option>
                                                                    <option value="3">Aluminium</option>
                                                                    <option value="4">Panel Crease</option>
                                                                    <option value="5">P2P</option>
                                                                   </select>
                                                                </div>
                                                              </td>
                                                            </tr>


                                                            <tr class="table-td-clr"  id="damagedcon_<?php echo $pre->id; ?>_2"  style="display:none">
                                                              <td class="text-truncate text-left t-br"  width="25%"><?php echo $pre->panel_area_name; ?></td>
                                                              <td class="text-truncate text-center t-br"  width="25%" style="display:none">
                                                                <div class="form-group m-0">
                                                                   <select class="select2-tokenizer form-control damaged_parts"  data-id="<?php echo $pre->id;?>_2" style="width: 100%">
                                                                     <option  value="0">Select Dents</option>
                                                                     <option  value="1">1</option>
                                                                      <option  value="2">2</option>
                                                                      <option  value="3">3</option>
                                                                      <option  value="4">4</option>
                                                                      <option  value="5">5</option>
                                                                      <option  value="6">6</option>
                                                                      <option  value="7">7</option>
                                                                      <option  value="8">8</option>
                                                                     <option  value="9">9</option>
                                                                   </select>
                                                                </div>
                                                              </td>
                                                              <td class="text-truncate bt-0 text-center t-br"  width="25%">
                                                                <div class="form-group m-0">
                                                                   <select class="select2-tokenizer form-control text-left" id="amount_<?php echo $pre->id;?>_2" style="width: 100%">
                                                                     <option  value="0">$0</option>
                                                                      <option  value="100">$100</option>
                                                                      <option  value="150">$150</option>
                                                                      <option  value="250">$250</option>
                                                                      <option  value="350">$350</option>
                                                                      <option  value="550">$550</option>
                                                                      <option  value="750">$750</option>
                                                                      <option  value="950">$950</option>
                                                                      <option  value="1200">$1200</option>
                                                                     <option value="1650">$1650</option>
                                                                     <option  value="2000">$2000</option>
                                                                   </select>
                                                                </div>
                                                              </td>
                                                              <td class="text-truncate bt-0 text-center"  width="25%">

                                                                   Extreme Size

                                                              </td>
                                                            </tr>
                                                            <tr class="table-td-clr"  id="damagedcon_<?php echo $pre->id;?>_3"  style="display:none">
                                                              <td class="text-truncate text-left t-br"  width="25%"><?php echo $pre->panel_area_name; ?></td>
                                                              <td class="text-truncate text-center t-br"  width="25%" style="display:none">
                                                                <div class="form-group m-0">
                                                                   <select class="select2-tokenizer form-control damaged_parts" data-id="<?php echo $pre->id;?>_3" style="width: 100%">
                                                                     <option  value="0">Select Dents</option>
                                                                     <option  value="1">1</option>
                                                                      <option  value="2">2</option>
                                                                      <option  value="3">3</option>
                                                                      <option  value="4">4</option>
                                                                      <option  value="5">5</option>
                                                                      <option  value="6">6</option>
                                                                      <option  value="7">7</option>
                                                                      <option  value="8">8</option>
                                                                     <option  value="9">9</option>
                                                                   </select>
                                                                </div>
                                                              </td>
                                                              <td class="text-truncate bt-0 text-center t-br"  width="25%">
                                                                <div class="form-group m-0">
                                                                   <select class="select2-tokenizer form-control text-left" id="amount_<?php echo $pre->id;?>_3" style="width: 100%">
                                                                     <option  value="0">$0</option>
                                                                      <option  value="100">$100</option>
                                                                      <option  value="150">$150</option>
                                                                      <option  value="250">$250</option>
                                                                      <option  value="350">$350</option>
                                                                      <option  value="550">$550</option>
                                                                      <option  value="750">$750</option>
                                                                      <option  value="950">$950</option>
                                                                      <option  value="1200">$1200</option>
                                                                     <option value="1650">$1650</option>
                                                                     <option  value="2000">$2000</option>
                                                                   </select>
                                                                </div>
                                                              </td>
                                                              <td class="text-truncate bt-0 text-center"  width="25%">
                                                               Aluminium
                                                              </td>
                                                            </tr>
                                                            <tr class="table-td-clr"  id="damagedcon_<?php echo $pre->id;?>_4"  style="display:none">
                                                              <td class="text-truncate text-left t-br"  width="25%"><?php echo $pre->panel_area_name; ?></td>
                                                              <td class="text-truncate text-center t-br"  width="25%" style="display:none">
                                                                <div class="form-group m-0">
                                                                   <select class="select2-tokenizer form-control damaged_parts" data-id="<?php echo $pre->id;?>_4" style="width: 100%">
                                                                     <option  value="0">Select Dents</option>
                                                                     <option  value="1">1</option>
                                                                      <option  value="2">2</option>
                                                                      <option  value="3">3</option>
                                                                      <option  value="4">4</option>
                                                                      <option  value="5">5</option>
                                                                      <option  value="6">6</option>
                                                                      <option  value="7">7</option>
                                                                      <option  value="8">8</option>
                                                                     <option  value="9">9</option>
                                                                   </select>
                                                                </div>
                                                              </td>
                                                              <td class="text-truncate bt-0 text-center t-br"  width="25%">
                                                                <div class="form-group m-0">
                                                                   <select class="select2-tokenizer form-control text-left" id="amount_<?php echo $pre->id;?>_4" style="width: 100%">
                                                                     <option  value="0">$0</option>
                                                                      <option  value="100">$100</option>
                                                                      <option  value="150">$150</option>
                                                                      <option  value="250">$250</option>
                                                                      <option  value="350">$350</option>
                                                                      <option  value="550">$550</option>
                                                                      <option  value="750">$750</option>
                                                                      <option  value="950">$950</option>
                                                                      <option  value="1200">$1200</option>
                                                                     <option value="1650">$1650</option>
                                                                     <option  value="2000">$2000</option>
                                                                   </select>
                                                                </div>
                                                              </td>
                                                              <td class="text-truncate bt-0 text-center"  width="25%">
                                                                Panel Crease
                                                              </td>
                                                            </tr>
                                                            <tr class="table-td-clr"  id="damagedcon_<?php echo $pre->id;?>_5"  style="display:none">
                                                              <td class="text-truncate text-left t-br"  width="25%"><?php echo $pre->panel_area_name; ?></td>
                                                              <td class="text-truncate text-center t-br"  width="25%" style="display:none">
                                                                <div class="form-group m-0">
                                                                   <select class="select2-tokenizer form-control damaged_parts" data-id="<?php echo $pre->id;?>_5" style="width: 100%">
                                                                     <option  value="0">Select Dents</option>
                                                                     <option  value="1">1</option>
                                                                      <option  value="2">2</option>
                                                                      <option  value="3">3</option>
                                                                      <option  value="4">4</option>
                                                                      <option  value="5">5</option>
                                                                      <option  value="6">6</option>
                                                                      <option  value="7">7</option>
                                                                      <option  value="8">8</option>
                                                                     <option  value="9">9</option>
                                                                   </select>
                                                                </div>
                                                              </td>
                                                              <td class="text-truncate bt-0 text-center t-br"  width="25%">
                                                                <div class="form-group m-0">
                                                                   <select class="select2-tokenizer form-control text-left" id="amount_<?php echo $pre->id;?>_5" style="width: 100%">
                                                                     <option  value="0">$0</option>
                                                                      <option  value="100">$100</option>
                                                                      <option  value="150">$150</option>
                                                                      <option  value="250">$250</option>
                                                                      <option  value="350">$350</option>
                                                                      <option  value="550">$550</option>
                                                                      <option  value="750">$750</option>
                                                                      <option  value="950">$950</option>
                                                                      <option  value="1200">$1200</option>
                                                                     <option value="1650">$1650</option>
                                                                     <option  value="2000">$2000</option>
                                                                   </select>
                                                                </div>
                                                              </td>
                                                              <td class="text-truncate bt-0 text-center"  width="25%">
                                                                P2P
                                                              </td>
                                                            </tr>

		                                                       <?php }
                                                              ?>
                                                            <?php
                                                              }
                                                            ?>
                                                          </tbody>
                                                        </table>
                                                    </div>
                                                  </div>
                                              </div>
                                        </div>
                              </div>
                        </div>
                        <div class="col-md-12" style="margin-bottom: 15px;">
                            <button type="button" class="btn btn-success btn-number" data-toggle="modal" data-target="#enter_damaged_area">
                              <span class="glyphicon glyphicon-plus" style="font-weight:bold;">+</span>
                          </button>
                          </div>
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <button onclick="back_fun('3', '4')" type="button" class="btn  my-quotations-btn next-btn pull-left">Back</button>
                              <button onclick="next_page_6(5)" type="button" class="btn  my-quotations-btn next-btn pull-right" >Next</button>

                          </div>
                        </div>

                              </form>
                      </div>

                      </div>

                  </div>
              </div>
            </section>
        </div>
        </div>
    </div>
    <div class="modal fade" id="enter_damaged_area" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Add Custom Damaged Area</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body text-center modal-inner">
            <div class="row">
                <div class="col-md-5 ">
                    <label for="userinput1" class="fw-600">Enter Damaged Area</label>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <input type="text"  class="form-control" name="damage_dialog_name" id="damage_dialog_name">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5">
                    <label for="userinput1" class="fw-600">Position</label>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <select name="position" id="position" class="form-control">
                            <option value="left">Left</option>
                            <option value="right">Right</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn  my-quotations-btn next-btn" data-dismiss="modal">Back</button>
            <button type="button" onclick="add_custom_damage()" class="btn  my-quotations-btn next-btn" >Add Panel</button>
        </div>
        </div>

    </div>
    </div>

@push('scripts')
<script>
    function check_select_new_(s){
        var d  = $(s).val();
        var id =  $(s).data("id");
        for(i=1; i < 6 ; i++ ){
            if(jQuery.inArray( String(i), d )!=-1){
            //   console.log('#damagedcon_'+id+'_'+i+'yes')
                $('#damagedcon_'+id+'_'+i).css('display' , 'table-row')
            }else{
            //   console.log('#damagedcon_'+id+'_'+i+'no')
                $('#damagedcon_'+id+'_'+i).css('display' , 'none')
                $('select[data-id="'+id+'_'+i+'"] option:eq(0)').prop('selected', true).trigger('change');
                $('#amount_'+id+'_'+i+' option:eq(0)').prop('selected', true).trigger('change');
                // console.log($('select[data-id="'+id+'_'+i+'"]').val());
            }
        }
    }

    $(document).ready(function(){
        $(".js-select2").select2({
            closeOnSelect : false,
            placeholder : "Placeholder",
            allowHtml: true,
            allowClear: true,
            tags: false, // создает новые опции на лету,

            dropdownCssClass: "test",
            templateSelection : function (tag, container){
                // here we are finding option element of tag and
                // if it has property 'locked' we will add class 'locked-tag'
                // to be able to style element in select
                var $option = $('#mySelect2 option[value="'+tag.id+'"]');
                if ($option.attr('locked')){
                    $(container).addClass('locked-tag');
                    tag.locked = true;
                }
                return tag.text;
            },
        });

        $(".js-select2").on('select2:unselecting', function(e){
             // before removing tag we check option element of tag and
            // if it has property 'locked' we will create error to prevent all select2 functionality
            if ($(e.params.args.data.element).attr('locked')) {
                e.select2.pleaseStop();
            }
       });

      // $("select").change(function(){
      //     $(this).find("option:selected").each(function(){
      //         var optionValue = $(this).attr("value");
      //         if(optionValue){
      //             $("#show-additional").not("." + optionValue).hide();
      //             $("." + optionValue).show();
      //         } else{
      //             $("#show-additional").hide();
      //         }
      //     });
      // }).change();
    });
</script>

<script>
    function update_one_by_one(id){
        if($('#damagedcon_'+id).prop('checked')) {
            $('#damagedcon_'+id).val(1);
        } else {
            $('#damagedcon_'+id).val(0);
        }

        val=$('#damagedcon_'+id).val();

        $.ajax({
            type: "POST",
            url: '',
            data: {id:id , val:val , main_id: '{{ !empty($quote) ? $quote->id : '' }}'}, // serializes the form's elements.
            success: function(data)
            {
                if(data==0){
                    $('#append_to_'+id).html(' ');
                    $('#append_to_'+id).css('display', 'none');
                }else{
                    $('#append_to_'+id).html(' ');
                    $('#append_to_'+id).html(data);
                    $('#append_to_'+id).css('display', 'block');

                    $('.dents').select2({
                        tags: true,
                    });
                }
            }
        });
    }

    function next_page_five(){
        $.ajax({
            type: "POST",
            url: '',
            data: $('#page_three_form_submit_').serialize(), // serializes the form's elements.
            success: function(data)
            {
                $('#page4').css('display', 'none');
                $('#page_5_main_div').html(' ');
                $('#page_5_main_div').html(data);
                $('#page5').css('display', 'block');

                $('.dents').select2({
                    tags: true,
                });
            }
        });
    }

    $('.dents').select2({
        tags: true,
    });
</script>

<script>
    function show_hide_assement(id){
        if($('#check_box_id_'+id).val()==0){
            $('#assismnet_'+id).css('display', 'block');
            $('#check_box_id_'+id).val(1);
        }else{
            $('#assismnet_'+id).css('display', 'none');
            $('#check_box_id_'+id).val(0);
        }
    }

    function submit_assement(id){
        $.ajax({
        type: "POST",
        url: '',
        data: {id:id , qty:$('#qty_'+id).val(), amount:$('#amount_'+id).val()},
        success: function(data)
        {
            //$('#assismnet_'+id).css('display', 'none');

        }
        });
    }

    function next_page_6(tab){
        var arrNumber = Array();

        dent = 1;
        $('.damaged_parts').each(function(){
            if($('#amount_'+$(this).data('id')).val() > 0){
                var valueToPush = new Array();
                valueToPush["id"] =$(this).data('id');
                valueToPush["dents"] =dent;
                valueToPush["amount"] = $('#amount_'+$(this).data('id')).val();
                arrNumber.push({"id":$(this).data('id') , "dents":dent ,"amount":$('#amount_'+$(this).data('id')).val()  });
            }
        });

        if(arrNumber.length == 0 ){
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    cancelButton: 'btn btn-danger',
                    confirmButton: 'btn'
                },
                buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
                title: 'You didn’t select any damaged area. Do you want to select? !',
                text: "",
                icon: 'warning',
                showCancelButton: true,
                cancelButtonText: 'No, Proceed!',
                confirmButtonText: 'Yes, Select it!',

                reverseButtons: false
            }).then((result) => {
                if (result.value) {
                $("html, body").animate({ scrollTop: 0 }, "slow");
                } else if (
                /* Read more about handling dismissals below */
                result.dismiss === Swal.DismissReason.cancel
                ) {
                    next_tab(tab);
                }
            })

        }else{
            var  fd =  new FormData();
            fd.append("parts", JSON.stringify(arrNumber));
            fd.append("id", <?php echo !empty($quote) ? $quote->id : '';?>);
            fd.append("_token", '{{ csrf_token() }}');
            fd.append("main_id", '{{ !empty($quote) ? $quote->id : "" }}');

            $.ajax({
                type: "POST",
                url: '{{ route('admin.quotation.submit_page_data', '4') }}',
                data :fd ,
                contentType : false,
                processData : false,
                success: function(data)
                {
                    //$('#assismnet_'+id).css('display', 'none');
                next_tab(tab);
                }
            });
        }
    }

    function edit_damage(e){
        $.ajax({
            type: "POST",
            url: '',
            data:{val:$(e).val() , id:$(e).data('id')} , // serializes the form's elements.
        });
    }

    $(".js-select2").select2({
        closeOnSelect : false,
        placeholder : "Placeholder",
        allowHtml: true,
        allowClear: true,
        tags: false, // создает новые опции на лету,

        dropdownCssClass: "test",
        templateSelection : function (tag, container){
            // here we are finding option element of tag and
            // if it has property 'locked' we will add class 'locked-tag'
            // to be able to style element in select
            var $option = $('#mySelect2 option[value="'+tag.id+'"]');
            if ($option.attr('locked')){
                $(container).addClass('locked-tag');
                tag.locked = true;
            }
            return tag.text;
        },
    });

    function add_custom_damage(){
        $.ajax({
            type: "POST",
            url: "{{ route('admin.quotation.damage_areas.store') }}",
            data:{_token: '{{ csrf_token() }}', name:$('#damage_dialog_name').val(), position: $('#position').val(), quote_id:'<?php echo !empty($quote) ? $quote->id : ''; ?>'} , // serializes the form's elements.
            success: function(data)
            {
                $('#new-orders-tables').find('tbody').append(data);

                $('.modal-backdrop').hide();

                $(".js-select2").select2({
                    closeOnSelect : false,
                    placeholder : "Placeholder",
                    allowHtml: true,
                    allowClear: true,
                    tags: false, // создает новые опции на лету,

                    dropdownCssClass: "test",
                    templateSelection : function (tag, container){
                        // here we are finding option element of tag and
                        // if it has property 'locked' we will add class 'locked-tag'
                        // to be able to style element in select
                        var $option = $('#mySelect2 option[value="'+tag.id+'"]');
                        if ($option.attr('locked')){
                            $(container).addClass('locked-tag');
                            tag.locked = true;
                        }
                        return tag.text;
                    },
		        });
                $(".js-select2").on('select2:unselecting', function(e){
                    // before removing tag we check option element of tag and
                    // if it has property 'locked' we will create error to prevent all select2 functionality
                    if ($(e.params.args.data.element).attr('locked')) {
                        e.select2.pleaseStop();
                    }
                });

                $('.select2-tokenizer').select2({
                    tags: true,
                });

                $('.select2-tokenizer').on('change', function() {
                    var num= this.value
                    if($.isNumeric(num)){

                    }else{
                        //$(".dents option[value='MRW']").remove();
                        $('option:selected',this).remove();
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Please enter an integer!'
                        })
                    }
                });

                // $('#enter_damaged_area').modal('hide');
            }
        });
    }
</script>
@endpush
