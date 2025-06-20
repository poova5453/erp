$(document).ready(function () {
let items = [];
   $('#itemName').select2()



$(document).on('change', '#itemName', function() {
    var selected = this.options[this.selectedIndex];
    // var itemId = selected.value;
    var gst = selected.getAttribute('data-gst');
    var rate = selected.getAttribute('data-rate');
    var itemName = selected.getAttribute('data-name');


    $('#itemGst').val(gst);
    $('#itemRate').val(rate);
    $('#itemName').val(itemName);

});
$(document).on('keyup', '#itemQty', function() {
    var qty = parseFloat($(this).val()) || 0;
    var rate = parseFloat($('#itemRate').val()) || 0;
    var gst = parseFloat($('#itemGst').val()) || 0;

    // Calculate amount and GST
    var amount = qty * rate;
    var cgst = (gst / 100) * amount / 2; // Assuming CGST and SGST are equal
    var sgst = cgst; // Assuming SGST is equal to CGST
    // var igst = (gst / 100) * amount; // For IGST, if applicable

    // Update the input fields
    $('#itemAmount').val(amount);
    $('#itemCgst').val(cgst);
    $('#itemSgst').val(sgst);
    // $('#itemIgst').val(igst);
    
    // Update total amount
    var totalAmount = amount + cgst + sgst ;
    $('#itemTotalAmount').val(totalAmount);
    
   updateTotals();
    // $('#itemGst').val(gst);
    // $('#itemRate').val(rate);
    // $('#itemName').val(itemName);
   
});

// Example: Add New button click
$('.btn-primary').on('click', function(e) {
    e.preventDefault();
    // Get values from your input fields (customize selectors as needed)
    let item = {
        name: $('#itemName').val(),
        gst: $('#itemGst').val(),
        hsn: $('#itemHsn').val(),
        unit: $('#itemUnit').val(),
        qty: $('#itemQty').val(),
        rate: $('#itemRate').val(),
        amount: $('#itemAmount').val(),
        cgst: $('#itemCgst').val(),
        sgst: $('#itemSgst').val(),
        igst: $('#itemIgst').val(),
        total: $('#itemTotalAmount').val()
    };
    items.push(item);
    

    // Clear the input fields
    renderTable();
  
    updateTotals();
});
 // Render items in table
    function renderTable() {
        let tbody = '';
        items.forEach((item, idx) => {
            tbody += `<tr>
                <td>${idx + 1}</td>
                <td>${item.name}</td>
                <td>${item.gst}</td>
             
                <td>${item.qty}</td>
                <td>${item.rate}</td>
                <td>${item.amount}</td>
                <td>${item.cgst}</td>
                <td>${item.sgst}</td>
          
                <td>${item.total}</td>
                <td><button class="btn btn-danger btn-sm delete-item" data-idx="${idx}"><i class="fas fa-trash"></i></button></td>
            </tr>`;
        });
        $('#itemsTableBody').html(tbody);
        resetInputs();
    }

    // Reset input fields   
    function resetInputs() {
        $('#itemName').val('');
        $('#itemGst').val('');
        $('#itemHsn').val('');
        $('#itemUnit').val('');
        $('#itemQty').val('');
        $('#itemRate').val('');
        $('#itemAmount').val('');
        $('#itemCgst').val('');
        $('#itemSgst').val('');
       
        $('#itemTotalAmount').val('');
    }
     function updateTotals() {
     let totalQty = 0;
    let subTotal = 0;
    let totalCgst = 0;
    let totalSgst = 0;
    let totalAmount = 0;
     let totalgst = 0;

    // Sum over all items in the array
    items.forEach(item => {
        totalQty += parseFloat(item.qty) || 0;
        subTotal += parseFloat(item.amount) || 0;
        totalCgst += parseFloat(item.cgst) || 0;
        totalSgst += parseFloat(item.sgst) || 0;
        totalgst = totalCgst + totalSgst;
        totalAmount += (parseFloat(item.amount) || 0) + (parseFloat(item.cgst) || 0) + (parseFloat(item.sgst) || 0);
    });

    // Set totals in the DOM
    $('#totalQty').val(totalQty);
    $('#totalCgst').val(totalCgst);
    $('#totalSgst').val(totalSgst);
    $('#totalAmount').val(totalAmount);
    $('#subTotal').val(subTotal);
    $('#totalGst').val(totalgst);


}

    // Delete item
    $(document).on('click', '.delete-item', function() {
        let idx = $(this).data('idx');
        items.splice(idx, 1);
        renderTable();
        updateTotals();
    });
});
