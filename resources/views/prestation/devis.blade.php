<table style="padding: 2px; background: rgb(255,255,255);" border="0" cellpadding="0" cellspacing="0" width="100%">
    <tbody>
    <tr>
        <td>
            <table style="border: solid rgb(218,218,218); border-width: 4px 1px 1px 4px; padding: 10px; background-color: white;" border="0" cellpadding="0" cellspacing="0" width="100%">
                <tbody>
                <tr>
                    <td valign="top">
                        <table style="font-size: 18px;" border="0" cellpadding="0" cellspacing="0" width="100%">
                            <tbody>
                            <tr>
                                <td align="left" valign="top">${companyLogo}</td>
                                <td style="color: black; font-size: 12px;" align="left" valign="bottom">
                                    <span style="color: black; font-size: 16px; font-weight: bold;">${Organization.OrganizationName}</span><br>
                                    ${Organization.Street}<br>
                                    ${Organization.City}<br>
                                    ${Organization.State}<br>
                                    ${Organization.Country} ${Organization.ZipCode}
                                </td>
                                <td style="color: black; font-size: 12px;" align="right" valign="bottom">
                                    <span style="font-size: 20px; font-weight: bold;">Devis</span><br>
                                    <span style="color: black; font-size: 12px;">Valable jusqu'au : ${Quotes.ValidTill}</span><br>
                                    <span style="color: black; font-size: 12px;">Numéro de devis : ${Quotes.QuoteNumber}</span><br>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <table border="0" cellpadding="0" cellspacing="0" width="100%">
                            <tbody>
                            <tr>
                                <td style="border: solid rgb(232,232,232); border-width: 2px; padding: 10px;" valign="top" width="50%">
                                    <b style="color: rgb(0,0,0);">FACTURER À :</b><br>
                                    <b>${Quotes.AccountName}<br>${Quotes.BillingStreet}</b><br>
                                    ${Quotes.BillingCity}<br>
                                    ${Quotes.BillingState}<br>
                                    ${Quotes.BillingCountry}<br>
                                    ${Quotes.BillingCode}<br>
                                </td>
                                <td style="border: solid rgb(232,232,232); border-width: 2px; color: rgb(0,0,0);" valign="top" width="50%">
                                    <b>LIVRER À :</b><br>
                                    <b>${Quotes.ShippingStreet}</b><br>
                                    ${Quotes.ShippingCity}<br>
                                    ${Quotes.ShippingState}<br>
                                    ${Quotes.ShippingCountry}<br>
                                    ${Quotes.ShippingCode}<br>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <br><br>
                        <table style="font-family: Arial, Helvetica, sans-serif; color: rgb(0,0,0); font-size: 11px;" border="0" cellpadding="0" cellspacing="0" width="100%">
                            <tbody>
                            <tr>
                                <td style="text-align: right; background-color: rgb(242,242,242); width: 20%; border-top: gray 2px solid;">Nom du compte :</td>
                                <td style="border-bottom: rgb(234,234,234) 1px solid; width: 30%; border-top: gray 2px solid; font-weight: bold;">${Quotes.AccountName}</td>
                                <td style="text-align: right; background-color: rgb(242,242,242); width: 20%; border-top: gray 2px solid;">État du devis :</td>
                                <td style="border-bottom: rgb(234,234,234) 1px solid; width: 30%; border-top: gray 2px solid; font-weight: bold;">${Quotes.QuoteStage}</td>
                            </tr>
                            <tr>
                                <td style="text-align: right; background-color: rgb(242,242,242); width: 20%;">Nom du contact :</td>
                                <td style="border-bottom: rgb(234,234,234) 1px solid; width: 30%; font-weight: bold;">${Quotes.ContactName}</td>
                                <td style="text-align: right; background-color: rgb(242,242,242); width: 20%;"></td>
                                <td style="border-bottom: rgb(234,234,234) 1px solid; width: 30%; font-weight: bold;">${Quotes.di}</td>
                            </tr>
                            </tbody>
                        </table>
                        <br><br>
                        <table style="font-family: Arial, Helvetica, sans-serif; color: rgb(0,0,0); font-size: 11px;" border="0" cellpadding="0" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <td style="background-color: rgb(234,234,234); border-top: gray 2px solid; font-weight: bold;">Nom du produit</td>
                                <td style="background-color: rgb(234,234,234); border-top: gray 2px solid; font-weight: bold;">Code du produit</td>
                                <td style="background-color: rgb(234,234,234); border-top: gray 2px solid; font-weight: bold;">Qté</td>
                                <td style="background-color: rgb(234,234,234); border-top: gray 2px solid; font-weight: bold;" align="right">Prix unitaire</td>
                                <td style="background-color: rgb(234,234,234); border-top: gray 2px solid; font-weight: bold;" align="right">Total</td>
                            </tr>
                            </thead>
                            <tbody id="lineItem">
                            <tr>
                                <td style="border-bottom: rgb(218,218,218) 2px dotted;"><b>${Products.ProductName}</b></td>
                                <td style="border-bottom: rgb(218,218,218) 2px dotted;" valign="top">${Products.ProductCode}</td>
                                <td style="border-bottom: rgb(218,218,218) 2px dotted;" valign="top">${Quotes.Qty}</td>
                                <td style="border-bottom: rgb(218,218,218) 2px dotted;" align="right" valign="top">${Quotes.ListPrice}</td>
                                <td style="border-bottom: rgb(218,218,218) 2px dotted;" align="right" valign="top">${Quotes.Total}</td>
                            </tr>
                            </tbody>
                            <tbody>
                            <tr>
                                <td colspan="4" align="right">Sous-total</td>
                                <td align="right"><b>${Quotes.SubTotal}</b></td>
                            </tr>
                            <tr>
                                <td colspan="4" align="right">Remise<br>Taxe</td>
                                <td align="right">${Quotes.Discount}<br>${Quotes.Tax}</td>
                            </tr>
                            <tr>
                                <td colspan="4" align="right">Ajustement</td>
                                <td align="right">${Quotes.Adjustment}</td>
                            </tr>
                            <tr>
                                <td style="border-bottom: rgb(204,204,204) 2px solid;" colspan="4" align="right"><b>Total général</b></td>
                                <td style="border-bottom: rgb(204,204,204) 2px solid; border-top: rgb(218,218,218) 2px solid;" align="right"><b>${Quotes.GrandTotal}</b></td>
                            </tr>
                            </tbody>
                        </table>
                        <br><br>
                        <table border="0" cellpadding="5" cellspacing="0" width="100%">
                            <tbody>
                            <tr>
                                <td style="color: gray; border-top: gray 2px solid;"><b>Termes et conditions</b></td>
                            </tr>
                            <tr>
                                <td>${Quotes.TermsAndConditions}</td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    </tbody>
</table>
