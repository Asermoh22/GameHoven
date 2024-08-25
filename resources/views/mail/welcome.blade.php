@extends('layout')
<link rel="stylesheet" href="{{ url('css/form.css') }}">
<h1>welcome {{Auth::user()->name}} : To GameHaven</h1>
<p style="color: rgb(0, 0, 0);"><strong>Email sent by system</strong></p>
<p style="color: brown;"><strong>You are logged in GameHaven {{ now() }}</strong></p>
