<div class="hero min-h-screen ">
    <div class="card md:w-full w-5/6 max-w-sm shadow-2xl bg-base-100  ">
        <div class="card-body">
            @if (session('status'))
                <x-alert />
            @endif
            <form action="{{ route('login.action') }}" method="POST">
                @csrf
                <div class="form-control">
                    <label class="label">
                        <span class="label-text">Email</span>
                    </label>
                    <input type="text" placeholder="email" class="input input-bordered" name="email" />
                </div>
                <div class="form-control">
                    <label class="label">
                        <span class="label-text">Password</span>
                    </label>
                    <input type="password" placeholder="password" class="input input-bordered" name="password" />
                    <label class="label">
                        <a href="{{ route('register.form') }}" class="label-text-alt link link-hover">Does'nt have
                            account?
                            Register Here</a>
                    </label>
                </div>
                <div class="form-control mt-6">
                    <button class="btn btn-primary" type="submit">Login</button>
                </div>
            </form>
        </div>
    </div>
</div>
