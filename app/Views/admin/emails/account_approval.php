<!DOCTYPE html>
<html lang="en">

<head>
    <title>pixels</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://fonts.googleapis.com/css?family=Objektiv+Mk1&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500&display=swap" rel="stylesheet">

    <style>
        @font-face {
            font-family: objektiv mk1;
            src: url(fonts.ttf);
        }

        * {
            font-family: 'Montserrat', sans-serif;
        }
        @import url('https://fonts.googleapis.com/css2?family=Audiowide&display=swap');
    </style>
</head>

<body style="margin: 0; padding: 0;">
    <div style="width: 600px; margin: auto; overflow: hidden; border: 1px solid #E5E5E5; background-repeat: no-repeat; background-position: 0px 91px;">
        <table width="600px" cellspacing="0" cellpadding="0" style="position: relative; border: none;">
        <tbody>
            <tr>
                <td>
                    <table width="100%">
                        <tr style="text-align: center;">
                            <td>
                                <p style="font-weight: bold; font-size: 35px;">
                                    <span style="color: blue; font-family: 'Audiowide', sans-serif;">TAMARAW</span>
                                    <span style="color: #99CC33; font-family: 'Audiowide', sans-serif;">TECHNOHUB</span>
                                </p>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td style="background: #fff; font-size: 25px; padding: 0 26px;">
                    <p style="text-align: left; font-weight: bold; color: #000;">
                        <?= $email ?> is newly registered to the system
                    </p>
                </td>
            </tr>
            <tr>
                <td style="background-color: #EEFDEB; margin-top: 10px; padding: 10px; text-align: center;">
                    <p style="font-size: 24px; font-weight: bold; color: #000;">
                        Click a button if you want to approve them
                    </p>
                    <table border="0" cellspacing="0" cellpadding="0" style="margin: 0 auto;">
                        <tr>
                            <td style="padding: 10px;">
                                <a href="<?= site_url('verify_admin/' . $approve_token) ?>" style="text-decoration: none; background-color: #9ACD32; color: #ffffff; padding: 10px 20px; border-radius: 5px; display: inline-block;">Admin</a>
                            </td>
                            <td style="padding: 10px;">
                                <a href="<?= site_url('verify_itOfficer/' . $approve_token) ?>" style="text-decoration: none; background-color: #007bff; color: #ffffff; padding: 10px 20px; border-radius: 5px; display: inline-block;">IT Officer</a>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td style="padding: 25px;">
                    <table width="100%" style="border-radius: 5px; border: 1px solid #000; padding: 13px 25px;">
                        <tr>
                            <td style="font-size: 20px; font-weight: 600;">Stalk us on our socials 👀</td>
                            <td style="text-align: right;">
                                <table width="100%;">
                                    <tr>
                                        <td style="text-align: center;"><a href="https://www.facebook.com/tamarawtechnohubinc" style="line-height: 0; display: block;"><img src="https://i.postimg.cc/HnPDpXZQ/xxx.png"></a></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
    </div>
</body>


</html>
