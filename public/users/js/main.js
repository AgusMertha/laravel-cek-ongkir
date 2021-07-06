$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
})

$("#loader").hide()
$("#waybill_content").hide()

$("#form_waybill").on("submit", function(e){
  e.preventDefault();

  $.ajax({
    method: "POST",
    url: "/way-bill",
    data: $(this).serialize(),
    beforeSend: function(){
      $("#loader").show()
      $("#waybill_content").hide()
      $("#waybill_table_body").html("")
      $("#waybill_detail_table_body").html("")
    },
    success: function(data){
      $("#loader").hide()
      console.log(data);

      if(data.data != null){
        $("#courier_name").text(`Expedisi ${checkString(data.data.summary.courier_name)}`)

        // waybill summary
        const tableWaybillBody = `
        <tr>
          <td>${checkString(data.data.summary.waybill_number)}</td>
          <td>${checkString(data.data.delivery_status.status)}</td>
          <td>${checkString(data.data.details.shippper_name)}</td>
          <td>${checkString(data.data.delivery_status.pod_receiver)}</td>
        </tr>
        `

        $("#waybill_table_body").html("")
        $("#waybill_table_body").append(tableWaybillBody)

        // waybill details
        let waybillDetailTableBody = ""
        data.data.manifest.forEach(item => {
          waybillDetailTableBody += 
          `
          <tr>
            <td>${convertDateAndTime(item.manifest_date, item.manifest_time)}</td>
            <td>${item.city_name != "" ? item.city_name : "-"}</td>
            <td>${item.manifest_description}</td>
          </tr>
          `
        });

        $("#waybill_detail_table_body").html("")
        $("#waybill_detail_table_body").append(waybillDetailTableBody)

        $("#waybill_content").show()
      }else{
        // alert not found
      }
    },
    error: function(xhr, status, error){
      console.log(xhr.responseText)
      console.log(status)
      console.log(error)
    }
  })
})

function checkString(data){
  if(data != "")
  {
    return data
  }

  return "-";
}

function convertDateAndTime(date, time){
  const day = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"]
  const month = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"]
  const rawDate = new Date(`${date} ${time}`)

  const mDate = rawDate.getDate() < 10 ? `0${rawDate.getDate()}` : rawDate.getDate()
  const mDay = day[rawDate.getDay()]
  const mMonth = month[rawDate.getMonth()]
  const mYear = rawDate.getFullYear()

  mHours = rawDate.getHours() < 10 ? `0${rawDate.getHours()}` : rawDate.getHours()
  mMinutes = rawDate.getMinutes() < 10 ? `0${rawDate.getMinutes()}` : rawDate.getMinutes()


  return `${mDay}, ${mDate} ${mMonth} ${mYear}, ${mHours}:${mMinutes}`
}