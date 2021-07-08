// loadCityData()

$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
})
  
$.ajax({
  url: "/city/get-province-data",
  method: "GET",
  success: function(data){
    let optionItem = ''
    data.forEach(item => {
      optionItem += `<option value="${item.province_id}">${item.name}</option>`
    });

    $("#select_province").append(optionItem);
  }
})

$("#select_province").on("change", function(){
  const provinceId = $(this).val()

  $.ajax({
    url: `/city/get-city-source/${provinceId}`,
    method: "GET",
    success: function(data){
      $("#select_city").html("")
      let cityItem = ''
      data.forEach(item => {
        cityItem+= `<option value="${item.city_id}">${item.city_name}</option>`
      })

      $("#select_city").removeAttr("disabled")
      $("#select_city").append(cityItem)
    },
    error: function(xhr, status, error){
      console.log(xhr.responseText)
      console.log(status)
      console.log(error)
    }
  })
})

$("#form_city").on("submit", function(e){
  e.preventDefault()

  $.ajax({
    url: "/city/store-city",
    method: "POST",
    data: $(this).serialize(),
    success: function(data){
      $('#city-table').DataTable().ajax.reload();
    }
  })
})

  $(document).on("click", ".delete", function(){
      const id = $(this).attr("id");
  
      $.ajax({
          url: `/province/delete-province/${id}`,
          method: "POST",
          success: function(data){
              $('#province-table').DataTable().ajax.reload();
              console.log(data);
          },
          error: function(xhr, status, error){
              console.log(xhr.responseText)
              console.log(status)
              console.log(error)
          }
      })
  })

function loadCityData()
{   
  $("#city-table").DataTable({
      processing: true,
      serverSide: true,
      autoWidth: false,
      ajax: {
          url: "/city/get-city",
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
              data: "type",
              name: "type"
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

  
})