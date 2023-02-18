<div>
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Login</div>
                <div class="card-body">
                    <form wire:submit.prevent="loginUser">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" wire:model.defer="email">
                            @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" wire:model.defer="password">
                            @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="remember" wire:model.defer="remember">
                            <label class="form-check-label" for="remember">Remember me</label>
                        </div>
                        <div class="mb-3" wire:loading.class="spinner-border text-primary d-block" wire:click="loginUser">
                            <span class="visually-hidden">Loading...</span>
                            <button type="submit" class="btn btn-primary" wire:loading.attr="hidden">Login</button>
                        </div>
                        <a href="/register" class="d-block text-primary">Register Account</a>
                        <a href="{{ route('password.request') }}" class="text-primary">Forgot Password</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
