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
    success: function(data){
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
      console.log(data);
    },
    error: function(xhr, status, error){
      console.log(xhr.responseText)
      console.log(status)
      console.log(error)
    }
  })
})