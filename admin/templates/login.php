<?php require_once 'include/top.php'; ?>
{% include "include/top.php" %}

    <div class="login-page">
        <div class="container">
            <div class="login-page-block">
                <form action="/admin/logincheck" method="post">
                    <div class="form-body">
                        <div class="img-wrapper">
                            <img src="/admin/templates/images/logo.png" alt="LOGO">
                        </div>
                        <div class="user-input">
                            <label for="useremail" class="form-label">User Name</label>
                            <input type="text" class="form-control" id="user_name" name="user_name" placeholder="Enter your user name" required>
                        </div>
                        <div class="user-input">
                            <label for="userpsd" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
                            {%if error=='Invalid Creditional'%}
                            <span class="text-danger" >{{error}}</span>
                            {%endif%}
                        </div>
                        
                        
                        <button type="submit" class="btn btn-primary">Submit</button>
                        
                    </div>
                </form>
            </div>
        </div>
    </div>

{% include "include/bottom.php" %}
<?php require_once 'include/bottom.php'; ?>