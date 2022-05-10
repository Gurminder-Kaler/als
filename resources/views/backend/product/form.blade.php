<div class="row">
  <div class="col-md-6">
    <div class="form-group{{ $errors->has('title') ? ' has-error' : ''}}">
    {!! Form::label('title', 'Title: ', ['class' => 'control-label']) !!}
    {!! Form::text('title', null, ['class' => 'form-control', 'required' => 'required']) !!}
    {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
    </div>

  </div>
  <div class="col-md-3">
    <div class="form-group{{ $errors->has('max_no_of_products') ? ' has-error' : ''}}">
    {!! Form::label('max_no_of_products', 'Max. No. of Products: ', ['class' => 'control-label']) !!}
    {!! Form::number('max_no_of_products', null, ['class' => 'form-control', 'required' => 'required']) !!}
    {!! $errors->first('max_no_of_products', '<p class="help-block">:message</p>') !!}
    </div>

  </div>
</div>
<div class="row">
  <div class="col-md-6">
      <div class="form-group{{ $errors->has('price') ? ' has-error' : ''}}">
          {!! Form::label('price', 'Price Per piece (CAD): ', ['class' => 'control-label']) !!}
          {!! Form::number('price', null, ['class' => 'form-control', 'required' => 'required']) !!}
          {!! $errors->first('price', '<p class="help-block">:message</p>') !!}
      </div>
  </div>
  <div class="col-md-6">
      <div class="form-group{{ $errors->has('discount') ? ' has-error' : ''}}">
            {!! Form::label('discount', 'Discount % : ', ['class' => 'control-label']) !!}
            {!! Form::number('discount', null, ['class' => 'form-control', 'required' => 'required']) !!}
            {!! $errors->first('discount', '<p class="help-block">:message</p>') !!}
      </div>
  </div>
</div>
 
@if($formMode!=="edit")
<div class="row">
    <div class="col s6">
       {!! Form::label('category_id', 'Select Category: ', ['class' => 'control-label']) !!}
        <select name="category_id" class="form-control" >
          @foreach($allcategories as $cat)
          <option value="{{$cat->id}}" >{{$cat->title}}</option>
          @endforeach
        </select>
    </div> 
</div>
<div class="row pt-4">
  <div class="col s6 m6 l6">
    <div class="row section">
      <div class="col s12 m12 l12">
        FEATURED IMAGE: (Recommended Size Approx: 700px X 700px)
      </div>

      <div class="col s12 m12 l12">
        <input required accept="image/*" type="file" name="img" />
      </div>
    </div>
  </div>
  <div class="col s6 m6 l6">
      <div class="row section">
         <div class="col s12 m12 l12">
          MULTIPLE IMAGE(s): (Recommended Size Approx: 700px X 700px) <span style="color:red">(Can be left empty)</span><br><br>
         
          <input type="file" id="input-file-disable-remove" name="images[]"  multiple  />
        </div>
      </div>
  </div>
</div>
@else
<div class="row">
    <div class="col s6">
       {!! Form::label('category_id', 'Select Category: ', ['class' => 'control-label']) !!}
        <select name="category_id" class="form-control" >
          @foreach($allcategories as $cat)
          <option value="{{$cat->id}}" @if($cat->id == $product->category_id) selected @endif>{{$cat->title}}</option>
          @endforeach
        </select>
    </div>
</div>
<div class="col s6 m6 l6">
    <div class="row section" style="border: 1px solid red;padding: 12px;margin-bottom: 5px;margin-top:5px;">
      <div class="col s12 m12 l12">
        FEATURED IMAGE: (Recommended Size Approx: 700px X 700px) <br>
       
        <img src="{{asset('/storage/product/'.$product->img.'')}}" alt="" style="height: 100px;width: 120px">
        <input type="file" name="img" />
      </div>
    </div>
  </div> 
    <div class="col s12 m12 l12" style="border: 1px solid red;padding: 12px;">
          MULTIPLE IMAGE(s): (Recommended Size Approx: 700px X 700px) <span style="color:red">(Can be left empty)</span><br>
             
      @php
      $product_img = explode(';',$product->images);
      @endphp
      @foreach($product_img as $img)
      <div class="col s3">
      <input type="hidden" style="display:none" name="img_c[]" value="{{$img}}">
         <img class="product_img{{$img}}" style="width:100px;height: 70px" src="{{asset('/storage/product/images/'.$img.'') }}" alt="...">
         <a class="btn btn-sm btn-danger text-white" onclick="$(this).parent().remove()">Remove</a>

      </div>
      @endforeach
      <div class="row" style="border: 1px solid pink;padding: 24px;margin:2px;">
          <div class="col-md-6">
              <p>Add More Images from here  <input class="pt-2" type="file" multiple name="images[]" /></p>
            
          </div>
      </div> 
  </div>
@endif
<div class="form-group{{ $errors->has('desc') ? ' has-error' : ''}} mt-2">
    {!! Form::label('desc', 'Description: ', ['class' => 'control-label']) !!}
    {!! Form::textarea('desc', null, ['class' => 'form-control', 'required' => 'required']) !!}
    {!! $errors->first('desc', '<p class="help-block">:message</p>') !!}
</div>
 

<div class="form-group pt-4">
    {!! Form::submit($formMode === 'edit' ? 'Update' : 'Create', ['class' => 'btn btn-primary']) !!}
</div>
