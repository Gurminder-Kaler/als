
<div class="row">
    <div class="col-md-12">
        <div class="input-field">
        <label for="address">Address</label>
        <input class="form-control" required type="text" id="address" value="{{$siteSetting->address}}" name="address">                     
        </div>
    </div>
    <div class="col-md-6">
        <div class="input-field">
        <label for="phone_one">Phone 1</label>
        <input class="form-control" type="number" required id="phone_one" value="{{$siteSetting->phone_one}}" name="phone_one">                     
        </div>
    </div>
    <div class="col-md-6">
        <div class="input-field">
        <label for="phone_two">Phone 2 (used on single product page)</label>
        <input class="form-control" type="number" required id="phone_two" value="{{$siteSetting->phone_two}}" name="phone_two">                     
        </div>
    </div>
    <div class="col-md-6">
        <div class="input-field">
        <label for="contact_email">Contact Email</label>
        <input class="form-control" required type="text" id="contact_email" value="{{$siteSetting->contact_email}}" name="contact_email">                     
        </div>
    </div>  
    <div class="col-md-6">
        <div class="input-field">
        <label for="twitter">Twitter</label>
        <input class="form-control" required type="text" id="twitter" value="{{$siteSetting->twitter}}" name="twitter">                     
        </div>
    </div> 
    <div class="col-md-6">
        <div class="input-field">
        <label for="facebook">Facebook</label>
        <input class="form-control" required type="text" id="facebook" value="{{$siteSetting->facebook}}" name="facebook">                     
        </div>
    </div> 
    <div class="col-md-6">
        <div class="input-field">
        <label for="instagram">Instagram</label>
        <input class="form-control" required type="text" id="instagram" value="{{$siteSetting->instagram}}" name="instagram">                     
        </div>
    </div> 
    <div class="col-md-6">
        <div class="input-field">
        <label for="youtube">Youtube</label>
        <input class="form-control" required type="text" id="youtube" value="{{$siteSetting->youtube}}" name="youtube">                     
        </div>
    </div> 
    <div class="col-md-6">
        <div class="input-field">
        <label for="map_address">Map Address</label>
        <input class="form-control" required type="text" id="map_address" value="{{$siteSetting->map_address}}" name="map_address">                     
        </div>
    </div> 
    <div class="col-md-6">
        <div class="input-field">
        <label for="whatsapp">Whats app number (used in footer)</label>
        <input class="form-control" required type="text" id="whatsapp" value="{{$siteSetting->whatsapp}}" name="whatsapp">                     
        </div>
    </div>
    <div class="col-md-12">
        <div class="input-field">
        <label for="whatsapp">Privacy Policy</label>
        <textarea name="privacy_policy" id="privacy_policy" cols="140" rows="10">{!!$siteSetting->privacy_policy!!}</textarea>                 
        </div>
    </div>
    
    <br>
    <div class="divider mb-1 mt-1"></div>

    <div class="row">
        <div class="col-md-12">
            <div class="row section">
            <div class="col-md-12">
                <h2>Logo</h2>
            </div>
            <div class="col-md-12">
                <img src="{{url('/storage/logo/'.$siteSetting->logo.'')}}" alt="" style="height:140px;width:130px">
            </div>
            <div class="col-md-12">
                <input class="form-control" type="file"  name="logo" />
            </div>
            </div>
        </div> 
    </div>

    <div class="form-group pt-4">
    {!! Form::submit($formMode === 'edit' ? 'Update' : 'Create', ['class' => 'btn btn-primary btn-sm']) !!}
    </div>
</div>  