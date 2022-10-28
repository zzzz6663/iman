@extends('main.manager')
@section('content')


    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            {{$slot}}



        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    @endsection
