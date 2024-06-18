
 @php
    /**
          * Modal component.
          *
          * This component creates a modal overlay with customizable content.
          * It accepts a 'name' parameter to differentiate between multiple instances.
          *
          * Usage:
          * ```
          * <x-modal name="uniqueName">
          *     <x-slot name="title">
          *         Modal Title
          *     </x-slot>
          *     <p>This is the content of the modal.</p>
          * </x-modal>
          * ```
          *
          * @param {string} name - The unique identifier for the modal instance.
          * @param {string} title - Modal header.
          */
@endphp

@props(['name' => '', 'title' => ''])

@php
    $modalId = 'modal_' . $name;
    $closeId = 'closeBtn_' . $name;
    $confirmId = 'confirmBtn_' . $name;
@endphp

<div class="modal-overlay" id="modalOverlay_{{ $name }}" style="display: none;">
    <div class="modal" id="{{ $modalId }}">
        <div class="modal-header">
            <h2 class="title-small-text">{{ $title ?? 'Modal Title' }}</h2>
            <button class="close-btn btn" id="{{ $closeId }}">&times;</button>
        </div>
        <div class="modal-body">
            {{ $slot }}
        </div>
        <div class="modal-footer">
            <button class="confirm-btn btn round" id="{{ $confirmId }}">Confirm</button>
        </div>
    </div>
</div>

@once
@push('styles')
    <style>
        /* Animation for modal shake */
        @keyframes shake {
            0% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            50% { transform: translateX(5px); }
            75% { transform: translateX(-3px); }
            100% { transform: translateX(0); }
        }

        .shake {
            animation: shake 0.3s ease-in-out;
        }

        /* Styles for the modal overlay */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(5px);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }

        /* Styles for the modal itself */
        .modal {
            background: #fff;
            padding: 20px;
            border-radius: 5px;
            width: 500px;
            max-width: 80%;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #eee;
            padding-bottom: 10px;
        }

        .modal-body {
            margin: 20px 0;
        }

        .modal-footer {
            display: flex;
            justify-content: flex-end;
            border-top: 1px solid #eee;
            padding-top: 10px;
        }

        /* Close button styles */
        .close-btn, .confirm-btn {
            background: none;
            border: none;
            font-size: 1.2em;
            cursor: pointer;
        }

        .confirm-btn {
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 1em;
            margin-left: 10px;
        }


        /* Disable scrolling on the body when modal is open */
        body.modal-open {
            overflow: hidden;
        }
    </style>
@endpush


@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {

        // Function to create modal functions dynamically
        function createModalFunctions(modalName) {
            const overlay = document.getElementById('modalOverlay_' + modalName);
            const modalElement = overlay.querySelector('.modal');
            const closeElement = modalElement.querySelector('.close-btn');
            const confirmElement = modalElement.querySelector('.confirm-btn');

            function showModal() {
                overlay.style.display = 'flex';
                document.body.classList.add('modal-open');
            }

            function hideModal() {
                overlay.style.display = 'none';
                document.body.classList.remove('modal-open');
            }

            function shakeModal() {
                modalElement.classList.add('shake');
                setTimeout(() => {
                    modalElement.classList.remove('shake');
                }, 500);
            }

            closeElement.addEventListener('click', hideModal);
            confirmElement.addEventListener('click', hideModal);

            overlay.addEventListener('click', function (event) {
                if (event.target === overlay) {
                    shakeModal();
                }
            });

            return {
                showModal,
                hideModal,
                shakeModal
            };
        }

        // Add event listener to handle modal opening using event delegation
        document.addEventListener('click', function (event) {
            const button = event.target.closest('[data-modal-target]');
            if (button) {
                const modalName = button.getAttribute('data-modal-target');
                const modalFunctions = window[`modalFunctions_${modalName}`];
                if (modalFunctions) {
                    modalFunctions.showModal();
                } else {
                    console.error(`Modal functions for "${modalName}" not found.`);
                }
            }
        });

        // Example of exporting modal functions for each modal object
        // Replace this with your specific modal setup logic in your application
        const modalButtons = document.querySelectorAll('[data-modal-target]');

        modalButtons.forEach(button => {
            const modalName = button.getAttribute('data-modal-target');
            window[`modalFunctions_${modalName}`] = createModalFunctions(modalName);
        });

    });
</script>
@endpush
@endonce

