{{--
    example :
    <x-form-input-inline label="" value="" type="" name="" id="" class="" list-option="" :label-required="true"></x-form-input-inline>
--}}
@php
    $a = ['value', 'id', 'name', 'class'];
    $attr = $attributes->filter(fn ($value, $key) => !in_array($key, $a));
@endphp
@if ($type == 'text')
<div class="">
    <div class="form-group row">
        <label for="{{ $id }}" class="col-lg-3">
            {{ $label }}
            @if ($labelRequired)
            <span class="text-danger">*</span>
            @endif
        </label>
        <div class="col-lg-9">
            <input type="text" value="{{ $value }}" class="form-control @error($name) is-invalid @enderror {{ $class }}" id="{{ $id }}" name="{{ $name }}" {{ $attr }}>
            {{ $slot }}
            @error($name)
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>
</div>
@elseif($type == 'textarea')
<div class="">
    <div class="form-group row">
        <label for="{{ $id }}" class="col-lg-3">
            {{ $label }}
            @if ($labelRequired)
            <span class="text-danger">*</span>
            @endif
        </label>

        <div class="col-lg-9">
            <textarea class="form-control @error($name) is-invalid @enderror {{ $class }}" name="{{ $name }}" rows="6" {{ $attr }}>{{ $value }}</textarea>
            {{ $slot }}
            @error($name)
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>
</div>
@elseif($type == 'date')
<div class="">
    <div class="form-group row">
        <label for="{{ $id }}" class="col-lg-3">
            {{ $label }}
            @if ($labelRequired)
            <span class="text-danger">*</span>
            @endif
        </label>
        <div class="col-lg-9">
            <input type="date" value="{{ $value }}" class="form-control @error($name) is-invalid @enderror {{ $class }}" id="{{ $id }}" name="{{ $name }}" {{ $attr }}>
            {{ $slot }}
            @error($name)
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>
</div>
@elseif($type == 'email')
<div class="">
    <div class="form-group row">
        <label for="{{ $id }}" class="col-lg-3">
            {{ $label }}
            @if ($labelRequired)
            <span class="text-danger">*</span>
            @endif
        </label>

        <div class="col-lg-9">
            <input type="email" value="{{ $value }}" class="form-control @error($name) is-invalid @enderror {{ $class }}" id="{{ $id }}" name="{{ $name }}" {{ $attr }}>
            {{ $slot }}
            @error($name)
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>
</div>
@elseif($type == 'number')
<div class="">
    <div class="form-group row">
        <label for="{{ $id }}" class="col-lg-3">
            {{ $label }}
            @if ($labelRequired)
            <span class="text-danger">*</span>
            @endif
        </label>

        <div class="col-lg-9">
            <input type="number" value="{{ $value }}" class="form-control @error($name) is-invalid @enderror {{ $class }}" id="{{ $id }}" name="{{ $name }}" {{ $attr }}>
            {{ $slot }}
            @error($name)
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>
</div>
@elseif($type == 'password')
<div class="">
    <div class="form-group row">
        <label for="{{ $id }}" class="col-lg-3">
            {{ $label }}
            @if ($labelRequired)
            <span class="text-danger">*</span>
            @endif
        </label>

        <div class="col-lg-9">
            <input type="password" value="{{ $value }}" class="form-control @error($name) is-invalid @enderror {{ $class }}" id="{{ $id }}" name="{{ $name }}" {{ $attr }}>
            {{ $slot }}
            @error($name)
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>
</div>
@elseif($type == 'select')
<div class="">
    <div class="form-group row">
        <label for="{{ $id }}" class="col-lg-3">
            {{ $label }}
            @if ($labelRequired)
            <span class="text-danger">*</span>
            @endif
        </label>

        <div class="col-lg-9">
            <select class="form-control @error($name) is-invalid @enderror {{ $class }}" name="{{ $name }}" id="{{ $id }}" {{ $attr }}>
                @foreach ($listOption as $key => $val)
                <option value="{{ $key }}" @selected($value == $key)>{{ $val }}</option>
                @endforeach
            </select>
            {{ $slot }}
            @error($name)
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>
</div>
@elseif($type == 'checkbox')
<div class="">
    <div class="form-group row">
        <label for="" class="col-lg-3">
            {{ $label }}
            @if ($labelRequired)
                <span class="text-danger">*</span>
            @endif
        </label>

        @php
            $index = 0;
        @endphp
        <div class="col-lg-9">
            @foreach ($listOption as $key => $item)
            <div class="custom-control custom-checkbox d-inline-block {{ $index > 0 ? 'ml-3' : '' }} ">
                <input type="checkbox" class="custom-control-input {{ $class }}" id="custom-checkbox-{{ $id }}-{{ $index }}" name="{{ $name }}" value="{{ $key }}" @checked(in_array($key, explode("|", $value))) {{ $attr }}>
                <label class="custom-control-label" for="custom-checkbox-{{ $id }}-{{ $index }}">{{ $item }}</label>
            </div>
            @php $index++ @endphp
            @endforeach
        </div>
        {{ $slot }}
        @error($name)
            <div class="invalid-feedback d-block">
                {{ $message }}
            </div>
        @enderror
    </div>
</div>
@elseif($type == 'radio')
<div class="">
    <div class="form-group row">
        <label for="" class="col-lg-3">
            {{ $label }}
            @if ($labelRequired)
                <span class="text-danger">*</span>
            @endif
        </label>

        @php
            $index = 0;
        @endphp
        <div class="col-lg-9">
            @foreach ($listOption as $key => $item)
            <div class="custom-control custom-radio d-inline-block {{ $index > 0 ? 'ml-3' : '' }} ">
                <input type="radio" class="custom-control-input {{ $class }}" id="custom-checkbox{{ $index }}{{$name}}" name="{{ $name }}" value="{{ $key }}"  @checked($key == $value) {{ $attr }}>
                <label class="custom-control-label" for="custom-checkbox{{ $index }}{{$name}}">{{ $item }}</label>
            </div>
            @php $index++ @endphp
            @endforeach
            {{ $slot }}
            @error($name)
            <div class="invalid-feedback d-block">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>
</div>
@elseif($type == 'upload_image')
<div class="">
    <div class="form-group row">
        <label for="{{ $id }}" class="col-lg-3">
            {{ $label }}
            @if ($labelRequired)
                <span class="text-danger">*</span>
            @endif
        </label>

        <div class="col-lg-9">
            <div class="row">
                <div class="col-md-3">
                    <img src="{{ $value != '' ? $value : 'https://via.placeholder.com/200/15b3b2/FFFFFF?text=image' }}" class="img-thumbnail preview-{{ $name }} {{ $class }}" style="max-height: 200px" alt="">
                </div>
                <div class="col-md-9">
                    {{ $slot2 ?? ''}}
                </div>
            </div>
            <div class="custom-file mt-2">
                <input type="file" class="form-control" name="{{ $name }}" accept=".jpg,.png,.jpeg"
                    class="custom-file-input @error($name) is-invalid @enderror"
                    id="{{ $id }}"
                    onchange="preview('.preview-{{ $name }}', this.files[0])"
                    {{ $attr }}>
                {{ $slot }}
                @error($name)
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>
</div>
@elseif($type == 'upload_file')
<div class="">
    <div class="form-group row">
        <label for="{{ $id }}" class="col-lg-3">
            {{ $label }}
            @if ($labelRequired)
                <span class="text-danger">*</span>
            @endif
        </label>

        <div class="col-lg-9">
            <div class="input-group mt-2">
                <input type="file" class="form-control" name="{{ $name }}"
                    class="custom-file-input @error($name) is-invalid @enderror"
                    id="{{ $id }}"
                    {{ $attr }}>
                {{ $slot }}
                @error($name)
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                @if ($value !== '')
                    <div class="input-group-append">
                        <a target="_blank" href="{{ $value }}"
                            class="btn btn-sm btn-info ml-3">
                            <i class="fa-solid fa-download mr-1"></i>
                            Lihat
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@elseif($type == 'time')
<div class="">
    <div class="form-group row">
        <label for="{{ $id }}" class="col-lg-3">
            {{ $label }}
            @if ($labelRequired)
                <span class="text-danger">*</span>
            @endif
        </label>

        <div class="col-lg-9">
            <div class="custom-file mt-2">
                <input type="time" value="{{ $value }}" class="form-control @error($name) is-invalid @enderror {{ $class }}" id="{{ $id }}" name="{{ $name }}" {{ $attr }}>
                {{ $slot }}
                @error($name)
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>
</div>
@else
<p>tidak ada</p>
@endif

