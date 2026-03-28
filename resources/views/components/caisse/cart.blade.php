<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="lg:col-span-2">
        <div class="bg-white shadow-sm sm:rounded-lg p-6">
            <h3 class="text-lg font-semibold mb-4">Recherche de produits</h3>

            <div class="mb-4">
                <input
                    type="text"
                    placeholder="Rechercher un produit par nom ou code-barres..."
                    class="w-full border-gray-300 rounded-md shadow-sm"
                >
            </div>

            <div class="border rounded-lg p-4 bg-gray-50">
                <p class="text-sm text-gray-500">
                    Les produits disponibles apparaîtront ici une fois le module produit terminé.
                </p>
            </div>
        </div>

        <div class="bg-white shadow-sm sm:rounded-lg p-6 mt-6">
            <h3 class="text-lg font-semibold mb-4">Panier</h3>

            <div class="overflow-x-auto">
                <table class="min-w-full border border-gray-200">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-2 text-left border">Produit</th>
                            <th class="px-4 py-2 text-left border">Prix Unitaire</th>
                            <th class="px-4 py-2 text-left border">Quantité</th>
                            <th class="px-4 py-2 text-left border">Sous-total</th>
                            <th class="px-4 py-2 text-left border">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="5" class="px-4 py-6 text-center text-gray-500 border">
                                Aucun produit dans le panier pour le moment.
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="lg:col-span-1">
        <div class="bg-white shadow-sm sm:rounded-lg p-6 sticky top-6">
            <h3 class="text-lg font-semibold mb-4">Résumé de la vente</h3>

            <div class="space-y-3">
                <div class="flex justify-between">
                    <span class="text-gray-600">Nombre d’articles</span>
                    <span class="font-medium">0</span>
                </div>

                <div class="flex justify-between">
                    <span class="text-gray-600">Sous-total</span>
                    <span class="font-medium">0.00 DH</span>
                </div>

                <div class="flex justify-between">
                    <span class="text-gray-600">TVA / TTC</span>
                    <span class="font-medium">0.00 DH</span>
                </div>

                <hr>

                <div class="flex justify-between text-lg font-bold">
                    <span>Total TTC</span>
                    <span>0.00 DH</span>
                </div>
            </div>

            <button
                class="w-full mt-6 bg-blue-600 text-white py-2 px-4 rounded-md opacity-50 cursor-not-allowed"
                disabled
            >
                Valider la vente
            </button>

            <p class="text-xs text-gray-500 mt-3">
                Le bouton sera activé lorsque le panier contiendra des produits.
            </p>
        </div>
    </div>
</div>
