@extends('layouts.index')

@section('content')
    <livewire:shop.single-category :category="$productCategory"/>
@endsection
