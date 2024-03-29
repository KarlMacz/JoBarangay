@extends('layouts.dashboard')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/bulma.min.css') }}">
@endsection

@section('content')
<div class="dashboard">
	<div class="dashboard-sidebar">
		@include('partials.dashboard.sidebar')
		<div class="dashboard-sidebar-bottom">
			<ul class="nav flex-column">
				<li class="nav-item">
					<a class="logout-button nav-link" href="#">Log Out</a>
				</li>
			</ul>
		</div>
	</div>
	<div class="dashboard-content">
		<div class="dashboard-content-inner">
			<div class="card">
				<div class="container" style="margin-top: 20px">
					@include('partials.flash')
					<form action="{{ route('dashboard.resume.update') }}" method="POST" enctype="multipart/form-data">
						{{ csrf_field() }}
						<input type="hidden" name="id" value="{{ Auth::user()->id }}">
						<div class="row">
							<div class="col-sm-8">
								<div class="form-group">
									<label for="name">Buong Pangalan:</label>
									<input id="name" class="form-control" type="text" value="{{ Auth::user()->full_name() }}" readonly>
								</div>

								<div class="form-group">
									<label for="mobile">Cellphone Number:</label>
									<input id="mobile" class="form-control" type="number" value="{{ Auth::user()->mobile_number }}" readonly>
								</div>

								<div class="form-group">
									<label for="birth">Kaarawan:</label>
									<input id="birth" class="form-control" type="date" value="{{ Auth::user()->birth_date }}" readonly>
								</div>

								<div class="form-group">
									<label for="add">Tirahan:</label>
									<textarea id="add" class="form-control" name="address" cols="30" rows="2" required>{{ Auth::user()->address }}</textarea>
								</div>

								<div class="form-group">
									<label for="educ">Antas ng Edukasyon:</label>
									<select class="custom-select" name="educational_attainment" id="eduklvl" required>
										<option selected value="" disabled>Mamili ng Item</option>
										<option value="Elementary"{{ (Auth::user()->educational_attainment === 'Elementary' ? ' selected' : '') }}>Elementarya</option>
										<option value="High School"{{ (Auth::user()->educational_attainment === 'High School' ? ' selected' : '') }}>Hayskul</option>
										<option value="College"{{ (Auth::user()->educational_attainment === 'College' ? ' selected' : '') }}>Kolehiyo</option>
										<option value="Others"{{ (Auth::user()->educational_attainment === 'Others' ? ' selected' : '') }}>Wala sa nabanggit</option>
									</select>
								</div>

								<div class="form-group" id="degree">
									<label for="deg">Tinapos na Kurso</label>
									<input type="text" class="form-control" name="degree" id="deg" placeholder="">
								</div>

								<div class="form-group">
									<label for="skills">Kasanayan (Skills):</label>
									<!-- <input id="skills" class="form-control" type="text" name="skills" value=""> -->
									<select class="custom-select" name="skills[]" id="skills" multiple required>
										<option selected disabled>Mamili ng Item</option>
										@if($skills->count() > 0)
											@foreach($skills as $skill)
												<option value="{{ $skill->id }}">{{ $skill->name }}</option>
											@endforeach
										@endif
									</select>
								</div>

								<!-- <div class="form-group">
									<label for="clearances">Clearances:</label>
									<div id="clearances-fields" class="mb-2">
										<input class="form-control mb-1" type="text" name="clearances[]">
									</div>
									<button type="button" id="add-clearance-button" class="btn btn-primary">Magdagdag ng Clearance</button>
								</div> -->
							</div>
							<div class="col-sm-4">
								<img id="upload-preview" class="img-thumbnail" src="{{ asset('images/avatar.png') }}" alt="Profile Picture">
								<div id="upload-file" class="file has-name is-centered is-boxed" style="margin-top: 10px; margin-bottom: 40px">
									<label class="file-label">
										<input class="file-input" type="file" name="image">
										<span class="file-cta">
											<span class="file-icon">
												<i class="fas fa-upload"></i>
											</span>
											<span class="file-label">
												Pumili ng isang file...
											</span>
										</span>
										<span class="file-name">
											Walang nai-upload na file.
										</span>
									</label>
								</div>
								<button class="btn btn-block btn-primary">Ipasa</button>
								<a class="btn btn-block btn-danger" style="color: white">Kanselahin</a>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('js/resume.js') }}"></script>
<script>
	$(document).ready(function() {
		$('body').on('change', '.file-input[name="image"]', function() {
			if($(this)[0].files && $(this)[0].files[0]) {
				var reader = new FileReader();

				reader.onload = function(e) {
					$('#upload-preview').attr('src', e.target.result);
				}

				reader.readAsDataURL($(this)[0].files[0]);
			}

			return false;
		});

		$('body').on('click', '#add-clearance-button', function() {
			$('#clearances-fields').append('<input class="form-control mb-1" type="text" name="clearances[]" value="">');

			return false;
		});
	});
</script>
@endsection
