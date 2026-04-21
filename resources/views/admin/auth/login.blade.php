<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Login - Lifestyle Theme</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@300;400;500;600;700&display=swap" rel="stylesheet" />

    <style>
        :root {
            /* Light Theme Color Palette */
            --bg-body: #f8f9fa;
            --bg-card: #ffffff;
            --bg-input: #ffffff;
            --primary-accent: #ffb800;
            --primary-hover: #e6a600;
            --text-dark: #212529;
            --text-muted: #6c757d;
            --text-label: #495057;
            --border-color: #e9ecef;
            --border-focus: #ffb800;
            --danger: #ef4444;
            --success: #34d399;
        }

        body {
            margin: 0;
            min-height: 100vh;
            background-color: var(--bg-body);
            font-family: 'Sora', sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }

        /* Subtle Background Dots */
        body::before {
            content: '';
            position: absolute;
            inset: 0;
            background-image: radial-gradient(var(--primary-accent) 0.5px, transparent 0.5px);
            background-size: 30px 30px;
            opacity: 0.1;
            z-index: 0;
        }

        .login-wrapper {
            position: relative;
            z-index: 10;
            width: 100%;
            padding: 1.5rem;
        }

        .card-login {
            background: var(--bg-card);
            border: none;
            border-radius: 16px;
            padding: 3rem 2.5rem;
            max-width: 450px;
            margin: 0 auto;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.05);
        }

        .admin-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(255, 184, 0, 0.1);
            color: #b38100;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            padding: 6px 16px;
            border-radius: 100px;
            margin-bottom: 1.5rem;
        }

        .card-title {
            color: var(--text-dark);
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .card-subtitle {
            color: var(--text-muted);
            font-size: 0.95rem;
        }

        .form-label {
            color: var(--text-label);
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .input-group-custom {
            position: relative;
            margin-bottom: 1.25rem;
        }

        .input-icon {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-muted);
            z-index: 2;
        }

        .form-control-custom {
            width: 100%;
            background: var(--bg-input);
            border: 2px solid var(--border-color);
            border-radius: 10px;
            color: var(--text-dark);
            height: 52px;
            padding: 0 45px 0 48px;
            transition: all 0.3s;
            outline: none;
        }

        .form-control-custom:focus {
            border-color: var(--border-focus);
            box-shadow: 0 0 0 4px rgba(255, 184, 0, 0.1);
        }

        .toggle-pw {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: var(--text-muted);
            cursor: pointer;
            z-index: 2;
        }

        .btn-login {
            width: 100%;
            height: 52px;
            background: var(--primary-accent);
            border: none;
            border-radius: 10px;
            color: #fff;
            font-weight: 700;
            font-size: 16px;
            box-shadow: 0 8px 15px rgba(255, 184, 0, 0.2);
            margin-top: 1rem;
            transition: all 0.3s;
            cursor: pointer;
        }

        .btn-login:hover {
            background: var(--primary-hover);
            transform: translateY(-1px);
        }

        .btn-login:disabled {
            opacity: 0.7;
            cursor: not-allowed;
        }

        .spinner-sm {
            width: 18px;
            height: 18px;
            border: 3px solid rgba(255, 255, 255, 0.3);
            border-top-color: #fff;
            border-radius: 50%;
            animation: spin 0.7s linear infinite;
            display: none;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        .alert-custom {
            background: rgba(239, 68, 68, 0.08);
            border: 1px solid rgba(239, 68, 68, 0.2);
            border-radius: 10px;
            color: var(--danger);
            font-size: 13px;
            padding: 10px 14px;
            display: none;
            margin-bottom: 1rem;
            align-items: center;
            gap: 8px;
        }

        .divider {
            display: flex;
            align-items: center;
            gap: 12px;
            margin: 1.4rem 0;
        }

        .divider-line {
            flex: 1;
            height: 1px;
            background: var(--primary-accent);
        }

        .twofa-btn {
            width: 100%;
            height: 44px;
            background: transparent;
            border: 1px solid var(--border-color);
            border-radius: 10px;
            color: var(--text-label);
            font-size: 13px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: all 0.2s;
        }

        .twofa-btn:hover {
            border-color: rgba(167, 139, 250, 0.4);
            color: var(--accent-2);
            background: rgb(255, 184, 0, 0.5);
        }

        .login-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: 2rem;
            padding-top: 1.25rem;
            border-top: 1px solid var(--primary-accent);
        }

        .status-dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: var(--success);
            box-shadow: 0 0 6px var(--success);
            display: inline-block;
            margin-right: 6px;
        }

        .status-dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: var(--primary-accent);
            box-shadow: 0 0 6px var(--success);
            display: inline-block;
            margin-right: 6px;
        }

        .footer-status,
        .footer-version {
            color: var(--text-muted);
            font-size: 11px;
        }
    </style>
</head>

<body>

    <div class="login-wrapper">
        <div class="card-login">
            <div class="admin-badge">
                <i class="bi bi-person-badge"></i> Admin Portal
            </div>

            <div class="mb-4">
                <h1 class="card-title">Welcome back</h1>
                <p class="card-subtitle">Please enter your admin credentials</p>
                @if (session('error'))
                    <span class="text-danger mt-4 d-block">{{ session('error') }}</span>
                @endif
            </div>

            <div class="alert-custom" id="errorAlert">
                <i class="bi bi-exclamation-circle-fill"></i>
                <span id="errorMsg">Invalid credentials. Please try again.</span>
            </div>

            <form action="{{ route('admin.postLogin') }}" method="post" id="loginForm">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Email Address</label>
                    <div class="input-group-custom">
                        <i class="bi bi-envelope input-icon"></i>
                        <input type="email" id="email" name="email" class="form-control-custom"
                            placeholder="admin@email.com" required />
                    </div>
                    @error('email')
                        <span class="text-danger mb-2">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <div class="input-group-custom">
                        <i class="bi bi-lock input-icon"></i>
                        <input type="password" id="password" name="password" class="form-control-custom"
                            placeholder="••••••••" required />
                        <button type="button" class="toggle-pw" id="togglePw">
                            <i class="bi bi-eye" id="eyeIcon"></i>
                        </button>
                    </div>
                    @error('password')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="d-flex align-items-center justify-content-between mb-3">
                    <div class="form-check">
                        <input class="form-check-input" name="remember" type="checkbox" id="remember" />
                        <label class="form-check-label" for="remember">Keep me signed in</label>
                    </div>
                    <a href="#" class="forgot-link">Forgot password?</a>
                </div>

                <button type="submit" class="btn-login" id="loginBtn">
                    <div style="display: flex; align-items: center; justify-content: center; gap: 10px;">
                        <div class="spinner-sm" id="spinner"></div>
                        <span id="btnText">Sign In to Dashboard</span>
                    </div>
                </button>
            </form>
            <div class="divider">
                <div class="divider-line"></div>
                <span>or use alternative method</span>
                <div class="divider-line"></div>
            </div>

            <button class="twofa-btn" type="button">
                <i class="bi bi-shield-check"></i>
                Sign in with Two-Factor Authentication
            </button>

            <div class="login-footer">
                <div class="footer-status">
                    <span class="status-dot"></span> All systems operational
                </div>
                <div class="footer-version">v2.4.1</div>
            </div>
        </div>
    </div>

    <script>
        const togglePw = document.getElementById('togglePw');
        const pwInput = document.getElementById('password');
        const eyeIcon = document.getElementById('eyeIcon');

        togglePw.addEventListener('click', () => {
            const isHidden = pwInput.type === 'password';
            pwInput.type = isHidden ? 'text' : 'password';
            eyeIcon.className = isHidden ? 'bi bi-eye-slash' : 'bi bi-eye';
        });

        const form = document.getElementById('loginForm');
        const loginBtn = document.getElementById('loginBtn');
        const spinner = document.getElementById('spinner');
        const btnText = document.getElementById('btnText');
        const errorAlert = document.getElementById('errorAlert');

        form.addEventListener('submit', (e) => {
            e.preventDefault();
            const email = document.getElementById('email').value.trim();
            const pass = document.getElementById('password').value;

            errorAlert.style.display = 'none';

            if (!email || !pass) {
                errorAlert.style.display = 'flex';
                document.getElementById('errorMsg').textContent = 'Please fill in all fields.';
                return;
            }

            loginBtn.disabled = true;
            spinner.style.display = 'block';
            btnText.textContent = 'Authenticating...';

            setTimeout(() => {
                spinner.style.display = 'none';
                loginBtn.disabled = false;
                btnText.textContent = 'Sign In to Dashboard';

                if (email && pass.length >= 4) {
                    form.submit();
                } else {
                    errorAlert.style.display = 'flex';
                    document.getElementById('errorMsg').textContent =
                        'Invalid credentials. Please try again.';
                }
            }, 1500);
        });
    </script>
</body>

</html>
