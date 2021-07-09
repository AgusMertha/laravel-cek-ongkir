loadSubdistrictData()

$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
})

$.ajax({
  url: "/subdistrict/get-city-data",
  method: "GET",
  success: function(data){
    let optionItem = ''
    let optionGroup = ''
    for (let i = 0; i < data.length; i++) {
      optionGroup = `<optgroup label="${data[i][0]['name']}">`

      let item = ''
      for (let j = 0; j < data[i].length; j++) {
        item+= `<option value="${data[i][j]['city_id']}">${data[i][j]['city_name']}</option>`
      }
      
      const optionGroupComplete = `${optionGroup} ${item} </optgroup>`
      optionItem += optionGroupComplete
    }

    $("#select_city").append(optionItem)
  }
}).then(function(){
  const id = $("#select_city").val()

  getSubdistrict(id)
})

$("#select_city").on("change", function(e){
  const id = $(this).val()

  getSubdistrict(id)
})

function getSubdistrict(id)
{
  $.ajax({
    url: `/subdistrict/get-subdistrict-source/${id}`,
    method: "GET",
    beforeSend: function(){
      $("#load").show()
    },
    success: function(data){
      $("#load").hide()
      $("#select_subdistrict").html("")
      let subdistrictItem = ''
      data.forEach(item => {
        subdistrictItem += `<option value="${item.subdistrict_id}">${item.subdistrict_name}</option>`
      });

      $("#select_subdistrict").removeAttr("disabled")
      $("#select_subdistrict").append(subdistrictItem)
    },
    error: function(xhr, status, error){
      console.log(xhr.responseText)
      console.log(status)
      console.log(error)
    }
  })
}

$("#form_subdistrict").on("submit", function(e){
  e.preventDefault();

  const data = $(this).serialize()

  $.ajax({
    url: "/subdistrict/store-subdistrict",
    method: "POST",
    data: data,
    beforeSend: function(){
      $("#load").show()
    },
    success: function(data){
      $("#load").hide();
      Swal.fire({
        icon: data.status,
        text: data.message,
      })
      $('#subdistrict-table').DataTable().ajax.reload();
    },
    error: function(xhr, status, error){
      console.log(xhr.responseText)
      console.log(status)
      console.log(error)
    }
  })
})

function loadSubdistrictData()
{   
  $("#subdistrict-table").DataTable({
      processing: true,
      serverSide: true,
      autoWidth: false,
      ajax: {
          url: "/subdistrict/get-subdistrict",
      },
      columns: [
          {
              data: "province_id",
              render: function (data, type, row, meta) {
                  return meta.row + meta.settings._iDisplayStart + 1;
              }
          },
          {
              data: "name",
              name: "name"
          },
          {
              data: "city_name",
              name: "city_name"
          },
          {
              data: "subdistrict_name",
              name: "subdistrict_name"
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
    url: `/subdistrict/delete-subdistrict/${id}`,
    method: "POST",
    beforeSend: function(){
      $("#load").show()
    },
    success: function(data){
      $("#load").hide()
      Swal.fire({
        icon: data.status,
        text: data.message,
      })
      $('#subdistrict-table').DataTable().ajax.reload();
    }
  })
})