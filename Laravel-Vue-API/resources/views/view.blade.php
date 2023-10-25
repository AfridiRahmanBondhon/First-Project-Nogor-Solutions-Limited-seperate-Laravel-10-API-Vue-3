@extends('master')

@section('content')
    <div class="row">
        <div class="col-xl-12 mx-auto">

            <div class="card">
                <div class="card-body">

                    <div class="border p-3 rounded">

                        <h6 class="mb-0 text-uppercase">Blog Show</h6>
                        <hr/>

                        <div class="col-12">
                            <a href="{{route('add')}}" class="btn btn-primary btn-sm float-start col-md-12">Add</a>
                        </div>

                        <table id="example" class="table table-hover table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>sl</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Image</th>
                                <th>Gender</th>
                                <th>Skills</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($forms as $form)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $form->name }}</td>
                                    <td>{{ $form->email }}</td>
                                    <td><img src="{{ asset($form->image) }}" alt="" style="height: 50px;width: 50px"></td>
                                    <td>{{$form->gender}}</td>
                                    <td>{{$form->skills}}</td>
                                    <td>
                                        <a href="{{route('edit',$form->id)}}" class="btn btn-primary btn-sm float-start m-1">Edit</a>

                                        <form action="{{route('delete',$form->id)}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm float-start m-1"
                                                    onclick="return confirm('Are you DELETE this!!')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>

                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
