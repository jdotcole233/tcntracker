    $(document).ready(function(){

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
             community_table.append(`<tr><th scope="row"><div class="media align-items-center"><div class="media-body"><span class="mb-0 text-sm">${value.region_name}</span></div></div></th><td>${value.district_name}</td><td>${value.community_name}</td><td><a href="/view-community/${value.community_id}"><button type="button" class="btn btn-primary">View</button></a><a href="/edit-community/${value.community_id}"><button type="button" class="btn btn-info">Edit</button></a><a href=""><button type="button" class="btn btn-danger">Delete</button></a><a href="/update-price/${value.community_id}"><button type="button" class="btn btn-success">Update Price</button></a></td></tr>`);
          });
       },
       error: function(err){
         console.log("Something went wrong");
       }
     });

    $('#buyer-form-submit').click(function(){
        postData('POST','/register_buyer','#create-buyer-forms');
    });

    //getData('GET','/fetch_buyers', '#buyer_table tbody','<tr><th scope="row"><div class="media align-items-center"><div class="media-body"><span class="mb-0 text-sm">' + value.first_name + ' ' + value.other_name +' ' + value.last_name + '</span></div></div></th><td>' + value.location + '</td><td><span class="badge badge-dot mr-4">' + value.gender  +'</span></td><td>' + value.phone_number + '</td><td><a href="/edit-buyer"><button type="button" class="btn btn-success">Edit details</button></a></td></tr>');
    $.ajax({
      type: 'GET',
      url:'/fetch_buyers',
      success: function(data){
         var buyer_table = $('#buyer_table tbody');
         $.each(data, function(index, value){
            //console.table(data);
            buyer_table.append(`<tr><th scope="row"><div class="media align-items-center"><div class="media-body"><span class="mb-0 text-sm">${value.first_name} ${value.other_name} ${value.last_name}</span></div></div></th><td>${value.location}</td><td><span class="badge badge-dot mr-4">${value.gender}</span></td><td>${value.phone_number}</td><td><a href="/edit-buyer/${value.buyer_id}"><button type="button" class="btn btn-success">Edit details</button></a></td></tr>`);
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
                      <span class="mb-0 text-sm">${value.first_name} ${value.other_name} ${value.last_name}</span>
                    </div>
                  </div>
                </th>
                <td>
                  ${value.location}
                </td>
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
                        <span class="mb-0 text-sm">${value.first_name} ${value.other_name} ${value.last_name}</span>
                      </div>
                    </div>
                  </th>
                  <td>
                    ${value.location}
                  </td>
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


    $('#create-farmer-submit').click(function(){
        postData('POST', '/register_farmer', '#creater-farmer-form');
    });







    function postData(method, url, form_data){
          $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });

          $.ajax({
              type: method,
              url: url,
              data:$(form_data).serialize(),
              success: function(data){
                  console.log(data);
                  $(form_data).trigger('reset');
              },
              error: function(err){
                console.log("Something went wrong");
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
