<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body class="registration-login-page">
    <div class="registration-container">
        <!-- Illustration Column -->
        <div class="illustration"></div>

        <!-- Registration Form Column -->
        <div class="form-section">
            <h2 class="form-title">Registration</h2>
            <form>
                <div class="mb-3">
                    <label for="fullName" class="form-label">Full Name</label>
                    <input type="text" class="form-control" id="fullName" placeholder="Enter your name">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" placeholder="Enter your email">
                </div>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="birthMonth" class="form-label">Birth Month</label>
                        <input type="number" class="form-control" id="birthMonth" placeholder="1-12" min="1" max="12">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="birthDate" class="form-label">Birth Date</label>
                        <input type="number" class="form-control" id="birthDate" placeholder="1-31" min="1" max="31">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="birthYear" class="form-label">Birth Year</label>
                        <input type="number" class="form-control" id="birthYear" placeholder="Enter your birth year">
                    </div>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" placeholder="Enter your password">
                </div>
                <div class="mb-3">
                    <label for="confirmPassword" class="form-label">Confirm Password</label>
                    <input type="password" class="form-control" id="confirmPassword" placeholder="Confirm your password">
                </div>
                <div class="mb-3">
                    <label class="form-label">Gender</label>
                    <div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" id="male" value="Male">
                            <label class="form-check-label" for="male">Male</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" id="female" value="Female">
                            <label class="form-check-label" for="female">Female</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" id="other" value="Other">
                            <label class="form-check-label" for="other">Other</label>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
            <p class="text-center mt-3">
                Already have an account? <a href="#">Sign in</a>
            </p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
