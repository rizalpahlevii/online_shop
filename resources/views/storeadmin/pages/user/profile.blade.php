@extends('storeadmin.layout.template')
@section('page','Profile')
@section('content')
<div class="content-wrapper">
    <div class="content-header row"></div>
    <div class="content-body">
        <section id="basic-form-layouts">
            <div class="row match-height">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title" id="basic-layout-colored-form-control">User Profile</h4>
                            <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                            <div class="heading-elements">
                                <ul class="list-inline mb-0">
                                    <li><a data-action="collapse"><i class="icon-minus4"></i></a></li>
                                    <li><a data-action="reload"><i class="icon-reload"></i></a></li>
                                    <li><a data-action="expand"><i class="icon-expand2"></i></a></li>
                                    <li><a data-action="close"><i class="icon-cross2"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-body collapse in">
                            <div class="card-block">
                                <div class="row">
                                    <div class="col-md-6">
                                        @if (Session::has('status'))
                                            {!!Session::get('status')!!}
                                        @endif
                                    </div>
                                </div>
                            <form class="form" method="POST" action="{{route('admin.profile_update',auth()->user()->id)}}">
                                @csrf
                                @method('PUT')
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="email">Email</label>
                                                    <input type="text" id="email" class="form-control" placeholder="Email" name="email" value="{{auth()->user()->email}}" readonly>
                                                   
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="username">Username</label>
                                                    <input type="text" id="username" class="form-control" placeholder="Username" name="username" value="{{auth()->user()->username}}" readonly>
                                                     
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="name">Name</label>
                                                    <input type="text" id="name" class="form-control" placeholder="name" name="name" value="{{auth()->user()->name}}" >
                                                    @error('name')
                                                        <p class="text-danger">{{$errors->first('name')}}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="birthday">Birthday</label>
                                                    <input type="date" id="birthday" class="form-control" placeholder="birthday" name="birthday" value="<?=auth()->user()->birthday?>">
                                                    @error('birthday')
                                                        <p class="text-danger">{{$errors->first('birthday')}}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="sex">Sex</label>
                                                    
                                                    <select name="sex" id="sex" class="form-control">
                                                        <option disabled selected>--Choose--</option>
                                                        <option value="male" <?=(auth()->user()->sex === "male") ? 'selected':'';?>>Male</option>
                                                        <option value="female" <?=(auth()->user()->sex === "female") ? 'selected':'';?>>Female</option>
                                                        <option value="other" <?=(auth()->user()->sex ==="other") ? 'selected':'';?>>Other</option>
                                                    </select>
                                                    @error('sex')
                                                        <p class="text-danger">{{$errors->first('sex')}}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="phone">Phone</label>
                                                    <input type="text" id="phone" class="form-control" placeholder="phone" name="phone" value="<?=auth()->user()->phone?>">
                                                    @error('phone')
                                                        <p class="text-danger">{{$errors->first('phone')}}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="address">Address</label>
                                                <textarea name="address" id="address" cols="10" rows="5" class="form-control">{{auth()->user()->address}}</textarea>
                                                @error('address')
                                                        <p class="text-danger">{{$errors->first('address')}}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="postal_code">Postal Code</label>
                                                    <input type="text" id="postal_code" class="form-control" placeholder="postal_code" name="postal_code" value="<?=auth()->user()->postal_code?>">
                                                    @error('postal_code')
                                                        <p class="text-danger">{{$errors->first('postal_code')}}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
        
                                    </div>
        
                                    <div class="form-actions right">
                                        <button type="button" class="btn btn-warning mr-1">
                                            <i class="icon-cross2"></i> Cancel
                                        </button>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="icon-check2"></i> Update
                                        </button>
                                    </div>
                                </form>
        
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        
        
        </section>
    </div>
</div>
@endsection