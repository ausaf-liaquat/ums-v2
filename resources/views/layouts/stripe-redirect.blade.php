<!DOCTYPE html>
<html>
<head>
  <title>Redirect to Stripe Checkout</title>
</head>
<body>
  <script>
    window.location.href = decodeURIComponent("{{ $session->url }}");
  </script>
</body>
</html>