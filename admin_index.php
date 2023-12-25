<html>
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Traffic Police Website</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body>
    <section class="vh-100">

    <div class="container h-custom">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-md-9 col-lg-6 col-xl-5">
                <img src="img/index_image.jpg"
                class="img-fluid" alt="Sample image">
            </div>
        <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
            <form class="border shadow-sm p-4 rounded"
                  action = "admin_login.php"
                  method = "post">

            <div class="row justify content-center" >
                <h2 class="text-center">Admin Login</h2></br><br>
            </div><br>
               <!-- Email input -->
                <div class="form-outline mb-4">
                <h5><label for="username" class="form-label">User Name</label></h5>
                    <input type="text" class="form-control form-control-lg" name = "username" id="username" placeholder = "Enter Username"required>
                </div>

                <!-- Password input -->
                
                <div class="form-outline mb-4">
                    <h5><label for="password" class="form-label ">Password</label></h5>
                    <input type="password" class="form-control form-control-lg " name="password" id="password" placeholder = "Enter Password" required>
                </div>

                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" name ="check" id="check" required>
                    <label class="form-check-label" for="exampleCheck1">I am not a Robot</label>
                </div>
                



                <div class="text-center text-lg-start mt-4 pt-2">
                    <button type="submit" class="btn btn-primary btn-lg" style="padding-left: 2.5rem; padding-right: 2.5rem;">Login</button>

                        
                        <p class="small fw-bold mt-2 pt-1 mb-0">Not an Admin?
                        <a href=index.php class="link-danger"> Officer Login </a></p>
                </div>

                </form>
            </div>
            </div>
        </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    </body>
</html>