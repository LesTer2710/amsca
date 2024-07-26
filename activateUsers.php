<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Activate User Account</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <script>
        function activateUsers() {
            let userId = document.getElementById('userId').value;
            window.location.href = 'index.php?page=doactivateUsers&id=' + encodeURIComponent(userId);
        }
    </script>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="page-header"><br>
                    <h2>Activate User Account</h2>
                </div>
                <p>Please enter the User ID you want to activate.</p>

                <form>
                    <div class="form-group">
                        <label for="userId">User ID</label>
                        <input type="text" name="id" id="userId" class="form-control" required>
                    </div>
                    <input type="button" onclick="activateUsers()" class="btn btn-primary" value="Submit">
                </form>
            </div>
        </div>
    </div>
</body>
</html>
