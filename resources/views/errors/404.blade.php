<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Page Not Found</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f8f9fa;
            text-align: center;
        }

        .error-code {
            font-size: 120px;
            font-weight: bold;
            color: #dc3545;
        }

        .btn-custom {
            padding: 12px 20px;
            font-size: 18px;
            border-radius: 5px;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h1 class="error-code">404</h1>
                <h2 class="mb-3">Oops! Page Not Found</h2>
                <p class="mb-4">The page you're looking for doesn't exist or has been moved.</p>
                
                <a href="{{route('frontend.home')}}" class="btn btn-primary btn-custom">Go Back Home</a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
