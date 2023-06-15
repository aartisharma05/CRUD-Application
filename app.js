
 var number_of_rows = 1;
$(document).ready(function(){
    $(".addrow").click(function(e){
         number_of_rows++;
        e.preventDefault();
        $("#show_row").append(`<tr id="row">
        <td><a class="btn btn-danger removerow" role="button">-</a></td>
        <td><input type="text" name="username[]" id="uname" placeholder="username"></td>
        <td><input type="text" name="email[]" id="emil" placeholder="email"></td>
        <td><input type="text" name="mobile[]" id="mobile" placeholder="mobile"></td>
        <td><input type="text" name="address[]" id="address" placeholder="address"></td>
        <td><input type="text" name="qty[]" id="qty" class="qty" onkeyup="totalmul($(this))" required></td>
        <td><input type="text" name="unitprc[]" id="unitprice" class="unitprice" onkeyup="totalmul($(this))" 
                required></td>
        <td><input type="text" name="total[]" id="total" class="total" readonly></td>

    </tr>`)
    })
});

$(document).on('click','.removerow',function(e){
e.preventDefault();//to prevent from page refresh
let row_item = $(this).parent().parent();
$(row_item).remove();
});

//ajax request to insert all the data
// $("#addData").submit(function(e){
//     e.preventDefault();
//     $("#savebtn").value('Adding...');
//     $.ajax({
//         url:'Database.php',
//         method: 'post',
//         data:$(this).serialize(),
//         success: function(response){
//             console.log(response);
//             alert("ajax");
//         } 
//     })
// })

var count=1;

$(document).ready(function(){
    $(".add_div").click(function(e){
        e.preventDefault();
        let div_element =  $("#parentdiv").html()
        var element_to_add = `<div id="parentdivv">
        Option : `;
        element_to_add += count++;
        element_to_add+=`  <a class="btn btn-danger removediv" role="button">Remove</a>`;
        element_to_add += div_element;
        element_to_add +=`<input type="hidden" value="${count}" name="option[]"></div>`;
            
        $("#container").append(element_to_add);
    })
});

$(document).on('click','.removediv',function(e){
    e.preventDefault();//to prevent from page refresh
    let row_item = $(this).parent();
    $(row_item).remove();
    });


