@extends('bootstrap')

@section('title')
    Register Page
@endsection

@section('body')
<div class="page page-center">
    <div class="container-tight py-4">
        <div class="text-center mb-4">
            <a href="." class="navbar-brand navbar-brand-autodark"
                ><img
                    src="https://static.vecteezy.com/system/resources/previews/020/911/740/original/user-profile-icon-profile-avatar-user-icon-male-icon-face-icon-profile-icon-free-png.png"
                    height="100"
            /></a>
        </div>
        <form class="card card-md" autocomplete="off">
            <div class="card-body">
                <h2 class="card-title text-center mb-4">Buat akun baru</h2>
                <div class="mb-3">
                    <label class="form-label">Nama Lengkap</label
                    ><input
                        id="name"
                        name="name"
                        type="text"
                        class="form-control"
                        placeholder="Masukan Nama"
                        autocomplete="off"
                    />
                </div>
                <div class="mb-2">
                    <label class="form-label"
                        >Password
                        <span class="form-label-description"
                            ><a href="http://localhost:8000/forgot-password"
                                >I forgot password</a
                            ></span
                        ></label
                    >
                    <div class="input-group input-group-flat">
                        <input
                            id="password"
                            name="password"
                            type="password"
                            class="form-control"
                            placeholder="Password"
                            autocomplete="off"
                        />
                        <div class="invalid-feedback">Invalid feedback</div>
                        <span class="input-group-text"
                            ><a
                                href="#"
                                class="link-secondary"
                                title="Show password"
                                data-bs-toggle="tooltip"
                                ><svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="icon"
                                    width="24"
                                    height="24"
                                    viewBox="0 0 24 24"
                                    stroke-width="2"
                                    stroke="currentColor"
                                    fill="none"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                >
                                    <path
                                        stroke="none"
                                        d="M0 0h24v24H0z"
                                        fill="none"
                                    ></path>
                                    <circle cx="12" cy="12" r="2"></circle>
                                    <path
                                        d="M22 12c-2.667 4.667 -6 7 -10 7s-7.333 -2.333 -10 -7c2.667 -4.667 6 -7 10 -7s7.333 2.333 10 7"
                                    ></path></svg></a
                        ></span>
                    </div>
                </div>
                <div class="mb-2">
                    <label class="form-check"
                        ><input type="checkbox" class="form-check-input" /><span
                            class="form-check-label"
                            >Remember me on this device</span
                        ></label
                    >
                </div>
                <div class="form-footer">
                    <button type="submit" class="btn btn-primary w-100">
                        Sign in
                    </button>
                </div>
            </div>
            <div class="hr-text">or</div>
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <a href="/auth/google" class="btn btn-google w-100"
                            ><svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="icon"
                                width="24"
                                height="24"
                                viewBox="0 0 24 24"
                                stroke-width="2"
                                stroke="currentColor"
                                fill="none"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            >
                                <path
                                    stroke="none"
                                    d="M0 0h24v24H0z"
                                    fill="none"
                                ></path>
                                <path
                                    d="M17.788 5.108a9 9 0 1 0 3.212 6.892h-8"
                                ></path></svg
                            >Login with Google</a
                        >
                    </div>
                </div>
            </div>
        </form>
        <div class="text-center text-muted mt-3">
            Don't have account yet?
            <a tabindex="-1" href="http://localhost:8000/register">Sign up</a>
        </div>
    </div>
</div>

@endsection
