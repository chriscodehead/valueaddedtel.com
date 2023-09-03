<?php
$title = 'Data Plans';
?>

@extends('layout')
@section('contents')
    <div class="container-xl wide-lg">
        <div class="nk-content-body">
            <div class="nk-block-head">
                <div class="nk-block-between-md g-4">
                    <div class="nk-block-head-content">
                        <h2 class="nk-block-title fw-normal">Data Plans</h2>
                    </div>
                </div>
            </div>
            <div class="nk-block ">
                <!-- <div class="card border"> -->
                    <!-- <div class="card-body"> -->
                        <div class="row g-5">
                            @forelse ($plans as $plan)
                            <div class="col-md-6">
                                <div class="border p-4">
                                    <form method="post" action="{{route('admin.dataplans.update', ['dataPrincing' => $plan->id])}}">
                                            @csrf
                                            <h6>{{$plan->plan_name}}</h6>
                                            <div class="row row-cols-2 g-4">
                                                <div class="form-group">
                                                    <label class="form-label">Name</label>
                                                    <input type="text" name="plan_name" value="{{$plan->plan_name}}" class="form-control" id="">
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-label">Price</label>
                                                    <input type="text" name="amount" value="{{$plan->amount}}" class="form-control" id="">
                                                </div>
                                            </div>

                                            <button class="btn btn-primary">Update</button>
                                        </form>
                                    </div>
                                </div>
                                @empty
                                @endforelse
                        <!-- </div>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
@stop
