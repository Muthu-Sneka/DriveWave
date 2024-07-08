<?php require_once 'include/top.php'; ?>
<?php require_once 'include/sidemenu.php'; ?>
{% include "include/top.php" %}
{% include "include/sidemenu.php" %}

 
<div class="content-body">
    <div class="container-fluid">
        <div class="row available-rooms">
            <div class="col-lg-3 col-md-6">
                <div class="detail-box">
                    <h3>Total Bikes<span>{{bikecount}}</span></h3>
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" style="width: 50%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <div class="content-wrapper">
                        <!-- <div class="left">
                            <p>Recived<span>(<span class="value">60</span>)</span></p>
                        </div>
                        <div class="right">
                            <p>Pending<span>(<span class="value">40</span>)</span></p>
                        </div> -->
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="detail-box">
                    <h3>Cars<span>{{carcount}}</span></h3>
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" style="width: 43%;" aria-valuenow="43" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <div class="content-wrapper">
                        <!-- <div class="left">
                            <p>Recived<span>(<span class="value">760</span>)</span></p>
                        </div>
                        <div class="right">
                            <p>Pending <span>(<span class="value">40</span>)</span></p>
                        </div> -->
                    </div>
                </div>
            </div>
            <!-- <div class="col-lg-3 col-md-6">
                <div class="detail-box">
                    <h3>CHECK OUT <span>1000</span></h3>
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" style="width: 80%;" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <div class="content-wrapper">
                        <div class="left">
                            <p>Arrived <span>(<span class="value">800</span>)</span></p>
                        </div>
                        <div class="right">
                            <p>Pending <span>(<span class="value">200</span>)</span></p>
                        </div>
                    </div>
                </div>
            </div> -->
            <!-- <div class="col-lg-3 col-md-6">
                <div class="detail-box">
                    <h3>GUEST IN HOUSE <span>1000</span></h3>
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" style="width: 80%;" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <div class="content-wrapper">
                        <div class="left">
                            <p>Adult <span>(<span class="value">710</span>)</span></p>
                        </div>
                        <div class="right">
                            <p>Child <span>(<span class="value">290</span>)</span></p>
                        </div>
                    </div>
                </div>
            </div> -->
        </div>
        <!--<div class="row guest-database-wrapper mt-4">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header border-0 flex-wrap">
                        <h4 class="fs-20">Order Status</h4>
                        <div class="card-action coin-tabs">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link " data-bs-toggle="tab" href="#Daily1" role="tab">Daily</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link " data-bs-toggle="tab" href="#weekly1" role="tab" >Weekly</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#monthly1" role="tab" >Monthly</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-body pb-0">
                        <div class="d-flex flex-wrap">
                            <span class="me-sm-5 me-0 font-w500">
                                <svg class="me-1" xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 13 13">
                                <rect  width="13" height="13" fill="#135846"/>
                                </svg>

                                Order received
                            </span>
                            <span class="fs-16 font-w600 me-4">23<small class="text-success fs-12 font-w400">+0.4%</small></span>
                            <span class="me-sm-5 ms-0 font-w500">
                                <svg class="me-1" xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 13 13">
                                <rect  width="13" height="13" fill="#E23428"/>
                                </svg>
                                Order completed
                            </span>
                            <span class="fs-16 font-w600">20</span>
                        </div>	
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="Daily1">
                                <div id="chartBar" class="chartBar"></div>
                            </div>
                            <div class="tab-pane fade " id="weekly1">
                                <div id="chartBar1" class="chartBar"></div>
                            </div>
                            <div class="tab-pane fade " id="monthly1">
                                <div id="chartBar2" class="chartBar"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>-->
            <!-- <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Worker Status</h4>
                        <!-- <button class="btn btn-primary" type="" data-bs-toggle="modal" data-bs-target="#guestadd1">Add Guest</button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example3" class="display" style="min-width: 845px">
                                <thead>
                                    <tr>
                                        <th>
                                            <div class="form-check custom-checkbox ms-2">
                                                <input type="checkbox" class="form-check-input" id="checkAll" required="">
                                                <label class="form-check-label" for="checkAll"></label>
                                            </div>
                                        </th>
                                        <th>Worker Name</th>
                                        <th>Worker Role</th>
                                        <th>Present</th>
                                        <th>Absent</th>
                                        <th>Working Days</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="form-check custom-checkbox ms-2">
                                                <input type="checkbox" class="form-check-input" id="customCheckBox2" required="">
                                                <label class="form-check-label" for="customCheckBox2"></label>
                                            </div>
                                        </td>
                                        <td>Obi</td>
                                        <td>Cleaner</td>
                                        <td>25</td>
                                        <td>2</td>
                                        <td>27</td>											
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-check custom-checkbox ms-2">
                                                <input type="checkbox" class="form-check-input" id="customCheckBox3" required="">
                                                <label class="form-check-label" for="customCheckBox3"></label>
                                            </div>
                                        </td>
                                        <td>Dola</td>
                                        <td>Chef</td>
                                        <td>35</td>
                                        <td>5</td>
                                        <td>40</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-check custom-checkbox ms-2">
                                                <input type="checkbox" class="form-check-input" id="customCheckBox4" required="">
                                                <label class="form-check-label" for="customCheckBox4"></label>
                                            </div>
                                        </td>
                                        <td>Ja</td>
                                        <td>Cleaner</td>
                                        <td>35</td>
                                        <td>5</td>
                                        <td>40</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>	 -->
        </div>
    </div>
</div>


{% include "include/bottom.php" %}

<?php require_once 'include/bottom.php'; ?>