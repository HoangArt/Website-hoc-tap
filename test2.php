<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            background: #FFF9EC;
        }

        .ui-w-80 {
            width: 80px !important;
            height: auto;
        }

        .btn-default {
            border-color: rgba(24, 28, 33, 0.1);
            background: transparent;
            color: #4E5155;
        }

        .btn-outline-primary {
            border-color: #26B4FF;
            color: #26B4FF;
        }

        .list-group-item.active {
            font-weight: bold;
        }

        .account-settings-fileinput {
            display: none;
        }
    </style>
</head>
<body>
<div class="container light-style flex-grow-1 container-p-y">
        <div class="card overflow-hidden">
            <div>
                <h4 class="font-weight-bold py-3 mb-4">Cài đặt tài khoản</h4>
            </div>

            <!-- THANH BÊN -->
            <div class="row g-0">
                <div class="col-md-3 pt-0">
                    <div class="list-group list-group-flush">
                        <a class="list-group-item list-group-item-action active" data-bs-toggle="tab" href="#account-general">General</a>
                        <a class="list-group-item list-group-item-action" data-bs-toggle="tab" href="#account-change-password">Change Password</a>
                        <a class="list-group-item list-group-item-action" data-bs-toggle="tab" href="#account-info">Info</a>
                        <a class="list-group-item list-group-item-action" data-bs-toggle="tab" href="#account-connections">Connections</a>
                        <a class="list-group-item list-group-item-action" data-bs-toggle="tab" href="#account-notifications">Notifications</a>
                        <a class="list-group-item list-group-item-action" data-bs-toggle="tab" href="#account-social-links">Bảo mật</a>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="tab-content">
                        <!-- General Tab -->
                        <div class="tab-pane fade show active" id="account-general">
                            <div class="card-body d-flex align-items-center">
                                <img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="Avatar" class="ui-w-80">
                                <div class="ms-4">
                                    <label class="btn btn-outline-primary">
                                        Upload new photo
                                        <input type="file" class="account-settings-fileinput">
                                    </label>
                                    <button type="button" class="btn btn-default">Reset</button>
                                    <div class="text-muted small mt-1">Allowed JPG, GIF, or PNG. Max size of 800KB.</div>
                                </div>
                            </div>
                            <hr>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label">Họ và tên:</label>
                                    <input type="text" class="form-control" value="Nelle Maxwell">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Email:</label>
                                    <input type="email" class="form-control" value="nmaxwell@mail.com">
                                    <div class="alert alert-warning mt-2">
                                        Your email is not confirmed. Please check your inbox.
                                        <a href="#">Resend confirmation</a>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Số điện thoại:</label>
                                    <input type="text" class="form-control" value="Nelle Maxwell">
                                </div>
                            </div>
                        </div>

                        <!-- Change Password Tab -->
                        <div class="tab-pane fade" id="account-change-password">
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label">Current Password</label>
                                    <input type="password" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">New Password</label>
                                    <input type="password" class="form-control">
                                </div>
                                <div>
                                    <label class="form-label">Confirm Password</label>
                                    <input type="password" class="form-control">
                                </div>
                            </div>
                        </div>

                        <!-- Info Tab -->
                        <div class="tab-pane fade" id="account-info">
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label">Phone</label>
                                    <input type="text" class="form-control" value="+1234567890">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Address</label>
                                    <input type="text" class="form-control" value="123 Main St, City, Country">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Birthday</label>
                                    <input type="date" class="form-control" value="1990-01-01">
                                </div>
                            </div>
                        </div>



                        <!-- Connections Tab -->
                        <div class="tab-pane fade" id="account-connections">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-3">
                                    <img src="https://bootdey.com/img/Content/avatar/avatar2.png" alt="Google" class="ui-w-80">
                                    <div class="ms-3">
                                        <strong>Google</strong>
                                        <p class="text-muted mb-0">Connected</p>
                                    </div>
                                    <button class="btn btn-outline-danger ms-auto">Disconnect</button>
                                </div>
                                <div class="d-flex align-items-center">
                                    <img src="https://bootdey.com/img/Content/avatar/avatar3.png" alt="Facebook" class="ui-w-80">
                                    <div class="ms-3">
                                        <strong>Facebook</strong>
                                        <p class="text-muted mb-0">Not Connected</p>
                                    </div>
                                    <button class="btn btn-outline-primary ms-auto">Connect</button>
                                </div>
                            </div>
                        </div>

                        <!-- Notifications Tab -->
                        <div class="tab-pane fade" id="account-notifications">
                            <div class="card-body">
                                <div class="form-check form-switch mb-3">
                                    <input class="form-check-input" type="checkbox" id="emailNotifications" checked>
                                    <label class="form-check-label" for="emailNotifications">Email Notifications</label>
                                </div>
                                <div class="form-check form-switch mb-3">
                                    <input class="form-check-input" type="checkbox" id="smsNotifications">
                                    <label class="form-check-label" for="smsNotifications">SMS Notifications</label>
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="pushNotifications" checked>
                                    <label class="form-check-label" for="pushNotifications">Push Notifications</label>
                                </div>
                            </div>
                        </div>

                        <!-- BẢO MẬT -->
                        <div class="tab-pane fade" id="account-social-links">
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label">Facebook</label>
                                    <input type="text" class="form-control" value="https://facebook.com/username">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Twitter</label>
                                    <input type="text" class="form-control" value="https://twitter.com/username">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">LinkedIn</label>
                                    <input type="text" class="form-control" value="https://linkedin.com/in/username">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-end mt-3">
            <button type="button" class="btn btn-primary">Save changes</button>
            <button type="button" class="btn btn-default">Cancel</button>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" defer
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>