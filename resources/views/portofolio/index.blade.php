<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Assignment - CRUD PHP</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Bootstrap CSS -->
        <link
            rel="stylesheet"
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" />

        <style>
            @media only screen and (max-width: 992px) {
                #profile-detail {
                    border-left: 0 !important;
                }
            }
        </style>
    </head>
    <body style="background-color: #f3f4fe">
        <nav class="navbar navbar-expand-sm bg-body-tertiary shadow-sm">
            <div class="container-fluid">
                <button
                    class="navbar-toggler"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#navbarNavAltMarkup"
                    aria-controls="navbarNavAltMarkup"
                    aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div
                    class="collapse navbar-collapse justify-content-end"
                    id="navbarNavAltMarkup">
                    <div class="navbar-nav">
                        <a class="nav-link active" aria-current="page" href="#">HOME</a>
                        <a class="nav-link" href="#">PRODUCT</a>
                        <a class="nav-link" href="#">GALLERY</a>
                        <a class="nav-link" href="#">BLOG</a>
                        <a class="nav-link" href="#">MY INVENTORY</a>
                    </div>
                </div>
            </div>
        </nav>

        <main class="py-4">
            <section class="container p-0">
                <?php
                if (isset($_SESSION["alert-success"])) {
                    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>";
                    echo $_SESSION["alert-success"];
                    echo "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
                    unset($_SESSION["alert-success"]);
                }
                if (isset($_SESSION["alert-failed"])) {
                    echo "<div class='alert alert-failed alert-dismissible fade show' role='alert'>";
                    echo $_SESSION["alert-failed"];
                    echo "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
                    unset($_SESSION["alert-failed"]);
                }
                if (isset($_SESSION["error-not-found"])) {
                    echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>";
                    echo $_SESSION["error-not-found"];
                    echo "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
                    unset($_SESSION["error-not-found"]);
                }
                ?>
            </section>

            <section class="container bg-white rounded shadow-sm px-5 py-4">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="row">
                            <div class="col-md-auto d-flex align-items-center h-100">
                                <img
                                    src="{{ asset('images/photo-profile.png') }}"
                                    alt=""
                                    width="100"
                                    class="img-fluid rounded-circle" />
                            </div>
                            <div class="col">
                                <div class="mt-2 mt-lg-0">
                                    <div>
                                        <h1 class="fs-4 text-wrap" id="profile-data-name">
                                            <?php echo isset($data['name']) ? $data['name'] : '-' ?>
                                        </h1>
                                        <p id="profile-data-role">
                                            <?php echo isset($data['role']) ? $data['role'] : '-' ?>
                                        </p>
                                    </div>
                                    <div>
                                        <button class="btn btn-primary btn-md">
                                            <span>Kontak</span>
                                        </button>
                                        <button class="btn btn-info btn-md">
                                            <span>Resume</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div
                        id="profile-detail"
                        class="col-lg-6 border-0 border-lg-start mt-3 mt-lg-0 border-start">
                        <table class="table w-auto table-borderless bg-danger h-100">
                            <tr>
                                <td class="m-0 p-0 pe-4">Availability</td>
                                <td
                                    class="m-0 p-0 pe-4 text-gray"
                                    id="profile-data-availability">
                                    <?php echo isset($data['availability']) ? $data['availability'] : '-' ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="m-0 p-0 pe-4">Usia</td>
                                <td class="m-0 p-0 pe-4 text-gray" id="profile-data-age">
                                    <?php echo isset($data['age']) ? $data['age'] : '-' ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="m-0 p-0 pe-4">Lokasi</td>
                                <td class="m-0 p-0 pe-4 text-gray" id="profile-data-location">
                                    <?php echo isset($data['location']) ? $data['location'] : '-' ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="m-0 p-0 pe-4">Pengalaman</td>
                                <td
                                    class="m-0 p-0 pe-4 text-gray"
                                    id="profile-data-years_experience">
                                    <?php echo isset($data['years_experience']) && $data['years_experience'] != '-' ? $data['years_experience'] . ' tahun' : '-' ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="m-0 p-0 pe-4">Email</td>
                                <td class="m-0 p-0 pe-4 text-gray" id="profile-data-email">
                                    <?php echo isset($data['email']) ? $data['email'] : '-' ?>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </section>

            <section class="container mt-3 bg-white shadow-sm rounded px-4 py-3">
                <form id="profile-form" method="POST" action="process.php">
                    <div class=" mb-3">
                        <label for="name" class="form-label">Nama</label>
                        <input
                            type="text"
                            class="form-control <?= isset($_SESSION['error']['name']) ? 'border-danger' : '' ?>"
                            id="name"
                            name="name"
                            aria-describedby="emailHelp" />
                        <?php
                        if (isset($_SESSION['error']['name'])) {
                            echo "<div class='form-text text-danger'>";
                            foreach ($_SESSION['error']['name'] as $error) {
                                echo $error . '<br>';
                            }
                            echo "</div>";
                            unset($_SESSION['error']['name']);
                        }
                        ?>
                    </div>

                    <div class="mb-3">
                        <label for="role" class="form-label">Role</label>
                        <input
                            type="text"
                            class="form-control  <?= isset($_SESSION['error']['role']) ? 'border-danger' : '' ?>"
                            id="role"
                            name="role"
                            aria-describedby="emailHelp" />
                        <?php
                        if (isset($_SESSION['error']['role'])) {
                            echo "<div class='form-text text-danger'>";
                            foreach ($_SESSION['error']['role'] as $error) {
                                echo $error . '<br>';
                            }
                            echo "</div>";
                            unset($_SESSION['error']['role']);
                        }
                        ?>
                    </div>

                    <div class="mb-3">
                        <label for="availability" class="form-label">Availability</label>
                        <select
                            class="form-select <?= isset($_SESSION['error']['availability']) ? 'border-danger' : '' ?>"
                            name="availability"
                            id="availability">
                            <option value="" selected>-</option>
                            <option value="full-time">Full Time</option>
                            <option value="part-time">Part Time</option>
                            <option value="internship">Internship</option>
                        </select>
                        <?php
                        if (isset($_SESSION['error']['availability'])) {
                            echo "<div class='form-text text-danger'>";
                            foreach ($_SESSION['error']['availability'] as $error) {
                                echo $error . '<br>';
                            }
                            echo "</div>";
                            unset($_SESSION['error']['availability']);
                        }
                        ?>
                    </div>

                    <div class="mb-3">
                        <label for="age" class="form-label">Usia</label>
                        <input
                            type="number"
                            class="form-control <?= isset($_SESSION['error']['age']) ? 'border-danger' : '' ?>"
                            id="age"
                            name="age"
                            aria-describedby="emailHelp" />
                        <?php
                        if (isset($_SESSION['error']['age'])) {
                            echo "<div class='form-text text-danger'>";
                            foreach ($_SESSION['error']['age'] as $error) {
                                echo $error . '<br>';
                            }
                            echo "</div>";
                            unset($_SESSION['error']['age']);
                        }
                        ?>
                    </div>

                    <div class="mb-3">
                        <label for="location" class="form-label">Lokasi</label>
                        <input
                            type="text"
                            class="form-control <?= isset($_SESSION['error']['location']) ? 'border-danger' : '' ?>"
                            id="location"
                            name="location"
                            aria-describedby="emailHelp" />
                        <?php
                        if (isset($_SESSION['error']['location'])) {
                            echo "<div class='form-text text-danger'>";
                            foreach ($_SESSION['error']['location'] as $error) {
                                echo $error . '<br>';
                            }
                            echo "</div>";
                            unset($_SESSION['error']['location']);
                        }
                        ?>
                    </div>

                    <div class="mb-3">
                        <label for="years_experience" class="form-label">Years Experience</label>
                        <input
                            type="number"
                            class="form-control <?= isset($_SESSION['error']['years_experience']) ? 'border-danger' : '' ?>"
                            id="years_experience"
                            name="years_experience"
                            aria-describedby="emailHelp" />
                        <?php
                        if (isset($_SESSION['error']['years_experience'])) {
                            echo "<div class='form-text text-danger'>";
                            foreach ($_SESSION['error']['years_experience'] as $error) {
                                echo $error . '<br>';
                            }
                            echo "</div>";
                            unset($_SESSION['error']['years_experience']);
                        }
                        ?>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input
                            type="email"
                            class="form-control <?= isset($_SESSION['error']['email']) ? 'border-danger' : '' ?>"
                            id="email"
                            name="email"
                            aria-describedby="emailHelp" />
                        <?php
                        if (isset($_SESSION['error']['email'])) {
                            echo "<div class='form-text text-danger'>";
                            foreach ($_SESSION['error']['email'] as $error) {
                                echo $error . '<br>';
                            }
                            echo "</div>";
                            unset($_SESSION['error']['email']);
                        }
                        ?>
                    </div>

                    <button type="submit" class="btn btn-success w-100">
                        Create Data
                    </button>

                </form>
            </section>
        </main>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </body>
</html>
