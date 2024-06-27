<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Créer un Devis</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css">
</head>
<body>
<div class="container mx-auto mt-10">
    <h2 class="text-2xl font-bold text-center mb-6">Créer un Devis</h2>
    <form method="POST" action="/path/to/your/backend">
        <!-- Informations de l'entreprise -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            <div>
                <label for="companyLogo" class="block text-gray-700">Logo de l'entreprise</label>
                <input type="file" id="companyLogo" name="companyLogo" class="mt-1 block w-full">
            </div>
            <div>
                <label for="organizationName" class="block text-gray-700">Nom de l'organisation</label>
                <input type="text" id="organizationName" name="organizationName" class="mt-1 block w-full px-3 py-2 border rounded-md" required>
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            <div>
                <label for="organizationStreet" class="block text-gray-700">Rue de l'organisation</label>
                <input type="text" id="organizationStreet" name="organizationStreet" class="mt-1 block w-full px-3 py-2 border rounded-md" required>
            </div>
            <div>
                <label for="organizationCity" class="block text-gray-700">Ville de l'organisation</label>
                <input type="text" id="organizationCity" name="organizationCity" class="mt-1 block w-full px-3 py-2 border rounded-md" required>
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            <div>
                <label for="organizationState" class="block text-gray-700">État de l'organisation</label>
                <input type="text" id="organizationState" name="organizationState" class="mt-1 block w-full px-3 py-2 border rounded-md" required>
            </div>
            <div>
                <label for="organizationCountry" class="block text-gray-700">Pays de l'organisation</label>
                <input type="text" id="organizationCountry" name="organizationCountry" class="mt-1 block w-full px-3 py-2 border rounded-md" required>
            </div>
        </div>
        <div class="mb-4">
            <label for="organizationZipCode" class="block text-gray-700">Code postal de l'organisation</label>
            <input type="text" id="organizationZipCode" name="organizationZipCode" class="mt-1 block w-full px-3 py-2 border rounded-md" required>
        </div>

        <!-- Informations du devis -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            <div>
                <label for="quoteValidTill" class="block text-gray-700">Valable jusqu'au</label>
                <input type="date" id="quoteValidTill" name="quoteValidTill" class="mt-1 block w-full px-3 py-2 border rounded-md" required>
            </div>
            <div>
                <label for="quoteNumber" class="block text-gray-700">Numéro de devis</label>
                <input type="text" id="quoteNumber" name="quoteNumber" class="mt-1 block w-full px-3 py-2 border rounded-md" required>
            </div>
        </div>

        <!-- Informations de facturation et de livraison -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            <div>
                <label for="accountName" class="block text-gray-700">Nom du compte</label>
                <input type="text" id="accountName" name="accountName" class="mt-1 block w-full px-3 py-2 border rounded-md" required>
            </div>
            <div>
                <label for="billingStreet" class="block text-gray-700">Adresse de facturation</label>
                <input type="text" id="billingStreet" name="billingStreet" class="mt-1 block w-full px-3 py-2 border rounded-md" required>
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            <div>
                <label for="billingCity" class="block text-gray-700">Ville de facturation</label>
                <input type="text" id="billingCity" name="billingCity" class="mt-1 block w-full px-3 py-2 border rounded-md" required>
            </div>
            <div>
                <label for="billingState" class="block text-gray-700">État de facturation</label>
                <input type="text" id="billingState" name="billingState" class="mt-1 block w-full px-3 py-2 border rounded-md" required>
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            <div>
                <label for="billingCountry" class="block text-gray-700">Pays de facturation</label>
                <input type="text" id="billingCountry" name="billingCountry" class="mt-1 block w-full px-3 py-2 border rounded-md" required>
            </div>
            <div>
                <label for="billingCode" class="block text-gray-700">Code postal de facturation</label>
                <input type="text" id="billingCode" name="billingCode" class="mt-1 block w-full px-3 py-2 border rounded-md" required>
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            <div>
                <label for="shippingStreet" class="block text-gray-700">Adresse de livraison</label>
                <input type="text" id="shippingStreet" name="shippingStreet" class="mt-1 block w-full px-3 py-2 border rounded-md" required>
            </div>
            <div>
                <label for="shippingCity" class="block text-gray-700">Ville de livraison</label>
                <input type="text" id="shippingCity" name="shippingCity" class="mt-1 block w-full px-3 py-2 border rounded-md" required>
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            <div>
                <label for="shippingState" class="block text-gray-700">État de livraison</label>
                <input type="text" id="shippingState" name="shippingState" class="mt-1 block w-full px-3 py-2 border rounded-md" required>
            </div>
            <div>
                <label for="shippingCountry" class="block text-gray-700">Pays de livraison</label>
                <input type="text" id="shippingCountry" name="shippingCountry" class="mt-1 block w-full px-3 py-2 border rounded-md" required>
            </div>
        </div>
        <div class="mb-4">
            <label for="shippingCode" class="block text-gray-700">Code postal de livraison</label>
            <input type="text" id="shippingCode" name="shippingCode" class="mt-1 block w-full px-3 py-2 border rounded-md" required>
        </div>

        <!-- Informations des produits/services -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
            <div>
                <label for="productName" class="block text-gray-700">Nom du produit</label>
                <input type="text" id="productName" name="productName" class="mt-1 block w-full px-3 py-2 border rounded-md" required>
            </div>
            <div>
                <label for="productCode" class="block text-gray-700">Code du produit</label>
                <input type="text" id="productCode" name="productCode" class="mt-1 block w-full px-3 py-2 border rounded-md" required>
            </div>
            <div>
                <label for="quantity" class="block text-gray-700">Quantité</label>
                <input type="number" id="quantity" name="quantity" class="mt-1 block w-full px-3 py-2 border rounded-md" required>
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            <div>
                <label for="unitPrice" class="block text-gray-700">Prix unitaire</label>
                <input type="number" step="0.01" id="unitPrice" name="unitPrice" class="mt-1 block w-full px-3 py-2 border rounded-md" required>
            </div>
            <div>
                <label for="totalPrice" class="block text-gray-700">Prix total</label>
                <input type="number" step="0.01" id="totalPrice" name="totalPrice" class="mt-1 block w-full px-3 py-2 border rounded-md" required>
            </div>
        </div>

        <!-- Sous-total, Remise, Taxes, Ajustement, Total général -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            <div>
                <label for="subTotal" class="block text-gray-700">Sous-total</label>
                <input type="number" step="0.01" id="subTotal" name="subTotal" class="mt-1 block w-full px-3 py-2 border rounded-md" required>
            </div>
            <div>
                <label for="discount" class="block text-gray-700">Remise</label>
                <input type="number" step="0.01" id="discount" name="discount" class="mt-1 block w-full px-3 py-2 border rounded-md">
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            <div>
                <label for="tax" class="block text-gray-700">Taxe</label>
                <input type="number" step="0.01" id="tax" name="tax" class="mt-1 block w-full px-3 py-2 border rounded-md" required>
            </div>
            <div>
                <label for="adjustment" class="block text-gray-700">Ajustement</label>
                <input type="number" step="0.01" id="adjustment" name="adjustment" class="mt-1 block w-full px-3 py-2 border rounded-md">
            </div>
        </div>
        <div class="mb-4">
            <label for="grandTotal" class="block text-gray-700">Total général</label>
            <input type="number" step="0.01" id="grandTotal" name="grandTotal" class="mt-1 block w-full px-3 py-2 border rounded-md" required>
        </div>

        <!-- Termes et conditions -->
        <div class="mb-4">
            <label for="termsAndConditions" class="block text-gray-700">Termes et conditions</label>
            <textarea id="termsAndConditions" name="termsAndConditions" class="mt-1 block w-full px-3 py-2 border rounded-md" rows="4" required></textarea>
        </div>

        <!-- Bouton de soumission -->
        <div class="mb-4">
            <button type="submit" class="w-full px-4 py-2 bg-indigo-600 text-white rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring focus:ring-indigo-200 dark:focus:ring-indigo-800">Créer le Devis</button>
        </div>
    </form>
</div>
</body>
</html>
