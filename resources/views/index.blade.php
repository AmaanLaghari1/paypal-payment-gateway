<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Paypal Payment Gateway</h1>
    <h3>Samsung Galaxy S22</h3>
    <h5>Price: 1,50,000</h5>

    <form action="/paypal" method="post">
        @csrf
        <input type="hidden" name="product_name" value="samsung galaxy s22">
        <input type="hidden" name="price" value="15">
        <input type="hidden" name="quantity" value="1">
        <button type="submit">Make Paypal Payment</button>
    </form>
</body>
</html>