<div>
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Register</div>
                <div class="card-body">
                    <form wire:submit.prevent="registerUser">
                        <div class="mb-3">
                            <label for="name" class="form-label">Full Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" wire:model.defer="name">
                            @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
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
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Re-enter Password</label>
                            <input type="password" class="form-control" id="password_confirmation" wire:model.defer="password_confirmation">
                        </div>
                        <div class="mb-3" wire:loading.class="spinner-border text-primary d-block" wire:click="registerUser">
                            <span class="visually-hidden">Loading...</span>
                            <button type="submit" class="btn btn-primary" wire:loading.attr="hidden">Register</button>
                        </div>
                        <a href="/login" class="text-primary">Have Account?</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
