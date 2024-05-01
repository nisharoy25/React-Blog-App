<!DOCTYPE html>
<html lang="en">
<head>
  <title>Blog Category</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

  <nav class="navbar navbar-expand-sm bg-dark justify-content-center display-6">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link text-light" href="/">Blog Category</a>
      </li>
    </ul>
  </nav>

  @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif

        @yield('main')

</body>
</html>