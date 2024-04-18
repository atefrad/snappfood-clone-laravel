@extends('layouts.main')

@section('content')
<div class="col-md-7 offset-md-2 col-lg-6 offset-lg-3 py-8 text-md-start text-center">
    <div class="card w-xxl-75">
        <div class="card-body">
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                    <h3 class="mb-4 text-center">ورود</h3>
                    <form class="row gx-2 gy-2 align-items-center">
                        <div class="input-group-icon mb-2">
                            <label class="visually-hidden" for="email">Email</label>
                            <input class="form-control input-box form-foodwagon-control" name="email" id="email" type="email" placeholder="ایمیل" />
                        </div>
                        <div class="input-group-icon mb-2">
                            <label class="visually-hidden" for="password">Password</label>
                            <input class="form-control input-box form-foodwagon-control" name="password" id="password" type="password" placeholder="کلمه ی عبور" />
                        </div>
                        <div class="d-grid gap-3 w-25 mx-auto">
                            <button class="btn btn-danger text-center" type="submit">ورود</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
