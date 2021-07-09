loadCourierTable()

$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
})

$("#form_courier").on("submit", function(e){
  e.preventDefault();

  const data = {
    courier_code : $("#select_courier").val(),
    courier_name :  $("#select_courier option:selected").html()
  }

  $.ajax({
    url: "/courier/store-courier",
    method: "POST",
    data: data,
    beforeSend: function(){
      $("#load").show()
    },
    success: function(data){
      $("#load").hide()
      $('#courier-table').DataTable().ajax.reload();
      Swal.fire({
        icon: data.status,
        text: data.message
      })
    },
    error: function(xhr, status, error){
      console.log(xhr.responseText)
      console.log(status)
      console.log(error)
    }
  })
})

function loadCourierTable()
{   
  $("#courier-table").DataTable({
    processing: true,
    serverSide: true,
    autoWidth: false,
    ajax: {
      url: "/courier/get-courier",
    },
    columns: [
      {
        data: "province_id",
        render: function (data, type, row, meta) {
          return meta.row + meta.settings._iDisplayStart + 1;
        }
      },
      {
        data: "courier_code",
        name: "courier_code"
      },
      {
        data: "courier_name",
        name: "courier_name"
      },
      {
        data: "action",
        name: "action"
      }
    ]
  })
}

$(document).on("click", ".delete", function(){
  const id = $(this).attr("id")

  $.ajax({
    url: `/courier/delete-courier/${id}`,
    method: "POST",
    beforeSend: function(){
      $("#load").show()
    },
    success: function(data){
      $("#load").hide()
      $('#courier-table').DataTable().ajax.reload();
      Swal.fire({
        icon: data.status,
        text: data.message
      })
    }
  })
})