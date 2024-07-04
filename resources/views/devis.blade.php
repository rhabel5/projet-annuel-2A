 <!DOCTYPE html>
        <html lang="fr">
        <head>
            <meta charset="utf-8">
            <title>Proforma Invoice</title>
            <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
        </head>
        <body class="font-sans bg-gray-100 p-8">
        <div class="container mx-auto bg-white shadow-md rounded-lg p-6">
            <div class="flex justify-between items-center mb-8">
                <img src="logo.png" alt="GreenMotor Shop" class="w-32">
                <div class="text-right">
                    <p class="fontm  -bold">GREENMOTORSHOP 17</p>
                    <p>117 RUE DE ROME</p>
                    <p>75017 PARIS 17</p>
                    <p>TEL : 09.86.15.92.20</p>
                    <p>E-MAIL : paris17@greenmotorshop.com</p>
                    <p>SIREN : 844036624</p>
                </div>
            </div>

            <div class="flex justify-between items-center mb-8">
                <div>
                    <p class="font-bold">SOCIETE SAID WAKIL YOUSOUF</p>
                    <p>85 RUE DANREMONT</p>
                    <p>75018 PARIS 18 - FRANCE</p>
                    <p>Tél : 0658068650</p>
                </div>
            </div>

            <table class="min-w-full bg-white border-collapse rounded-lg">
                <thead>
                <tr class="w-full bg-gray-200 text-left text-xs uppercase">
                    <th class="px-4 py-2 border">REFERENCE</th>
                    <th class="px-4 py-2 border">DESIGNATION</th>
                    <th class="px-4 py-2 border">QUANTITÉ</th>
                    <th class="px-4 py-2 border">P.U. HT</th>
                    <th class="px-4 py-2 border">P.U. TTC</th>
                    <th class="px-4 py-2 border">REM.</th>
                    <th class="px-4 py-2 border">%</th>
                    <th class="px-4 py-2 border">MONTANT TTC</th>
                    <th class="px-4 py-2 border">TVA</th>
                </tr>
                </thead>
                <tbody>
                <tr class="w-full border">
                    <td class="px-4 py-2 border">SUPERSOCOHUNTER</td>
                    <td class="px-4 py-2 border">TS STREET HUNTER</td>
                    <td class="px-4 py-2 border">1,00</td>
                    <td class="px-4 py-2 border">3 325,00</td>
                    <td class="px-4 py-2 border">3 990,00</td>
                    <td class="px-4 py-2 border">20,00</td>
                    <td class="px-4 py-2 border">20,00</td>
                    <td class="px-4 py-2 border">3 990,00</td>
                    <td class="px-4 py-2 border">0,00</td>
                </tr>
                <!-- Add other rows as needed -->
                </tbody>
            </table>

            <div class="mt-8 text-right">
                <p class="mb-2">TOTAL H.T. <span class="ml-4">3 531,55 €</span></p>
                <p class="mb-2">TVA <span class="ml-4">706,32 €</span></p>
                <p class="mb-2">TOTAL T.T.C. <span class="ml-4">4 237,87 €</span></p>
                <p class="font-bold">NET A PAYER <span class="ml-4">4 237,87 €</span></p>
            </div>
        </div>

        <div class="container mx-auto bg-white shadow-md rounded-lg p-6 mt-8">
            <div class="text-center font-bold mb-4">RELEVÉ D'IDENTITÉ BANCAIRE</div>
            <div class="text-center">
                <p>Titulaire du compte : GREENMOTORSHOP</p>
                <p>156 RUE DU FBG POISSONNIERE 75010 PARIS</p>
                <p>IBAN : FR76 3006 6108 1100 0202 4750 148</p>
                <p>BIC : CMCIFRPP</p>
                <p class="mt-4">Devis valable 1 mois</p>
                <p>Signature</p>
            </div>
        </div>
        </body>
        </html>
