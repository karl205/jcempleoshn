<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Verifica tu cuenta</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body style="margin:0; padding:0; background:#f4f6f9; font-family:Arial, sans-serif;">

    <table width="100%" cellpadding="0" cellspacing="0" style="padding:40px 15px;">
        <tr>
            <td align="center">

                <table width="600" cellpadding="0" cellspacing="0"
                    style="background:#ffffff; border-radius:16px; box-shadow:0 10px 30px rgba(0,0,0,0.08); overflow:hidden;">

                    <!-- HEADER -->
                    <tr>
                        <td align="center" style="padding:35px 20px 20px 20px;">
                            <img src="https://via.placeholder.com/150x50?text=JC+Empleos" alt="JC Empleos"
                                style="display:block; margin-bottom:20px;">
                        </td>
                    </tr>

                    <!-- TITLE -->
                    <tr>
                        <td align="center" style="padding:0 30px;">
                            <h2 style="margin:0; color:#1d1f23;">Verifica tu cuenta</h2>
                        </td>
                    </tr>

                    <!-- MESSAGE -->
                    <tr>
                        <td align="center" style="padding:20px 40px;">
                            <p style="color:#555; font-size:15px; line-height:1.6; margin:0;">
                                Gracias por registrarte en <strong>JC Empleos</strong>.<br>
                                Para activar tu cuenta, haz clic en el siguiente botón:
                            </p>
                        </td>
                    </tr>

                    <!-- BUTTON -->
                    <tr>
                        <td align="center" style="padding:30px;">
                            <a href="{{ $link ?? (config('app.frontend_url') . '/verify-email?token=' . $token) }}"
                                style="background:#0a66c2;
          color:#ffffff;
          padding:14px 32px;
          text-decoration:none;
          border-radius:8px;
          font-weight:600;
          font-size:15px;
          display:inline-block;">
                                Verificar mi cuenta
                            </a>
                        </td>
                    </tr>

                    <!-- INFO -->
                    <tr>
                        <td align="center" style="padding:0 40px 25px 40px;">
                            <p style="font-size:13px; color:#888; margin:0;">
                                Este enlace expirará en 30 minutos.<br>
                                Si no solicitaste esta cuenta, puedes ignorar este mensaje.
                            </p>
                        </td>
                    </tr>

                    <!-- FOOTER -->
                    <tr>
                        <td align="center" style="background:#f8f9fb; padding:20px; font-size:12px; color:#777;">

                            © {{ date('Y') }} JC Empleos<br>
                            Conectando talento hondureño con oportunidades reales.

                            <div style="margin-top:10px;">
                                <a href="#" style="margin:0 5px; text-decoration:none;">Facebook</a> |
                                <a href="#" style="margin:0 5px; text-decoration:none;">Instagram</a>
                            </div>

                        </td>
                    </tr>

                </table>

            </td>
        </tr>
    </table>

</body>

</html>