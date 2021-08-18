@extends('layouts.master2')
@section('css')
<!-- Sidemenu-respoansive-tabs css -->
<link href="{{URL::asset('assets/plugins/sidemenu-responsive-tabs/css/sidemenu-responsive-tabs.css')}}" rel="stylesheet">
@endsection
@section('content')
		<div class="container-fluid">
			<div class="row no-gutter">
				@if (session('message'))
					<div class="alert alert-danger">{{ session('message') }}</div>
				@endif
				<!-- The content half -->
				<div class="col-md-12 col-lg-12 col-xl-12 bg-white">
					<div class="login d-flex align-items-center py-2">
						<!-- Demo content-->
						<div class="container p-0">
							<div class="row">
								<div class="col-md-12 col-lg-6 col-xl-6 mx-auto">
									<div class="card-sigin">
										<div class="mb-5 d-flex">
											<img src="{{URL::asset('assets/img/brand/favicon.png')}}" class="sign-favicon ht-40" alt="logo">
											<h1 class="main-logo1 ml-1 mr-0 my-auto tx-28">PSTIC</h1>
										</div>
										<div class="card-sigin">
											<div class="main-signup-header">
												<h2>Welcome back!</h2>
												<h5 class="font-weight-semibold mb-4">Please sign in to continue.</h5>
												
												<form method="POST" action="{{ route('login') }}">
													@csrf
													
													<div class="form-group">
														<label>Email</label>
														<input id="email" type="email"
														class="form-control @error('email') is-invalid @enderror" name="email"
														value="{{ old('email') }}" required autocomplete="email" autofocus>
														@error('email')
															<span class="invalid-feedback" role="alert">
																<strong>{{ $message }}</strong>
															</span>
														@enderror
													</div>

													<div class="form-group">
														<label>Password</label>
														<input id="password" type="password"
														class="form-control @error('password') is-invalid @enderror" name="password"
														required autocomplete="current-password">
														@error('password')
															<span class="invalid-feedback" role="alert">
																<strong>{{ $message }}</strong>
															</span>
														@enderror
													</div>

													<button class="btn btn-main-primary btn-block">Log In</button>

												</form>

											</div>
										</div>
									</div>
								</div>
							</div>
						</div><!-- End -->
					</div>
				</div><!-- End -->
			</div>
		</div>
@endsection
@section('js')
@endsection