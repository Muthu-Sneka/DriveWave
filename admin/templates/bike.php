
{% include "include/top.php" %}
{% include "include/sidemenu.php" %}

<div class="content-body">
    <div class="container-fluid">
        <div class="row guest-database-wrapper">
            <div class="col-12">

                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Bikes</h4>
                        <a class="btn btn-primary" type="" href="/admin/add_bikes">Add Bikes</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example3" class="display" style="min-width: 845px">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Bike Name and model</th>
                                        <th>Cost per/hr</th>
                                        <th>Total Trips</th>
                                        <th>Fuel type</th>
                                        <th>Available Status</th>
                                        
                                        <th>Action</th>
                                    </tr>
                                </thead>
                            
                                <tbody>
                                    {%for i in bikes%}
                                    <tr>
                                        <td>{{loop.index}}</td>
                                        <td>{{i.Bikename_model}}</td>
                                        <td> ₹{{i.CostperHR}} </td>
                                        <td>{{i.Nooftrips}}</td>
                                        <td>{{i.Fueltype}}</td>
                                        <td>{{i.Availablestatus}}</td> 
                                        <td>
                                            <div class="d-flex">
                                                <a href="#" class="btn btn-primary shadow btn-xs sharp me-1" type="button" data-bs-toggle="modal"  onclick="view_bike({{i.id}})" ><i class="far bi bi-eye-fill"></i></a>
                                                <a href="#" class="btn btn-primary shadow btn-xs sharp me-1" type="button" data-bs-toggle="modal"  onclick="edit_bike({{i.id}})"><i class="fas fa-pencil-alt"></i></a>
                                                <a href="#" class="btn btn-danger shadow btn-xs sharp" onclick="del_conformation({{i.id}})"><i class="fa fa-trash"></i></a>
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
    </div>
</div>

<!--**********************************
    Add Guest start
***********************************-->
<!-- Modal -->
<div class="modal fade guestadd" id="editpro">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Bike</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
            <form>
                <div class="guest-information-area">
                    <input type="hidden" id="edit_id" name="edit_id" />
                    <h4>Bike Information</h4>
                    <span id="errmsg"></span>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-block">
                                <label for="guestsub" class="form-label">Bike Name and model</label>
                                <div class="input-text">
        
                                    <input type="text" class="form-control" id="edit_bikename" name="edit_bikename" placeholder="Bike Name and model" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="input-block">
                                <label for="guestnumber" class="form-label">Fuel type</label>
                                <div class="input-text">
                                    <select class="form-control wide" id="edit_bikefuel" name="edit_bikefuel" required>
                                        <option value="" selected disabled>Select Fuel type</option>
                                        <option value="Petrol" >Petrol</option>
                                        <option value="Electric" >Electric</option>
                                       
                                        
                                        
                                    </select>
                               </div>
                                
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="input-block">
                                <label for="guestemail" class="form-label">Cost pre/Hr</label>
                                <input type="number" class="form-control" name="edit_costperhr" min="0" id="edit_costperhr" placeholder="cost per/hr" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-block">
                                <label for="guestnumber" class="form-label">Vehicle type</label>
                                <div class="input-text">
                                    <select class="form-control wide" id="edit_vehicletype" name="edit_vehicletype" required>
                                        <option value="" selected disabled>Select Vehicle type</option>
                                        <option value="scooter" >scooter</option>
                                        <option value="motorcycle" >motorcycle</option>
                                        
                                           
                                    </select>
                               </div>
                                
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="input-block">
                                <label for="guestnumber" class="form-label">City Name</label>
                                <div class="input-text">
                                    <select class="form-control wide" id="edit_city" onchange="fetch_location(this.value)" name="edit_city" required>
                                        
                                        {% for i in cities%}
                                        <option value="{{i}}">{{i}}</option>
                                        {% endfor %}
                                        
                                        
                                    </select>
                               </div>
                                
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="input-block">
                                <label for="guestnumber" class="form-label">vehicle Location</label>
                                <div class="input-text">
                                    <select class="form-control wide" id="edit_location"  name="edit_location" required>
                                        
                                        
                                        
                                    </select>
                               </div>
                                
                            </div>
                        </div>
                       
                     
                       
                    </div>
                </div>
                <div class="col-xl-12">
                            <div class="mb-3 row">

                                <div class="col-lg-12">
                                    <label class="col-lg-12 col-form-label" for="validationCustom01">Bike IMages

                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="mb-3 row guestadd expense">
                                        <div class="col-xl-6">
                                            <div class="mb-3 row">

                                                <div class="col-lg-12">
                                                    <div class="input-block profile">
                                                        <p>Image 1<span class="text-danger">*</span></p>
                                                            <label for="pimage1" class="form-label"><img id="editbikimg1" src="templates/images/profile/profile1.png"></label>
                                                        <input type="file" accept="image/*" name="pimage1" id="pimage1" oninput="editbikimg1.src=window.URL.createObjectURL(this.files[0])" required>
                                                    </div>
                                                    
                                                </div>
                                            </div>

                                        </div>
                                        <div class="col-xl-6">
                                            <div class="mb-3 row">

                                                <div class="col-lg-12">
                                                    <div class="input-block profile">
                                                        <p>Image 2<span class="text-danger">*</span></p>
                                                        <label for="pimage2" class="form-label"><img id="editbikimg2" src="templates/images/profile/profile1.png"></label>
                                                        <input type="file" accept="image/*" name="pimage2" id="pimage2" oninput="editbikimg2.src=window.URL.createObjectURL(this.files[0])" required>
                                                    </div>
                                                    
                                                </div>
                                            </div>

                                        </div>
                                        <div class="col-xl-6">
                                            <div class="mb-3 row">

                                                <div class="col-lg-12">
                                                    <div class="input-block profile">
                                                        <p>Image 3<span class="text-danger">*</span></p>
                                                        <label for="pimage3" class="form-label"><img id="editbikimg3" src="templates/images/profile/profile1.png"></label>
                                                        <input type="file" accept="image/*" name="pimage3" id="pimage3" oninput="editbikimg3.src=window.URL.createObjectURL(this.files[0])" required>
                                                    </div>
                                                    
                                                </div>
                                            </div>

                                        </div>
                                        <div class="col-xl-6">
                                            <div class="mb-3 row">

                                                <div class="col-lg-12">
                                                    <div class="input-block profile">
                                                        <p>Image 4<span class="text-danger">*</span></p>
                                                        <label for="pimage4" class="form-label"><img id="editbikimg4" src="templates/images/profile/profile1.png"></label>
                                                        <input type="file" accept="image/*" name="pimage4" id="pimage4" oninput="editbikimg4.src=window.URL.createObjectURL(this.files[0])" required>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                            <h5><strong>Extra features in Bike</strong></h5>
                            <div class="mb-3 col-md-6 col-sm-6">
                                <label for="product_discription+" class="form-label">start Type</label>
                                <div class="input-text">
                                    <select class="form-control wide" id="edit_starttype" name="edit_starttype" required>
                                        <option value="" selected disabled>Select start type</option>
                                        <option value="Self start" >Self start</option>
                                        <option value="Kick start" >Kick start</option>
                                        
                                        
                                        
                                    </select>
                               </div>
                              </div>
                              <div class="mb-3 col-md-6 col-sm-6">
                                <label for="product_methodOfUse" class="form-label">CC of the Bike</label>
                                  <input type="number" min="50" id="edit_bikecc" class="form-control" name="edit_bikecc" placeholder="Bike cc"/>
                              </div>
                              <div class="mb-3 col-md-6 col-sm-6">
                                <label for="product_methodOfUse" class="form-label">Mileage</label>
                                  <input type="number" min="10" id="edit_bikemileage" class="form-control" name="edit_bikemileage" placeholder="Bike Mileage"/>
                              </div>
                              
                            </div>
                    </div>
                    <button type="button" onclick="update_bike()" class="btn btn-primary">Submit</button>
                </div>
                
                    
                </form>
        </div>
    </div>
</div>
<!--**********************************
    Add Guest end
***********************************-->

<!--**********************************
    Add Guest start
***********************************-->
<!-- Modal -->

<!--**********************************
    Add Guest end
***********************************-->

<div class="modal fade guestadd filter-item1" id="listeditem">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">View Bike</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
            <form>
                <div class="guest-information-area">
                    <h4>Bike Information</h4>
                    <span id="errmsg"></span>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-block">
                                <label for="guestsub" class="form-label">Bike Name and model</label>
                                <div class="input-text">
                                   <span id="vbikename">Yamaha YZF-R1 2022</span>
                                  
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="input-block">
                                <label for="guestnumber" class="form-label">Fuel type</label>
                                <div class="input-text">
                                    <span id="vfuel">Petrol</span>
                               </div>
                                
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <label for="guestemail" class="form-label">Cost pre/Hr</label>
                            <div class="input-block">
                                
                                <span id="vcost">₹250</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-block">
                                <label for="guestnumber" class="form-label">Vehicle type</label>
                                <div class="input-text">
                                    <span id="vvtype">Motor cycle</span>
                               </div>
                                
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="input-block">
                                <label for="guestnumber" class="form-label">City Name</label>
                                <div class="input-text">
                                    <span id="vcity">Chennai</span>
                               </div>
                                
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="input-block">
                                <label for="guestnumber" class="form-label">vehicle Location</label>
                                <div class="input-text">
                                    <span id="vlocation">Chennai Central Railway Station</span>
                               </div>
                                
                            </div>
                        </div>
                       
                       
                    </div>
                </div>
                <div class="col-xl-12">
                            <div class="mb-3 row">

                                <div class="col-lg-12">
                                    <label class="col-lg-12 col-form-label" for="validationCustom01">Bike IMages

                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="mb-3 row guestadd expense">
                                        <div class="col-xl-6">
                                            <div class="mb-3 row">

                                                <div class="col-lg-12">
                                                    <div class="input-block profile">
                                                        <p>Image 1<span class="text-danger">*</span></p>
                                                            <label for="pimage1" class="form-label"><img id="vbikeimg1" src="templates/images/profile/profile1.png"></label>
                                                    
                                                    </div>
                                                    
                                                </div>
                                            </div>

                                        </div>
                                        <div class="col-xl-6">
                                            <div class="mb-3 row">

                                                <div class="col-lg-12">
                                                    <div class="input-block profile">
                                                        <p>Image 2<span class="text-danger">*</span></p>
                                                        <label for="pimage2" class="form-label"><img id="vbikeimg2" src="templates/images/profile/profile1.png"></label>
                                                    
                                                    </div>
                                                    
                                                </div>
                                            </div>

                                        </div>
                                        <div class="col-xl-6">
                                            <div class="mb-3 row">

                                                <div class="col-lg-12">
                                                    <div class="input-block profile">
                                                        <p>Image 3<span class="text-danger">*</span></p>
                                                        <label for="pimage3" class="form-label"><img id="vbikeimg3" src="templates/images/profile/profile1.png"></label>
                                                        
                                                    </div>
                                                    
                                                </div>
                                            </div>

                                        </div>
                                        <div class="col-xl-6">
                                            <div class="mb-3 row">

                                                <div class="col-lg-12">
                                                    <div class="input-block profile">
                                                        <p>Image 4<span class="text-danger">*</span></p>
                                                        <label for="pimage4" class="form-label"><img id="vbikeimg4" src="templates/images/profile/profile1.png"></label>
                                                        
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                            <h5><strong>Extra features in Bike</strong></h5>
                            <div class="mb-3 col-md-6 col-sm-6">
                                <label for="product_discription+" class="form-label">start Type</label>
                                <div class="input-text">
                                    <span id="vstart">Self start</span>
                               </div>
                              </div>
                              <div class="mb-3 col-md-6 col-sm-6">
                                <label for="product_methodOfUse" class="form-label">Bike CC</label>
                                <div class="input-text">
                                <span id="vbikrcc">998cc</span>
                                </div>
                              </div>
                              <div class="mb-3 col-md-6 col-sm-6">
                                <label for="product_methodOfUse" class="form-label">Mileage</label>
                                <div class="input-text">
                                  <span id="vmileage">20 km</span>
                                </div>
                              </div>
                              
                            </div>
                    </div>
                    
                </div>
                    
                </form>
                
        </div>
    </div>
</div>
<!-- Delete Modal -->
<div class="modal fade" id="delpro" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Delete Product</h5>
        <input type="hidden" id="delid" name="delid">
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
         Do you want to Delete the Product ?
      </div>
      <div class="modal-footer">
        <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
        <button type="button" onclick="del_product()" class="btn btn-primary">Delete</button>
      </div>
    </div>
  </div>
</div>

{% include "include/bottom.php" %}
<?php require_once 'include/bottom.php'; ?>

<script type="text/javascript">
    function view_bike(id){
        $.ajax({
            type : "PUT",
            url : "/admin/view_bike/"+ id,
            id : id,
            encode: true,
            dataType: 'json',
            processData: false,
            contentType: false,

        }).done(function(data){
            var image_path1 = "/admin/templates/bike_images/" + data.Image1;
            var image_path2 = "/admin/templates/bike_images/" + data.Image2;
            var image_path3 = "/admin/templates/bike_images/" + data.Image3;
            var image_path4 = "/admin/templates/bike_images/" + data.Image4;
            $("#vbikename").html(data.Bikename_model);
            $("#vfuel").html(data.Fueltype);
            $("#vcost").html(data.CostperHR);
            $("#vvtype").html(data.Vehicletype);
            $("#vcity").html(data.Cityname);
            $("#vlocation").html(data.Location);
            $("#vbikeimg1").attr("src", image_path1);
            $("#vbikeimg2").attr("src", image_path2);
            $("#vbikeimg3").attr("src", image_path3);
            $("#vbikeimg4").attr("src", image_path4);
            $("#vstart").html(data.Starttype);
            $("#vbikrcc").html(data.Ccofthebike);
            $("#vmileage").html(data.Mileage);
            $("#listeditem").modal('show');


        });
    }
    function edit_bike(id){
        $.ajax({
            type : 'PUT',
            url :'/admin/edit_bike/'+ id,
            id :id ,
            encode: true,
            dataType: 'json',
            processData: false,
            contentType: false,
        }).done(function(data){
           
            var image_path1 = "/admin/templates/bike_images/" + data.Image1;
            var image_path2 = "/admin/templates/bike_images/" + data.Image2;
            var image_path3 = "/admin/templates/bike_images/" + data.Image3;
            var image_path4 = "/admin/templates/bike_images/" + data.Image4;
            let lodiv=document.getElementById('edit_location');
             while (lodiv&&lodiv.firstChild) {
                lodiv.removeChild(lodiv.firstChild);
            }
            var firstOption = document.createElement('option');
            firstOption.value = '';
            firstOption.textContent = 'Select vehicle location';
            firstOption.disabled = true;
            firstOption.selected = true;
            lodiv.appendChild(firstOption);
            for(var i=0;i<data.location.length;i++){
                var option1 = document.createElement('option');
                option1.value = data.location[i];
                option1.textContent = data.location[i];
                lodiv.appendChild(option1);
            }
            $("#edit_id").val(data.id);
            $("#edit_bikename").val(data.Bikename_model);
            $("#edit_bikefuel").val(data.Fueltype);
            $("#edit_costperhr").val(data.CostperHR);
            $("#edit_vehicletype").val(data.Vehicletype);
            $("#edit_city").val(data.Cityname);
            $("#edit_location").val(data.Location);
            $("#editbikimg1").attr("src", image_path1);
            $("#editbikimg2").attr("src", image_path2);
            $("#editbikimg3").attr("src", image_path3);
            $("#editbikimg4").attr("src", image_path4);
            $("#edit_starttype").val(data.Starttype);
            $("#edit_bikecc").val(data.Ccofthebike);
            $("#edit_bikemileage").val(data.Mileage);
            $("#editpro").modal('show');

        });
    }
    function update_bike() {
        var imageUrl1 = document.getElementById('editbikimg1').src;
        var imageUrl2 = document.getElementById('editbikimg2').src;
        var imageUrl3 = document.getElementById('editbikimg3').src;
        var imageUrl4 = document.getElementById('editbikimg4').src;
       
        // var img1;
        // fetch(imageUrl2)
        //     .then(response => response.blob())
        //     .then(blob => {
        //         img1=blob;
        //         //alert(blob);
        //     });
        fetch(imageUrl1)
        .then(response =>response.blob())
        .then(blob => {
            fetch(imageUrl2)
            .then(response =>response.blob())
            .then(blob1 =>{
                fetch(imageUrl3)
                .then(response =>response.blob())
                .then(blob2 =>{
                    fetch(imageUrl4)
                    .then(response =>response.blob())
                    .then(blob3 =>{

          
        var formData = new FormData();
        formData.append("edit_id", $("#edit_id").val());
        formData.append("edit_bikename", $("#edit_bikename").val());
        formData.append("edit_bikefuel", $("#edit_bikefuel").val());
        formData.append("edit_costperhr", $("#edit_costperhr").val());
        formData.append("edit_vehicletype",$("#edit_vehicletype").val());
        formData.append("edit_city",$("#edit_city").val());
        formData.append("edit_location", $("#edit_location").val());
        formData.append("edit_starttype", $("#edit_starttype").val());
        formData.append("edit_bikecc", $("#edit_bikecc").val());
        formData.append("edit_bikemileage", $("#edit_bikemileage").val());
        formData.append("edit_bikimg1", blob);
        formData.append("edit_bikimg2", blob1);
        formData.append("edit_bikimg3", blob2);
        formData.append("edit_bikimg4", blob3);
       
        

        
             
        

        $.ajax({
            type: 'POST',
            url: '/admin/update_bike',
            data: formData,
            encode: true,
            dataType: 'json',
            processData: false,
            contentType: false,
        }).done(function(data1) {
            if (data1 == "Done") {
                location.reload();
            } else {
                $("#errmsg").html(data1);
            }
        });
        });
        });
        });
        });
       
    }
    function del_conformation(id){
        $("#delid").val(id);
        $("#delpro").modal('show');
    }
    function del_product(){
        var id = document.getElementById('delid').value;
        alert(id);
        $.ajax( {
            type    : "put",
            url     : '/admin/delete_bike/'+id,
            id    : id,
            contentType: "application/json",
            success: function(data) {
                location.reload();
            },
        });
        return false;

    }
    function fetch_location(city){
        
        $.ajax({
            type :"PUT",
            url:"/admin/fetch_location/"+city,
            encode: true,
            dataType: 'json',
            processData: false,
            contentType: false,
    
          }).done(function(data1){
             let lodiv=document.getElementById('edit_location');
             alert(lodiv);
             while (lodiv&&lodiv.firstChild) {
                lodiv.removeChild(lodiv.firstChild);
            }
            var firstOption = document.createElement('option');
            firstOption.value = '';
            firstOption.textContent = 'Select vehicle location';
            firstOption.disabled = true;
            firstOption.selected = true;
            lodiv.appendChild(firstOption);
            for(var i=0;i<data1.length;i++){
                var option1 = document.createElement('option');
                option1.value = data1[i];
                option1.textContent = data1[i];
                lodiv.appendChild(option1);
            }
                
    
          });
        
    }

</script>




<style>
  .checkbox-wrapper-8 .tgl {
    display: none;
  }
  .checkbox-wrapper-8 .tgl,
  .checkbox-wrapper-8 .tgl:after,
  .checkbox-wrapper-8 .tgl:before,
  .checkbox-wrapper-8 .tgl *,
  .checkbox-wrapper-8 .tgl *:after,
  .checkbox-wrapper-8 .tgl *:before,
  .checkbox-wrapper-8 .tgl + .tgl-btn {
    box-sizing: border-box;
  }
  .checkbox-wrapper-8 .tgl::-moz-selection,
  .checkbox-wrapper-8 .tgl:after::-moz-selection,
  .checkbox-wrapper-8 .tgl:before::-moz-selection,
  .checkbox-wrapper-8 .tgl *::-moz-selection,
  .checkbox-wrapper-8 .tgl *:after::-moz-selection,
  .checkbox-wrapper-8 .tgl *:before::-moz-selection,
  .checkbox-wrapper-8 .tgl + .tgl-btn::-moz-selection,
  .checkbox-wrapper-8 .tgl::selection,
  .checkbox-wrapper-8 .tgl:after::selection,
  .checkbox-wrapper-8 .tgl:before::selection,
  .checkbox-wrapper-8 .tgl *::selection,
  .checkbox-wrapper-8 .tgl *:after::selection,
  .checkbox-wrapper-8 .tgl *:before::selection,
  .checkbox-wrapper-8 .tgl + .tgl-btn::selection {
    background: none;
  }
  .checkbox-wrapper-8 .tgl + .tgl-btn {
    outline: 0;
    display: block;
    width: 4em;
    height: 2em;
    position: relative;
    cursor: pointer;
    -webkit-user-select: none;
       -moz-user-select: none;
        -ms-user-select: none;
            user-select: none;
  }
  .checkbox-wrapper-8 .tgl + .tgl-btn:after,
  .checkbox-wrapper-8 .tgl + .tgl-btn:before {
    position: relative;
    display: block;
    content: "";
    width: 60%;
    height: 100%;
  }
  .checkbox-wrapper-8 .tgl + .tgl-btn:after {
    left: 0;
  }
  .checkbox-wrapper-8 .tgl + .tgl-btn:before {
    display: none;
  }
  .checkbox-wrapper-8 .tgl:checked + .tgl-btn:after {
    left: 50%;
  }

  .checkbox-wrapper-8 .tgl-skewed + .tgl-btn {
    overflow: hidden;
    transform: skew(-10deg);
    -webkit-backface-visibility: hidden;
            backface-visibility: hidden;
    transition: all 0.2s ease;
    font-family: sans-serif;
    background: #888;
  }
  .checkbox-wrapper-8 .tgl-skewed + .tgl-btn:after,
  .checkbox-wrapper-8 .tgl-skewed + .tgl-btn:before {
    transform: skew(10deg);
    display: inline-block;
    transition: all 0.2s ease;
    width: 100%;
    text-align: center;
    position: absolute;
    line-height: 2em;
    font-weight: bold;
    color: #fff;
    text-shadow: 0 1px 0 rgba(0, 0, 0, 0.4);
  }
  .checkbox-wrapper-8 .tgl-skewed + .tgl-btn:after {
    left: 100%;
    content: attr(data-tg-on);
  }
  .checkbox-wrapper-8 .tgl-skewed + .tgl-btn:before{
    left: 0;
    content: attr(data-tg-off);
  }
  .checkbox-wrapper-8 .tgl-skewed + .tgl-btn:active {
    background: #888;
  }
  .checkbox-wrapper-8 .tgl-skewed + .tgl-btn:active:before {
    left: -10%;
  }
  .checkbox-wrapper-8 .tgl-skewed:checked + .tgl-btn {
    background: #86d993;
  }
  .checkbox-wrapper-8 .tgl-skewed:checked + .tgl-btn:before {
    left: -100%;
  }
  .checkbox-wrapper-8 .tgl-skewed:checked + .tgl-btn:after {
    left: 0;
  }
  .checkbox-wrapper-8 .tgl-skewed:checked + .tgl-btn:active:after {
    left: 10%;
  }
</style>
