<div class="app-content content" id="page8" style="display:none;">
    <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-center  col-12 mb-2 text-center">
          <h3 class="content-header-title mb-0 d-inline-block">Pre Authorisation</h3>
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
                  <div class="card-body p-0">
                       <form class="form">
                      <div class="row mt-3 m-0">

                          <div class="col-md-12">


                                          <div  id="load_summary_data">


                                          </div>

                                <div class="col-md-12 text-center mt-2">
                                    <button onclick="back_fun('7', '8')" type="button" class="btn  my-quotations-btn next-btn pull-left pre-btns">Back</button>
                                     <button type="button" class="btn  my-quotations-btn next-btn pull-right pre-btns" onclick="approve_fun()" >Approve</button>

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
  <!--userdetails Modal-->
   <div class="modal fade" id="userdetails_email" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Enter Details of the user Quotation will be sent to</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <form class="form" id="last_form_email">
        <div class="modal-body text-center modal-inner-1">
            <div class="row">
                      <div class="col-md-4 tr"> <label for="userinput1" class="fw-600">Customer Name</label></div>
                      <div class="col-md-8">
                        <div class="form-group">
                          <input type="text" id="last_cust_name" class="form-control" placeholder=""
                          name="last_cust_name" required>
                        </div>
                      </div>
                    <div class="col-md-4 tr"> <label for="userinput1" class="fw-600">Email</label></div>
                      <div class="col-md-8">
                        <div class="form-group">
                          <input type="email" id="last_cust_email" class="form-control " placeholder=""
                          name="last_cust_email" required >
                        </div>
                      </div>
                </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn  my-quotations-btn next-btn" data-dismiss="modal">Cancel</button>
             <button onclick="new_email_approve_fun()" type="button" class="btn  my-quotations-btn next-btn"  >Submit</button>
        </div>
        </form>
      </div>

    </div>
  </div>

  <script>

      function approve_fun(){


          if($('#email_check').val()==0){
              $('#userdetails_email').modal('show');
          }else{
         document.getElementById('divLoading').style.display = 'block';
            $.ajax({
          type: "POST",
          url: "{{ route('admin.quotation.approve_current_quote') }}",
          data: {_token: '{{ csrf_token() }}', email_check:$('#email_check').val() , email:"" , name:"", main_id: "{{ !empty($quote) ? $quote->id : '' }}" }, // serializes the form's elements.
          success: function(data)
          {
              document.getElementById('divLoading').style.display = 'none';
            window.location = "{{ route('admin.quotation.quotation_summary', !empty($quote) ? base64_encode($quote->id) : null) }}";

          }
         });


          }
      }

      function new_email_approve_fun(){



          jQuery.validator.addMethod("validate_email", function(value, element) {

    if (/^\b[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b$/i.test(value)) {
        return true;
    } else {
        return false;
    }
}, "Please enter a valid Email.");

    (function ($, W, D) {
    var JQUERY4U = {};
    JQUERY4U.UTIL = {
      setupFormValidation: function () {
        $("#last_form_email").validate({
          rules: {

            last_cust_email: {
                required: true,
				email: true
        },
          },
          messages: {
            last_cust_email: "Please enter a valid email address",
          },
        });
      }
    }
    $(D).ready(function ($) {
      JQUERY4U.UTIL.setupFormValidation();
    });
  })(jQuery, window, document);



           if($("#last_form_email").valid()){
               $('#userdetails_email').modal('hide');
               document.getElementById('divLoading').style.display = 'block';
          $.ajax({
          type: "POST",
          url: "{{ route('admin.quotation.approve_current_quote') }}",
          data: {_token: '{{ csrf_token() }}', main_id: "{{ !empty($quote) ? $quote->id : '' }}", email_check:$('#email_check').val()  , email:$('#last_cust_email').val() , name:$('#last_cust_name').val()}, // serializes the form's elements.
          success: function(data)
          {
              document.getElementById('divLoading').style.display = 'none';
            window.location = "{{ route('admin.quotation.quotation_summary', !empty($quote) ? base64_encode($quote->id) : null) }}";

          }
         });
           }
      }

     function  myFunction(e){


         if($(e).val() <  1  || $(e).val() > 9  ){
             $(e).val('1');
         }
  }
  </script>
