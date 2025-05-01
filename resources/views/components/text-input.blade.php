@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'form-control',"style"=>"border:1px solid crimson"]) }}>
