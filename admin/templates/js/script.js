$('.form-check-input').change(function() {
    $(this).parents(".information-wrapper").toggleClass("active");
});


// $('.output').click(function(event) {
//     // var loadFile = function(event, '.output') {
//         this.src = URL.createObjectURL(event.target.files[0]);
//     // };
// });
var loadFile = function(event) {
    // var image = $(this).siblings(".form-label").children("img");
    var image = document.getElementById('output');
    // console.log(image);
    image.src = URL.createObjectURL(this.event.target.files[0]);
    // console.log(image.src);
};
// var loadFile1 = function(event1) {
//     var image = document.getElementById('output1');
//     image.src = URL.createObjectURL(event1.target.files[0]);
// };

// $('.uploadimage').change(function(){
//     var imageval = $(this).siblings(".form-label").children("img");
//     console.log(imageval);
// });



// navbar-active class
$( '.reservation-nav .reservation-menu li > a' ).on( 'click', function () {
    $( '.reservation-nav .reservation-menu' ).find( 'li.active' ).removeClass( 'active' );
    $( this ).parent( 'li' ).addClass( 'active' );
});

$('.delete-guest').click(function() {
    if (confirm("Do you confirm to delete the data?")) {
        $(this).parents("tr").fadeOut();
      } else {
        $(this).parents("tr").fadeIn();
      }
});

$(document).ready(function(){

    $('.filter-item1 .svg-wrapper').magnificPopup({
        type:'image'
    });

    
    $('#header-profile .nav-link').on('click', function () {
        $('#header-profile .dropdown-menu').toggleClass('show');
        console.log("clicked");
    });

    $('.settingicon').on('click', function () {
        $('.switch-color').toggleClass('active');
        // console.log("clicked");
    });

    let themeButtons = document.querySelectorAll('.theme-color-button');

    themeButtons.forEach(color => {
        color.addEventListener('click', () =>{
            let dataColor = color.getAttribute('data-color');
            document.querySelector(':root').style.setProperty('--nav-headbg', dataColor);
            document.querySelector(':root').style.setProperty('--primary', dataColor)
        });
    });

    // Custom change button color
    // buttoncolor.addEventListener('change', (e) => {
    //     let btnColor = e.target.value;
    //     document.querySelector(':root').style.setProperty('--nav-headbg', btnColor);
    // });

    // Custom change Primary color
    // primarycolor.addEventListener('change', (e) => {
    //     let btnColor = e.target.value;
    //     document.querySelector(':root').style.setProperty('--primary', btnColor);
    // });

	$(".addrooms").click(function(){
		$("#addroomtype").append('<tr><td><select class="form-control" id="roomtypevalue"><option value="" selected>-Select-</option><option value="Standard Non AC">Standard Non AC</option><option value="Suite">Suite</option><option value="Standard AC">Standard AC</option></select></td><td><select class="form-control" id="ratetypevalue"><option value="" selected>-Select-</option><option value="Room Only">Room Only</option></select></td><td><select class="form-control" id="roomnumber"><option value="" selected>-Select-</option><option value="201">201</option><option value="202">202</option><option value="203">203</option><option value="204">204</option><option value="205">205</option><option value="206">206</option></select></td><td><input type="text" class="form-control" id="numberofadult" placeholder="0"></td><td><input type="text" class="form-control" id="numberofchild" placeholder="0"></td><td><input type="number" class="form-control" id="amount" placeholder="0.00"></td><td><a type="button" class="btn btn-primary delete">Delete</a></td></tr>');
		// $("#addroomtype").append('<tr valign="top"><th scope="row"><label for="customFieldName">Custom Field</label></th><td><input type="text" class="code" id="customFieldName" name="customFieldName[]" value="" placeholder="Input Name" /> &nbsp; <input type="text" class="code" id="customFieldValue" name="customFieldValue[]" value="" placeholder="Input Value" /> &nbsp; <a href="javascript:void(0);" class="remCF">Remove</a></td></tr>');
	});
    $("#addroomtype").on('click','.delete',function(){
        $(this).parent().parent().remove();
    });
    $("#addroomtype").on('click','.nodelete',function(){
        alert("We Can't delete the first row in the table!!!");
    });


    // Add Services
    $(".addservis").click(function(){
		$("#addservices").append('<tr><td><select class="form-control" id="servicetype"><option value="" selected>-Select-</option><option value="Swimming Pool">Swimming Pool</option><option value="GYM">GYM</option></select></td><td><input type="date" name="checkindatepicker" class="datepicker-default form-control" placeholder="From Date"></td><td><input type="date" name="checkindatepicker" class="datepicker-default form-control" placeholder="To Date"></td><td><input type="time" class="form-control" placeholder="Check In Time" /></td><td><input type="time" class="form-control" placeholder="Check Out Time" /></td><td><input type="text" class="form-control" id="amount" placeholder="0.00"></td><td><a type="button" class="btn btn-primary delete">Delete</a></td></tr>');
	});
    $("#addservices").on('click','.delete',function(){
        $(this).parent().parent().remove();
    });
    $("#addservices").on('click','.nodelete',function(){
        alert("We Can't delete the first row in the table!!!");
    });

    // Add Purchase Item
    $(".additems").click(function(){
		$("#addpurchaseitem").append('<tr><td><select class="form-control" id="iteminformation"><option value="" selected>-Select-</option><option value="Item 1">Item 1</option><option value="Item 2">Item 2</option></select></td><td><input type="number" class="form-control" id="stock" placeholder="0.00"></td><td><input type="number" class="form-control" id="quantity" placeholder="0.00"></td><td><input name="checkindatepicker" type="date" class="datepicker-default form-control" placeholder="Expiry Date"></td><td><input type="number" class="form-control" id="rate" placeholder="0.00"></td><td><input type="number" class="form-control" id="total" placeholder="0.00"></td><td><a type="button" class="btn btn-primary delete">Delete</a></td></tr>');
	});
    $("#addpurchaseitem").on('click','.delete',function(){
        $(this).parent().parent().remove();
    });
    $("#addpurchaseitem").on('click','.nodelete',function(){
        alert("We Can't delete the first row in the table!!!");
    });

    // Restaurant Add Purchase Item
    $(".additems").click(function(){
		$("#addrespurchaseitem").append('<tr><td><select class="form-control" id="iteminformation"><option value="" selected>-Select-</option><option value="Item 1">Item 1</option><option value="Item 2">Item 2</option></select></td><td><input type="number" class="form-control" id="stock" placeholder="0.00"></td><td><select class="form-control" id="quantitytype"><option value="" selected>-Select-</option><option value="Kg">Kg</option><option value="Unit">Unit</option></select></td><td><input type="number" class="form-control" id="quantity" placeholder="0.00"></td><td><input name="checkindatepicker" type="date" class="datepicker-default form-control" placeholder="Expiry Date"></td><td><input type="number" class="form-control" id="rate" placeholder="0.00"></td><td><input type="number" class="form-control" id="total" placeholder="0.00"></td><td><a type="button" class="btn btn-primary delete">Delete</a></td></tr>');
	});
    $("#addrespurchaseitem").on('click','.delete',function(){
        $(this).parent().parent().remove();
    });
    $("#addrespurchaseitem").on('click','.nodelete',function(){
        alert("We Can't delete the first row in the table!!!");
    });

    // Add Wastage Item
    $(".addwastage").click(function(){
		$("#addwastageitem").append('<tr><td><select class="form-control" id="itemcategory"><option value="" selected>-Select-</option><option value="Food">Food</option><option value="Vegetables">Vegetables</option></select></td><td><input type="text" class="form-control" id="fooddetails" placeholder="Wastage Details"></td><td><select class="form-control" id="quantitytype"><option value="" selected>-Select-</option><option value="Kg">Kg</option><option value="Unit">Unit</option></select></td><td><input type="number" class="form-control" id="quantity" placeholder="0.00"></td><td><a type="button" class="btn btn-primary delete">Delete</a></td></tr>');
	});
    $("#addwastageitem").on('click','.delete',function(){
        var count_row = document.getElementsByTagName(this).length
        $(this).parent().parent().remove();
        // $(this).parent().parent().remove();
    });
    $("#addwastageitem").on('click','.nodelete',function(){
        alert("We Can't delete the first row in the table!!!");
    });

    // Add Vegetable
    $(".additems").click(function(){
		$("#addvegatable").append('<tr><td><input type="text" class="form-control" id="vegetables" placeholder="Items"></td><td><select class="form-control" id="quantitytype"><option value="" selected>-Select-</option><option value="Kg">Kg</option><option value="Unit">Unit</option></select></td><td><input type="number" class="form-control" id="quantityitem" placeholder="0"></td><td><a type="button" class="btn btn-primary delete">Delete</a></td></tr>');
	});
    $("#addvegatable").on('click','.delete',function(){
        var count_row = document.getElementsByTagName(this).length
        $(this).parent().parent().remove();
        // $(this).parent().parent().remove();
    });
    $("#addvegatable").on('click','.nodelete',function(){
        alert("We Can't delete the first row in the table!!!");
    });
    // Edit Vegetable
    $(".edititems").click(function(){
		$("#editvegatable").append('<tr><td><input type="text" class="form-control" id="vegetables" placeholder="Items"></td><td><select class="form-control" id="quantitytype"><option value="" selected>-Select-</option><option value="Kg">Kg</option><option value="Unit">Unit</option></select></td><td><input type="number" class="form-control" id="quantityitem" placeholder="0"></td><td><a type="button" class="btn btn-primary delete">Delete</a></td></tr>');
	});
    $("#editvegatable").on('click','.delete',function(){
        var count_row = document.getElementsByTagName(this).length
        $(this).parent().parent().remove();
        // $(this).parent().parent().remove();
    });
    $("#editvegatable").on('click','.nodelete',function(){
        alert("We Can't delete the first row in the table!!!");
    });

    // Add Market Item
    $(".addrestaurantitems").click(function(){
		$("#addmarketitem").append('<tr><td><select class="form-control" id="iteminformation"><option value="" selected>-Select-</option><option value="Item 1">Item 1</option><option value="Item 2">Item 2</option></select></td><td><select class="form-control" id="quantitytype"><option value="" selected>-Select-</option><option value="Kg">Kg</option><option value="Unit">Unit</option></select></td><td><input type="number" class="form-control" id="quantity" placeholder="0.00"></td><td><a type="button" class="btn btn-primary delete">Delete</a></td></tr>');
	});
    $("#addmarketitem").on('click','.delete',function(){
        $(this).parent().parent().remove();
    });
    $("#addmarketitem").on('click','.nodelete',function(){
        alert("We Can't delete the first row in the table!!!");
    });
    // Edit Market Item
    $(".editrestaurantitems").click(function(){
		$("#editmarketitem").append('<tr><td><select class="form-control" id="iteminformation"><option value="" selected>-Select-</option><option value="Item 1">Item 1</option><option value="Item 2">Item 2</option></select></td><td><select class="form-control" id="quantitytype"><option value="" selected>-Select-</option><option value="Kg">Kg</option><option value="Unit">Unit</option></select></td><td><input type="number" class="form-control" id="quantity" placeholder="0.00"></td><td><a type="button" class="btn btn-primary delete">Delete</a></td></tr>');
	});
    $("#editmarketitem").on('click','.delete',function(){
        $(this).parent().parent().remove();
    });
    $("#editmarketitem").on('click','.nodelete',function(){
        alert("We Can't delete the first row in the table!!!");
    });


    // Add Vehical Item
    $(".addvehical").click(function(){
		$("#vehicaldetails").append('<tr><td><input type="text" class="form-control" id="drivername" placeholder="Driver Name"></td><td><input type="number" class="form-control" id="mobile" placeholder="Mobile"></td><td><input type="text" class="form-control" id="vehicaltype" placeholder="Vehical Type"></td><td><input type="text" class="form-control" id="vehicalnumber" placeholder="Vehical Number"></td><td><input type="text" class="form-control" id="capacity" placeholder="Capacity"></td><td><a type="button" class="btn btn-primary delete">Delete</a></td></tr>');
	});
    $("#vehicaldetails").on('click','.delete',function(){
        $(this).parent().parent().remove();
    });
    $("#vehicaldetails").on('click','.nodelete',function(){
        alert("We Can't delete the first row in the table!!!");
    });
    // Edit Vehical Item
    $(".editvehical").click(function(){
		$("#editvehicaldetails").append('<tr><td><input type="text" class="form-control" id="edit_drivername" placeholder="Driver Name"></td><td><input type="number" class="form-control" id="edit_mobile" placeholder="Mobile"></td><td><input type="text" class="form-control" id="edit_vehicaltype" placeholder="Vehical Type"></td><td><input type="text" class="form-control" id="edit_vehicalnumber" placeholder="Vehical Number"></td><td><input type="text" class="form-control" id="edit_capacity" placeholder="Capacity"></td><td><a type="button" class="btn btn-primary delete">Delete</a></td></tr>');
	});
    $("#editvehicaldetails").on('click','.delete',function(){
        $(this).parent().parent().remove();
    });
    $("#editvehicaldetails").on('click','.nodelete',function(){
        alert("We Can't delete the first row in the table!!!");
    });


    // Add Vehical Item
    $(".addsourcebtn").click(function(){
		$("#addsource").append('<tr><td><input type="text" class="form-control" id="source" placeholder="Source"></td><td><input type="text" class="form-control" id="destination" placeholder="Destination"></td><td><a type="button" class="btn btn-primary delete">Delete</a></td></tr>');
	});
    $("#addsource").on('click','.delete',function(){
        $(this).parent().parent().remove();
    });
    $("#addsource").on('click','.nodelete',function(){
        alert("We Can't delete the first row in the table!!!");
    });
    // Edit Vehical Item
    $(".editsourcebtn").click(function(){
		$("#editsource").append('<tr><td><input type="text" class="form-control" id="edit_source" placeholder="Source"></td><td><input type="text" class="form-control" id="edit_destination" placeholder="Destination"></td><td><a type="button" class="btn btn-primary delete">Delete</a></td></tr>');
	});
    $("#editsource").on('click','.delete',function(){
        $(this).parent().parent().remove();
    });
    $("#editsource").on('click','.nodelete',function(){
        alert("We Can't delete the first row in the table!!!");
    });


    // Add Vehical Item
    $(".addlaundryrow").click(function(){
		$("#addlaundry").append('<tr><td><input type="text" class="form-control" id="itemname" placeholder="Item Name"></td><td><input type="number" class="form-control" id="quantity" placeholder="Quantity"></td><td><input type="number" class="form-control" id="amount" placeholder="0.00"></td><td><a type="button" class="btn btn-primary delete">Delete</a></td></tr>');
	});
    $("#addlaundry").on('click','.delete',function(){
        $(this).parent().parent().remove();
    });
    $("#addlaundry").on('click','.nodelete',function(){
        alert("We Can't delete the first row in the table!!!");
    });
    // Edit Vehical Item
    $(".editsourcebtn").click(function(){
		$("#editsource").append('<tr><td><input type="text" class="form-control" id="edit_source" placeholder="Source"></td><td><input type="text" class="form-control" id="edit_destination" placeholder="Destination"></td><td><a type="button" class="btn btn-primary delete">Delete</a></td></tr>');
	});
    $("#editsource").on('click','.delete',function(){
        $(this).parent().parent().remove();
    });
    $("#editsource").on('click','.nodelete',function(){
        alert("We Can't delete the first row in the table!!!");
    });


     //   Add Ingredients Item

  $('.addingredients').click(function () {
    $('#ingredientsdetails').append('<tr><td><input type="text" class="form-control" id="ingredientname" placeholder="Ingredients Name"></td><td><input type="number" class="form-control" id="ingredientsquantity1" placeholder="Ingredients Qty/Kg"></td><td><input type="text" class="form-control" id="ingredientsquantity2" placeholder="Ingredients Qty/Nos"></td><td><a type="button" class="btn btn-primary delete">Delete</a></td></tr>');
  });
  $('#ingredientsdetails').on('click', '.delete', function () {
    $(this).parent().parent().remove();
  });
  $('#ingredientsdetails').on('click', '.nodelete', function () {
    alert("We Can't delete the first row in the table!!!");
  });
  // Edit Ingredients Item
  $('.editingredients').click(function () {
    $('#editingredientsdetails').append('<tr><td><input type="text" class="form-control" id="editingredientname" placeholder="Ingredients Name"></td><td><input type="number" class="form-control" id="editingredientsquantity1" placeholder="Ingredients Qty/Kg"></td><td><input type="text" class="form-control" id="editingredientsquantity2" placeholder="Ingredients Qty/Nos"></td><td><a type="button" class="btn btn-primary delete">Delete</a></td></tr>');
  });
  $('#editingredientsdetails').on('click', '.delete', function () {
    $(this).parent().parent().remove();
  });
  $('#editingredientsdetails').on('click', '.nodelete', function () {
    alert("We Can't delete the first row in the table!!!");
  });



    // trave detail select tab ----------------------------------

    //hide all tabs first
    $('.select-tab-content').hide();
    //show the first tab content
    $('#tab-1').show();

    $('#select-box').change(function () {
    dropdown = $('#select-box').val();
    //first hide all tabs again when a new option is selected
    $('.select-tab-content').hide();
    //then show the tab content of whatever option value was selected
    $('#' + 'tab-' + dropdown).show();
    });

    
    // Table Export Format
    // $('#example3').DataTable({
    //     dom: 'Sfrtip',
    //     buttons: [
    //         'copy', 'csv', 'excel', 'pdf', 'print'
    //     ]
    // });

    var csvoption = {
        "separator":",",
        "filename":"Reports.csv"
    }
    $('#downloadcsv').on('click', function(){
        $('#example3').table2csv(csvoption);
    });

    document.getElementById('downloadexcel').addEventListener('click', function(){
        var table2excel = new Table2Excel();
        table2excel.export(document.querySelectorAll("#example3"))
    });


    // $('#downloadpdf').click(function(){
    //     html2canvas(document.querySelector('#example3')).then((canvas) => {
    //         let base64image = canvas.toDataURL('image/png');

    //         let pdf = new jsPDF('p', 'px', [1000, 1000]);
    //         pdf.addImage(base64image, 'PNG', 15, 15, 1200, 300);
    //         pdf.save('Report.pdf');
    //     });
    //     // let reportPDF = document.getElementById('example3').contentWindow;
    //     // reportPDF.focus();
    //     // reportPDF.print();
    //     // window.print();
    // });
    
    

});

function generate() {
    var doc = new jsPDF('p', 'pt', 'letter');
    var htmlstring = '';
    var tempVarToCheckPageHeight = 0;
    var pageHeight = 0;
    pageHeight = doc.internal.pageSize.height;
    specialElementHandlers = {
        // element with id of "bypass" - jQuery style selector  
        '#bypassme': function (element, renderer) {
            // true = "handled elsewhere, bypass text extraction"  
            return true
        }
    };
    margins = {
        top: 150,
        bottom: 60,
        left: 40,
        right: 40,
        width: 600
    };
    var y = 20;
    doc.setLineWidth(2);
    doc.text(200, y = y + 30, "Table Report");
    doc.autoTable({
        html: '#example3',
        startY: 70,
        theme: 'grid',
        columnStyles: {
            0: {
                cellWidth: 'auto',
            },
            1: {
                cellWidth: 'auto',
            },
            2: {
                cellWidth: 'auto',
            }
        },
        styles: {
            minCellHeight: 25
        }
    })
    doc.save('Report.pdf');
}