<div id="confirm-modal" class="fixed inset-0 flex items-center justify-center z-50 hidden bg-black/40 backdrop-blur-sm transform opacity-0 transition duration-200 ease-out">
    <div class="bg-white rounded-2xl shadow-2xl p-6 w-80">
        <div class="flex items-start gap-3">
            <div class="flex h-11 w-11 items-center justify-center rounded-full bg-red-100 text-red-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-12.728 12.728M5.636 5.636l12.728 12.728" />
                </svg>
            </div>
            <div class="text-left">
                <h2 class="text-lg font-semibold text-slate-900">Confirmação</h2>
                <p id="confirm-modal-message" class="text-sm text-slate-600 mt-1">Tem certeza que deseja excluir <span class="font-semibold text-slate-900" id="confirm-modal-item-name">este item</span>?</p>
            </div>
        </div>
        <div class="mt-6 flex justify-end gap-3">
            <button id="confirm-modal-cancel" class="btn btn-secondary">Cancelar</button>
            <button id="confirm-modal-confirm" class="btn btn-danger">Excluir</button>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        let formToSubmit = null;
        const modal = document.getElementById('confirm-modal');
        const modalWrapper = modal;

        function showModal() {
            modalWrapper.classList.remove('hidden');
            requestAnimationFrame(() => {
                modalWrapper.classList.remove('opacity-0');
                modalWrapper.classList.add('opacity-100');
            });
        }

        function hideModal() {
            modalWrapper.classList.add('opacity-0');
            setTimeout(() => {
                modalWrapper.classList.add('hidden');
            }, 200);
        }

        document.querySelectorAll('.btn-excluir').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                formToSubmit = this.closest('form');
                let itemName = this.getAttribute('data-item-name') || 'este item';
                document.getElementById('confirm-modal-item-name').textContent = itemName;
                showModal();
            });
        });

        document.getElementById('confirm-modal-cancel').onclick = function() {
            hideModal();
            formToSubmit = null;
        };

        document.getElementById('confirm-modal-confirm').onclick = function() {
            if (formToSubmit) formToSubmit.submit();
            hideModal();
            formToSubmit = null;
        };
    });
</script>
