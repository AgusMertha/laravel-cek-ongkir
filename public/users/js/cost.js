// load data on first time
$("#loader_cost").hide()

$.ajax({
  url: "/get-courier",
  method: "GET",
  success: function(data){
    let courierItem = ''
    data.forEach(item => {
      courierItem += `<option value="${item.courier_code}">${item.courier_name}</option>`
    })

    $("#select_courier").append(courierItem)
    $("#courier").append(courierItem)
  }
})

$.ajax({
  url: "get-province",
  method: "GET",
  success: function(data){
    let provinceOption = ''
    data.forEach(item => {
      provinceOption += `<option value="${item.province_id}">${item.name}</option>`
    })

    $("#origin_province").append(provinceOption)
    $("#destination_province").append(provinceOption)
  },
  error: function(xhr, status, error){
    console.log(xhr.responseText)
    console.log(status)
    console.log(error)
  }
}).then(function(){
  const provinceId = $("#origin_province").val()

  selectCity("origin", provinceId, $("#origin_city"), $("#origin_subdistrict"))
  selectCity("destination", provinceId, $("#destination_city"), $("#destination_subdistrict"))
})


function selectCity(type, provinceId, element, nextElement)
{
  $.ajax({
    url: `get-city/${provinceId}`,
    method: "GET",
    success: function(data){
      let cityItem = ''
      data.forEach(item => {
        cityItem += `<option value="${item.city_id}">${item.city_name}</option>`
      })
      element.html("")
      element.append(cityItem)
    }
  }).then(function(){
      let cityId = ""
      if(type == "origin"){
        cityId = $("#origin_city").val()
      }
      else  if(type == "destination"){
        cityId = $("#destination_city").val()
      }

      console.log(cityId);

    selectSubdistrict(cityId, nextElement)
  })
}

function selectSubdistrict(cityId, element)
{
  $.ajax({
    url: `get-subdistrict/${cityId}`,
    method: "GET",
    success: function(data){
      let subdistrictItem = ''
      data.forEach(item => {
        subdistrictItem += `<option value="${item.subdistrict_id}">${item.subdistrict_name}</option>`
      })
      element.html("")
      element.append(subdistrictItem)
    }
  })
}

// load data on change event
$("#origin_province").on("change", function(){
  const provinceId = $(this).val()
  console.log(provinceId);

  selectCity("origin", provinceId, $("#origin_city"), $("#origin_subdistrict"))
})

$("#destination_province").on("change", function(){
  const provinceId = $(this).val()
  console.log(provinceId);

  selectCity("destination", provinceId, $("#destination_city"), $("#destination_subdistrict"))
})

$("#origin_city").on("change", function(){
  const cityId = $(this).val()
  console.log(cityId);

  selectSubdistrict(cityId, $("#origin_subdistrict"))
})

$("#destination_city").on("change", function(){
  const cityId = $(this).val()
  console.log(cityId);

  selectSubdistrict(cityId, $("#destination_subdistrict"))
})



// submit data and count cost

$("#form_cost").on("submit", function(e){
  e.preventDefault()

  const data = $(this).serialize()
  
  $.ajax({
    url: "/count-cost",
    method: "POST",
    data: data,
    beforeSend: function(){
      $("#loader_cost").show()
    },
    success: function(data){
      $("#loader_cost").hide()
      
      $("#courier_sn").text(data[0].code)
      $("#courier_fn").text(data[0].name)

      console.log(data);
      let tableCost = ''
      data[0].costs.forEach(item => {
        tableCost += `
        <tr>
          <td>${item.service}</td>
          <td>${checkDay(item.cost[0].etd)} hari</td>
          <td>Rp. ${item.cost[0].value}</td>
          <td>${item.description}</td>
        </tr>
        `
      })

      $("#body_count_cost_table").html("")
      $("#body_count_cost_table").append(tableCost)
    },
    error: function(xhr, status, error){
      console.log(xhr.responseText)
      console.log(status)
      console.log(error)
    }
  })
})

function checkDay(day){
  console.log(day);
  if(day == ""){
    return "-"
  }

  return day
}