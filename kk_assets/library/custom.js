var base_url = $("#base_url").val();
// sweet alert
      $(document).on("click","#dl-btn", function(e){
      e.preventDefault();
      var id=$(this).attr("data-id");
      var post_title = $(this).attr("data-title");
      var abc = base_url+'beranda/delete/'+id;

        swal({
        title: "Apakah kamu yakin akan menghapus ini?",
        text: "Kamu akan menghapus ["+post_title+"]",
        icon: "warning",
        buttons: true,
        dangerMode: true,
        closeOnConfirm: false,
            closeOnCancel: false
      })
      .then((willDelete) => {
        if (willDelete) {
          swal("Gambar berhasil dihapus", {
            icon: "success",
          });
          setTimeout(function(){ window.location.href = abc; }, 1000);
        } else {
          swal("Hapus Gambar dibatalkan", {
            icon: "success",
          });
        }
      });
    });

    $(document).on("click","#dl-btn-cat", function(e){
      e.preventDefault();
      var id=$(this).attr("data-id");
      var cat_title = $(this).attr("data-title");
      var abc = "<?=base_url("for_admin/kategori/delete/"); ?>"+id;

        swal({
        title: "Apakah kamu yakin akan menghapus ini?",
        text: "Kamu akan menghapus ["+cat_title+"]",
        icon: "warning",
        buttons: true,
        dangerMode: true,
        closeOnConfirm: false,
            closeOnCancel: false
      })
      .then((willDelete) => {
        if (willDelete) {
          swal("Kategori berhasil dihapus", {
            icon: "success",
          });
          setTimeout(function(){ window.location.href = abc; }, 1000);
        } else {
          swal("Hapus Kategori dibatalkan", {
            icon: "success",
          });
        }
      });
    });


    $(document)
      .ready(function() {
        $('.ui.checkbox')
        .checkbox()
      ;
        // fix main menu to page on passing
        $('.main.menu').visibility({
          type: 'fixed'
        });

          $('select.dropdown')
        .dropdown()
      ;

        $('.special.cards .image').dimmer({
        on: 'hover'
      });
        
        /*$('.overlay').visibility({
          type: 'fixed',
          offset: 80
        });*/

          $("input:text").click(function() {
        $(this).parent().find("input:file").click();
      });

      $('input:file', '.ui.action.input')
        .on('change', function(e) {
          var name = e.target.files[0].name;
          $('input:text', $(e.target).parent()).val(name);
      });

        // lazy load images
        $('.image').visibility({
          type: 'image',
          transition: 'vertical flip in',
          duration: 500
        });

        // show dropdown on hover
        $('.main.menu  .ui.dropdown').dropdown({
          on: 'hover'
        });
      })
    ;

  $(function(){
    $("#post").click(function(){
      $(".ui.small.modal.share").modal('show');
    });
    $(".ui.small.modal.share").modal({
      closable: true
    });

    // modal login
    $("#signin").click(function(){
      $(".ui.small.modal.signin").modal('show');
    });
    $(".ui.small.modal.signin").modal({
      closable: true
    });

    // modal register
    $("#signup").click(function(){
      $(".ui.small.modal.signup").modal('show');
    });
    $(".ui.small.modal.signup").modal({
      closable: true
    });

    // modal kategori
    $("#kategori").click(function(){
      $(".ui.small.modal.kategori").modal('show');
    });
    $(".ui.small.modal.kategori").modal({
      closable: true
    });

    // modal pengguna
    $("#users").click(function(){
      $(".ui.small.modal.users").modal('show');
    });
    $(".ui.small.modal.users").modal({
      closable: true
    });
  });

  function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#showgambar').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#inputgambar").change(function () {
        readURL(this);
    });

    $(document).ready(function() {
      $('#example').DataTable();
  } );

  // timeago
  $(document).ready(function(){
    $(".timeago").livequery(function() // LiveQuery 
    {
      $(this).timeago(); // Calling Timeago Funtion 
    });
  });

  $(document).on("click", "#edit-cat", function(){
    $(".ui.small.modal.kategori").modal('show');

    var cat_id  = $(this).data('id');
    var nm    = $(this).data('nama');
    var dc    = $(this).data('desc');

    $('.ui.small.modal.kategori #form-cat').attr('action',base_url+'for_admin/kategori/update/'+cat_id);
    $("#tampil-modal #nama").val(nm);
    $("#tampil-modal #desc").val(dc);
    $("#tampil-modal #btn-modal").text('Update Kategori');
  });

  $(document).on("click", "#edit-user", function(){
    $(".ui.small.modal.users").modal('show');

    var user_id = $(this).data('id');
    var fnm     = $(this).data('first_name');
    var lnm     = $(this).data('last_name');
    var phone   = $(this).data('phone');
    var email   = $(this).data('email');

    $('.ui.small.modal.users #form-user').attr('action',base_url+'for_admin/pengguna/update/'+user_id);
    $("#tampil-modal #first_name").val(fnm);
    $("#tampil-modal #password").text('Password (Jika diubah)');
    $("#tampil-modal #last_name").val(lnm);
    $("#tampil-modal #phone").val(phone);
    $("#tampil-modal #email").val(email);
    $("#tampil-modal #btn-modal").text('Update Pengguna');
  });

  $(document).on("click", "#edit-gal", function(){
    $(".ui.small.modal.share").modal('show');

    var gal_id  = $(this).data('id');
    var nm    = $(this).data('nama');
    var dc    = $(this).data('desc');
    var img   =   $(this).data('img');
    var cat   =   $(this).data('cat');

    $('.ui.small.modal.share #form-gal').attr('action',base_url+'beranda/update/'+gal_id);
    $("#tampil-modal #nama").val(nm);
    $("#tampil-modal #desc").val(dc);
    $("#tampil-modal #id_kategori").val(cat);
    $("#showgambar").attr('src',img);
    $(".actions #btn-share").text('Update Pict');
  });
  //disqus
  (function() { // DON'T EDIT BELOW THIS LINE
      var d = document, s = d.createElement('script');
      s.src = '//pictone.disqus.com/embed.js';
      s.setAttribute('data-timestamp', +new Date());
      (d.head || d.body).appendChild(s);
  })();
  
  //  angka 500 dibawah ini artinya pesan akan muncul dalam 0,5 detik setelah document ready
    $(document).ready(function(){setTimeout(function(){$(".notifs").fadeIn('slow');}, 300);});
    //  angka 3000 dibawah ini artinya pesan akan hilang dalam 3 detik setelah muncul
    setTimeout(function(){$(".notifs").fadeOut('slow');}, 3000);