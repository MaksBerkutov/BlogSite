<div class="mb-3">
    <label for="{{$name}}" class="form-label">{{ucwords($name)}}</label>
    <input id="{{$name}}" type="{{$type}}" class="form-control @error($name) is-invalid @enderror" name="{{$name}}" placeholder="{{ucwords($name,'_')}}" value="{{old($name)}}">
    @error($name)
    <div class="invalid-feedback">{{$message}}</div>
    @enderror
</div>
