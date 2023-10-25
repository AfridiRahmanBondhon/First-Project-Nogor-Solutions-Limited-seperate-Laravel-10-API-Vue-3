@extends('master')

@section('content')
    <div class="row">
        <div class="col-xl-8 mx-auto">

            <div class="card">
                <div class="card-body">
                    <div class="border p-3 rounded">
                        <h6 class="mb-0 text-uppercase">Blog Form</h6>
                        <hr/>
                        <form action="{{ route('store') }}" method="post" enctype="multipart/form-data" class="row g-3">
                            @csrf
                            <div class="col-12">
                                <label class="form-label">Name</label>
                                <input type="text" name="name" class="form-control">
                                @error('name')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-12">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control">
                                @error('email')
                                <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>
                            <div class="col-12">
                                <label class="form-label">Image</label>
                                <input type="file" name="image" class="form-control" accept="image/*">
                                @error('image')
                                <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>
                            <div class="col-12">
                                <label class="form-label">Gender</label>
                                @error('gender')
                                <p class="text-danger">{{$message}}</p>
                                @enderror
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="gender[]" value="male" id="flexRadioDefault[]1">
                                    <label class="form-check-label">
                                        Male
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="gender[]" value="female" id="flexRadioDefault[]2">
                                    <label class="form-check-label" for="flexRadioDefault[]2">
                                        Female
                                    </label>
                                </div>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Skills</label>
                                @error('skills')
                                <p class="text-danger">{{$message}}</p>
                                @enderror
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="laravel" name="skills[]" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Laravel
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="ajax" name="skills[]" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Ajax
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="mysql" name="skills[]" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        MySQL
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="codeigniter" name="skills[]" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Codeigniter
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="vue js" name="skills[]" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        VUE JS
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="api" name="skills[]" id="flexCheckChecked">
                                    <label class="form-check-label" for="flexCheckChecked">
                                        API
                                    </label>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary">SUBMIT</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
