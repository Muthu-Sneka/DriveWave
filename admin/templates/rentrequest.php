<?php require_once 'include/top.php'; ?>
<?php require_once 'include/sidemenu.php'; ?>
{% include "include/top.php" %}
{% include "include/sidemenu.php" %}


<div class="content-body">
    <div class="container-fluid">
        <div class="room-nav order-summary">
            
        </div>
        <div class="tab-content room-block order-summary-block">
            <div class="tab-pane fade show active" id="all" role="tabpanel">
                <div class="table-responsive">
                    <table id="example3" class="display" style="min-width: 845px">
                        <thead>
                            <tr>
                                
                                <th>No</th>
                                <th>Booking ID</th>
                                <th>Username</th>
                                <th>User emailid</th>
                                <th>Vehicle ID</th>
                                 <th>Total Price</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            {% for i in rent%}
                            <tr> 
                                <td>{{loop.index}}</td>
                                <td>{{i.BookingId}}</td>
                                <td>{{i.Username}}</td>
                                <td>{{i.Emailid}}</td>
                                <td>{{i.VehicleId}}</td>
                                <td>₹{{i.Totalcost}}</td>
                                <td>
                                    <div class="d-flex">
                                        <a href="#" class="btn btn-primary shadow btn-xs sharp me-1" type="button" data-bs-toggle="modal" data-bs-target="#view_order" onclick="viewrent({{i.id}})" ><i class="far bi bi-eye-fill"></i></a>
                                    </div>
                                </td>												
                            </tr>
                            {% endfor %}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!------------------------------------------------------------------------------------------------------------------------------->
<!--**********************************
    Add Guest start
***********************************-->
<!-- Modal -->
<div class="modal fade guestadd" id="view_rent">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">view Booking Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="row mb-4">
                    <div class="col">
                        <label>Booking Id</label><br>
                        <span id="bkid">B202412</span>
                    </div>
                    <div class="col">
                        <label>Username</label><br>
                        <span id="uname">Jeffry</span>
                    </div>
                    <div class="col">
                        <label>User EmailID</label><br>
                        <span id="umailid">Jeffry@gmail.com</span>
                    </div>

                </div>
                <div class="row mb-4">
                    <div class="col">
                        <label>Total Price</label><br>
                       <span>₹<span id="totcost">2500</span></span>
                    </div>
                    <div class="col">
                        <label>Pickup Datetime</label><br>
                        <span id="startt">17-3-2024,2:00 pm</span>
                    </div>
                    <div class="col">
                        <label>Drop Datetime</label><br>
                        <span id="endt">18-3-2024,10:00 am</span>
                    </div>

                </div>
                <div class="row mb-4">
                    <div class="col-md-4">
                        <label>Vehicle Type</label><br>
                        <span id="vcid">Car</span>
                    </div>
                    <div class="col-md-4">
                        <label> Vehicle Name and model</label><br>
                        <span id="vname"> Ford Mustang GT</span>
                    </div>
                    <div class="col-md-4">
                        <label>Payment Id</label><br>
                        <span id="paymentid"> Ford Mustang GT</span>
                    </div>
                </div>
            </div>
            </div>
    </div>
</div>
<!------------------------------------------------------------------------------------------------------------------------------->
<div class="modal fade payment-way" id="print_bill">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content"id="contentprint">
            <div class="modal-header">
                <h5 class="modal-title">Order Bill</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" >
                <div class="row">
                    <div class="col-lg-6">
                        <div class="input-block">
                            <label for="paymentprocess" class="form-label">Customer Name</label>
                               <div class="input-text">
                                 <sapn id="bill_cusname">User__01</sapn>
                               </div>
                           
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="input-block">
                            <label for="totalamount" class="form-label">Phone Number</label>
                            <div class="input-text">
                                <span id="bill_phonenum">+91 9045234567</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="input-block">
                            <label for="Tips" class="form-label">No of products</label>
                            <div class="input-text">
                                <span id="bill_nopro">3</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="input-block">
                            <label for="Tips" class="form-label">Payment method</label>
                            <div class="input-text">
                                <span id="bill_paymentmethod">3</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="input-block">
                            <label for="Tips" class="form-label">Payment id</label>
                            <div class="input-text">
                                <span id="bill_paymentid">3</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="input-block">
                            <label for="Tips" class="form-label">Address Type</label>
                            <div class="input-text">
                            
                            <span id="p_addtype">45,xyz street</span><br>
                            
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="input-block">
                            <label for="Tips" class="form-label">Locality</label>
                            <div class="input-text">
                            
                            <span id="bill_local">45,xyz street</span><br>
                           
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="input-block">
                            <label for="Tips" class="form-label">Landmark</label>
                            <div class="input-text">
                            
                            <span id="bill_land">45,xyz street</span><br>
                           
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="input-block">
                            <label for="Tips" class="form-label">Pin code</label>
                            <div class="input-text">
                            
                            <span id="bill_pin">45,xyz street</span><br>
                           
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="input-block">
                            <label for="Tips" class="form-label">Alternative mobile no</label>
                            <div class="input-text">
                            
                            <span id="bill_altpno">45,xyz street</span><br>
                           
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="input-block">
                            <label for="Tips" class="form-label">Address</label>
                            <div class="input-text">
                            
                            <span id="bill_cadd">45,xyz street</span><br>
                            <!-- <span>unknown area</span><br>
                            <span>Unknown city</span><br>
                            <span>unknown distric with pincode</span><br> -->
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                    <table class="des">
                     <tr>
                        <th>No</th>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Offer</th>
                        <th>Price</th>
                    </tr>
                    <tbody id="p_bill">
                    <!--<tr>
                        <td>1</td>
                        <td>Guava Leaf Powder </td>
                        <td>10</td>
                        <td>₹50</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td> Guava Leaf Powder</td>
                        <td>15</td>
                        <td>₹70</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Guava Leaf Powder</td>
                        <td>8</td>
                        <td>₹40</td>
                    </tr>   
                    <tr>
                      <td colspan=3>Total Price</td>
                      <td>₹500</td>
                   </tr> -->
                   </tbody>
                </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <!-- <button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button> -->
                <div class="pay-section">
                    <div class="form-check">
                        <!-- <input type="checkbox" class="form-check-input" id="printreport">
                        <label class="form-check-label" for="printreport">Print Receipt</label> -->
                    </div>
                    <a href="" class="btn btn-primary" download="" target="_blank" id="print">Print</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="complete" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Complete</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="hidden" id="statid" name="statid">
        <h4>Do you want to compelete it?</h4>
      </div>
      <div class="modal-footer">
        <!-- <button type="button" class="btn-close btn btn-danger" data-dismiss="modal">Close</button> -->
        <button type="button" onclick="update_state()" class="btn  btn-primary">Complete</button>
      </div>
    </div>
  </div>
</div>

{% include "include/bottom.php" %}
<?php require_once 'include/bottom.php'; ?>
<script>
  
  function viewrent(id){
    $.ajax({
        type : 'PUT',
        url : '/admin/viewrent/'+id,
        id : id,
        encode: true,
        dataType: 'json',
        processData: false,
        contentType: false,
    }).done(function(data){
        $("#bkid").text(data.BookingId);
        $("#uname").text(data.Username);
        $("#umailid").text(data.Emailid);
        $("#totcost").text(data.Totalcost);
        $("#startt").text(data.Pickuptime);
        $("#endt").text(data.Droptime);
        if(data.VehicleId[0]=='B'){
            $("#vcid").text("Bike");
            $("#vname").text(data.vehicle.Bikename_model);

        }
        else{
            $("#vcid").text("Cae");
            $("#vname").text(data.vehicle.Carname_model);

        }
        $("#paymentid").text(data.PaymentId);
    

        $("#view_rent").modal('show');

    });
  }
  
 

  
</script>