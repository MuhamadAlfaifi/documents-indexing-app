@props([ 'name' => '', 'value' => '', 'submit' => false ])

<input @class([
  'm-0 p-0 border-0 focus:border-transparent focus:ring-0 focus:outline-none bg-transparent',
  $attributes['class'],
]) {{ $attributes }} type="date" lang="ar-SA" {{ str('onchange=event.target.form.submit()')->if($submit) }} format="Y-m-d" min="{{ request()->tools()->min()->format('Y-m-d') }}" max="{{ request()->tools()->max()->format('Y-m-d') }}" name="{{ $name }}" value="{{ $value }}" />