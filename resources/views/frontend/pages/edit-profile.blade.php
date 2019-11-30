@extends('frontend.layout.template')
@section('page','Edit Profile')
@section('content')
    <div class="container">
        <form action="{{route('fe.profileUpdate')}}" method="POST">
            @csrf
            <div class="row mt-4 mb-3">
                <div class="col-md-6">
                    <div class="card">
                        <h5 class="card-header">Informasi User</h5>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="name">Nama</label>
                                        <input type="text" name="name" value="{{Auth::user()->name}}" class="form-control @error('name') 'is-invalid' @enderror" id="name">
                                        @error('name')
                                            <span class="text-danger">{{$errors->first('name')}}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="text" name="email" value="{{Auth::user()->email}}" class="form-control @error('email') 'is-invalid' @enderror" id="email" readonly style="cursor: no-drop;">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="username">Username</label>
                                        <input type="text" name="username" value="{{Auth::user()->username}}" class="form-control @error('username') 'is-invalid' @enderror" id="username" readonly style="cursor: no-drop;">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="phone">Hp</label>
                                        <input type="text" name="phone" value="{{Auth::user()->phone}}" class="form-control @error('phone') 'is-invalid' @enderror" id="phone" >
                                        @error('phone')
                                            <span class="text-danger">{{$errors->first('phone')}}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="postal_code">Kode Pos</label>
                                        <input type="text" name="postal_code" value="{{Auth::user()->postal_code}}" class="form-control @error('postal_code') 'is-invalid' @enderror" id="postal_code" >
                                        @error('postal_code')
                                            <span class="text-danger">{{$errors->first('postal_code')}}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="postal_code">Address</label>
                                        <textarea name="address" id="address" cols="30" rows="5" class="form-control @error('address') 'is-invalid' @enderror">{{Auth::user()->address}}</textarea>
                                        @error('address')
                                            <span class="text-danger">{{$errors->first('address')}}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <h5 class="card-header">Informasi Bank</h5>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="bank_name">Nama Bank</label>
                                        <input type="text" name="bank_name" value="<?=($userBank->userBank) ? $userBank->userBank->name:'';?>" class="form-control @error('bank_name') 'is-invalid' @enderror" id="bank_name">
                                        @error('bank_name')
                                            <span class="text-danger">{{$errors->first('bank_name')}}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="account_name">Nama Akun</label>
                                        <input type="text" name="account_name" value="<?=($userBank->userBank) ? $userBank->userBank->account_name:'';?>" class="form-control @error('account_name') 'is-invalid' @enderror" id="account_name">
                                        @error('account_name')
                                            <span class="text-danger">{{$errors->first('account_name')}}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="account_number">Nomer Akun</label>
                                        <input type="text" name="account_number" value="<?=($userBank->userBank) ? $userBank->userBank->account_number:'';?>" class="form-control @error('account_number') 'is-invalid' @enderror" id="number_account">
                                        @error('account_number')
                                            <span class="text-danger">{{$errors->first('account_number')}}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-12">
                    <input type="submit" name="submit" class="btn btn-primary float-right">
                    <a href="{{route('fe.myprofile')}}" class="btn btn-light float-right mr-2">Back</a>
                </div>
            </div>
        </form>
    </div>
@endsection