@php
    $value = isset($fieldModel) ? $fieldModel->{$fieldName} : old($fieldName);
    if (isset($fieldValue)) {
        $value = $fieldValue;
    }
    if (isset($fieldType) && $fieldType == 'password') {
        $value = '';
    }
@endphp
<div class="form-group row">
    <label for="{{ $fieldName }}" class="col-md-2 col-form-label text-md-right">{{{ $fieldTitle }}}</label>

    <div class="col-md-8">
        <input
            type="{{ $fieldType ?? 'text' }}"
            class="form-control{{ $errors->has($fieldName) ? ' is-invalid' : '' }}"
            name="{{ $fieldName }}"
            value="{{ $value }}"
        >

        @if ($errors->has($fieldName))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first($fieldName) }}</strong>
            </span>
        @endif
    </div>
</div>
