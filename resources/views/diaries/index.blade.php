@extends('layout')

@section('title')
Diary 一覧
@endsection

@section('content')
	<a href="{{ route('diary.create') }}" class="btn btn-primary">新規投稿</a>
	@foreach($diaries as $diary)
	<div class="m-4 p-4 border border-primary">
		<p>{{ $diary['title'] }}</p>
		<p>{{ $diary['body']  }}</p>
		<p>{{ $diary['created_at']  }}</p>

		@if(Auth::check() && Auth::user()->id == $diary['user_id'])
		<a class="btn btn-outline-success" href="{{ route('diary.edit', ['id' => $diary['id']]) }}"><i class="fas fa-user-edit"></i></a>


		<form action="{{ route('diary.destory', ['id' => $diary['id']])}}", method="POST" class="d-inline">
			@csrf
			@method('delete')
			<button class="btn btn-danger">削除</button>
		</form>
		@endif
		{{---いいね機能まわりの表示--}}
		<div class="mt-3 ml-3">
			<form method="POST" action="{{ route('diary.like',['id'=>$diary['id']])}}">
		@csrf
				<button type="submit" class="btn btn-outline-primary">
					<i class="fas fa-thumbs-up"></i>
					<span>{{ $diary->likes->count() }}</span>
				</button>
			</form>
		</div>
	</div>
	@endforeach
@endsection