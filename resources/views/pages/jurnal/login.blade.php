<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MoSiKoLa-App-v1</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        .login {
            margin: 70px auto;
        }

        .rounded-t-5 {
            border-top-left-radius: 0.5rem;
            border-top-right-radius: 0.5rem;
        }

        @media (min-width: 992px) {
            .rounded-tr-lg-0 {
                border-top-right-radius: 0;
            }

            .rounded-bl-lg-5 {
                border-bottom-left-radius: 0.5rem;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="login">
                <!-- Section: Design Block -->
                <section class=" text-center text-lg-start">

                    <div class="card mb-3">
                        <div class="row g-0 d-flex align-items-center">
                            <div class="col-lg-4 d-none d-lg-flex">
                                <img src="{{ asset('/img/login.jpg') }}" alt="foto sekolah"
                                    class="w-100 rounded-t-5 rounded-tr-lg-0 rounded-bl-lg-5" />
                            </div>
                            <div class="col-lg-8">
                                <div class="card-body py-5 px-md-5">
                                    <h3 class="text-center"><strong>{{ $app->shortName }}</strong></h3>
                                    <h3 class="text-center">{{ $sekolah->appName }}</h3>
                                    <h3 class="text-center">{{ $sekolah->nama }} </h3>
                                    <hr>
                                    @if (session('status'))
                                        <div class="alert alert-danger">
                                            {{ session('status') }}
                                        </div>
                                    @endif
                                    <form action="/jurnal/cekLogin" method="post">
                                        @csrf
                                        <!-- Email input -->
                                        <div class="input-group">
                                            <div class="input-group-text">Username</div>
                                            <input type="text" name="id" class="form-control"
                                                id="autoSizingInputGroup" placeholder="Username">
                                        </div>
                                        <p>
                                            <!-- Password input -->
                                        <div class="input-group">
                                            <div class="input-group-text">Password</div>
                                            <input type="password" name="password" class="form-control"
                                                id="autoSizingInputGroup" placeholder="Password">
                                        </div>

                                        <!-- 2 column grid layout for inline styling -->
                                        <p>
                                        <p>

                                            <!-- Submit button -->
                                            <button type="submit"
                                                class="btn btn-lg btn-primary btn-block mb-4">Login</button>

                                    </form>
                                    <p class="text-center">This app was developed by {{$app->dev}} &copy; {{ $app->year }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- Section: Design Block -->
            </div>
        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
    integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
    integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
</script>

</html>
