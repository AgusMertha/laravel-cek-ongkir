loadProvinceData()

$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
})

$.ajax({
  url: "/province/get-province-source",
  method: "GET",
  success: function(data){
    let optionItem = ''
    data.forEach(item => {
      optionItem += `<option value="${item.province_id}">${item.province}</option>`
    });

    $("#select_province").append(optionItem);
  }
}).then(function(){
  submitProvince()    
})

$(document).on("click", ".delete", function(){
  const id = $(this).attr("id");
                
  $.ajax({
    url: `/province/delete-province/${id}`,
    method: "POST",
    success: function(data){
      $('#province-table').DataTable().ajax.reload();
    },
    error: function(xhr, status, error){
      console.log(xhr.responseText)
      console.log(status)
      console.log(error)
    }
  })
})

function submitProvince()
                {
                    $("#form_province").on("submit", function(e){
                        e.preventDefault();
    
                        const selectedText = $("#select_province option:selected").html();
                        const selectedProvince = $("#select_province").val();
                        const data = {
                            province_id: selectedProvince,
                            province_name: selectedText,
                        }
    
                        $.ajax({
                            url: "/province/store-province",
                            method: 'POST',
                            data: data,
                            beforeSend: function(){
                                $("#load").show()
                            },
                            success: function(data){
                                $("#load").hide()
                                Swal.fire({
                                  icon: data.status,
                                  text: data.message,
                              })
                              $('#province-table').DataTable().ajax.reload();
                            },
                            error: function(xhr, status, error){
                                console.log(xhr.responseText)
                                console.log(status)
                                console.log(error)
                            }
                        })
                    })
                }
    
                function loadProvinceData()
                {   
                    $("#province-table").DataTable({
                        processing: true,
                        serverSide: true,
                        autoWidth: false,
                        ajax: {
                            url: "/province/get-province",
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
                                data: "action",
                                name: "action"
                            }
                        ]
                        
                    })
                }