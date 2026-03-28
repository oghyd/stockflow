<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Reçu Vente #{{ $sale->id }}</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 14px; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { border: 1px solid #000; padding: 8px; text-align: left; }
        h1, h3 { margin: 0 0 10px 0; }
    </style>
</head>
<body>
    <h1>Reçu de vente</h1>
    <p><strong>Vente #:</strong> {{ $sale->id }}</p>
    <p><strong>Vendeur:</strong> {{ $sale->user->name ?? 'N/A' }}</p>
    <p><strong>Date:</strong> {{ $sale->validated_at ?? $sale->created_at }}</p>

    <table>
        <thead>
            <tr>
                <th>Produit</th>
                <th>Quantité</th>
                <th>Prix unitaire</th>
                <th>Sous-total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($sale->saleItems as $item)
                <tr>
                    <td>{{ $item->product->name ?? ('Produit #' . $item->product_id) }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ number_format($item->unit_price, 2) }} DH</td>
                    <td>{{ number_format($item->subtotal, 2) }} DH</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h3 style="margin-top: 20px;">
        Total TTC: {{ number_format($sale->total_ttc, 2) }} DH
    </h3>
</body>
</html>
