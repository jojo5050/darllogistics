<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notification from {{ config('app.name') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background-color: #f4f4f4; font-family: Arial, sans-serif;">
    <div class="container" style="max-width: 600px; margin: 0 auto; padding: 20px;">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <div class="row text-center" style="width:100%;text-align:center">
                    <div class="col-md-4 m-auto text-center">
                        {{-- <img src="{{asset('assets/images/logo.png')}}" alt="Logo" style="max-width: 150px; margin-bottom: 15px;"> --}}
                        <h4>{{ config('app.name') }}</h4>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <p>Hello,</p>

                {!! $msg !!}

                <p>Regards,</p>
                <p>The {{ config('app.name') }} Team</p>
            </div>
        </div>
    </div>
</body>
</html>
