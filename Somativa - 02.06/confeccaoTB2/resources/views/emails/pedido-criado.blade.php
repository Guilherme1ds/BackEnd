<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmação de Pedido</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f5f5;
            color: #333;
            line-height: 1.6;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .header {
            background: linear-gradient(135deg, #0066cc 0%, #0052a3 100%);
            color: #ffffff;
            padding: 40px 20px;
            text-align: center;
        }
        .header h1 {
            font-size: 32px;
            margin-bottom: 10px;
            font-weight: 700;
        }
        .header p {
            font-size: 14px;
            opacity: 0.9;
        }
        .content {
            padding: 40px 20px;
        }
        .greeting {
            font-size: 18px;
            font-weight: 600;
            color: #0066cc;
            margin-bottom: 20px;
        }
        .message {
            color: #666;
            margin-bottom: 30px;
            font-size: 14px;
        }
        .order-details {
            background-color: #f9f9f9;
            border-left: 4px solid #0066cc;
            padding: 20px;
            margin-bottom: 30px;
            border-radius: 4px;
        }
        .detail-row {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid #eee;
        }
        .detail-row:last-child {
            border-bottom: none;
        }
        .detail-label {
            font-weight: 600;
            color: #0066cc;
        }
        .detail-value {
            color: #333;
            text-align: right;
        }
        .order-total {
            background: linear-gradient(135deg, #0066cc 0%, #0052a3 100%);
            color: #ffffff;
            padding: 20px;
            border-radius: 4px;
            text-align: center;
            margin-bottom: 30px;
        }
        .order-total-label {
            font-size: 12px;
            opacity: 0.9;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .order-total-value {
            font-size: 32px;
            font-weight: 700;
            margin-top: 10px;
        }
        .items-section {
            margin-bottom: 30px;
        }
        .items-section h3 {
            color: #0066cc;
            font-size: 16px;
            margin-bottom: 15px;
        }
        .items-table {
            width: 100%;
            border-collapse: collapse;
        }
        .items-table thead {
            background-color: #f0f0f0;
        }
        .items-table th {
            padding: 12px;
            text-align: left;
            font-weight: 600;
            color: #0066cc;
            font-size: 12px;
            border-bottom: 2px solid #0066cc;
        }
        .items-table td {
            padding: 12px;
            border-bottom: 1px solid #eee;
        }
        .status-badge {
            display: inline-block;
            background-color: #e3f2fd;
            color: #0066cc;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .cta-button {
            background: linear-gradient(135deg, #0066cc 0%, #0052a3 100%);
            color: #ffffff;
            padding: 14px 30px;
            text-decoration: none;
            border-radius: 4px;
            display: inline-block;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 30px;
            font-size: 12px;
        }
        .footer {
            background-color: #f5f5f5;
            border-top: 1px solid #ddd;
            padding: 20px;
            text-align: center;
            font-size: 12px;
            color: #999;
        }
        .footer-brand {
            font-weight: 600;
            color: #0066cc;
            margin-bottom: 5px;
        }
        .alert-info {
            background-color: #e3f2fd;
            border-left: 4px solid #0066cc;
            padding: 15px;
            border-radius: 4px;
            margin-bottom: 20px;
            font-size: 13px;
            color: #0066cc;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1>✨ Confecção TB</h1>
            <p>Sistema de Gestão de Pedidos</p>
        </div>

        <!-- Content -->
        <div class="content">
            <div class="greeting">Olá, {{ $pedido->cliente->nome }}! 👋</div>

            <div class="message">
                Seu pedido foi recebido com sucesso e já está sendo processado em nossa planta fabril. 
                Acompanhe os detalhes abaixo:
            </div>

            <!-- Alert Info -->
            <div class="alert-info">
                📍 Você pode acompanhar o status do seu pedido em tempo real através da nossa plataforma.
            </div>

            <!-- Order Details -->
            <div class="order-details">
                <div class="detail-row">
                    <span class="detail-label">Número do Pedido</span>
                    <span class="detail-value">#{{ str_pad($pedido->id, 5, '0', STR_PAD_LEFT) }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Data do Pedido</span>
                    <span class="detail-value">{{ $pedido->created_at->format('d/m/Y \à\s H:i') }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Cliente</span>
                    <span class="detail-value">{{ $pedido->cliente->nome }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Status Atual</span>
                    <span class="detail-value">
                        <span class="status-badge">{{ $pedido->status }}</span>
                    </span>
                </div>
            </div>

            <!-- Total -->
            <div class="order-total">
                <div class="order-total-label">Valor Total</div>
                <div class="order-total-value">R$ {{ number_format($pedido->valor_total, 2, ',', '.') }}</div>
            </div>

            <!-- Items -->
            @if($pedido->itens && count($pedido->itens) > 0)
            <div class="items-section">
                <h3>📦 Itens do Pedido</h3>
                <table class="items-table">
                    <thead>
                        <tr>
                            <th>Produto</th>
                            <th>Qtd.</th>
                            <th>Preço Unit.</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pedido->itens as $item)
                        <tr>
                            <td>{{ $item->produto->nome ?? 'N/A' }}</td>
                            <td>{{ $item->quantidade }}</td>
                            <td>R$ {{ number_format($item->preco_unitario, 2, ',', '.') }}</td>
                            <td><strong>R$ {{ number_format($item->quantidade * $item->preco_unitario, 2, ',', '.') }}</strong></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @endif

            <!-- CTA Button -->
            <center>
                <a href="{{ env('APP_URL') }}/admin/pedidos/{{ $pedido->id }}" class="cta-button">
                    Acompanhar Pedido
                </a>
            </center>

            <div class="message" style="text-align: center; font-style: italic; margin-top: 30px;">
                Qualquer dúvida, entre em contato conosco. Estamos aqui para ajudar! 💪
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <div class="footer-brand">Confecção TB - ERP de Gestão</div>
            <p>© {{ date('Y') }} Todos os direitos reservados | Sistema Automatizado de Monitoramento de Produção</p>
            <p style="margin-top: 10px; color: #bbb;">Este é um email automático. Não responda diretamente.</p>
        </div>
    </div>
</body>
</html>