@props([ 'checked' => false, 'type' => 'radio', 'name' => '', 'value' => '', 'submit' => false, 'icon' => null ])

@if($checked)
{{ $icon }}
@endif
<label @class([
  'block px-4 py-2 text-sm cursor-pointer hover:bg-gray-100', 
  'font-medium text-gray-900' => $checked,
  'text-gray-500' => !$checked,
 ]) tabindex="-1" {{ $attributes }}> 
  <input {{ str('onchange=event.target.form.submit()')->if($submit) }} type="{{ $type }}" name="{{ $name }}" value="{{ $value }}" @checked($checked) class="sr-only" />

  @isset($icon)
    <div class="pr-6">
      {{ $slot }}
    </div>
  @else
    {{ $slot }}
  @endisset
</label>