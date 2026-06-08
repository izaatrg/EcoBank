<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EcoBank Admin</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            display: flex;
            background: #f5f7f9;
        }

        .sidebar {
            width: 250px;
            height: 100vh;
            background: #0f5132;
            color: white;
            padding: 20px;
        }

        .sidebar h2 {
            margin-bottom: 30px;
        }

        .sidebar a {
            display: block;
            color: white;
            text-decoration: none;
            margin-bottom: 15px;
            padding: 10px;
            border-radius: 5px;
        }

        .sidebar a:hover {
            background: #198754;
        }

        .content {
            flex: 1;
            padding: 30px;
        }

        .navbar {
            background: white;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
    </style>

</head>

<body>

    <div class="sidebar">

        <h2>EcoBank</h2>

        <a href="/admin/dashboard">Dashboard</a>

        <a href="/kategori">Kategori Sampah</a>

        <a href="/reward">Reward</a>

        <a href="#">Laporan</a>

        <a href="#">Data Warga</a>

        <a href="#">Data Petugas</a>

    </div>

    <div class="content">

        <div class="navbar">

            <h3>Admin EcoBank</h3>

        </div>

        @yield('content')

    </div>

</body>

</html>