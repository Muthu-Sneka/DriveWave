<?php require_once 'include/top.php'; ?>
<?php require_once 'include/sidemenu.php'; ?>
{% include "include/top.php" %}
{% include "include/sidemenu.php" %}


<div class="content-body">
    <div class="container-fluid">
        <div class="row guest-database-wrapper">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Query</h4>
                        
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example3" class="display" style="min-width: 845px">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Query ID</th>
                                        <th>Email ID</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                              
                                <tbody>
                                  {%for i in query%}
                                    <tr>
                                        <td>{{loop.index}}</td>
                                        <td>{{i.QueryId}}</td>
                                        <td>{{i.Emailid}}</td>
                                        <td>
                                            <div class="d-flex">
                                            <a href="#" class="btn btn-primary shadow btn-xs sharp me-1" type="button" data-bs-toggle="modal"  onclick="view_query({{i.id}})" > <i class="far fa-clipboard"></i></a>
                                            <a href="#" class="btn btn-danger shadow btn-xs sharp" onclick="del_conformation({{i.id}})" ><i class="fa fa-trash"></i></a>

                                                <!-- <a href="#" class="btn btn-primary shadow btn-xs sharp me-1" type="button" data-bs-toggle="modal" data-bs-target="#guestadd"><i class="fas fa-pencil-alt"></i></a>
                                                <a href="#" class="btn btn-danger shadow btn-xs sharp delete-guest"><i class="fa fa-trash"></i></a> -->
                                            </div>												
                                        </td>												
                                    </tr>
                                    {%endfor%}
                                    <!--<tr>
                                        <td>2</td>
                                        <td>#P1</td>
                                        <td>Guava Leaf Powder</td>
                                        <td>5%</td>
                                        
                                        <td>
                                            <div class="d-flex">
                                                <a href="#" class="btn btn-primary shadow btn-xs sharp me-1" type="button" data-bs-toggle="modal" data-bs-target="#viewreview"><i class="far fa-clipboard"></i></a>
                                                 <a href="#" class="btn btn-primary shadow btn-xs sharp me-1" type="button" data-bs-toggle="modal" data-bs-target="#guestadd"><i class="fas fa-pencil-alt"></i></a>
                                                <a href="#" class="btn btn-danger shadow btn-xs sharp delete-guest"><i class="fa fa-trash"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>#P1</td>
                                        <td>Guava Leaf Powder</td>
                                        <td>4%</td>
                                        
                                        <td>
                                            <div class="d-flex">
                                                <a href="#" class="btn btn-primary shadow btn-xs sharp me-1" type="button" data-bs-toggle="modal" data-bs-target="#viewreview"><i class="far fa-clipboard"></i></a>
                                                 <a href="#" class="btn btn-primary shadow btn-xs sharp me-1" type="button" data-bs-toggle="modal" data-bs-target="#guestadd"><i class="fas fa-pencil-alt"></i></a>
                                                <a href="#" class="btn btn-danger shadow btn-xs sharp delete-guest"><i class="fa fa-trash"></i></a>
                                            </div>
                                        </td>
                                    </tr>-->
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
<div class="modal fade guestadd" id="guestadd">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
            </div>
            </div>
    </div>
</div>
<!--**********************************
    Add Guest end
***********************************-->

<!--**********************************
    Add Guest start
***********************************-->
<div class="modal fade guestadd" id="view_review">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Query Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body testr">
                <label>Query ID</label><br>
                <span id="qid">B203423</span><br>
                <label>Email ID</label><br>
                <span id="mailid">jeffry@gmail.com</span><br>
                <label>Query</label><br>
                <sapn id="qcontent">
                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum
                </span>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
  <!-- Modal -->
  <div class="modal" id="viewreview" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Product Reveiw</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="container">
            <div class="row" id="reviewcontent">
              <!-- <div class="col-md-4">
                <div class="card">

                  <div class="card-body">
                    <h5 class="card-title">User__001</h5>
                    <p class="customerRating">
                      <i class="bi bi-star-fill"></i>
                      <i class="bi bi-star-fill"></i>
                      <i class="bi bi-star-fill"></i>
                      <i class="bi bi-star-fill"></i>
                      <i class="bi bi-star"></i>
                    </p>
                    <p class="card-text">I recently incorporated Guava Leaf Powder into my daily routine, and I am thoroughly impressed with its numerous health benefits. Not only is it an excellent source of antioxidants, but it also boasts an array of essential nutrients, making it a valuable addition to my wellness regimen</p>
                  </div>
                  <div class="card-footer">
                        <input type="checkbox">
                        <label>View</label>
                </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="card">

                  <div class="card-body">
                    <h5 class="card-title">user__002</h5>
                    <p class="customerRating">
                      <i class="bi bi-star-fill"></i>
                      <i class="bi bi-star-fill"></i>
                      <i class="bi bi-star-fill"></i>
                      <i class="bi bi-star-half"></i>
                      <i class="bi bi-star"></i>
                    </p>
                    <p class="card-text">I recently incorporated Guava Leaf Powder into my daily routine, and I am thoroughly impressed with its numerous health benefits. Not only is it an excellent source of antioxidants, but it also boasts an array of essential nutrients, making it a valuable addition to my wellness regimen</p>
                  </div>
                  <div class="card-footer">
                        <input type="checkbox">
                        <label>View</label>
                </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="card">

                  <div class="card-body">
                    <h5 class="card-title">user__003</h5>
                    <p class="customerRating">
                      <i class="bi bi-star-fill"></i>
                      <i class="bi bi-star-fill"></i>
                      <i class="bi bi-star-fill"></i>
                      <i class="bi bi-star-half"></i>
                      <i class="bi bi-star"></i>
                    </p>
                    <p class="card-text">I recently incorporated Guava Leaf Powder into my daily routine, and I am thoroughly impressed with its numerous health benefits. Not only is it an excellent source of antioxidants, but it also boasts an array of essential nutrients, making it a valuable addition to my wellness regimen</p>
                  </div>
                  <div class="card-footer">
                        <input type="checkbox">
                        <label>View</label>
                </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="card">

                  <div class="card-body">
                    <h5 class="card-title">user__04</h5>
                    <p class="customerRating">
                      <i class="bi bi-star-fill"></i>
                      <i class="bi bi-star-fill"></i>
                      <i class="bi bi-star-fill"></i>
                      <i class="bi bi-star-half"></i>
                      <i class="bi bi-star"></i>
                    </p>
                    <p class="card-text">I recently incorporated Guava Leaf Powder into my daily routine, and I am thoroughly impressed with its numerous health benefits. Not only is it an excellent source of antioxidants, but it also boasts an array of essential nutrients, making it a valuable addition to my wellness regimen</p>
                  </div>
                  <div class="card-footer">
                        <input type="checkbox">
                        <label>View</label>
                </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="card">

                  <div class="card-body">
                    <h5 class="card-title">User__05</h5>
                    <p class="customerRating">
                      <i class="bi bi-star-fill"></i>
                      <i class="bi bi-star-fill"></i>
                      <i class="bi bi-star-fill"></i>
                      <i class="bi bi-star-half"></i>
                      <i class="bi bi-star"></i>
                    </p>
                    <p class="card-text">I recently incorporated Guava Leaf Powder into my daily routine, and I am thoroughly impressed with its numerous health benefits. Not only is it an excellent source of antioxidants, but it also boasts an array of essential nutrients, making it a valuable addition to my wellness regimen</p>
                  </div>
                  <div class="card-footer">
                        <input type="checkbox">
                        <label>View</label>
                </div>
                </div>
              </div> -->
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button> -->
        </div>
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
         Do you want to Delete this Query ?
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
  function view_query(id){
    

    
    $.ajax({
      type : 'PUT',
      url : '/admin/view_query/'+id,
      id : id,
      encode: true,
      dataType: 'json',
      processData: false,
      contentType: false,
      

    }).done(function(data){
      $("#qid").text(data.QueryId);
      $("#mailid").text(data.Emailid);
      $("#qcontent").text(data.Querycontent);
      $("#view_review").modal('show');


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
        url     : '/admin/delete_query/'+id,
        id    : id,
        contentType: "application/json",
        success: function(data) {
            location.reload();
        },
    });
    return false;

}
  
</script>

