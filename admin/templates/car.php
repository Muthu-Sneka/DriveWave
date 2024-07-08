
{% include "include/top.php" %}
{% include "include/sidemenu.php" %}


<div class="content-body">
    <div class="container-fluid">
        <div class="row guest-database-wrapper">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Cars</h4>
                        <a class="btn btn-primary" type="" href="/admin/add_cars">Add Cars</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example3" class="display" style="min-width: 845px">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>car Name and model</th>
                                        <th>Cost per/hr</th>
                                        <th>Total Trips</th>
                                        <th>Fuel type</th>
                                        <th>Available Status</th>
                                        
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                
                                <tbody>
                                    {%for i in cars%}
                                    <tr>
                                        <td>{{loop.index}}</td>
                                        <td>{{i.Carname_model}}</td>
                                        <td>₹ {{i.CostperHR}}</td>
                                        <td>{{i.Nooftrips}}</td>
                                        <td>{{i.Fueltype}}</td>
                                        <td>{{i.Availablestatus}}</td> 
                                        <td>
                                            <div class="d-flex">
                                                <a href="#" class="btn btn-primary shadow btn-xs sharp me-1" type="button" onclick="view_car({{i.id}})"   ><i class="far bi bi-eye-fill"></i></a>
                                                <a href="#" class="btn btn-primary shadow btn-xs sharp me-1" type="button" data-bs-toggle="modal" onclick="edit_car({{i.id}})" ><i class="fas fa-pencil-alt"></i></a>
                                                <a href="#" class="btn btn-danger shadow btn-xs sharp" onclick="del_conformation({{i.id}})" ><i class="fa fa-trash"></i></a>
                                            </div>												
                                        </td>												
                                    </tr>
                                    {% endfor%}
                                   
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
                <h5 class="modal-title">Edit Car</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
            <form>
                <div class="guest-information-area">
                    <h4>Car Information</h4>
                    <span id="errmsg"></span>
                    <input type="hidden" id="edit_id" name="edit_id" />
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-block">
                                <label for="guestsub" class="form-label">Car Name and model</label>
                                <div class="input-text">
        
                                    <input type="text" class="form-control" id="edit_carname" name="edit_carname" placeholder="Car Name and model" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="input-block">
                                <label for="guestnumber" class="form-label">Fuel type</label>
                                <div class="input-text">
                                    <select class="form-control wide" id="edit_carfuel" name="edit_carfuel" required>
                                        <option value="" selected disabled>Select Fuel type</option>
                                        <option value="Petrol" >Petrol</option>
                                        <option value="Diesel" >Diesel</option>
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
                                        <option value="Hatchback" >Hatchback</option>
                                        <option value="Sedan" >Sedan</option>
                                        <option value="SUV" >SUV</option>
                                        <option value="Luxury" >Luxury</option>
                                    </select>
                               </div>
                                
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="input-block">
                                <label for="guestnumber" class="form-label">City Name</label>
                                <div class="input-text">
                                    <select class="form-control wide" id="edit_city" name="edit_city" onchange="fetch_location(this.value)" required>
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
                                    <select class="form-control wide" id="edit_location" name="edit_location" required>
                                       
                                        
                                        
                                    </select>
                               </div>
                                
                            </div>

                       
                    </div>
                </div>
                <div class="col-xl-12">
                            <div class="mb-3 row">

                                <div class="col-lg-12">
                                    <label class="col-lg-12 col-form-label" for="validationCustom01">Car IMages

                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="mb-3 row guestadd expense">
                                        <div class="col-xl-6">
                                            <div class="mb-3 row">

                                                <div class="col-lg-12">
                                                    <div class="input-block profile">
                                                        <p>Image 1<span class="text-danger">*</span></p>
                                                            <label for="pimage1" class="form-label"><img id="edit_img1" src="templates/images/car.jpg"></label>
                                                        <input type="file" accept="image/*" name="pimage1" id="pimage1" oninput="edit_img1.src=window.URL.createObjectURL(this.files[0])" required>
                                                    </div>
                                                    
                                                </div>
                                            </div>

                                        </div>
                                        <div class="col-xl-6">
                                            <div class="mb-3 row">

                                                <div class="col-lg-12">
                                                    <div class="input-block profile">
                                                        <p>Image 2<span class="text-danger">*</span></p>
                                                        <label for="pimage2" class="form-label"><img id="edit_img2" src="templates/images/car.jpg"></label>
                                                        <input type="file" accept="image/*" name="pimage2" id="pimage2" oninput="edit_img2.src=window.URL.createObjectURL(this.files[0])" required>
                                                    </div>
                                                    
                                                </div>
                                            </div>

                                        </div>
                                        <div class="col-xl-6">
                                            <div class="mb-3 row">

                                                <div class="col-lg-12">
                                                    <div class="input-block profile">
                                                        <p>Image 3<span class="text-danger">*</span></p>
                                                        <label for="pimage3" class="form-label"><img id="edit_img3" src="templates/images/car.jpg"></label>
                                                        <input type="file" accept="image/*" name="pimage3" id="pimage3" oninput="edit_img3.src=window.URL.createObjectURL(this.files[0])" required>
                                                    </div>
                                                    
                                                </div>
                                            </div>

                                        </div>
                                        <div class="col-xl-6">
                                            <div class="mb-3 row">

                                                <div class="col-lg-12">
                                                    <div class="input-block profile">
                                                        <p>Image 4<span class="text-danger">*</span></p>
                                                        <label for="pimage4" class="form-label"><img id="edit_img4" src="templates/images/car.jpg"></label>
                                                        <input type="file" accept="image/*" name="pimage4" id="pimage4" oninput="edit_img4.src=window.URL.createObjectURL(this.files[0])" required>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                            <h5><strong>Extra features in Car</strong></h5>
                            <div class="mb-3 col-md-6 col-sm-6">
                                <label for="product_discription+" class="form-label">Transmission</label>
                                <div class="input-text">
                                    <select class="form-control wide" id="edit_transmission" name="edit_transmission" required>
                                        <option value="" selected disabled>Select Transmission type</option>
                                        <option value="Manual" >Manual</option>
                                        <option value="Automatic" >Automatic</option>
                                        
                                    </select>
                               </div>
                              </div>
                              <div class="mb-3 col-md-6 col-sm-6">
                                <label for="product_methodOfUse" class="form-label">Seats</label>
                                <div class="input-text">
                                    <select class="form-control wide" id="edit_seats" name="edit_seats" required>
                                        <option value="" selected disabled>Select Seats</option>
                                        <option value="4/5 seater"> 4/5 seater</option>
                                        <option value="6/7 seater"> 6/7 seater</option>                                            
                                    </select>
                               </div>
                              </div>  
                           
                            <h5><strong>Others</strong></h5>
                            <div class="mb-3 col-md-3 col-sm-2">
                                <input type="checkbox" id="edit_airbags" name="edit_airbags" value="Air bags"/>
                                <label>2 Front Airbags</label>
                            </div>
                            <div class="mb-3 col-md-3 col-sm-2">
                                <input type="checkbox" id="edit_musicsystem" name="edit_musicsystem" value="Music System"/>
                                <label>Music System</label>
                            </div>
                            <div class="mb-3 col-md-3 col-sm-2">
                                <input type="checkbox" id="edit_usbcharger" name="edit_usbcharger" value="Usb charger"/>
                                <label> USB charger</label>
                            </div>
                            <div class="mb-3 col-md-3 col-sm-2">
                                <input type="checkbox" id="edit_powersteering" name="edit_powersteering" value="Power Streering"/>
                                <label> Power steering</label>
                            </div>
                            <div class="mb-3 col-md-3 col-sm-2">
                                <input type="checkbox" id="edit_airconditioning" name="edit_airconditioning" value="Air Conditioning"/>
                                <label>Air Conditioning</label>
                            </div>
                            <div class="mb-3 col-md-3 col-sm-2">
                                <input type="checkbox" id="edit_toolkit" name="edit_toolkit" value="Tool kit"/>
                                <label> Toolkit</label>
                            </div>
                            <div class="mb-3 col-md-3 col-sm-2">
                                <input type="checkbox" id="edit_reversecam" name="edit_reversecam" value="Reverse Camera"/>
                                <label>  Reverse Camera</label>
                            </div>
                            <div class="mb-3 col-md-3 col-sm-2">
                                <input type="checkbox" id="edit_sparetyre" name="edit_sparetyre" value="Spare tyre"/>
                                <label>Spare Tyre</label>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="button" onclick="update_car()" class="btn btn-primary">Submit</button>
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
                <h5 class="modal-title">View car</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
            <form>
                <div class="guest-information-area">
                    <h4>Car Information</h4>
                    <span id="errmsg"></span>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-block">
                                <label for="guestsub" class="form-label">Car Name and model</label>
                                <div class="input-text">
        
                                    <span id="vcarname">Ford Mustang GT 2022</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="input-block">
                                <label for="guestnumber" class="form-label">Fuel type</label>
                                <div class="input-text">
                                    <span id="vfueltype">Diesel</span>
                               </div>
                                
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <label for="guestemail" class="form-label">Cost pre/Hr</label>
                            <div class="input-block">
                                
                                <span id="vcost">₹ 550</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-block">
                                <label for="guestnumber" class="form-label">Vehicle type</label>
                                <div class="input-text">
                                    <span id="vvtype">Luxury</span>
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
                <div class="col-xl-12">
                            <div class="mb-3 row">

                                <div class="col-lg-12">
                                    <label class="col-lg-12 col-form-label" for="validationCustom01">Car IMages

                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="mb-3 row guestadd expense">
                                        <div class="col-xl-6">
                                            <div class="mb-3 row">

                                                <div class="col-lg-12">
                                                    <div class="input-block profile">
                                                        <p>Image 1<span class="text-danger">*</span></p>
                                                            <label for="pimage1" class="form-label"><img id="vimg1" src="templates/images/car.jpg"></label>
                                                       
                                                    </div>
                                                    
                                                </div>
                                            </div>

                                        </div>
                                        <div class="col-xl-6">
                                            <div class="mb-3 row">

                                                <div class="col-lg-12">
                                                    <div class="input-block profile">
                                                        <p>Image 2<span class="text-danger">*</span></p>
                                                        <label for="pimage2" class="form-label"><img id="vimg2" src="templates/images/car.jpg"></label>
                                                       
                                                    </div>
                                                    
                                                </div>
                                            </div>

                                        </div>
                                        <div class="col-xl-6">
                                            <div class="mb-3 row">

                                                <div class="col-lg-12">
                                                    <div class="input-block profile">
                                                        <p>Image 3<span class="text-danger">*</span></p>
                                                        <label for="pimage3" class="form-label"><img id="vimg3" src="templates/images/car.jpg"></label>
                                                      
                                                    </div>
                                                    
                                                </div>
                                            </div>

                                        </div>
                                        <div class="col-xl-6">
                                            <div class="mb-3 row">

                                                <div class="col-lg-12">
                                                    <div class="input-block profile">
                                                        <p>Image 4<span class="text-danger">*</span></p>
                                                        <label for="pimage4" class="form-label"><img id="vimg4" src="templates/images/car.jpg"></label>
                                                        
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                            <h5><strong>Extra features in Car</strong></h5>
                            <div class="mb-3 col-md-6 col-sm-6">
                                <label for="product_discription+" class="form-label">Transmission</label>
                                <div class="input-text">
                                    <span id="vtransmission">Manual</span>
                               </div>
                              </div>
                              <div class="mb-3 col-md-6 col-sm-6">
                                <label for="product_methodOfUse" class="form-label">Seats</label>
                                <div class="input-text">
                                    <span id="vseats">4/5 Seater</span>
                               </div>
                              </div>  
                            
                            <h5><strong>Others</strong></h5>
                            <div id="others" class="row"> 
                            
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
    function view_car(id){
        $.ajax({
            type : "PUT",
            url : "/admin/view_car/"+ id,
            id : id,
            encode: true,
            dataType: 'json',
            processData: false,
            contentType: false,

        }).done(function(data){
            var image_path1 = "templates/car_images/" + data.Image1;
            var image_path2 = "templates/car_images/" + data.Image2;
            var image_path3 = "templates/car_images/" + data.Image3;
            var image_path4 = "templates/car_images/" + data.Image4;
            $("#vcarname").html(data.Carname_model);
            $("#vfueltype").html(data.Fueltype);
            $("#vcost").html(data.CostperHR);
            $("#vvtype").html(data.Vehicletype);
            $("#vcity").html(data.Cityname);
            $("#vlocation").html(data.Location);
            $("#vimg1").attr("src", image_path1);
            $("#vimg2").attr("src", image_path2);
            $("#vimg3").attr("src", image_path3);
            $("#vimg4").attr("src", image_path4);
            $("#vtransmission").html(data.Transmission);
            $("#vseats").html(data.Seats);
            let otherss=document.getElementById('others');
            for(let i=0;i<data.Others.length;i++){

                var div = document.createElement("div");
                div.classList.add("mb-3", "col-md-3", "col-sm-2");
                var span = document.createElement("span");
                span.textContent = data.Others[i];
                div.appendChild(span);
                otherss.appendChild(div);

            }
            $("#listeditem").modal('show');


        });
    }
    function edit_car(id){
        $.ajax({
            type : 'PUT',
            url :'/admin/edit_car/'+ id,
            id :id ,
            encode: true,
            dataType: 'json',
            processData: false,
            contentType: false,
        }).done(function(data){
            var image_path1 = "templates/car_images/" + data.Image1;
            var image_path2 = "templates/car_images/" + data.Image2;
            var image_path3 = "templates/car_images/" + data.Image3;
            var image_path4 = "templates/car_images/" + data.Image4;
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
            $("#edit_carname").val(data.Carname_model);
            $("#edit_carfuel").val(data.Fueltype);
            $("#edit_costperhr").val(data.CostperHR);
            $("#edit_vehicletype").val(data.Vehicletype);
            $("#edit_city").val(data.Cityname);
            $("#edit_location").val(data.Location);
            $("#edit_img1").attr("src", image_path1);
            $("#edit_img2").attr("src", image_path2);
            $("#edit_img3").attr("src", image_path3);
            $("#edit_img4").attr("src", image_path4);
            $("#edit_transmission").val(data.Transmission);
            $("#edit_seats").val(data.Seats);
            let oth=["Air bags", "Music System", "Usb charger", "Power Streering", "Spare tyre","Air Conditioning","Tool kit","Reverse Camera"];
            for(let i=0;i<data.Others.length;i++){
                if(data.Others[i]=="Air bags"){
                    const checkbox = document.getElementById('edit_airbags');
                    checkbox.checked = true;

                }
                else if(data.Others[i]=="Music System"){
                    const checkbox = document.getElementById('edit_musicsystem');
                    checkbox.checked = true;

                }
                else if(data.Others[i]=="Usb charger"){
                    const checkbox = document.getElementById('edit_usbcharger');
                    checkbox.checked = true;

                }
                else if(data.Others[i]=="Power Streering"){
                    const checkbox = document.getElementById('edit_powersteering');
                    checkbox.checked = true;

                }
                else if(data.Others[i]=="Spare tyre"){
                    const checkbox = document.getElementById('edit_sparetyre');
                    checkbox.checked = true;


                }
                else if(data.Others[i]=="Air Conditioning"){
                    const checkbox = document.getElementById('edit_airconditioning');
                    checkbox.checked = true;

                }
                else if(data.Others[i]=="Tool kit"){
                    const checkbox = document.getElementById('edit_toolkit');
                    checkbox.checked = true;

                }
                else if(data.Others[i]=="Reverse Camera"){
                    const checkbox = document.getElementById('edit_reversecam');
                    checkbox.checked = true;

                }
                  

            }           
            $("#editpro").modal('show');
        });
    }
    function update_car() {
        var imageUrl1 = document.getElementById('edit_img1').src;
        var imageUrl2 = document.getElementById('edit_img2').src;
        var imageUrl3 = document.getElementById('edit_img3').src;
        var imageUrl4 = document.getElementById('edit_img4').src;
       
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
        formData.append("edit_carname", $("#edit_carname").val());
        formData.append("edit_carfuel", $("#edit_carfuel").val());
        formData.append("edit_costperhr", $("#edit_costperhr").val());
        formData.append("edit_vehicletype",$("#edit_vehicletype").val());
        formData.append("edit_city",$("#edit_city").val());
        formData.append("edit_location", $("#edit_location").val());
        formData.append("edit_transmission", $("#edit_transmission").val());
        formData.append("edit_seats", $("#edit_seats").val());
        formData.append("edit_img1", blob);
        formData.append("edit_img2", blob1);
        formData.append("edit_img3", blob2);
        formData.append("edit_img4", blob3);
        var ids=["edit_airbags","edit_musicsystem","edit_usbcharger","edit_powersteering","edit_airconditioning","edit_toolkit","edit_reversecam","edit_sparetyre"];
        var others = [];

        for (var i = 0; i < ids.length; i++) {
            if (document.getElementById(ids[i]).checked) {
                others.push(document.getElementById(ids[i]).value);
            }
        }

        formData.append("others", others);
             
        $.ajax({
            type: 'POST',
            url: '/admin/update_car',
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
    
        $.ajax( {
            type    : "put",
            url     : '/admin/delete_car/'+id,
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
