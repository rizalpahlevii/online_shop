@extends('frontend.layout.template')
@section('page','My Profile')
@section('content')
<div class="container">
    <div class="row mt-3">
        <div class="col-sm-6">
            @if (Session::has('message'))
                {!!Session::get('message')!!}
            @endif
        </div>
    </div>
    <div class="row mt-2 mb-2">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title mb-4">
                        My Profile
                    </h6>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="text-center">
                                <img src="{{asset('images')}}/avatar-1.png" alt="Profile" class="img-sm rounded-circle border" >
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="row">
                                <div class="col-md-12">
                                        
                                    <table>
                                        <tr>
                                            <th>Name</th>
                                            <td>:</td>
                                            <td>{{Auth::user()->name}}</td>
                                        </tr>
                                        <tr>
                                            <th>Email</th>
                                            <td>:</td>
                                            <td>{{Auth::user()->email}}</td>
                                        </tr>
                                    </table>
                                    
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <div class="row">
                            <div class="col-md-12">
                                    <ul class="list-inline float-right">
                                        <li><a href="{{route('fe.profile_edit')}}" data-toggle="tooltip" title="Edit Profile"><i class="fa fa-cog"></i></a></li>
                                    </ul>
                                </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="row">
                <div class="col-md-12">
                        <div class="card">
                                <div class="card-body">
                                    <h6 class="card-title mb-4">
                                    User Information </h6>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="phone">Hp</label>
                                                    <input type="text" name="hp" value="{{Auth::user()->phone}}" class="form-control" readonly style="cursor:no-drop;">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="address">Alamat</label>
                                                    <input type="text" name="hp" value="{{Auth::user()->address}}" class="form-control" readonly style="cursor:no-drop;">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="postal_code">Kode Pos</label>
                                                    <input type="text" name="hp" value="{{Auth::user()->postal_code}}" class="form-control" readonly style="cursor:no-drop;">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="register_datetime">Register Datetime</label>
                                                    <input type="text" name="hp" value="{{Auth::user()->register_datetime}}" class="form-control" readonly style="cursor:no-drop;">
                                                </div>
                                            </div>
                                        </div>
                                </div>
                            </div>
                </div>
                <div class="col-md-12 mt-2">
                        <div class="card">
                                <div class="card-body">
                                    <h6 class="card-title mb-4">
                                    Bank Information </h6>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="phone">Bank</label>
                                                    <input type="text" name="hp" value="<?=($user->userBank) ? $user->userBank->name : '' ?>" class="form-control" readonly style="cursor:no-drop;">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="address">Account Name</label>
                                                    <input type="text" name="hp" value="<?=($user->userBank) ? $user->userBank->account_name : ''?>" class="form-control" readonly style="cursor:no-drop;">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="postal_code">Account Number</label>
                                                    <input type="text" name="hp" value="<?=($user->userBank) ? $user->userBank->account_number : ''?>" class="form-control" readonly style="cursor:no-drop;">
                                                </div>
                                            </div>
                                        </div>
                                </div>
                            </div>
                </div>
            </div>
            
        </div>
    </div>
</div>
@endsection