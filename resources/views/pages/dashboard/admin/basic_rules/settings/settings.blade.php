@extends('layouts.dashboard_layout')
@section('title', 'Settings')
@section('content')

    <div class="container pt-4">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h3>Settings</h3>
                        @if (session('success'))
                            <div id="success" class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        <form action="{{ route('settings.update') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="title">Title</label>
                                    <input type="text" class="form-control" id="title" name="title"
                                        value="{{ $settings->title }}" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                        value="{{ $settings->email }}" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="phone">Phone</label>
                                    <input type="text" class="form-control" id="phone" name="phone"
                                        value="{{ $settings->phone }}" required>
                                </div>

                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="description">Description</label>
                                    <textarea class="form-control summernote" id="description" name="description" required>{{ $settings->description }}</textarea>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="currency">Currency</label>
                                    <input type="text" class="form-control" id="currency" name="currency"
                                        value="{{ $settings->currency }}" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="currency_symbol">Currency Symbol</label>
                                    <input type="text" class="form-control" id="currency_symbol" name="currency_symbol"
                                        value="{{ $settings->currency_symbol }}" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="address">Address</label>
                                    <input type="text" class="form-control" id="address" name="address"
                                        value="{{ $settings->address }}" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="facebook">Facebook</label>
                                    <input type="text" class="form-control" id="facebook" name="facebook"
                                        value="{{ $settings->facebook }}">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="twitter">Twitter</label>
                                    <input type="text" class="form-control" id="twitter" name="twitter"
                                        value="{{ $settings->twitter }}">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="instagram">Instagram</label>
                                    <input type="text" class="form-control" id="instagram" name="instagram"
                                        value="{{ $settings->instagram }}">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="linkedin">LinkedIn</label>
                                    <input type="text" class="form-control" id="linkedin" name="linkedin"
                                        value="{{ $settings->linkedin }}">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="youtube">YouTube</label>
                                    <input type="text" class="form-control" id="youtube" name="youtube"
                                        value="{{ $settings->youtube }}">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="logo">Logo</label>
                                    <input type="file" class="form-control-file" id="logo" name="logo">
                                    @if ($settings->logo)
                                        <img src="{{ asset($settings->logo) }}" alt="Logo" class="img-fluid mt-2"
                                            style="max-width: 100px;">
                                    @endif
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="favicon">Favicon</label>
                                    <input type="file" class="form-control-file" id="favicon" name="favicon">
                                    @if ($settings->favicon)
                                        <img src="{{ asset($settings->favicon) }}" alt="Favicon" class="img-fluid mt-2"
                                            style="max-width: 32px;">
                                    @endif
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Update Settings</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
