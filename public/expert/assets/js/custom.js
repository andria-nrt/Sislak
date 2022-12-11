$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function dataTableLoad(parData) {
  var curUrl=parData.curUrl;
  var addUrl=parData.addUrl;

  $('#dataTable').on("click", ".printView", function(e){
      e.preventDefault();
      var data = $(this).attr("data");
      var width = $(document).width();
      var height = $(document).height();
      var myWindow = window.open(curUrl+"/"+data, "", "width="+width+",height="+height);
  });

  $("#addNew").click(function(){
      $("#darkmodal").find(".modal-content").load(addUrl, function(){
          $("#darkmodal").modal({backdrop:'static'});
          $("#darkmodal").find("form").validate();
      });
  });

  $('#dataTable').on("click", ".edit", function(){
      var data = $(this).attr("data");
      $("#darkmodal").find(".modal-content").load(curUrl+"/"+data+"/edit", function(){
          $("#darkmodal").modal({backdrop:'static'});
          $("#darkmodal").find("form").validate();
      });
  });

  $('#dataTable').on("click", ".delete", function(){
      var data = $(this).attr("data");

      swal({
          title: "Are you sure?",
          text: "Once deleted, you will not be able to recover data!",
          icon: "warning",
          buttons: true,
          dangerMode: true,
      })
      .then((willDelete) => {
          if (willDelete) {
              $.ajax({
                  url: curUrl+"/"+data,
                  method: "delete",
                  dataType: "json",
                  success: function(data){
                      if(data.status=='success') {
                          Lobibox.notify('success', {
                              pauseDelayOnHover: true,
                              continueDelayOnInactiveTab: false,
                              position: 'top right',
                              icon: 'fa fa-check-circle',
                              msg: data.message
                          });
                          setTimeout(function(){ location.replace(curUrl); }, 500);
                      } else {
                          swal("Somthing Wrong!", data.message, "error");
                      }
                  },
                  error: function(data) {
                      Lobibox.notify('error', {
                          pauseDelayOnHover: true,
                          continueDelayOnInactiveTab: false,
                          position: 'top right',
                          icon: 'fa fa-times-circle',
                          msg: data.responseJSON.message
                      });
                  }
              });
          }
      });
  });

  $("#darkmodal").on("submit", "form", function(e){
      e.preventDefault();
      var btnText = $(this).find("[type=submit]").html();
      $(this).find("[type=submit]").html('Loading...').prop('disabled', true);
      var url = $(this).attr("action");
      var method = $(this).attr("method");
      var inputData = $(this).serializeArray();
      $.ajax({
          url: url,
          method: method,
          data: inputData,
          dataType: "json",
          success: function(data){
              $(this).find("[type=submit]").html(btnText).prop('disabled', false);
              if(data.status=='success') {
                  Lobibox.notify('success', {
                      pauseDelayOnHover: true,
                      continueDelayOnInactiveTab: false,
                      position: 'top right',
                      icon: 'fa fa-check-circle',
                      msg: data.message
                  });
                  $("#darkmodal").modal('hide');
                  setTimeout(function(){ location.replace(curUrl); }, 500);
              } else {
                  Lobibox.notify('error', {
                      pauseDelayOnHover: true,
                      continueDelayOnInactiveTab: false,
                      position: 'top right',
                      icon: 'fa fa-times-circle',
                      msg: data.message
                  });
              }
          },
          error: function(data) {
              $(this).find("[type=submit]").html(btnText).prop('disabled', false);
              Lobibox.notify('error', {
                  pauseDelayOnHover: true,
                  continueDelayOnInactiveTab: false,
                  position: 'top right',
                  icon: 'fa fa-times-circle',
                  msg: data.responseJSON.message
              });
              $.each(data.responseJSON.errors, function(i, error){
                  $("#darkmodal").find("#validate-error").append('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert">&times;</button><div class="alert-icon"><i class="icon-close"></i></div><div class="alert-message"><span><strong>Danger!</strong> '+error[0]+'</span></div></div>');
              });
          }
      });
  });
  
  $('#dataTable').DataTable( {
      lengthChange: false,
      pageLength: 15,
      columnDefs: [ { orderable: false, targets: [0,-1] }],
      aaSorting: [],
      buttons: {
          buttons: [
              { extend: 'excel', className: 'btn-outline-dark' },
              { extend: 'pdf', className: 'btn-outline-dark' },
              { extend: 'print', className: 'btn-outline-dark' }
          ]
      }
  }).buttons().container().appendTo('#dataTable_wrapper .col-md-6:eq(0)');
}


function printReport() {
    window.print();
}
