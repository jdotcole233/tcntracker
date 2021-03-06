    $(document).ready(function(){
        let community_addprice_id;
        $('#submit_community_forms').click(function(){
          postData('POST', '/register_community','#create-community-form');
        });



     $.ajax({
       type: 'GET',
       url:'/fetch_communities',
       success: function(data){
          var community_table = $('#community_table tbody');
          $.each(data, function(index, value){
             //console.table(data);
             community_table.append(`<tr><th scope="row"><div class="media align-items-center"><div class="media-body"><span class="mb-0 text-sm">${value.region_name}</span></div></div></th><td>${value.district_name}</td><td>${value.community_name}</td><td><a href="/view-community/${value.community_id}"><button type="button" class="btn btn-primary">View</button></a><a href="/edit-community/${value.community_id}"></a><a href=""><button type="button" class="btn btn-danger">Delete</button></a><a href="/update-price/${value.community_id}"></a></td></tr>`);
          });
       },
       error: function(err){
         console.log("Something went wrong");
       }
     });

    $('#buyer-form-submit').click(function(){
        postData('POST','/register_buyer','#create-buyer-forms');
    });

    // getData('GET','/fetch_buyers', '#buyer_table tbody','<tr><th scope="row"><div class="media align-items-center"><div class="media-body"><span class="mb-0 text-sm">' + value.first_name + ' ' + value.other_name +' ' + value.last_name + '</span></div></div></th><td>' + value.location + '</td><td><span class="badge badge-dot mr-4">' + value.gender  +'</span></td><td>' + value.phone_number + '</td><td><a href="/edit-buyer"><button type="button" class="btn btn-success">Edit details</button></a></td></tr>');
    $.ajax({
      type: 'GET',
      url:'/fetch_buyers',
      success: function(data){
         var buyer_table = $('#buyer_table tbody');
         console.log(data);
         $.each(data, function(index, value){
            // console.table(data);
            buyer_table.append(`<tr><th scope="row"><div class="media align-items-center"><div class="media-body"><span class="mb-0 text-sm">${value.first_name}   ${value.last_name}</span></div></div></th><td>${value.community_name}</td><td><span class="badge badge-dot mr-4">${value.gender}</span></td><td>${value.phone_number}</td><td><a href="/edit-buyer/${value.buyer_id}"><button type="button" class="btn btn-success">Edit details</button></a></td></tr>`);
         });
      },
      error: function(err){
        console.log("Something went wrong");
      }
    });


    $.ajax({
      type: 'GET',
      url:'/fetch_farmers',
      success: function(data){
         var farmers_table = $('#farmer_table tbody');
         var allfaremers_table = $('#allfarmers tbody');
         $.each(data, function(index, value){
            //console.table(data);
            farmers_table.append(`<tr>
                <th scope="row">
                  <div class="media align-items-center">
                    <div class="media-body">
                      <span class="mb-0 text-sm">${value.first_name} ${value.last_name}</span>
                    </div>
                  </div>
                </th>
                <td>
                  <span class="badge badge-dot mr-4">
                    ${value.gender}
                  </span>
                </td>
                <td>
                  ${value.phone_number}
                </td>
                <td>
                  <a href="/view-farmer/${value.farmer_id}"><button type="button" class="btn btn-primary">View profile</button></a>
                  <a href="/create-sale/${value.farmer_id}"><button type="button" class="btn btn-success salebutton">Create sale</button></a>

                </td>

              </tr>`);
              allfaremers_table.append(`<tr>
                  <th scope="row">
                    <div class="media align-items-center">
                      <div class="media-body">
                        <span class="mb-0 text-sm">${value.first_name}  ${value.last_name}</span>
                      </div>
                    </div>
                  </th>
                  <td>
                    <span class="badge badge-dot mr-4">
                      ${value.gender}
                    </span>
                  </td>
                  <td>
                    ${value.phone_number}
                  </td>
                  <td>
                    <a href="/farmer-sales/${value.farmer_id}"><button type="button" class="btn btn-primary">View sales</button></a>
                  </td>

                </tr>`);
         });
      },
      error: function(err){
        console.log("Something went wrong");
      }
    });

    $('#create-sale-submit').click(function(){
       $('#farmer_id').val($(location).attr('pathname').substr(13));
       postData('POST','/create-sale-forfarmer','#create-farmer-sale');
    });

    $('#save_editted_farmer').click(function(){
      $('#farmer_editted_id').val($(location).attr('pathname').substr(13));
      postData('POST','/edit-forfarmer','#edit_farmer_forms');
    });

    $('#save_editted_buyer').click(function(){
      $('#buyer_editted_id').val($(location).attr('pathname').substr(12));
      postData('POST','/edit-forBuyer','#edit_buyer_forms');
    });

    $('#total_weight').keyup(function(){
        $('#total_amount_paid').val($('#total_weight').val() * $('#unit_price').val());
    });

    $('#edit_sale_submit').click(function(){
      $('#farmer_transactions_id').val($(location).attr('pathname').substr(11));
      postData('POST','/edit-forFarmerSale','#edit_sale_form');
    });

    $('#community_edit_submit').click(function(){
      $('#community_id').val($(location).attr('pathname').substr(16));
      postData('POST','/edit-forCommunity','#edit-community-form');
    });

    $('#create-farmer-submit').click(function(){
        postData('POST', '/register_farmer', '#creater-farmer-form');
    });


    $('#add_community_price').click(function(){
      $('#communitiescommunity_id').val($(location).attr('pathname').substr(11));
      postData('POST','/add_priceto_community','#community_price_forms');
    });


    $('.update_price_btn').click(function(){
      console.log();
    });


    $('#community_price_update_btn').click(function(){
        postData('POST','/update_current_price','#update_community_price_form');
    });

    $('#company_button').click(function(){
      postData('POST','/register_com','#company_form');
    });



    function postData(method, url, form_data){
          $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });
          $(this).ajaxStart(function(){
            $('#formLoader').css('display','block');
          });

          $(this).ajaxComplete(function(){
            $('#formLoader').css('display','none');
          });
          $.ajax({
              type: method,
              url: url,
              data:$(form_data).serialize(),
              success: function(data){
                  console.log(data);
                  Swal({
                    position: 'center',
                    type: 'success',
                    title: data,
                    showCloseButton: true,
                    showConfirmButton: false
                  })
                  $(form_data).trigger('reset');
              },
              error: function(err){
                Swal({
                  type: 'error',
                  title: 'Oops...',
                  text: 'Something went wrong!',
                  footer: '<a href>Refresh the page and try again!</a>'
                })
              }
          });
      }
    });


    function getData(method, url, table, tabedata){
      $.ajax({
        type: method,
        url:url,
        success: function(data){
           var buyer_table = $(table);
           $.each(data, function(index, value){
            //  console.table(data);
              buyer_table.append(tabedata);
           });
        },
        error: function(err){
          console.log("Something went wrong");
        }
      });
    }
