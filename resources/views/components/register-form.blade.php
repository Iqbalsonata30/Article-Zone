<div class="hero min-h-screen ">
    <div class="card md:w-full w-5/6 max-w-md shadow-2xl bg-base-100  ">

        <div class="card-body">
            <form action="{{ route('register.action') }}" method="POST">
                @csrf
                <div class="form-control">
                    <label class="label">
                        <span class="label-text">Name</span>
                    </label>
                    <input type="text" placeholder="name" class="input input-bordered" name="name"
                        value="{{ old('name') }}" />
                    @error('name')
                        <small class="text-red-600 ml-1">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-control">
                    <label class="label">
                        <span class="label-text">Email</span>
                    </label>
                    <input type="email" placeholder="email" class="input input-bordered" name="email"
                        value="{{ old('email') }}" />
                    @error('email')
                        <small class="text-red-600 ml-1">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-control">
                    <label class="label">
                        <span class="label-text">Password</span>
                    </label>
                    <input type="password" placeholder="password" class="input input-bordered" name="password" />
                    @error('password')
                        <small class="text-red-600 ml-1">{{ $message }}</small>
                    @enderror
                    <label class="label">
                        <a href="{{ route('login.form') }}" class="label-text-alt link link-hover">Already have account?
                            Login Here</a>
                    </label>
                </div>
                <div class="form-control mt-6">
                    <button class="btn btn-primary" type="submit">Register</button>
                </div>
            </form>
        </div>
    </div>
</div>
