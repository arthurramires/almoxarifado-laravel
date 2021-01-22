<html>
    <body>
        <p>Olá {{ $user->name }}!</p>
        <p></p>
        <p>Enviamos este e-mail pois identificamos uma solicitação para recuperação de senha.</p>
        <p>Para redefinir sua senha acesse o link abaixo.</p>
        <p></p>
        <a href={{ $url }}>Redefinir senha</a>
        <p>Atenciosamente, <br>
        <strong>Equipe Gestor Food!</strong></p>
    </body>
</html>
