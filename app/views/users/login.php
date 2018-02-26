<div class="card">
    <div class="card-header">User Login</div>
    <div class="card-body">
        <form method="post" action="">
            <div class="form-group">
                <label>Email</label>
                <input type="text" name="email" class="form-control"/>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control"/>
            </div>
            <input type="submit" name="submitLogin" value="Submit" class="btn btn-primary"/>
        </form>
    </div>
</div>


<!-- AJAX login -->
<!--<div class="card">-->
<!--    <div class="card-header">User Login</div>-->
<!--    <div class="card-body">-->
<!--        <form method="post" action="">-->
<!--            <div class="form-group">-->
<!--                <label>Email</label>-->
<!--                <input type="text" id="email" name="email" class="form-control"/>-->
<!--            </div>-->
<!--            <div class="form-group">-->
<!--                <label>Password</label>-->
<!--                <input type="password" id="password" name="password" class="form-control"/>-->
<!--            </div>-->
<!--            <input type="submit" id="submitLogin" name="submitLogin" value="Submit" class="btn btn-primary"/>-->
<!--        </form>-->
<!--        <script type="text/javascript">-->
<!--            $(document).ready(function () {-->
<!--                $("#loginBtn").submit(function(event) {-->
<!--                    event.preventDefault();-->
<!--                    $.ajax({-->
<!--                        type: "POST",-->
<!--                        url: "users/login",-->
<!--                        data: {-->
<!--                            email: $("#email").val(),-->
<!--                            password: $("#password").val()-->
<!--                        }-->
<!--                        success: function (response) {-->
<!--                            console.log(response)-->
<!--                        },-->
<!--                        error: function (jqXHR, exception) {-->
<!--                            let msg = '';-->
<!--                            if (jqXHR.status === 0) {-->
<!--                                msg = 'Not connect.\n Verify Network.';-->
<!--                            } else if (jqXHR.status == 404) {-->
<!--                                msg = 'Requested page not found. [404]';-->
<!--                            } else if (jqXHR.status == 500) {-->
<!--                                msg = 'Internal Server Error [500].';-->
<!--                            } else if (exception === 'parsererror') {-->
<!--                                msg = 'Requested JSON parse failed.';-->
<!--                            } else if (exception === 'timeout') {-->
<!--                                msg = 'Time out error.';-->
<!--                            } else if (exception === 'abort') {-->
<!--                                msg = 'Ajax request aborted.';-->
<!--                            } else {-->
<!--                                msg = 'Uncaught Error.\n' + jqXHR.responseText;-->
<!--                            }-->
<!--                            console.log(msg);-->
<!--                        }-->
<!--                    });-->
<!--                });-->
<!--            });-->
<!--        </script>-->
<!--    </div>-->
<!--</div>-->