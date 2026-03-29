<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>403 - Sem Permissão</title>
    <style>
        body {
            margin: 0;
            font-family: "Public Sans", sans-serif;
            background: linear-gradient(135deg, #f4f6fb 0%, #e9edf7 100%);
            color: #1f2d3d;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
        }
        .card {
            max-width: 560px;
            width: 100%;
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 18px 45px rgba(47, 64, 113, 0.12);
            padding: 28px;
        }
        .code {
            display: inline-block;
            background: #ffe9e9;
            color: #b42318;
            border-radius: 8px;
            padding: 6px 10px;
            font-weight: 700;
            margin-bottom: 14px;
        }
        h1 {
            margin: 0 0 10px;
            font-size: 1.6rem;
        }
        p {
            margin: 0 0 18px;
            color: #5a6a7c;
            line-height: 1.5;
        }
        .actions {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }
        .btn {
            text-decoration: none;
            padding: 10px 14px;
            border-radius: 8px;
            font-weight: 600;
            border: 1px solid transparent;
        }
        .btn-primary {
            background: #696cff;
            color: #fff;
        }
        .btn-outline {
            border-color: #d4dbe7;
            color: #1f2d3d;
            background: #fff;
        }
    </style>
</head>
<body>
    <div class="card">
        <span class="code">Erro 403</span>
        <h1>Você não tem permissão para acessar esta área.</h1>
        <p>Se precisar desse acesso, solicite ao administrador do sistema. Você pode voltar para o painel principal ou retornar à página anterior.</p>
        <div class="actions">
            <a href="{{ url('/') }}" class="btn btn-primary">Ir para Dashboard</a>
            <a href="{{ url()->previous() }}" class="btn btn-outline">Voltar</a>
        </div>
    </div>
</body>
</html>

