<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Fiche de depannage</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style type="text/css">
        /**
         * Google webfonts. Recommended to include the .woff version for cross-client compatibility.
         */
        @media screen {
            @font-face {
                font-family: 'Merriweather';
                font-style: normal;
                font-weight: 400;
                src: local('Merriweather'), local('Merriweather'), url(http://fonts.gstatic.com/s/merriweather/v8/ZvcMqxEwPfh2qDWBPxn6nmB7wJ9CoPCp9n30ZBThZ1I.woff) format('woff');
            }

            @font-face {
                font-family: 'Merriweather Bold';
                font-style: normal;
                font-weight: 700;
                src: local('Merriweather Bold'), local('Merriweather-Bold'), url(http://fonts.gstatic.com/s/merriweather/v8/ZvcMqxEwPfh2qDWBPxn6nhAPw1J91axKNXP_-QX9CC8.woff) format('woff');
            }
        }

        /**
         * Avoid browser level font resizing.
         * 1. Windows Mobile
         * 2. iOS / OSX
         */
        body,
        table,
        td,
        a {
            -ms-text-size-adjust: 100%; /* 1 */
            -webkit-text-size-adjust: 100%; /* 2 */
        }
        p{
            font-size: 12px;
        }
        /**
         * Remove extra space added to tables and cells in Outlook.
         */
        table,
        td {
            mso-table-rspace: 0pt;
            mso-table-lspace: 0pt;
        }

        /**
         * Better fluid images in Internet Explorer.
         */
        img {
            -ms-interpolation-mode: bicubic;
        }

        /**
         * Remove blue links for iOS devices.
         */
        a[x-apple-data-detectors] {
            font-family: inherit !important;
            font-size: inherit !important;
            font-weight: inherit !important;
            line-height: inherit !important;
            color: inherit !important;
            text-decoration: none !important;
        }

        /**
         * Fix centering issues in Android 4.4.
         */
        div[style*="margin: 16px 0;"] {
            margin: 0 !important;
        }

        body {
            width: 100% !important;
            height: 100% !important;
            padding: 0 !important;
            margin: 0 !important;
        }

        /**
         * Collapse table borders to avoid space between cells.
         */
        table {
            border-collapse: collapse !important;
        }

        a {
            color: #CC7953;
        }

        img {
            height: auto;
            line-height: 100%;
            text-decoration: none;
            border: 0;
            outline: none;
        }
    </style>

</head>
<body>

<!-- start preheader -->
<div class="preheader" style="display: none; max-width: 0; max-height: 0; overflow: hidden; font-size: 1px; line-height: 1px; color: #fff; opacity: 0;">
</div>
<!-- end preheader -->

<!-- start body -->
<table border="0" cellpadding="0" cellspacing="0" width="100%">

    <!-- start logo -->
    <tr>
        <td align="center" bgcolor="#D2C7BA">
            <!--[if (gte mso 9)|(IE)]>
            <table align="center" border="0" cellpadding="0" cellspacing="0" width="600">
                <tr>
                    <td align="center" valign="top" width="600">
            <![endif]-->
            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                <tr>
                    <td align="left" valign="top" style="padding: 36px 24px;">
                        <h3>{{env('APP_NAME')}}</h3>
                        <p>Rue des quatre vents 60</p>
                        <p>1080 Bruxelles</p>
                        <p>BTW:BE 408.636.875</p>
                        <p>www.{{env('APP_NAME')}}.com</p>
                    </td>
                    <td align="center" valign="top" style="padding: 36px 24px;">
                        <h4>Fiche de depannage N° {{$fiche->id}}</h4>
                    </td>
                </tr>
            </table>
            <!--[if (gte mso 9)|(IE)]>
            </td>
            </tr>
            </table>
            <![endif]-->
        </td>
    </tr>
    <!-- end logo -->

    <!-- start hero -->
    <tr>
        <td align="center">
            <!--[if (gte mso 9)|(IE)]>
            <table align="center" border="0" cellpadding="0" cellspacing="0" width="600">
                <tr>
                    <td align="center" valign="top" width="600">
            <![endif]-->
            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                <tr>
                    <td align="left" bgcolor="#ffffff" style="padding: 36px 24px 0; font-family: 'Merriweather Bold', serif; border-top: 1px solid #69BCB1;">
                        <h3 style="margin: 0; font-size: 25px; font-weight: 700; letter-spacing: -1px; line-height: 25px;">Client</h3>
                    </td>
                </tr>
                <tr>
                    <td style="padding: 6px 24px 0; font-family: 'Merriweather Bold', serif;">
                        <p>NOM: {{$fiche->demande->user->name}}</p>
                        <p>ADRESSE: {{$fiche->demande->user->adresse}}</p>
                        <p>TELEPHONE: {{$fiche->demande->user->phone}}</p>
                        <p>EMAIL: {{$fiche->demande->user->email}}</p>
                    </td>
                    <td align="left" valign="top" style="padding: 6px 24px;">
                        <h5>Machine</h5>
                        <p>Marque: {{$fiche->demande->machine->marque}}</p>
                        <p>Model: {{$fiche->demande->machine->modele}}</p>
                    </td>
                </tr>
            </table>
            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                <tr>
                    <td align="left" bgcolor="#ffffff" style="padding: 36px 24px 0; font-family: 'Merriweather Bold', serif; border-top: 1px solid #69BCB1;">
                        <h3 style="margin: 0; font-size: 25px; font-weight: 700; letter-spacing: -1px; line-height: 25px;">Description du probleme</h3>
                    </td>
                </tr>
                <tr>
                    <td style="padding: 36px 24px 24px 24px; font-family: 'Merriweather Bold', serif;">
                        {{$fiche->demande->description}}
                    </td>
                </tr>
            </table>
            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                <tr>
                    <td align="left" bgcolor="#ffffff" style="padding: 36px 24px 0; font-family: 'Merriweather Bold', serif; border-top: 1px solid #69BCB1;">
                        <h3 style="margin: 0; font-size: 25px; font-weight: 700; letter-spacing: -1px; line-height: 25px;">Observation du technicien</h3>
                    </td>
                </tr>
                <tr>
                    <td style="padding: 36px 24px 0; font-family: 'Merriweather Bold', serif;">
                        {{$fiche->observation}}
                    </td>
                </tr>
            </table>
            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;"  bgcolor="#ffffff">
                <tr>
                    <td align="left" bgcolor="#ffffff" style="padding: 36px 24px 0; font-family: 'Merriweather Bold', serif; border-top: 1px solid #69BCB1;">
                        <h3 style="margin: 0; font-size: 25px; font-weight: 700; letter-spacing: -1px; line-height: 25px;">Pieces a changés</h3>
                    </td>
                </tr>
                <tr>
                    <td  align="left" style="padding: 36px 24px 0; font-family: 'Merriweather Bold', serif;">
                        <table align="left" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                            <thead>
                            <tr align="left">
                                <th>#</th>
                                <th>Libelle</th>
                                <th>Quantité</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($lines as $line)
                                <tr>
                                    <td></td>
                                    <td>{{$line->piece->libelle}}</td>
                                    <td>{{$line->quantity}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </td>
                </tr>
            </table>
            <!--[if (gte mso 9)|(IE)]>
            </td>
            </tr>
            </table>
            <![endif]-->
        </td>
    </tr>
    <!-- end hero -->


</table>
<!-- end body -->

</body>
</html>
