<div class="container">
    <div class="row justify-content-center min-vh-100 align-items-center">
        <div class="col-md-6 col-lg-5">
            <div class="card shadow">
                <div class="card-body p-5">
                    <div class="text-center mb-4">
                        <i class="fas fa-user-circle fa-3x text-primary mb-3"></i>
                        <h3 class="fw-bold">Welcome Back</h3>
                        <p class="text-muted">Sign in to your account</p>
                    </div>

                    <form wire:submit.prevent="login">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fas fa-envelope"></i>
                                </span>
                                <input type="email" 
                                       wire:model="email"
                                       class="form-control @error('email') is-invalid @enderror" 
                                       id="email" 
                                       placeholder="Enter your email"
                                       autofocus>
                            </div>
                            @error('email')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fas fa-lock"></i>
                                </span>
                                <input type="password" 
                                       wire:model="password"
                                       class="form-control @error('password') is-invalid @enderror" 
                                       id="password" 
                                       placeholder="Enter your password">
                            </div>
                            @error('password')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 form-check">
                            <input type="checkbox" 
                                   wire:model="remember"
                                   class="form-check-input" 
                                   id="remember">
                            <label class="form-check-label" for="remember">
                                Remember me
                            </label>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="fas fa-sign-in-alt me-2"></i>Sign In
                            </button>
                        </div>
                    </form>

                    <div class="text-center mt-4">
                        <p class="text-muted">
                            Don't have an account? 
                            <a href="{{ route('register') }}" class="text-decoration-none">
                                <strong>Sign Up</strong>
                            </a>
                        </p>
                    </div>

                    <div class="text-center mt-3">
                        <p class="text-muted small">
                            Test with: <br>
                            <strong>Email:</strong> test@example.com <br>
                            <strong>Password:</strong> password
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
