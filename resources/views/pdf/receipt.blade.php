<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Reçu Vente #{{ $sale->id }}</title>
</head>
<body>
    <h1>Reçu de vente</h1>
    <p>Vente #{{ $sale->id }}</p>
    <p>Vendeur: {{ $sale->user->name ?? 'N/A' }}</p>
    <p>Total TTC: {{ number_format($sale->total_ttc, 2) }} DH</p>

    <hr>

    @forelse($sale->saleItems as $item)
        <p>
            Produit ID: {{ $item->product_id }} |
            Quantité: {{ $item->quantity }} |
            PU: {{ number_format($item->unit_price, 2) }} DH |
            Sous-total: {{ number_format($item->subtotal, 2) }} DH
        </p>
    @empty
        <p>Aucun article.</p>
    @endforelse
</body>
</html>
