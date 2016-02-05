jam();
			function jam(){
				var time = new Date();
				document.getElementById('jam').innerHTML = time.getHours()+ ":" + time.getMinutes() + ":" + time.getSeconds();
				setTimeout("jam()", 1000);
			}
function ClearFields1() {

     document.getElementById("readLocation").value = "";
     
}

function ClearFields2() {

     document.getElementById("readBarcode").value = "";
     document.getElementById("readGroup").value = "";
}
// remove value option
// function handleSelect() {
  
//  var selectobject=document.getElementById("loc_from");
//  var selectobject2=document.getElementById("loc_to");
//   for (var i=0; i<selectobject.length; i++){
//   if (selectobject.options[i].value == '2' )
//      selectobject2.remove(i);
//   }
//  } 

//flash ilang
$(".alert-danger" ).fadeOut(4000);
$(".alert-info" ).fadeOut(4000);
$(".alert-warning" ).fadeOut(4000);
$(".alert-success" ).fadeOut(4000);

// autocomplete barang
$(function() {
 
    $( "#readItem" ).autocomplete({
      minLength: 1,
      limit: 10,
      source: '/api/items/search',
      
      select: function( event, ui ) {
        $('input[name="mysearch"]').val(ui.item.item_name);
        $('input[name="mysearch2"]').val(ui.item.barcode);
        return false;
      }
    })
    .autocomplete( "instance" )._renderItem = function( ul, item ) {
      return $( "<li>" )
        .append( "<a>" + item.barcode + "<br>"+ item.upc_ean_isbn + " - " + item.item_name + "</a>" )
        .appendTo( ul );
    };
  });
 // autocomplete barang
$(function() {
 
    $( "#readBarcode" ).autocomplete({
      minLength: 2,
      limit: 10,
      source: '/api/items/search',
      focus: function( event, ui ) {
        $( "#readBarcode" ).val( ui.item.barcode );
        return true;
      },
      select: function( event, ui ) {
        $( "#readBarcode" ).val( ui.item.barcode );
        return false;
      }
    })
    .autocomplete( "instance" )._renderItem = function( ul, item ) {
      return $( "<li>" )
        .append( "<a>" + item.barcode + "<br>"+ item.upc_ean_isbn + " - " + item.item_name + "</a>" )
        .appendTo( ul );
    };
  });

 // autocomplete barang
$(function() {
 
    $( "#readSales" ).autocomplete({
      minLength: 1,
      limit: 10,
      source: '/api/sales/search',
      focus: function( event, ui ) {
        $( "#readsales" ).val( ui.item.id );
        return false;
      },
      select: function( event, ui ) {
        $( "#readSales" ).val( ui.item.id );
        return false;
      }
    })
    .autocomplete( "instance" )._renderItem = function( ul, item ) {
      return $( "<li>" )
        .append( "<a>" + item.id + "<br> - " + item.customer_name + "</a>" )
        .appendTo( ul );
    };
  });

$(function() {
 
    $( "#readLocation" ).autocomplete({
      minLength: 2,
      limit: 10,
      source: '/api/locations/search',
      focus: function( event, ui ) {
        $( "#readLocation" ).val( ui.item.code );
        return false;
      },
      select: function( event, ui ) {
        $( "#readLocation" ).val( ui.item.code );
        return false;
      }
    })
    .autocomplete( "instance" )._renderItem = function( ul, item ) {
      return $( "<li>" )
        .append( "<a>" + item.code + " - " + item.name + "<br>" + item.desc + "</a>" )
        .appendTo( ul );
    };
  });

$(function() {
 
    $( "#readGroup" ).autocomplete({
      minLength: 2,
      limit: 10,
      source: '/api/group/search',
      focus: function( event, ui ) {
        $( "#readGroup" ).val( ui.item.code );
        return false;
      },
      select: function( event, ui ) {
        $( "#readGroup" ).val( ui.item.code );
        $( "#nameGroup" ).val( ui.item.name );
        $( "#idGroup" ).val( ui.item.id );
        return false;
      }
    })
    .autocomplete( "instance" )._renderItem = function( ul, item ) {
      return $( "<li>" )
        .append( "<a>" + item.code + " - " + item.name + "<br>" + item.desc + "</a>" )
        .appendTo( ul );
    };
  });
// type autocomplete
// $(document).ready(function() {
// $('#readBarcode').typeahead({
// 	minLength: 3, // send AJAX request only after user type in at least 3 characters
//     limit: 5,
//     source: function (query, process) {
//     	states = [];
//     	map	= {};
//         return $.get('/api/items/search', { term: query }, function (data, state) {
//             $.each(data, function(i, state)
//             {
//             	map[state.barcode] = state;
//             	states.push(state.barcode);
//             });
//             return process(states);
//         });
//     },

//         matcher: function (item) {
//    		 if (item.toLowerCase().indexOf(this.query.trim().toLowerCase()) != -1) {
//         return true;
//     		}
// 		},
// 		sorter: function (items) {
//     		return items.sort();
// 		},
// 		highlighter: function (item) {
// 		    var regex = new RegExp( '(' + this.query + ')', 'gi' );
// 		    return item.replace( regex, "<strong>$1</strong>" );
// 		},
// 		updater: function (item) {
// 		    selectedState = map[item].barcode;
// 		    return item;
// 		},
    
// });
// });


$(document).ready(function() {
$('#readNo').typeahead({
    minLength: 3, // send AJAX request only after user type in at least 3 characters
    limit: 5,
    source: function (query, process) {
        states = [];
        map = {};
        return $.get('/api/location_moving/search', { term: query }, function (data, state) {
            $.each(data, function(i, state)
            {
                map[state.no] = state;
                states.push(state.no);
            });
            return process(states);
        });
    },

        matcher: function (item) {
         if (item.toLowerCase().indexOf(this.query.trim().toLowerCase()) != -1) {
        return true;
            }
        },
        sorter: function (items) {
            return items.sort();
        },
        highlighter: function (item) {
            var regex = new RegExp( '(' + this.query + ')', 'gi' );
            return item.replace( regex, "<strong>$1</strong>" );
        },
        updater: function (item) {
            selectedState = map[item].no;
            return item;
        },
    
});
});

// laporan
$(document).ready(function() {
$('#all').click(function() {
    $('#mainform input[name=location]')
        .attr("disabled", true);
    // $('#mainform input[name=code]')
    //     .attr("disabled", true);
    // $('#mainform input[name=group]')
    //     .attr("disabled", true);

    return true;
});
$('#allitem').click(function() {
    $('#mainform input[name=code]')
        .attr("disabled", true);
    $('#mainform input[name=group]')
        .attr("disabled", true);
    // $('#mainform input[name=group]')
    //     .attr("disabled", true);

    return true;
});
$('#location').click(function() {
    
    // $('#mainform input[name=code]')
    //     .attr("disabled", true);

    // $('#mainform input[name=group]')
    //     .attr("disabled", true);
    
    $('#mainform input[name=location]')
        .attr('disabled', false);

    $('#mainform input[name=location]').focus();        
    return true;
});
$('#code').click(function() {
    
    $('#mainform input[name=code]')
        .attr("disabled", false);

    $('#mainform input[name=group]')
        .attr("disabled", true);
    
    // $('#mainform input[name=location]')
    //     .attr('disabled', false);
     $('#mainform input[name=code]').focus();  
    return true;
});

$('#group').click(function() {
    
    $('#mainform input[name=code]')
        .attr("disabled", true);
        
    // $('#mainform input[name=location]')
    //     .attr("disabled", false);
    
    $('#mainform input[name=group]')
        .attr('disabled', false);

     $('#mainform input[name=group]').focus();  
    return true;
});

});

$(function() {
    var allOptions = $('#loc_to option').clone();
    $('#loc_from').change(function() {
        var val = $(this).val();
        // $('#loc_to').html(allOptions.remove('option[value=' + val + ']' ));
        $('#loc_to option[value=' + val + ']').remove();
    });
});

$(function() {
    $( "#date" ).datepicker(
      {
        format: 'DD/MM/YYYY'
      });
  });
$(function() {
    $( "#date2" ).datepicker(
      {
        format: 'DD/MM/YYYY'
      });
  });