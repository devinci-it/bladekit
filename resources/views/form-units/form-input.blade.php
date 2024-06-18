 @use('Devinci\Bladekit\Helpers\PathHelper')

 @push('styles')
     <style>
         .form-group {
             margin-bottom: 1rem;
         }

         .form-control {
             width: 100%;
             padding: 0.5rem;
             margin-top: 0.25rem;
             border: 1px solid #ccc;
             border-radius: 4px;
             position: relative;
         }

         .form-control-icon {
             position: absolute;
             top: 50%;
             right: 10px;
             transform: translateY(-50%);
             pointer-events: none;
         }

         .text-danger {
             color: #e3342f;
             font-size: 0.875rem;
         }
     </style>
 @endpush

 <div class="form-group">
     <label for="{{ $name }}"
         @if ($hideLabel) style="display:none;" @endif>{{ $label }}</label>
     <div style="position: relative;">
         <input type="{{ $isPassword ? 'password' : $type }}" id="{{ $name }}" name="{{ $name }}"
             value="{{ old($name, $value) }}" placeholder="{{ $placeholder ?: ($hideLabel ? $label : '') }}"
             @if ($required) required @endif {{ $attributes->merge(['class' => 'form-control']) }}>

         @if ($icon)

         @bladekitIcon("$icon") 
         @endif
     </div>
     @error($name)
         <span class="text-danger">{{ $message }}</span>
     @enderror
 </div>
