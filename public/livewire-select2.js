/**
 * Inicializa Select2 e sincroniza com Livewire
 *
 * @param {string} selector - Ex: "#customer_id" ou ".select2"
 * @param {string} livewireProperty - Nome da propriedade Livewire a atualizar
 * @param {string|null} listenEvent - Nome de evento global (window) para reinicializar (opcional)
 */
function initSelect2(selector, livewireTarget, listenEvent = null) {
    const runInit = () => {
        const $el = $(selector);
        if (!$el.length) return;

        // Reset antes de recriar
        if ($el.hasClass("select2-hidden-accessible")) {
            $el.select2('destroy');
        }
        let parentModal = $el.closest('.modal, .tw-modal, [data-modal]');
        let dropdownParent = parentModal.length ? parentModal : $(document.body);

        $el.select2({
            theme: 'classic',
            placeholder: $el.data('placeholder') || "Selecionar...",
            allowClear: true,
            width: '100%',
            dropdownParent: dropdownParent // fix para modais
        });


        // Atualiza Livewire no change
        $el.off('change').on('change', function () {
            const value = $(this).val();

            if (typeof window.Livewire !== 'undefined') {
                const component = Livewire.find($el.closest('[wire\\:id]').attr('wire:id'));

                if (typeof livewireTarget === 'string') {
                    component.set(livewireTarget, value);
                } else if (livewireTarget && typeof livewireTarget === 'object' && livewireTarget.method) {
                    component.call(livewireTarget.method, value);
                }
            }
        });
    };

    // Primeira carga
    document.addEventListener("livewire:initialized", runInit);

    // Reinit sempre que Livewire atualizar o DOM
    document.addEventListener("livewire:initialized", () => {
        Livewire.hook('morph.updated', runInit);
    });

    // Reinicializar via evento custom (se fornecido)
    if (listenEvent) {
        window.addEventListener(listenEvent, runInit);
    }
}

// Exporta para uso global
window.initSelect2 = initSelect2;
