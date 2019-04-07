@extends('adminlte::page')

@section('title', Config::get('adminlte.title'))

@section('js')
	<script src="{{ asset('js/todolist.js') }}"></script>
@endsection

@section('content')
	<div id="TodoList">
		<TodoList name="TodoList" :todos='{{ json_encode($todos) }}'></TodoList>
	</div>
@endsection
