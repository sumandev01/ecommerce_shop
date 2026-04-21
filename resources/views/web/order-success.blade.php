<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Success</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .page-wrap {
            max-width: 420px;
            width: 100%;
            padding: 2rem 1rem 3rem;
        }

        .logo {
            text-align: center;
            margin-bottom: 2rem;
            font-size: 1.25rem;
            font-weight: 700;
            color: #111827;
            letter-spacing: -0.5px;
        }

        .logo span {
            color: #059669;
        }

        .success-card {
            background: #fff;
            border-radius: 16px;
            padding: 2.5rem 2rem;
            text-align: center;
            box-shadow: 0 4px 24px rgba(0, 0, 0, 0.07);
            animation: slideUp 0.5s ease both;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .check-circle {
            width: 72px;
            height: 72px;
            border-radius: 50%;
            background-color: #d1fae5;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.25rem;
            animation: popIn 0.5s ease 0.3s both;
        }

        @keyframes popIn {
            from {
                opacity: 0;
                transform: scale(0.5);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        .check-icon {
            width: 36px;
            height: 36px;
            stroke: #059669;
            stroke-width: 2.5;
            stroke-linecap: round;
            stroke-linejoin: round;
            fill: none;
            stroke-dasharray: 50;
            stroke-dashoffset: 50;
            animation: drawCheck 0.5s ease 0.7s forwards;
        }

        @keyframes drawCheck {
            to {
                stroke-dashoffset: 0;
            }
        }

        .title {
            font-size: 1.35rem;
            font-weight: 600;
            color: #111827;
            margin-bottom: 0.35rem;
            animation: fadeIn 0.4s ease 0.5s both;
        }

        .subtitle {
            font-size: 0.9rem;
            color: #6b7280;
            margin-bottom: 0;
            animation: fadeIn 0.4s ease 0.6s both;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        hr {
            border-color: #f0f0f0;
            margin: 1.5rem 0;
            animation: fadeIn 0.4s ease 0.7s both;
        }

        .meta-row {
            display: flex;
            justify-content: space-between;
            font-size: 0.875rem;
            padding: 4px 0;
            animation: fadeIn 0.4s ease 0.8s both;
        }

        .meta-row .label {
            color: #6b7280;
        }

        .meta-row .value {
            font-weight: 500;
            color: #111827;
        }

        .btn-track {
            background-color: #111827;
            color: #fff;
            border: none;
            border-radius: 10px;
            padding: 12px;
            font-size: 0.95rem;
            font-weight: 500;
            width: 100%;
            transition: background 0.2s, transform 0.15s;
            animation: fadeIn 0.4s ease 1s both;
            cursor: pointer;
        }

        .btn-track:hover {
            background-color: #1f2937;
            transform: translateY(-1px);
            color: #fff;
        }

        .btn-continue {
            background-color: transparent;
            color: #111827;
            border: 1px solid #d1d5db;
            border-radius: 10px;
            padding: 11px;
            font-size: 0.95rem;
            font-weight: 500;
            width: 100%;
            transition: background 0.2s, transform 0.15s;
            animation: fadeIn 0.4s ease 1.1s both;
            cursor: pointer;
        }

        .btn-continue:hover {
            background-color: #f9fafb;
            transform: translateY(-1px);
        }
    </style>
</head>

<body>

    <div class="page-wrap">

        <!-- Logo -->
        <div class="logo">
            <a href="{{ route('root') }}" style="text-decoration: none; color: inherit;">
                Shop<span>Zone</span>
            </a>
        </div>

        <div class="success-card">

            <div class="check-circle">
                <svg viewBox="0 0 36 36" class="check-icon">
                    <path d="M7 18L14 25L29 11" />
                </svg>
            </div>

            <h2 class="title">Order Confirmed!</h2>
            <p class="subtitle">Your order has been placed successfully.</p>

            <hr>

            <div class="meta-row">
                <span class="label">Order number</span>
                <span class="value">{{ $order?->order_code }}</span>
            </div>
            {{-- <div class="meta-row mt-1">
                <span class="label">Estimated delivery</span>
                <span class="value">14-16 April</span>
            </div> --}}

            <hr>

            <div class="d-grid gap-2">
                <button onclick="window.location.href='{{ route('order-details', $order->id) }}'" class="btn-track">Order Details →</button>
                <button class="btn-continue" onclick="window.location.href='{{ route('shop') }}'">Continue shopping</button>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
