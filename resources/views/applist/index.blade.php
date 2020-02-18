@extends('layouts.app')

@section('content')

<div class="container">
    <table class="table">
        <thead>
            <tr>
                <th>App Name</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $emp)
                <tr>
                    <td>{{ $emp->emp_id }}</td>
                    <td>{{ $emp->first_name }}</td>
                    <td>{{ $emp->last_name }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $data->links() }}

@endsection