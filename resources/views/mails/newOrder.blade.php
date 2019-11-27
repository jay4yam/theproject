<!DOCTYPE html>
<html lang="{{ App::getLocale() }}" xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
<head>
    <meta charset="utf-8"> <!-- utf-8 works for most cases -->
    <meta name="viewport" content="width=device-width"> <!-- Forcing initial-scale shouldn't be necessary -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> <!-- Use the latest (edge) version of IE rendering engine -->
    <meta name="x-apple-disable-message-reformatting">  <!-- Disable auto-scale in iOS 10 Mail entirely -->
    <title>EasyCopter: Récapitulatif de votre commande</title> <!-- The title tag shows in email notifications, like Android 4.4. -->

    <!-- Web Font / @font-face : BEGIN -->
    <!-- NOTE: If web fonts are not required, lines 10 - 27 can be safely removed. -->

    <!-- Desktop Outlook chokes on web font references and defaults to Times New Roman, so we force a safe fallback font. -->
    <!--[if mso]>
    <style>
        * {
            font-family: sans-serif !important;
        }
    </style>
    <![endif]-->

    <!-- All other clients get the webfont reference; some will render the font and others will silently fail to the fallbacks. More on that here: http://stylecampaign.com/blog/2015/02/webfont-support-in-email/ -->
    <!--[if !mso]><!-->
    <!-- insert web font reference, eg: <link href='https://fonts.googleapis.com/css?family=Roboto:400,700' rel='stylesheet' type='text/css'> -->
    <!--<![endif]-->

    <!-- Web Font / @font-face : END -->

    <!-- CSS Reset : BEGIN -->
    <style>

        /* What it does: Remove spaces around the email design added by some email clients. */
        /* Beware: It can remove the padding / margin and add a background color to the compose a reply window. */
        html,
        body {
            margin: 0 auto !important;
            padding: 0 !important;
            height: 100% !important;
            width: 100% !important;
        }

        /* What it does: Stops email clients resizing small text. */
        * {
            -ms-text-size-adjust: 100%;
            -webkit-text-size-adjust: 100%;
        }

        /* What it does: Centers email on Android 4.4 */
        div[style*="margin: 16px 0"] {
            margin: 0 !important;
        }

        /* What it does: Stops Outlook from adding extra spacing to tables. */
        table,
        td {
            mso-table-lspace: 0pt !important;
            mso-table-rspace: 0pt !important;
        }

        /* What it does: Fixes webkit padding issue. */
        table {
            border-spacing: 0 !important;
            border-collapse: collapse !important;
            table-layout: fixed !important;
            margin: 0 auto !important;
        }

        /* What it does: Prevents Windows 10 Mail from underlining links despite inline CSS. Styles for underlined links should be inline. */
        a {
            text-decoration: none;
        }

        /* What it does: Uses a better rendering method when resizing images in IE. */
        img {
            -ms-interpolation-mode:bicubic;
        }

        /* What it does: A work-around for email clients meddling in triggered links. */
        *[x-apple-data-detectors],  /* iOS */
        .unstyle-auto-detected-links *,
        .aBn {
            border-bottom: 0 !important;
            cursor: default !important;
            color: inherit !important;
            text-decoration: none !important;
            font-size: inherit !important;
            font-family: inherit !important;
            font-weight: inherit !important;
            line-height: inherit !important;
        }

        /* What it does: Prevents Gmail from changing the text color in conversation threads. */
        .im {
            color: inherit !important;
        }

        /* What it does: Prevents Gmail from displaying a download button on large, non-linked images. */
        .a6S {
            display: none !important;
            opacity: 0.01 !important;
        }
        /* If the above doesn't work, add a .g-img class to any image in question. */
        img.g-img + div {
            display: none !important;
        }

        /* What it does: Removes right gutter in Gmail iOS app: https://github.com/TedGoas/Cerberus/issues/89  */
        /* Create one of these media queries for each additional viewport size you'd like to fix */

        /* iPhone 4, 4S, 5, 5S, 5C, and 5SE */
        @media only screen and (min-device-width: 320px) and (max-device-width: 374px) {
            u ~ div .email-container {
                min-width: 320px !important;
            }
        }
        /* iPhone 6, 6S, 7, 8, and X */
        @media only screen and (min-device-width: 375px) and (max-device-width: 413px) {
            u ~ div .email-container {
                min-width: 375px !important;
            }
        }
        /* iPhone 6+, 7+, and 8+ */
        @media only screen and (min-device-width: 414px) {
            u ~ div .email-container {
                min-width: 414px !important;
            }
        }

    </style>

    <!-- What it does: Makes background images in 72ppi Outlook render at correct size. -->
    <!--[if gte mso 9]>
    <xml>
        <o:OfficeDocumentSettings>
            <o:AllowPNG/>
            <o:PixelsPerInch>96</o:PixelsPerInch>
        </o:OfficeDocumentSettings>
    </xml>
    <![endif]-->

    <!-- CSS Reset : END -->

    <!-- Progressive Enhancements : BEGIN -->
    <style>

        /* What it does: Hover styles for buttons */
        .button-td,
        .button-a {
            transition: all 100ms ease-in;
        }
        .button-td-primary:hover,
        .button-a-primary:hover {
            background: #555555 !important;
            border-color: #555555 !important;
        }

        /* Media Queries */
        @media screen and (max-width: 600px) {

            .email-container {
                width: 100% !important;
                margin: auto !important;
            }

            /* What it does: Forces elements to resize to the full width of their container. Useful for resizing images beyond their max-width. */
            .fluid {
                max-width: 100% !important;
                height: auto !important;
                margin-left: auto !important;
                margin-right: auto !important;
            }

            /* What it does: Forces table cells into full-width rows. */
            .stack-column,
            .stack-column-center {
                display: block !important;
                width: 100% !important;
                max-width: 100% !important;
                direction: ltr !important;
            }
            /* And center justify these ones. */
            .stack-column-center {
                text-align: center !important;
            }

            /* What it does: Generic utility class for centering. Useful for images, buttons, and nested tables. */
            .center-on-narrow {
                text-align: center !important;
                display: block !important;
                margin-left: auto !important;
                margin-right: auto !important;
                float: none !important;
            }
            table.center-on-narrow {
                display: inline-block !important;
            }

            /* What it does: Adjust typography on small screens to improve readability */
            .email-container p {
                font-size: 17px !important;
            }
        }

    </style>
    <!-- Progressive Enhancements : END -->

</head>
<!--
	The email background color (#222222) is defined in three places:
	1. body tag: for most email clients
	2. center tag: for Gmail and Inbox mobile apps and web versions of Gmail, GSuite, Inbox, Yahoo, AOL, Libero, Comcast, freenet, Mail.ru, Orange.fr
	3. mso conditional: For Windows 10 Mail
-->
<body width="100%" style="margin: 0; padding: 0 !important; mso-line-height-rule: exactly; background-color: #FFFFFF;">
<center style="width: 100%; background-color: #FFFFFF;">
    <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%" style="background-color: #FFFFFF;">
        <tbody>
        <tr>
            <td style="padding: 20px 0; text-align: center">
                <img src="{{ asset('images/new-logo-hell-black.png') }}" width="150" alt="logo easyCopter" style="height: auto; background: #ffffff; font-family: sans-serif; font-size: 15px; line-height: 15px; color: #FFFFFF;">
            </td>
        </tr>
        <tr style="padding: 20px 0; text-align: center">
            <td>
                <h1>Merci pour votre commande</h1>
            </td>
        </tr>
        </tbody>
    </table>
    <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="50%" style="background-color: #FFFFFF;">
        <tbody>
        <tr style="text-align: center">
            <td><h3>Vos Informations</h3></td>
        </tr>
        <tr>
            <td>
                <table>
                    <tr>
                        <td>Prénom : </td>
                        <td>{{ ucfirst($mainOrder->user->profile->firstName) }}</td>
                    </tr>
                    <tr>
                        <td>Nom :</td>
                        <td>{{ ucfirst($mainOrder->user->profile->fullName) }}</td>
                    </tr>
                    <tr>
                        <td>Adresse :</td>
                        <td>{{ ucfirst($mainOrder->user->profile->address) }}</td>
                    </tr>
                    <tr>
                        <td>Code Postal :</td>
                        <td>{{ ucfirst($mainOrder->user->profile->postalCode) }}</td>
                    </tr>
                    <tr>
                        <td>Ville :</td>
                        <td>{{ ucfirst($mainOrder->user->profile->city) }}</td>
                    </tr>
                </table>
            </td>
        </tr>
        </tbody>
    </table>
    <br><br>
    <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="50%" style="background-color: #FFFFFF;">
        <tbody>
            <tr>
                <td>
                    <table style="border: 1px solid black">
                        <thead style="background-color: #1a1a1a; color: white ">
                        <tr>
                            <th></th>
                            <th>Nom du voyage & Date de départ</th>
                            <th>Nombre de Voyageur(s)</th>
                            <th>Prix Unitaire</th>
                            <th>Prix Total</th>
                        </tr>
                        </thead>
                        <tbody>

                            @foreach($mainOrder->itemsOrder as $item)
                                <tr style="text-align: center; border: 1px solid black">
                                    <td style="border: 1px solid black">
                                        <img alt="{{ $item->voyage->title }}" src="/storage/voyages/thumbnails/{{ $item->voyage->main_photo }}" width="50">
                                    </td>
                                    <td style="border: 1px solid black">
                                        {{ $item->voyage->title }}<br>
                                        le {{ date( "d M Y", strtotime( $item->date_voyage ) ) }}
                                    </td>
                                    <td style="border: 1px solid black">{{ $item->num_of_passenger }}</td>
                                    <td style="border: 1px solid black">{{ $item->prix_unitaire }} €</td>
                                    <td style="border: 1px solid black">{{ $item->prix_final }} €</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
</center>
</body>
</html>