<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Rapport Stock Bas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }
        h1 {
            color: #333;
            text-align: center;
        }
        .date {
            text-align: right;
            margin-bottom: 20px;
            color: #666;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .text-center {
            text-align: center;
        }
        .low-stock {
            color: #e67e22;
            font-weight: bold;
        }
        .out-of-stock {
            color: #e74c3c;
            font-weight: bold;
        }
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 10px;
            color: #999;
        }
    </style>
</head>
<body>
    <h1>Rapport des produits en stock bas</h1>
    <div class="date">Généré le : {{ $date }}</div>

    @if($products->count() > 0)
        <table>
            <thead>
                 <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Catégorie</th>
                    <th>Fournisseur</th>
                    <th>Stock actuel</th>
                    <th>Seuil d'alerte</th>
                    <th>Quantité recommandée</th>
                 </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->category->name ?? 'N/A' }}</td>
                        <td>{{ $product->supplier->name ?? 'N/A' }}</td>
                        <td class="{{ $product->stock_quantity == 0 ? 'out-of-stock' : 'low-stock' }}">
                            {{ $product->stock_quantity }}
                        </td>
                        <td>{{ $product->alert_threshold }}</td>
                        <td>{{ max($product->alert_threshold * 2 - $product->stock_quantity, 0) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p class="text-center">✅ Aucun produit en stock bas. Tout est bon !</p>
    @endif

    <div class="footer">
        StockFlow - Rapport généré automatiquement
    </div>
</body>
</html>