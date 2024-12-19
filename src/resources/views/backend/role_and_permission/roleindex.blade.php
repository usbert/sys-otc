@extends('backend.layouts.master')

@section('section')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Roles List</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Roles List</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">List of all roles</h3>

          <div class="card-tools">
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Guard Name</th>
                    <th scope="col">Registered at</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse ($roles as $role)
                    <tr>
                      <th scope="row">{{ $role->id }}</th>
                      <td>{{ $role->name }}</td>
                      <td>{{ $role->guard_name }}</td>
                      <td>{{ $role->created_at }}</td>
                    </tr>
                  @empty
                      
                  @endforelse
                </tbody>
              </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>

  @endsection