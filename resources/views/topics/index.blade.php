@extends('layouts.app')

@section('content')
<div class="container">
  <div class="col-md-10 offset-md-1">
    <div class="card ">
      <div class="card-header">
        <ul class="nav nav-pills">
          <li class="nav-item"><a class="nav-link active" href="#">最后回复</a></li>
          <li class="nav-item"><a class="nav-link" href="#">最新发布</a></li>
        </ul>
      </div>

      <div class="card-body">
        {{--话题列表--}}
        @include('topics._topic_list',['topics' => $topics])
        {{--分页--}}
        <div class="mt-5">
          {!! $topics->appends(Request::except('page'))->render() !!}
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-10 offset-md-1">
    @include('topics._sidebar')
  </div>
</div>

@endsection
