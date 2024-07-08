<?php require_once 'include/top.php'; ?>
<?php require_once 'include/sidemenu.php'; ?>
{% include "include/top.php" %}
{% include "include/sidemenu.php" %}


<div class="content-body">
    <div class="container-fluid">
        <div class="reservation-area">
            <h3>Add Bikes</h3>
            <div class="form-body special_services">
                <form action="#" method="POST">
                    <div class="guest-information-area">
                        <h4>Bike Information</h4>
                        <span id="errmsg"></span>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="input-block">
                                    <label for="guestsub" class="form-label">Bike Name and model</label>
                                    <div class="input-text">
            
                                        <input type="text" class="form-control" id="bikename" name="bikename" placeholder="Bike Name and model" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <div class="input-block">
                                    <label for="guestnumber" class="form-label">Fuel type</label>
                                    <div class="input-text">
                                        <select class="form-control wide" id="bikefuel" name="bikefuel" required>
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
                                    <input type="number" class="form-control" name="costperhr" min="0" id="costperhr" placeholder="cost per/hr" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-block">
                                    <label for="guestnumber" class="form-label">Vehicle type</label>
                                    <div class="input-text">
                                        <select class="form-control wide" id="vehicletype" name="vehicletype" required>
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
                                        <select class="form-control wide" id="cityname" name="cityname" onchange="fetch_location(this.value)" required>
                                            <option value="" selected disabled>Select city</option>
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
                                        <select class="form-control wide" id="location" name="location" required>
                                            <option value="" selected disabled>Select vehicle location</option>
                                           
                                            
                                            
                                        </select>
                                   </div>
                                    
                                </div>
                            </div>
                           
                            <!-- <div class="col-md-6">
                                <div class="input-block">
                                    <label for="offer" class="form-label">Offers</label>
                                    <select class="default-select form-control wide" name="offer" id="offer">
                                        <option selected>Select offer</option>
                                        <option value="10">10%</option>
                                        <option value="25">25%</option>
                                        <option value="50">50%</option>
                                        <option value="100">100%</option>
                                    </select>
                                </div>
                            </div> -->
                           
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
                                                                <label for="pimage1" class="form-label"><img id="addoutput" src="templates/images/profile/profile1.png"></label>
                                                            <input type="file" accept="image/*" name="pimage1" id="pimage1" oninput="addoutput.src=window.URL.createObjectURL(this.files[0])" required>
                                                        </div>
                                                        
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="col-xl-6">
                                                <div class="mb-3 row">

                                                    <div class="col-lg-12">
                                                        <div class="input-block profile">
                                                            <p>Image 2<span class="text-danger">*</span></p>
                                                            <label for="pimage2" class="form-label"><img id="addoutput1" src="templates/images/profile/profile1.png"></label>
                                                            <input type="file" accept="image/*" name="pimage2" id="pimage2" oninput="addoutput1.src=window.URL.createObjectURL(this.files[0])" required>
                                                        </div>
                                                        
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="col-xl-6">
                                                <div class="mb-3 row">

                                                    <div class="col-lg-12">
                                                        <div class="input-block profile">
                                                            <p>Image 3<span class="text-danger">*</span></p>
                                                            <label for="pimage3" class="form-label"><img id="addoutput2" src="templates/images/profile/profile1.png"></label>
                                                            <input type="file" accept="image/*" name="pimage3" id="pimage3" oninput="addoutput2.src=window.URL.createObjectURL(this.files[0])" required>
                                                        </div>
                                                        
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="col-xl-6">
                                                <div class="mb-3 row">

                                                    <div class="col-lg-12">
                                                        <div class="input-block profile">
                                                            <p>Image 4<span class="text-danger">*</span></p>
                                                            <label for="pimage4" class="form-label"><img id="addoutput3" src="templates/images/profile/profile1.png"></label>
                                                            <input type="file" accept="image/*" name="pimage4" id="pimage4" oninput="addoutput3.src=window.URL.createObjectURL(this.files[0])" required>
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
                                        <select class="form-control wide" id="starttype" name="starttype" required>
                                            <option value="" selected disabled>Select start type</option>
                                            <option value="Self start" >Self start</option>
                                            <option value="Kick start" >Kick start</option>
                                            
                                            
                                            
                                        </select>
                                   </div>
                                  </div>
                                  <div class="mb-3 col-md-6 col-sm-6">
                                    <label for="product_methodOfUse" class="form-label">CC of the Bike</label>
                                      <input type="number" min="50" id="bikecc" class="form-control" name="bikecc" placeholder="Bike cc"/>
                                  </div>
                                  <div class="mb-3 col-md-6 col-sm-6">
                                    <label for="product_methodOfUse" class="form-label">Mileage</label>
                                      <input type="number" min="10" id="bikemileage" class="form-control" name="bikemileage" placeholder="Bike Mileage"/>
                                  </div>
                                  
                                </div>
                        </div>
                    </div>
                    <button type="button" onclick="add_bike()" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>


{% include "include/bottom.php" %}
<?php require_once 'include/bottom.php'; ?>
<script type="text/javascript">
    function add_bike(){
        
      var formData = new FormData();
      formData.append("bikename", $("#bikename").val());
      formData.append("bikefuel", $("#bikefuel").val());
      formData.append("costperhr", $("#costperhr").val());
      formData.append("vehicletype", $("#vehicletype").val());
      formData.append("cityname",$("#cityname").val());
      formData.append("location",$("#location").val());
      formData.append("bimage1", $("#pimage1")[0].files[0]);
      formData.append("bimage2", $("#pimage2")[0].files[0]);
      formData.append("bimage3", $("#pimage3")[0].files[0]);
      formData.append("bimage4", $("#pimage4")[0].files[0]);
      formData.append("starttype", $("#starttype").val());
      formData.append("bikecc", $("#bikecc").val());
      formData.append("bikemileage", $("#bikemileage").val());

      $.ajax({
        type :"POST",
        url:"/admin/add_bike",
        data: formData,
        encode: true,
        dataType: 'json',
        processData: false,
        contentType: false,

      }).done(function(data1){
        if(data1=="Done"){
            location.reload();
        }
        else{
            $("#errmsg").html(data1);
        }

      });
        
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
             let lodiv=document.getElementById('location');
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


