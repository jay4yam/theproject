<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
</head>
<body>
<h2>Inscription à la newsletter</h2>
<p>Pour vous remercier de votre inscription, easycopter.fr vous offre un code de réduction de {{ $coupon->value }} % </p>
<ul>
    <li><strong>Coupon de réduction</strong> : {{ $coupon->couponCode }}</li>
</ul>
<p>
    Vous pourrez utiliser ce coupon de réduction lors de votre prochaine commande
    Ce coupon n'est valable que pour 1 seul voyage
</p>
</body>
</html>