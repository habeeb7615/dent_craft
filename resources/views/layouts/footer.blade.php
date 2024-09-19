<footer class="footer footer-static footer-light navbar-border navbar-shadow">
    <div class="row align-items-center m-0" style="width: 100%; font-family: sans-serif;">
    <div class="col-md-5 text-left">
      <p class="clearfix  lighten-2 mb-0 px-2 " style="font-family: sans-serif; color:grey !important;" >
        <span class=" d-block d-md-inline-block text-left" " > &copy; <script>document.write(new Date().getFullYear())</script> <a href="{{ route('home') }}" style="font-family: sans-serif; color:grey;">Dentcraft</a>  All Rights Reserved</span>
      </p>
    </div>
    <div class="col-md-7 text-right">
       <a href="{{ route('admin.terms_conditions') }}" target="_blank" class="pr-4 border-right" style="font-family: sans-serif; color:grey;">Terms & Conditions</a>
      <a href="{{ route('admin.privacy_policy') }}" target="_blank" class="pl-4" style="font-family: sans-serif; color:grey;">Privacy Policy</a>
    </div>
    </div>
</footer>

<!-- footer -->
<script src="https://cdn.bootcss.com/jquery/1.12.4/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.1/js/bootstrap.min.js"></script>
<script src="https://cdn.bootcss.com/prettify/r298/prettify.min.js"></script>
<script src="https://cdn.bootcss.com/vue/2.5.16/vue.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="{{ asset('assets/magnifier/js/jquery.magnify.js') }}"></script>
<script>
  window.prettyPrint && prettyPrint();

  var defaultOpts = {
    draggable: true,
    resizable: true,
    movable: true,
    keyboard: true,
    title: true,
    modalWidth: 320,
    modalHeight: 320,
    fixedContent: true,
    fixedModalSize: false,
    initMaximized: false,
    gapThreshold: 0.02,
    ratioThreshold: 0.1,
    minRatio: 0.05,
    maxRatio: 16,
    headToolbar: ['maximize', 'close'],
    footToolbar: ['zoomIn', 'zoomOut', 'prev', 'fullscreen', 'next', 'actualSize', 'rotateRight'],
    multiInstances: true,
    initEvent: 'click',
    initAnimation: true,
    fixedModalPos: false,
    zIndex: 1090,
    dragHandle: '.magnify-modal',
    progressiveLoading: true
  };

  var vm = new Vue({
    el: '#playground',
    data: {
      options: defaultOpts
    },
    methods: {
      /*changeTheme: function (e) {
        if (e.target.value === '0') {
          $('.magnify-theme').remove();
        } else if (e.target.value === '1') {
          $('.magnify-theme').remove();
          $('head').append('<link class="magnify-theme" href="css/magnify-bezelless-theme.css" rel="stylesheet">');
        } else if (e.target.value === '2') {
          $('.magnify-theme').remove();
          $('head').append('<link class="magnify-theme" href="css/magnify-white-theme.css" rel="stylesheet">');
        }
      }*/
    },
    updated: function () {
      $('[data-magnify]').magnify(this.options);
    }
  });

</script>





<script>

// customer/update_seen_notifications
// function seen_notifications(){
//      $.ajax({
//           type: "POST",
//           url: '',
//           success: function(data)
//           {
//           // $('.badge').html('0');

//           }
//          });
// }

</script>
<!-- BEGIN VENDOR JS-->
<!-- BEGIN PAGE VENDOR JS-->

<script src="{{ asset('theme/app-assets/vendors/js/forms/icheck/icheck.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('theme/app-assets/vendors/js/forms/validation/jqBootstrapValidation.js') }}"
type="text/javascript"></script>

<script src="{{ asset('theme/app-assets/js/core/app-menu.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('theme/app-assets/js/core/app.min.js') }}" type="text/javascript"></script>

<script src="{{ asset('theme/app-assets/js/scripts/forms/form-login-register.min.js') }}" type="text/javascript"></script>
 <script src="{{ asset('theme/app-assets/vendors/js/gallery/masonry/masonry.pkgd.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('theme/app-assets/vendors/js/gallery/photo-swipe/photoswipe.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('theme/app-assets/vendors/js/gallery/photo-swipe/photoswipe-ui-default.min.js') }}"  type="text/javascript"></script>
 <script src="{{ asset('theme/app-assets/js/scripts/gallery/photo-swipe/photoswipe-script.js') }}"  type="text/javascript"></script>
